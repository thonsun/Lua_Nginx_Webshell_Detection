<?php $this->load->view('head');?>
<div class="pad-10">

<div class="cate_top">
     <a href="<?=base_url();?>index.php/sitemodel/add" class="on"><em>添加模型</em></a>
       <span>|</span><a href="<?=base_url();?>index.php/sitemodel/lists" class="on"><em>模型管理</em></a>
  </div>

<form name="myform" id="myform" action="" method="post" >
<div class="table-list">
    <table width="100%">
        <thead>
            <tr>
            <th width="50">排序</th>
            <th width="37">ID</th>
			<th width="120">模块名称</th>
            <th width="120">数据表</th>
            <th width="300">描述</th>
			<th width="100">管理操作</th>
            </tr>
        </thead>
<tbody>
     
<?php if(!empty($data['list'])){ foreach ($data['list'] as $v){?>
    <tr>
         <td align="center"><input name="listorder[<?=$v['id']?>]" size="3" value="<?=$v['listorder']?>" class="input-text-c" type="text"></td>
		<td align='center' ><?=$v['id']?></td>
		<td align='center'><?=$v['name']?></td>
        <td align='center'><?=$v['tablename']?></td>
        <td align='center'><?=$v['des']?></td>

		<td align='center'>
        <a href="<?=base_url();?>index.php/sitemodel/field_list/<?=$v['id']?>">字段管理</a> | 
        <a href="<?=base_url();?>index.php/sitemodel/edit/<?=$v['id']?>">修改</a> | 
         <a href="<?=base_url();?>index.php/sitemodel/del/<?=$v['id']?>">删除</a> 
		
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
    	<input type="button" class="button" value="排序" onclick="myform.action='<?=base_url();?>index.php/sitemodel/order_model';myform.submit();"/>
	</div>           
        <div class="pages"><?=$pages?></div>
</div>
</form>
</div>
</body>
</html>
