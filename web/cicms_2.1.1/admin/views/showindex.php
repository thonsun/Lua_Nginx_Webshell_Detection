<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>后台管理</title>
<base href="<?=base_url();?>index.php/views/skin/"/>
<link href="css/wl_css.css" rel="stylesheet" type="text/css" />
</head>

<body>
<style>
h3.bh{line-height: 24px; font-size:14px; font-weight:bold;}
.search-class{padding: 15px 10px;
background: #F8FBFD none repeat scroll 0% }
</style>

<dl class="search-class" style="border-bottom:1px solid #eee">
    <h3 class='bh'>
        你好：<font color='red'><?=$this->user_info['name']?></font>欢迎登录管理后台
    </h3>
    <div style=" width:100%; height:1px; border-top:1px dashed #ccc; margin:5px 0px;"></div>
    上次登录时间：<?php if($this->user_info['logintime']==''){echo date('Y-m-d H:i:s',$this->user_info['regtime']);}else{echo date('Y-m-d H:i:s',$this->user_info['logintime']);}?> <br>
上次登录IP：<?=$this->user_info['regip']?>  <br>
登陆次数：<?=$this->user_info['hits']?> 
</dl>

<div style="padding-left:10px;padding-top:16px;">
<div style='padding-left:10px;'>
    <div class='title' style='line-height:28px;border-bottom:1px dashed #ccc;font-weight:bold;'>系统信息</div>
    <div style='line-height:28px;width:90%;padding-top:10px;'>                   
      操作系统：<?=$_SERVER['HTTP_USER_AGENT']?> <br>
	服务器软件：<?=$_SERVER['SERVER_SOFTWARE']?><br>
	MySQL 版本：<?=mysql_get_server_info()?><br>
	当前登录IP：<?=$this->input->ip_address() ?><br>	
                               
                </div>
</div>
<br />
</div>

</body>
</html>
