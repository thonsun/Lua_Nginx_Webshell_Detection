<?php $this->load->view('head');?>

<script type="text/javascript">
<!--
$(function(){
	$.formValidator.initConfig({autotip:true,formid:"myform",debug:false,onerror:function(msg){}});

$("#title").formValidator({onshow:"请输入标题",onfocus:"标题长度应该为6-50个字符"}).inputValidator({min:6,max:50,onerror:"标题长度应该为6-50个字符"});

	
});
//-->
</script>
<div class="pad-10">
<div class="cate_top">
     <a href="<?=base_url();?>index.php/page/lists" class="on"><em>管理栏目</em></a>
  </div>
<div class="nav10"></div>
<form name="myform" id="myform" action="<?=base_url();?>index.php/page/edit" method="post" enctype="multipart/form-data" />
<div class="pad-10">
<div class="col-tab">
<ul class="tabBut cu-li">

    
<li id="tab_setting_1" class="on" onclick="switchmodTag('tab_setting_','div_setting_','1');this.blur();">添加内容</li>
</ul>
<div id="div_setting_1" class="contentList pad-10">

<table width="100%" class="table_form ">

     
      <tr>
        <th>标题：</th>
        <td>
       <input type="text" name="info[title]" id="title" class="input-text" size="60" value="<?=$data['res']['title']?>">
        
		</td>
      </tr>
	<tr>
        <th>关键字：</th>
        <td><input type="text" name="info[keyword]" id="catdir" class="input-text" size="40" value="<?=$data['res']['keyword']?>">  多关键词之间用空格或者“,”隔开</td>
      </tr>

    	<tr>
        <th>内容：</th>
        <td>
 <textarea id="editor_id" name="info[content]" style="width:700px;height:300px;"><?=$data['res']['content']?></textarea>
        </td>
      </tr> 
<tr>
        <th>发布时间：</th>
        <td><input type="text" name="info[uptime]" id="uptime" class="date" size="25" value="<?=date('Y-m-d H:i:s',$data['res']['uptime'])?>"></td>
      </tr>

<script charset="utf-8" src="<?=base_url();?>views/skin/kindeditor/kindeditor.js"></script>
<script charset="utf-8" src="<?=base_url();?>views/skin/kindeditor/lang/zh_CN.js"></script>
<script>
        KindEditor.ready(function(K) {
                window.editor = K.create('#editor_id');
        });
</script>
</table>

</div>

 <div class="nav10"></div>
 <input name="info[id]" type="hidden" value="<?=$data['res']['id']?>">
    <input name="dosubmit" type="submit" value="提交" class="button">
</div>
</div>
</form>
</div>
</body>
</html>





