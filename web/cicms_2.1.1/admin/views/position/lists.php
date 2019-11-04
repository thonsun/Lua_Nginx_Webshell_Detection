<?php $this->load->view('head');?>
<div class="pad-10">

<div class="cate_top">
     <a href="<?=base_url();?>index.php/position/add" class="on"><em>添加推荐位</em></a>
  
  </div>


<div id="searchid">
<div class="explain-col">
    前台调用方法:<font color="#FF0000">$this->p->get_position($id,$limit)</font>;说明 $id为推荐位ID,$limit调用数量.<br>
    例如调用10条推荐位ID为2的数据:<font color="#FF0000">$this->p->get_position(2,10)</font>
    
   
 </div>
</div>
<form name="myform" id="myform" action="" method="post" >
<div class="table-list">
    <table width="100%">
        <thead>
            <tr>
            <th width="30"><input type="checkbox" value=""  id="chkAll" onclick="CheckAll(this.form)"></th>
             <th width="60">排序</th>
            <th width="37">ID</th>
             <th width="100">所属模块</th>
			<th >推荐位名称</th>
			<th width="100">管理操作</th>
            </tr>
        </thead>
<tbody>
     
<?php if(!empty($data['list'])){ foreach ($data['list'] as $v){?>
    <tr>
      <td align="left"><input class="inputcheckbox " name="id[]" value="<?=$v['id']?>" type="checkbox" /> </td>
        <td align="center"><input name="listorder[<?=$v['id']?>]" size="3" value="<?=$v['listorder']?>" class="input-text-c" type="text"></td>
		<td align='center' ><?=$v['id']?></td>
        <td align='center'><?=$v['modelname']?></td>
        <td align='center'><?=$v['name']?></td>
		<td align='center'><a href="<?=base_url();?>index.php/position/edit/<?=$v['id']?>">修改</a> | 
		   <a onclick="return ConfirmDel();"  href="<?=base_url();?>index.php/position/del/<?=$v['id']?>">删除</a>
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
    	<input type="button" class="button" value="排序" onclick="myform.action='<?=base_url();?>index.php/position/order';myform.submit();"/>
        <input type="button" class="button" value="删除" onclick="javascript:if(ConfirmDel()){myform.action='<?=base_url();?>index.php/position/del';myform.submit();}"/>
	</div>
            
        <div class="pages"><?=$pages?></div>
</div>
</form>
</div>
</body>
</html>
