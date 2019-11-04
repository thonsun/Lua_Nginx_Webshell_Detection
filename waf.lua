local content_length=tonumber(ngx.req.get_headers()['content-length'])
local method=ngx.req.get_method()
local req_uri=ngx.var.request_uri
local ngxmatch=ngx.re.match
local ngxsub = ngx.re.sub
local driver = require "resty.mysql"
local cjson = require "cjson"
local num = 0 -- count for sql results
local gets_len = 0
local post_len = 0
local _schema = "http://"
local time=ngx.localtime()
local function get_req_args()
    local args = ngx.req.get_uri_args()
    debug_info("============get start "..time,"=========================")
         for key, val in pairs(args) do
             if type(val) == "table" then
                gets_len = gets_len + string.len(table.concat(val, ", "))
             else
                gets_len=gets_len+string.len(val)
             end
         end
    return
end
local function get_req_posts()
    ngx.req.read_body()
    debug_info("============post start "..time,"=========================")
    local args, err = ngx.req.get_post_args()
    if not args then
        debug_info("failed to get post args: ",err)
        return
    end
    for key, val in pairs(args) do
        if type(val) == "table" then
            post_len =post_len + string.len(table.concat(val, ", "))
        else
            post_len =post_len + string.len(val)
        end
    end
    return
end
local function sub_uri(_req_uri_) -- 转换req_uri 为mysql 的regexp可查询形式
    local u = UriParser.parse(_schema.._req_uri_)
    local _req_uri_path = u.path
    local newstr, n, err = ngx.re.sub(_req_uri_path, "[0-9]+", "[0-9]+")
    local pattern_url = ""
    if newstr then
        pattern_url = _schema.."[0-9]+.[0-9]+.[0-9]+.[0-9]+"..newstr
        debug_info("[*] sub url : ",pattern_url)
        
    else
        pattern_url = _schema.."[0-9]+.[0-9]+.[0-9]+.[0-9]+".._req_uri_
        debug_info("[*] sub url : ",err.." "..pattern_url)
    end
    return pattern_url
end

local function close_db(db)
    if not db then
        return
    end
    db:close()
end

local function select_db_linked(url,tb_check)
    local db,err = driver:new()
    if not db then
        ngx.say("new mysql errer:",err)
        return
    end
    db:set_timeout(2000)
    local props = {
        host = "127.0.0.1",
        port = 3306,
        database = "webshell",
        user = "root",
        password = "root"
    }
    local res,err,errno,sqlstate = db:connect(props)
    if not res then
        ngx.say("connect to mysql failed:",err)
        close_db(db)
        return
    end
    local sql = "select count(src) as num from "..tb_check.." where dst regexp '"..url.."'"
    debug_info("[*]sql check: ",sql)
    -- local sql = "select count(*) as num from gets where dst regexp 'http://[0-9]+.[0-9]+.[0-9]+.[0-9]+/news/show/[0-9]+.html'"
    res,err,errno,sqlstate = db:query(sql)
    if not res then
        ngx.say("select failed:",err)
        close_db(db)
        return
    end
    for i, row in ipairs(res) do
        for name, value in pairs(row) do
            num = string.format("%d",value)
            num = tonumber(num)
            -- ngx.say("select row ", i, " : ", name, " = ", value, "<br/>")
        end
    end
    -- debug :ngx.say("<br/>"..cjson.encode(res))
    close_db(db)
    return
end

local function detect_webshell()
    get_req_args()
    get_req_posts()
    local _req_uri = sub_uri(req_uri)
    debug_info("[*] method: ",method)
    debug_info("[*] linked num:"..type(num),num)
    debug_info("[*] get_args len: ",gets_len)
    debug_info("[*] post data len",post_len)
    debug_info("============end","================")
    if method == 'GET' then
        select_db_linked(_req_uri,"gets")
        if num > 0 then
            return
        elseif gets_len > 0 then
            msg = "[+] detect new webshell: GET "..req_uri.."\n"
            write(webshell_log,msg)
            say_html()
            return
        else
            return
        end
    else
        select_db_linked(_req_uri,"posts")
        if num > 0 then
            return
        elseif post_len >0 then
            msg = "[+] detect new webshell: POST "..req_uri.."\n"
            write(webshell_log,msg)
            say_html()
            return
        else
            return
        end
    end
end


-- select_db_linked("http://www.baidu.com","gets")
-- debug_info("[*]sql result",num)

if whiteip() then
elseif blockip() then
elseif ngx.var.http_Acunetix_Aspect then
    ngx.say("<h2>Oops!<h2><br><p>do not use scaner</p>")
    ngx.exit(444)
elseif ngx.var.http_X_Scan_Memo then
    ngx.say("<h2>Oops!<h2><br><p>do not use scaner</p>")
    ngx.exit(444)
elseif args() then
elseif webshellCheck then
    detect_webshell()
end

