RulePath = "/usr/local/openresty/nginx/conf/waf/wafconf"
Debug_file = "/var/log/openresty/debug.log"
logpath="/var/log/openresty"
webshelllogfile="/var/log/openresty/webshell.log"
argsCheck="on"
webshell="off"
Debug_ = "on"
attackLog = "on"
Redirect="on" --输出banner 控制
ipWhitelist={"127.0.0.1"}
ipBlocklist={"0.0.0.0"}


html=[[
  <html xmlns="http://www.w3.org/1999/xhtml">
  <head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <title>网站防火墙</title>
  <style>
  p {
    line-height:20px;
  }
  ul{ list-style-type:none;}
  li{ list-style-type:none;}
  .round_icon{
	  width: 120px;
	  height: 120px;
	  display: flex;
	  border-radius: 50%;
	  align-items: center;
	  justify-content: center;
	  overflow: hidden;
  }
  </style>
  </head>

  <body style="font:14px/1.5 Microsoft Yahei, 宋体,sans-serif; color:#555;">
    <div style="border-radius: 20px;margin: auto;padding-top:140px;position: absolute;top: 0;left: 0;right: 0;bottom: 0; width:600px;overflow:hidden;">
			<div style=" height:40px; line-height:40px; color:#fff; font-size:16px; overflow:hidden; background:#6bb3f6; padding-left:20px;">orz,您被揪出来了</div>
			<div style="margin:auto;padding-left:450px;padding-top:260px;position: absolute;top: 0;left: 0;right: 0;bottom: 0; width:600px;overflow:hidden;">
				<img src="https://s2.ax1x.com/2019/10/30/K4WfKS.jpg" class="round_icon">
			</div>
			<div style="border:1px dashed #cdcece; border-top:none; font-size:14px; background:#fff; color:#555; line-height:24px; height:220px; padding:20px 20px 0 20px; overflow-y:auto;background:#f3f7f9;">
            <p style=" margin-top:0px; margin-bottom:0px; margin-left:0px; margin-right:0px; -qt-block-indent:0; text-indent:0px;"><span style=" font-weight:600; color:#fc4f03;">您的请求可能带有恶意，已被管理员设置拦截！</span></p>
            <p style=" margin-top:0px; margin-bottom:0px; margin-left:0px; margin-right:0px; -qt-block-indent:0; text-indent:0px;">可能原因：您提交的内容包含危险的攻击请求</p>
            <p style=" margin-top:12px; margin-bottom:12px; margin-left:0px; margin-right:0px; -qt-block-indent:1; text-indent:0px;">如何解决：</p>
            <ul style="margin-top: 0px; margin-bottom: 0px; margin-left: 0px; margin-right: 0px; -qt-list-indent: 1;">
				<li style=" margin-top:12px; margin-bottom:0px; margin-left:0px; margin-right:0px; -qt-block-indent:0; text-indent:0px;">1）检查提交内容；</li>
				<li style=" margin-top:0px; margin-bottom:0px; margin-left:0px; margin-right:0px; -qt-block-indent:0; text-indent:0px;">2）如网站托管，请联系空间提供商；</li>
				<li style=" margin-top:0px; margin-bottom:0px; margin-left:0px; margin-right:0px; -qt-block-indent:0; text-indent:0px;">3）普通网站访客，请联系网站管理员；</li>
			</ul>
          </div>        
    </div>
  </body>
</html>

]]