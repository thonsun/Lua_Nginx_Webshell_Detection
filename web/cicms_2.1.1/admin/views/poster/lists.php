<?php $this->load->view('head');?>
<div class="pad-10">

<div class="cate_top">
     <a href="<?=base_url();?>index.php/poster/list_type" class="on"><em>内容管理</em></a>
     <span>|</span><a href="<?=base_url();?>index.php/poster/add_type" class="on"><em>添加广告位</em></a> 

  </div>

<form name="myform" id="myform" action="" method="post" >
<div class="table-list">
    <table width="100%">
        <thead>
            <tr>
			   <th width="20"><input type="checkbox" value=""  id="chkAll" onclick="CheckAll(this.form)"></th>
               <th width="50">排序</th>
               <th width="37">ID</th>
			   <th width="150">广告标题</th>
			   <th width="150">所属版块</th>
               <th width="70">状态</th>
               <th width="150">添加时间</th>
			<th width="100">管理操作</th>
            </tr>
        </thead>
<tbody>
     
<?php if(!empty($data['list'])){ foreach ($data['list'] as $v){?>
    <tr>
		<td align="left"><input class="inputcheckbox " name="id[]" value="<?=$v['id']?>" type="checkbox" /> </td>
         <td align="center"><input name="listorder[<?=$v['id']?>]" size="3" value="<?=$v['listorder']?>" class="input-text-c" type="text"></td>
         <td align='center' ><?=$v['id']?></td>
		<td align='center' ><?=$v['name']?></td>
		<td align='center'><?=$v['typename']?></td>
		<td align='center'><?php if($v['status']==1){echo '通过';}else{echo "<span style='color:red'>待审核</span>";}?></td>
		<td align='center'><?=date('Y-m-d H:i:s',$v['uptime'])?></td>
		<td align='center'><a href="<?=base_url();?>index.php/poster/edit/<?=$v['id']?>">修改</a> | <a onclick="return ConfirmDel();"  href="<?=base_url();?>index.php/poster/del/<?=$v['id']?>">删除</a></td>
	</tr>

 <?php }}else{?>
				<tr>
					<td colspan="7">暂无数据！</td>
				</tr>	
	<?php } ?> 
    


     </tbody>
     </table>
     <div class="btn">
    	<input type="button" class="button" value="排序" onclick="myform.action='<?=base_url();?>index.php/poster/order';myform.submit();"/>
		<input type="button" class="button" value="删除" onclick="javascript:if(ConfirmDel()){myform.action='<?=base_url();?>index.php/poster/del';myform.submit();}"/>
	</div>
            
        <div class="pages"><?=$pages?></div>
</div>
</form>
</div>
</body>
</html>
