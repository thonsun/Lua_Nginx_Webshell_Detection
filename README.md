### 基于OpenResty的waf+webshell detected 系统开发

#### 背景

对于openresty的介绍：[ref](https://openresty.org/)

OpenResty® 是一个基于 [Nginx](https://openresty.org/cn/nginx.html) 与 Lua 的高性能 Web 平台，其内部集成了大量精良的 Lua 库、第三方模块以及大多数的依赖项。用于方便地搭建能够处理超高并发、扩展性极高的动态 Web 应用、Web 服务和动态网关。

OpenResty® 通过汇聚各种设计精良的 [Nginx](https://openresty.org/cn/nginx.html) 模块（主要由 OpenResty 团队自主开发），从而将 [Nginx](https://openresty.org/cn/nginx.html) 有效地变成一个强大的通用 Web 应用平台。这样，Web 开发人员和系统工程师可以使用 Lua 脚本语言调动 [Nginx](https://openresty.org/cn/nginx.html) 支持的各种 C 以及 Lua 模块，快速构造出足以胜任 10K 乃至 1000K 以上单机并发连接的高性能 Web 应用系统。

![waf架构](../images/6d579ff4gw1f3wljbt257j20rx0pa77c.jpg)

此处的思想为：

服务器A : 192.168.40.133 LAMP的内容网站(内网)

服务器B:  192.168.40.131 Nginx 反向代理服务器

通过OpenResty：lua 对Nginx 模块进行拓展，让作为反向代理服务器B在转发流量的时候进行流量的检测，并对webshell等危害服务器A的流量进行 截断。用到的主要为：

* python3: 

    pymysql：写入数据库，mysql 的regexp的查询 [ref](https://blog.csdn.net/m0_37645820/article/details/75268972) 注意编程sql="..." 的为mysql的正则规范，而不是lua的规范

    requests,BeautifulSoup4：通过python的一个增量爬虫对开发完毕的网站A进行结构爬取（结构相对稳定）,craw()

* lua:

    luajit: 一个lua的即时解析器，相当于lua（安装了这个openresty自带了就不用装lua的环境了）

    opm：openresty集成的包管理模块，相当于lua的luarock

    net.url: lua的url解析

    resty.mysql：在access层查询网站结构数据库

#### openresty 安装指南

包含的基础组件：Nginx + luajit + opm。openresty的安装参考：[ref](https://www.howtoing.com/how-to-use-the-openresty-web-framework-for-nginx-on-ubuntu-16-04)

1.基础安装

```shell
#前期准备
mkdir -p ~/data/src
cd ~/data/src

sudo apt-get install libpcre3-dev libssl-dev perl make build-essential curl
sudo apt-get install mysql-server mysql-client
sudo apt-get install libmysqlclient-dev # mysql的开发包

# libdrizzle支持
http://openresty.org/download/drizzle7-2011.07.21.tar.gz
tar xzvf drizzle7-2011.07.21.tar.gz
cd drizzle7-2011.07.21/
./configure --without-server
make libdrizzle-1.0
sudo make install-libdrizzle-1.0

# openresty安装
wget https://openresty.org/download/openresty-1.15.8.2.tar.gz
tar -xzf openresty-1.15.8.2.tar.gz
cd openresty-1.15.8.2
# .configure --help可以查看编译选项 对应模块的开启
./configure --with-debug --with-http_iconv_module --with-libdrizzle=/usr/local --with-http_drizzle_module --with-luajit --with-pcre-jit \ 
--with-http_realip_module --with-http_v2_module  --with-http_geoip_module \
--with-http_stub_status_module --with-http_sub_module --with-http_gzip_static_module \
--without-mail_pop3_module --without-mail_imap_module --without-mail_smtp_module
make
sudo make install # 默认为/usr/local/openresty
```

2.设置openresty为系统服务

此处的openresty为编译安装好的Nginx的链接文件：

```shell
lrwxrwxrwx 1 root root    37 10月 30 15:15 openresty -> /usr/local/openresty/nginx/sbin/nginx
```

将包含二进制文件的所有openresty的bin目录加入系统变量：

```shell
vim ~/.bashrc
export PATH=/usr/local/openresty/bin:/usr/local/openresty/luajit/bin:$PATH
```

重启终端即可实现

注：有时候在sudo opm安装失败原因是 sudo make install :opm包默认安装路径site为root用户，可以对该目录进行权限变更：`chown|chgrp|chmod -R kali sites #递归` 



向系统注册服务：

```shell
vim ~/.vimrc

set ts=4
set expandtab
set number

sudo vim /etc/systemd/system/openresty.service

# Stop dance for OpenResty
# A modification of the Nginx systemd script
# =======================
#
# ExecStop sends SIGSTOP (graceful stop) to the Nginx process.
# If, after 5s (--retry QUIT/5) OpenResty is still running, systemd takes control
# and sends SIGTERM (fast shutdown) to the main process.
# After another 5s (TimeoutStopSec=5), and if OpenResty is alive, systemd sends
# SIGKILL to all the remaining processes in the process group (KillMode=mixed).
#
# Nginx signals reference doc:
# http://nginx.org/en/docs/control.html
#
[Unit]
Description=A dynamic web platform based on Nginx and LuaJIT.
After=network.target

[Service]
Type=forking
PIDFile=/run/openresty.pid
ExecStartPre=/usr/local/openresty/bin/openresty -t -q -g 'daemon on; master_process on;'
ExecStart=/usr/local/openresty/bin/openresty -g 'daemon on; master_process on;'
ExecReload=/usr/local/openresty/bin/openresty -g 'daemon on; master_process on;' -s reload
ExecStop=-/sbin/start-stop-daemon --quiet --stop --retry QUIT/5 --pidfile /run/openresty.pid
TimeoutStopSec=5
KillMode=mixed

[Install]
WantedBy=multi-user.target

sudo systemctl daemon-reload
sudo systemctl start|status|restart|reload|stop openresty
sudo systemctl enable openresty
```

#### nginx的配置

1. 作为服务器

    nginx.conf

    ```shell
    user www-data;
    worker_processes  auto;
    pid /run/openresty.pid;
    
    events {
        worker_connections  1024;
    }
    
    http {
        include       mime.types;
        default_type  application/octet-stream;
    
        sendfile        on;
        tcp_nopush      on;
        tcp_nodelay     on;
    
        keepalive_timeout  65;
    
        ssl_protocols TLSv1 TLSv1.1 TLSv1.2; # Dropping SSLv3, ref: POODLE
        ssl_prefer_server_ciphers on;
    
        access_log /var/log/openresty/access.log;
        error_log /var/log/openresty/error.log;
    
        gzip  on;
        gzip_disable "msie6";
    
        include ../sites/*.conf;
    }
    ```

    sites目录下为所有虚拟主机：*.conf

    ```shell
    server {
        # Listen on port 80.
        listen 80 default_server;
        listen [::]:80 default_server;
    
        # The document root.
        root /usr/local/openresty/nginx/html/default;
    
        # Add index.php if you are using PHP.
        index index.html index.htm;
    
        # The server name, which isn't relevant in this case, because we only have one.
        server_name _;
    
        # When we try to access this site...
        location / {
            # ... first attempt to serve request as file, then as a directory,
            # then fall back to displaying a 404.
            try_files $uri $uri/ =404;
        }
    
        # Redirect server error pages to the static page /50x.html.
        error_page   500 502 503 504  /50x.html;
        location = /50x.html {
            root /usr/local/openresty/nginx/html;
        }
    }
    ```

2. 作为代理服务器

    只需要一个nginx.conf

    ```shell
    user www-data;
    worker_processes  auto;
    pid /run/openresty.pid;
    
    events {
        worker_connections  1024;
    }
    
    http {
        # 这里把系统自带和opm安装的第三方lua包连接进来
        lua_package_path "/usr/local/openresty/nginx/conf/waf/?.lua;/usr/local/openresty/lualib/?.lua;/usr/local/openresty/site/lualib/?.lua";
        lua_shared_dict limit 10m;
        init_by_lua_file  /usr/local/openresty/nginx/conf/waf/init.lua; 
        access_by_lua_file /usr/local/openresty/nginx/conf/waf/waf.lua;    
    
        include mime.types;
        default_type  application/octet-stream;
        log_format  main  '$remote_addr - $remote_user [$time_local] "$request" '
                          '$status $body_bytes_sent "$http_referer" '
                          '"$http_user_agent" "$http_x_forwarded_for"';
        
        sendfile        on;
        keepalive_timeout  65;
        access_log /var/log/openresty/access.log main;
        error_log /var/log/openresty/error.log;
        
    	
        if_modified_since off;
        add_header Last-Modified "";    
    
        server {
            listen 80; 
            server_name www.thonsun.com;
        
            location / { 
                # pass to docker is oK
                #proxy_pass http://localhost:9654;
                proxy_pass http://192.168.40.133:80;
        
                #expires：-1; 
    
                sub_filter_once off;
                sub_filter "http://192.168.40.133" "http://192.168.40.131";
                # set to intranet
                # proxy_redirect off;
                proxy_set_header Host $host;
                proxy_set_header X-Real-IP $remote_addr;
                proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
            }   
        }
    }
    ```

    

#### openresty 基本使用

* opm的包管理：[ref](https://github.com/openresty/opm#readme)

    ```shell
    opm search url
    opm get neturl
    ```

* nginx 的环境配置

    openresty的默认安装位置为/usr/local/openresty/ (即没有设置 configure --prefix=)

    安装完毕的目录结构：

    ```shell
    kali@kali:/usr/local/openresty$ tree -l -d
    .
    ├── bin # 主要的环境变量：加入用户path即可运行：openresty(为nginx二进制连接文件)，opm等
    |
    ├── luajit # lua 即时解析器目录
    │   ├── bin # 可以添加到环境变量的PATH
    │   ├── include
    │   │   └── luajit-2.1
    │   ├── lib
    │   │   ├── lua
    │   │   │   └── 5.1
    │   │   └── pkgconfig
    │   └── share
    │       ├── lua
    │       │   └── 5.1
    │       ├── luajit-2.1.0-beta3
    │       │   └── jit
    │       └── man
    │           └── man1
    ├── lualib # 编译安装的openresty 开启的模块在这里 如 resty.mysql
    │   ├── ngx
    │   ├── rds
    │   ├── redis
    │   └── resty
    ├── nginx # 通常的nginx的目录：此处openresty对其进行模块拓展，并自编译安装
    │   ├── client_body_temp [error opening dir]
    │   ├── conf # nginx的配置文件nginx.conf 做代理转发的时候只需单个文件
    |   |---sites # 这里作为nginx 的服务器是虚拟机机server的配置文件
    │   │   └── waf
    │   │       └── wafconf
    ├── pod # openresty对nginx 的扩展与nginx的第三方模块
    └── site # 通过opm安装的包都默认安装在这里
        ├── lualib
        │   └── net(net.url)
        ├── manifest
        └── pod
    ```


#### 演示效果

1. get webshell

    ```
    http://192.168.40.131/webshell/1.php?x=phpinfo()
    http://192.168.40.131/webshell/4.php?cmd=ls
    ```

2. post webshell

    ```
    http://192.168.40.131/webshell/2.php 4
    ```

    

#### 参考

《openresty最佳实践》：https://moonbingbing.gitbooks.io/openresty-best-practices/lua/re.html

《lua-nginx 模块api》：https://openresty-reference.readthedocs.io/en/latest/Lua_Nginx_API/#ngxresub

《反向代理与负载均衡》：https://www.magentonotes.com/nginx-configure-proxy-intranet.html

https://www.cnblogs.com/tinywan/p/6560889.html

《waf实现1》：https://www.mmuaa.com/post/85bcbf20569cacfc.html

《waf实现2》：https://lua.ren/topic/347/