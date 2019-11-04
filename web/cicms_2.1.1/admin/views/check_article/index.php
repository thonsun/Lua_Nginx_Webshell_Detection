<?php $this->load->view('head');?>
<div class="pad-10">
<style>
ul.checklist  {width:800px;}
ul.checklist  li{ width:140px; height:80px;  float:left; margin-left:20px; margin-top:15px;}
ul.checklist  li a{ display:block; width:140px; height:80px;  padding:10px; background:#0D9D0D; color:#fff;}
ul.checklist  li p{ margin:0px;}
ul.checklist  li p span{ color:#ff0000}
ul.checklist  li p.z{ font-size:16px;}
ul.checklist  li a:hover{ text-decoration:none}
 
</style>
<ul class="checklist">
<?php if(!empty($data['list'])){ foreach ($data['list'] as $v){?>
 <li>
     <a href="<?=base_url();?>index.php/<?=$v['tablename']?>/status?status=0">
	   <p class="z"><?=$v['name']?></p>
	   <p>待审核：<span><?=$v['status0']?></span></p>
	   <p>已退稿：<span><?=$v['status2']?></span></p>
	 </a>
  </li>
 <?php } }else{?>
				
				暂无数据！
				
	<?php } ?> 
 


</ul>

</div>
</body>
</html>
