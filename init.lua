require 'config'
local match = string.match
local ngxmatch=ngx.re.match
local unescape=ngx.unescape_uri
local get_headers = ngx.req.get_headers
local optionIsOn = function (options) return options == "on" and true or false end -- 查看config.lua 变量是否开启
cjson = require "cjson"
UriParser = require("net.url")
rulepath = RulePath
debug_path = Debug_file
logpath = logpath
webshellCheck = optionIsOn(webshell)
argsCheck = optionIsOn(argsCheck)
DebugOn=optionIsOn(Debug_) -- 选择是否输出调试信息
Redirect=optionIsOn(Redirect)
attacklog=optionIsOn(attackLog)
ipBlocklist=ipBlocklist
ipWhitelist=ipWhitelist
webshell_log = webshelllogfile

-----------------------规则读入---------------------------
function read_rule(var)
    file = io.open(rulepath..'/'..var,"r")
    if file==nil then
        return
    end
    t = {}
    for line in file:lines() do
        table.insert(t,line)
    end
    file:close()
    return(t)
end
argsrules=read_rule('args')
------------------------------------------------------------

----------------------输出ban waf页面-----------------------
function say_html()
    if Redirect then
        ngx.header.content_type = "text/html"
        ngx.status = ngx.HTTP_FORBIDDEN
        ngx.say(html)
        ngx.exit(ngx.status)
    end
end
------------------------------------------------------------

function write(logfile,msg)
    local fd = io.open(logfile,"a+")
    if fd == nil then return end
    fd:write(msg)
    fd:flush()
    fd:close()
    return
end

function log(method,url,data,ruletag)
    if attacklog then
        local realIp = getClientIp()
        local ua = ngx.var.http_user_agent
        local servername=ngx.var.server_name
        local time=ngx.localtime()
        if ua  then
            line = realIp.." ["..time.."] \""..method.." "..servername..url.."\" \""..data.."\"  \""..ua.."\" \""..ruletag.."\"\n"
        else
            line = realIp.." ["..time.."] \""..method.." "..servername..url.."\" \""..data.."\" - \""..ruletag.."\"\n"
        end
        local filename = logpath..'/'..servername.."_"..ngx.today().."_sec.log"
        write(filename,line)
    end
end

function getClientIp()
    IP  = ngx.var.remote_addr 
    if IP == nil then
            IP  = "unknown"
    end
    return IP
end

function args()
    if argsCheck then
        for _,rule in pairs(argsrules) do
            local args = ngx.req.get_uri_args()
            for key, val in pairs(args) do
                if type(val)=='table' then
                    local t={}
                    for k,v in pairs(val) do
                        if v == true then
                            v=""
                        end
                        table.insert(t,v)
                    end
                    data=table.concat(t, " ")
                else
                    data=val
                end
                if data and type(data) ~= "boolean" and rule ~="" and ngxmatch(unescape(data),rule,"isjo") then
                    log('GET',ngx.var.request_uri,"-",rule)
                    say_html()
                    return true
                end
            end
        end
    end
    return false
end

function whiteip()
    if next(ipWhitelist) ~= nil then
        for _,ip in pairs(ipWhitelist) do
            if getClientIp()==ip then
                return true
            end
        end
    end
        return false
end

function blockip()
    if next(ipBlocklist) ~= nil then
        for _,ip in pairs(ipBlocklist) do
            if getClientIp()==ip then
                ngx.exit(403)
                return true
            end
        end
    end
        return false
end


function debug_info(info,info1)
    local f = io.open(debug_path,"a+")
    f:write(info.." "..info1.."\n")
    f:close()
end