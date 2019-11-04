<?php $this->load->view('head');?>
<div class="pad-10">
<div class="cate_top">
     <a href="<?=base_url();?>index.php/db/backup" class="on"><em>一键备份全部</em></a>
     <span>|</span><a href="<?=base_url();?>index.php/db/restore" class="on"><em>数据还原</em></a> 

  </div>

<form name="myform" id="myform" action="" method="post" >
<div class="table-list">
    <table width="100%">
        <thead>
            <tr>
			<th>文件名称</th>
           <th width="130">文件大小</th>
           <th width="130">备份时间</th>
  
			<th width="100">管理操作</th>
            </tr>
        </thead>
<tbody>
     
<?php if(!empty($data['list'])){ foreach ($data['list'] as $v){?>
<?php
if($v['size']<1024){$v['Index_length']=round($v['size'],1).' 字节';}
if($v['size']>=1024 && $v['size']<1024*1024){$v['size']=round(($v['size']/1024),1).' KB';}
if($v['size']>=1024*1024 && $v['size']<1024*1024*1024){$v['size']=round(($v['size']/(1024*1024)),1).' M';}

?>
    <tr>
		<td><?=$v['name']?></td>
        <td align='center'><?=$v['size']?></td>
        <td align='center'><?=date('Y-m-d H:i',$v['date'])?></td>
		<td align='center'><a href="<?=base_url();?>index.php/db/huany/<?=$v['name']?>/">恢复</a> | 
        <a   href="<?=base_url();?>index.php/db/down/<?=$v['name']?>/">下载</a>  | 
       <a onclick="return ConfirmDel();"  href="<?=base_url();?>index.php/db/del/<?=$v['name']?>/">删除</a>
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
    
	</div>
            

</div>
</form>
</div>
</body>
</html>
