<?php $this->load->view('head');?>
<div class="pad-10">

<div class="cate_top">
     <a href="<?=base_url();?>index.php/setting/add" class="on"><em>添加新标签</em></a>
  
  </div>


<div id="searchid">
<div class="explain-col">
    前台调用方法:<font color="#FF0000">$setting[$key]</font>;说明 $key为标签字段.<br>
    例如调用网站标题:<font color="#FF0000">$setting['title']</font>
    
   
 </div>
</div>
<form name="myform" id="myform" action="" method="post" >
<div class="table-list">
    <table width="100%">
        <thead>
            <tr>
             <th width="50">排序</th>
            <th width="37">ID</th>
			<th width="120">字段标签key</th>
            <th width="120">字段名称</th>
            <th width="120">字段类型</th>
            <th width="">提醒文字</th>
			<th width="100">管理操作</th>
            </tr>
        </thead>
<tbody>
     
<?php if(!empty($data['list'])){ foreach ($data['list'] as $v){?>
    <tr>
        <td align="center"><input name="listorder[<?=$v['id']?>]" size="3" value="<?=$v['listorder']?>" class="input-text-c" type="text"></td>
		<td align='center' ><?=$v['id']?></td>
		<td align='center'><?=$v['key']?></td>
        <td align='center'><?=$v['title']?></td>
        <td align='center'><?=$v['style']?></td>
        <td align='left'><?=$v['beizhu']?></td>

		<td align='center'><a href="<?=base_url();?>index.php/setting/edit/<?=$v['id']?>">修改</a> | 
        <?php if($v['type']==1){
		?>
		删除
		<?php }else{?>
		   <a onclick="return ConfirmDel();"  href="<?=base_url();?>index.php/setting/del/<?=$v['id']?>">删除</a>
		<?php }?>
        </td>
	</tr>

 <?php }}else{?>
				<tr>
					<td colspan="8">暂无数据！</td>
				</tr>	
	<?php } ?> 
    


     </tbody>
     </table>
     <div class="btn">
    	<input type="button" class="button" value="排序" onclick="myform.action='<?=base_url();?>index.php/setting/order';myform.submit();"/>
	</div>
            
        <div class="pages"><?=$pages?></div>
</div>
</form>
</div>
</body>
</html>
