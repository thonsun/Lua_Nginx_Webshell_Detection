<?php $this->load->view('head');?>
</div>
<!--banner-->
<div class="towBanner">
	<div class="towBannerBox" ><img src="upload/<?=$top_category['image']?>" alt="<?=$top_category['catname']?>" height="360" /></div>
</div>
<div style=" width:700px; margin:0 auto;">
<p><br></p><p><br></p>
   <!--formValidator插件相关-->
<link href="<?=base_url();?>admin/views/skin/css/formvalidator.css" rel="stylesheet" type="text/css" />
<script src="<?=base_url();?>admin/views/skin/js/jquery.js" type="text/javascript"></script>
<script src="<?=base_url();?>admin/views/skin/js/formValidatorRegex.js" type="text/javascript"></script>
<script language="javascript" type="text/javascript" src="<?=base_url();?>admin/views/skin/js/formvalidator.js" charset="UTF-8"></script>
<script type="text/javascript">
$(function(){
	$.formValidator.initConfig({autotip:true,formid:"book",debug:false,onerror:function(msg){}});
	$("#title").formValidator({onshow:"请输入标题",onfocus:"标题长度应该为6-50个字符"}).inputValidator({min:6,max:50,onerror:"标题长度应该为6-30个字符"});
	$("#name").formValidator({onshow:"请输入姓名",onfocus:"请输入姓名"}).inputValidator({min:3,max:20,onerror:"姓名输入不正确"});
	$("#tel").formValidator({onshow:"请输入联系电话",onfocus:"请输入联系电话"}).inputValidator({min:3,max:20,onerror:"联系电话输入不正确"});
	$("#content").formValidator({onshow:"请输入留言内容",onfocus:"请输入留言内容"}).inputValidator({min:10,max:200,onerror:"长度应该为10-200个字符"});
	$("#email").formValidator({onshow:"请输入邮箱(选填)",onfocus:"邮箱格式错误",oncorrect:"邮箱格式正确",empty:true}).regexValidator({regexp:"email",datatype:"enum",onerror:"邮箱格式错误"});
	$("#code").formValidator({onshow:"请输入验证码",onfocus:"请输入验证码",oncorrect:"输入完成"}).inputValidator({min:4,max:4,onerror:"验证码为4个字符"});
	
});
</script>

<!--验证码相关-->
<script type="text/javascript">
function get_captcha() {
    $.get("<?php echo base_url().'admin/login/code/ajax';?>", function(data){
        $('#captcha-image').html(data);
    });
};
$(function(){
    get_captcha();
    $('#captcha-image').click(get_captcha);
})
</script>                                      
<style>
/*留言*/

.biaoge{ width:693px; margin:0 auto; margin-left:30px; margin-bottom:15px;}
.biaoge table{border-collapse:separate;border-spacing: 1px;}
.biaoge table tr td{ padding:3px; text-align:left; line-height:30px;}
.biaoge table tr td{ background:#fff}
.biaoge table tr .aa{ background:#eeeeee; text-align:right}
.biaoge table tr td input{ width:300px; height:20px; border:1px solid #ccc;background:#fff;}
.biaoge table tr td input.bb{ width:200px; }
.biaoge table tr td input.bnt{ width:50px; margin-left:10px; background:#0085c3; color:#FFFFFF; border:1px solid #999999;cursor:pointer}
.biaoge table tr td textarea{width:400px; border:1px solid #ccc; background:#fff;}
</style>
<div class="biaoge">
       尊敬的客户：<br>
       如果您需要购买或咨询我们的产品，请直接拨打我们的销售热线，或者在此给我们留言，我们会尽快给您回复。<br>
       <span style="color:#FF0000">请务必填写带有*标志的项目</span>
       </div>
<div class="biaoge">
       <form id="book" name="book" method="post" action="<?=base_url();?>message/add/" >
      <table width="100%" border="0"  cellspacing="1" bgcolor="#cccccc">
  <tr>
    <td width="120" class="aa"><span style="color:#ff0000">*</span>留言主题：</td>
    <td><input name="info[title]" type="text" id="title"/></td>
  </tr>
  <tr>
    <td class="aa"><span style="color:#ff0000">*</span>姓名：</td>
    <td><input name="info[name]" type="text" class="bb"  id="name"/></td>
  </tr>
  <tr>
    <td class="aa">地址：</td>
    <td><input name="info[address]" type="text" id="address"/></td>
  </tr>
  <tr>
    <td class="aa"><span style="color:#ff0000">*</span>联系电话：</td>
    <td><input name="info[tel]" type="text" class="bb" id="tel"/></td>
  </tr>
  <tr>
    <td class="aa">邮箱：</td>
    <td><input name="info[email]" type="text" class="bb" id="email"/></td>
  </tr>
  <tr>
    <td class="aa"><span style="color:#ff0000">*</span>留言内容：</td>
    <td><textarea name="info[content]" rows="5" id="content" style="width:300px;"></textarea></td>
  </tr>
  <tr>
    <td class="aa"><span style="color:#ff0000">*</span>验证码：</td>
    <td><input type="text" class="bb" name="info[code]" id="code" style="width:50px;"/><div class="code_img" id="captcha-image" style="display:inline-block; margin-left:10px; position:relative; top:8px;"></div>	</td>
  </tr>

  <tr>
    <td colspan="2" align="center">
      
        <div align="center">
          <input type="submit" name="button" id="button" value="提交" class="bnt"/>
          <input type="reset" name="button" id="button" value="重置" class="bnt"/>
          
          
            </div></td>
    </tr>
</table>
 </form>
</div>

</div>
<?php $this->load->view('foot');?>