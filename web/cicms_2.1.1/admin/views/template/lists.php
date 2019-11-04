<?php $this->load->view('head');?>
<div class="pad-10">

<style>
.title-2{text-align: left;height: 20px;font: 18px/20px "MicroSoft YaHei","SimHei";color: #333;margin: 0px;padding: 3px 0px  5px 3px;}
</style>
<div class="cate_top">
     <h1 class="title-2">默认模板 - 列表显示</h1>
  </div>


<form name="myform" id="myform" action="<?=base_url();?>index.php/template/file_update_info" method="post" >
<div class="table-list">
    <table width="100%">
       <thead>
		<tr>
		<th align="left" >目录列表</th>
		<th align="left" >说明</th>
		<th align="left" >操作</th>
		</tr>
        </thead>
<tbody>
<tr>
<td align="left" colspan="3"><a href="<?=base_url()?>template/"><img src="<?=base_url()?>views/skin/images/folder-closed.gif" />上一层目录</a></td>
</tr>

<?php if(!empty($data['list'])){ foreach ($data['list'] as $v){?>

<tr>
   <td align="left"><img src="<?=base_url()?>views/skin/images/file.gif" /> <a href="<?=base_url();?>index.php/template/edit/?style=<?=$data['style']?>&file=<?=$v?>"><b><?=$v?></b></a></td>
   <td align="left"><input type="text" name="file_info[<?=$v?>]" value="<?php echo isset($file_name[$v]) ? $file_name[$v] : ""?>"></td>
   <td>
    <a href="<?=base_url();?>index.php/template/edit/?style=<?=$data['style']?>&file=<?=$v?>">修改</a> | 
    <a onclick="return ConfirmDel();"  href="<?=base_url();?>index.php/template/del/?style=<?=$data['style']?>&file=<?=$v?>">删除</a>
   </td>
</tr>



 <?php }}else{?>
				<tr>
					<td colspan="2">暂无数据！</td>
				</tr>	
	<?php } ?> 
    

     </tbody>
     </table>
  <div class="btn">
         <input name="info[style]" type="hidden" value="<?=$data['style']?>">
     <input type="button" onclick="location.href='<?=base_url()?>template/'" class="button" name="dosubmit" value="返回风格类型" />
     <input type="button" class="button" name="dosubmit" value="新建"  onclick="location.href='<?=base_url()?>template/add_file?style=<?=$data['style']?>'"/> 
     <input type="submit" class="button" name="dosubmit" value="更新" >
  </div> 
            
      
</div>
</form>
</div>
</body>
</html>
