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
			<th>数据库表</th>
           <th width="130">类型</th>
           <th width="130">记录条数</th>
            <th width="130">编码</th>
            <th width="130">占用空间</th>
			<th width="130">多余</th>
			<th width="100">管理操作</th>
            </tr>
        </thead>
<tbody>
     
<?php if(!empty($data)){ foreach ($data as $v){?>
<?php
if($v['Index_length']<1024){$v['Index_length']=round($v['Index_length'],1).' 字节';}
if($v['Index_length']>=1024 && $v['Index_length']<1024*1024){$v['Index_length']=round(($v['Index_length']/1024),1).' KB';}
if($v['Index_length']>=1024*1024 && $v['Index_length']<1024*1024*1024){$v['Index_length']=round(($v['Index_length']/(1024*1024)),1).' M';}

if($v['Data_free']<1024){$v['Data_free']=round($v['Data_free'],1).' 字节';}
if($v['Data_free']>=1024 && $v['Data_free']<1024*1024){$v['Data_free']=round(($v['Data_free']/1024),1).' KB';}
if($v['Data_free']>=1024*1024 && $v['Data_free']<1024*1024*1024){$v['Data_free']=round(($v['Data_free']/(1024*1024)),1).' M';}

?>
    <tr>
		<td><?=$v['Name']?></td>
    	<td align='center'><?=$v['Engine']?></td>
        <td align='center'><?=$v['Rows']?></td>
        <td align='center'><?=$v['Collation']?></td>
		<td align='center'><?=$v['Index_length']?></td>
        <td align='center'><?=$v['Data_free']?></td>
		<td align='center'><a href="<?=base_url();?>index.php/db/optimize_tbl/<?=$v['Name']?>/">优化</a> | <a   href="<?=base_url();?>index.php/db/repair_tb/<?=$v['Name']?>/">修复</a></td>
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
