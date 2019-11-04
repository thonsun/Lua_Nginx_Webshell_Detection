<?php $this->load->view('head');?>
<div class="pad-10">

<div class="cate_top">
     <a href="<?=base_url();?>index.php/message/" class="on"><em>内容管理</em></a>
</div>

<form name="myform" id="myform" action="" method="post" >
<div class="table-list">
    <table width="100%">
        <thead>
            <tr>
              <th width="20"><input type="checkbox" value=""  id="chkAll" onclick="CheckAll(this.form)"></th>
               <th width="37">ID</th>
               <th width="180">标题</th>
                <th width="250">内容</th>
			   <th width="100">联系人</th>
               <th width="100">电话</th>
			   <th width="100">邮箱</th>
               
               <th width="150">留言时间</th>
			<th width="120">管理操作</th>
            </tr>
        </thead>
<tbody>
     
<?php if(!empty($data['list'])){ foreach ($data['list'] as $v){?>
    <tr>
        <td align="left"><input class="inputcheckbox " name="id[]" value="<?=$v['id']?>" type="checkbox" /> </td>
        <td align='center' ><?=$v['id']?></td>
        <td align='center'><?=$v['title']?></td>
        <td align='center'><?=$v['content']?></td>
        
		<td align='center' ><?=$v['name']?></td>
		<td align='center'><?=$v['tel']?></td>
		<td align='center'><?=$v['email']?></td>
		<td align='center'><?=date('Y-m-d H:i:s',$v['uptime'])?></td>
		<td align='center'><a href="<?=base_url();?>index.php/message/edit/<?=$v['id']?>">查看详情</a> | <a onclick="return ConfirmDel();"  href="<?=base_url();?>index.php/message/del/<?=$v['id']?>">删除</a></td>
	</tr>

 <?php }}else{?>
				<tr>
					<td colspan="9">暂无数据！</td>
				</tr>	
	<?php } ?> 
    


     </tbody>
     </table>
     <div class="btn">
		<input type="button" class="button" value="删除" onclick="javascript:if(ConfirmDel()){myform.action='<?=base_url();?>index.php/message/del';myform.submit();}"/>
	</div>
            
        <div class="pages"><?=$pages?></div>
</div>
</form>
</div>
</body>
</html>
