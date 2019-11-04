<?php $this->load->view('head');?>
<div class="cate_top">
     <a href="<?=base_url();?>index.php/category/lists" class="on"><em>管理栏目</em></a>
     <span>|</span><a href="<?=base_url();?>index.php/category/add" id='test1'><em>添加栏目</em></a> 
  </div>
<div class="nav10"></div>
<form name="myform" id="myform" action="" method="post" >
<div class="table-list">
    <table width="100%" cellspacing="0" >
        <thead>
            <tr>
            <th width="38" style="color:#008ED2">排序</th>
            <th width="40">ID</th>
            <th >栏目名称</th>
            <th align='left' width="50">所属模型</th>
			<th >管理操作</th>
            </tr>
        </thead>
    <tbody>

  
    
<?php if(!empty($data['list'])){ foreach ($data['list'] as $v){


	     $m=substr_count($v['path'],',')-1;//统计路径的层次，判断分隔符出现的次数
	    $strpad=str_pad('',$m*25,'|&nbsp;&nbsp;&nbsp;&nbsp;');
		if($m==0){$font="font-weight:bold";}elseif($m==2){$font="color:#008ED2";}else{$font="";}
?>	
    <tr>
					<td align='center'><input name='listorder[<?=$v['id']?>]' type='text' size='3' value='<?=$v['listorder']?>' class='input-text-c'></td>
					<td align='center'><?=$v['id']?></td>
					<td   style="<?=$font?>"><?=$strpad?>|- <?=$v['catname']?></td>
					
					<td align='center'><font <?php if($v['tablename']=='page'){echo "class='blue'";}elseif($v['tablename']=='url'){echo "class='red'";}?>><?=$v['name']?></font></td>
					<td align='center' ><a href="<?=base_url();?>index.php/category/add/<?=$v['id']?>">添加子栏目</a> | <a href="<?=base_url();?>index.php/category/edit/<?=$v['id']?>">修改</a> | <a onclick="return ConfirmDel();"  href="<?=base_url();?>index.php/category/del/<?=$v['id']?>">删除</a></td>
				</tr>
                
       <?php if(!empty($v['child'])){ foreach ($v['child'] as $v){
	      $m=substr_count($v['path'],',')-1;//统计路径的层次，判断分隔符出现的次数
	    $strpad=str_pad('',$m*25,'|&nbsp;&nbsp;&nbsp;&nbsp;');
		if($m==0){$font="font-weight:bold";}elseif($m==2){$font="color:#008ED2";}else{$font="";}
	?>
    
     <tr>
					<td align='center'><input name='listorder[<?=$v['id']?>]' type='text' size='3' value='<?=$v['listorder']?>' class='input-text-c'></td>
					<td align='center'><?=$v['id']?></td>
					<td   style="<?=$font?>"><?=$strpad?>|- <?=$v['catname']?></td>
					
					<td align='center'><font <?php if($v['tablename']=='page'){echo "class='blue'";}elseif($v['tablename']=='url'){echo "class='red'";}?>><?=$v['name']?></font></td>
					<td align='center' ><a href="<?=base_url();?>index.php/category/add/<?=$v['id']?>">添加子栏目</a> | <a href="<?=base_url();?>index.php/category/edit/<?=$v['id']?>">修改</a> | <a onclick="return ConfirmDel();"  href="<?=base_url();?>index.php/category/del/<?=$v['id']?>">删除</a></td>
				</tr>
                  
                  
                   <?php if(!empty($v['child'])){ foreach ($v['child'] as $v){
	      $m=substr_count($v['path'],',')-1;//统计路径的层次，判断分隔符出现的次数
	    $strpad=str_pad('',$m*25,'|&nbsp;&nbsp;&nbsp;&nbsp;');
		if($m==0){$font="font-weight:bold";}elseif($m==2){$font="color:#008ED2";}else{$font="";}
	?>
    
     <tr>
					<td align='center'><input name='listorder[<?=$v['id']?>]' type='text' size='3' value='<?=$v['listorder']?>' class='input-text-c'></td>
					<td align='center'><?=$v['id']?></td>
					<td   style="<?=$font?>"><?=$strpad?>|- <?=$v['catname']?></td>
					
					<td align='center'><font <?php if($v['tablename']=='page'){echo "class='blue'";}elseif($v['tablename']=='url'){echo "class='red'";}?>><?=$v['name']?></font></td>
					<td align='center' ><a href="<?=base_url();?>index.php/category/add/<?=$v['id']?>">添加子栏目</a> | <a href="<?=base_url();?>index.php/category/edit/<?=$v['id']?>">修改</a> | <a onclick="return ConfirmDel();"  href="<?=base_url();?>index.php/category/del/<?=$v['id']?>">删除</a></td>
				</tr>
           
                   <?php if(!empty($v['child'])){ foreach ($v['child'] as $v){
	      $m=substr_count($v['path'],',')-1;//统计路径的层次，判断分隔符出现的次数
	    $strpad=str_pad('',$m*25,'|&nbsp;&nbsp;&nbsp;&nbsp;');
		if($m==0){$font="font-weight:bold";}elseif($m==2){$font="color:#008ED2";}else{$font="";}
	?>
    
     <tr>
					<td align='center'><input name='listorder[<?=$v['id']?>]' type='text' size='3' value='<?=$v['listorder']?>' class='input-text-c'></td>
					<td align='center'><?=$v['id']?></td>
					<td   style="<?=$font?>"><?=$strpad?>|- <?=$v['catname']?></td>
					
					<td align='center'><font <?php if($v['tablename']=='page'){echo "class='blue'";}elseif($v['tablename']=='url'){echo "class='red'";}?>><?=$v['name']?></font></td>
					<td align='center' ><a href="<?=base_url();?>index.php/category/add/<?=$v['id']?>">添加子栏目</a> | <a href="<?=base_url();?>index.php/category/edit/<?=$v['id']?>">修改</a> | <a onclick="return ConfirmDel();"  href="<?=base_url();?>index.php/category/del/<?=$v['id']?>">删除</a></td>
				</tr>
                
    
                   <?php if(!empty($v['child'])){ foreach ($v['child'] as $v){
	      $m=substr_count($v['path'],',')-1;//统计路径的层次，判断分隔符出现的次数
	    $strpad=str_pad('',$m*25,'|&nbsp;&nbsp;&nbsp;&nbsp;');
		if($m==0){$font="font-weight:bold";}elseif($m==2){$font="color:#008ED2";}else{$font="";}
	?>
    
     <tr>
					<td align='center'><input name='listorder[<?=$v['id']?>]' type='text' size='3' value='<?=$v['listorder']?>' class='input-text-c'></td>
					<td align='center'><?=$v['id']?></td>
					<td   style="<?=$font?>"><?=$strpad?>|- <?=$v['catname']?></td>
					
					<td align='center'><font <?php if($v['tablename']=='page'){echo "class='blue'";}elseif($v['tablename']=='url'){echo "class='red'";}?>><?=$v['name']?></font></td>
					<td align='center' ><a href="<?=base_url();?>index.php/category/add/<?=$v['id']?>">添加子栏目</a> | <a href="<?=base_url();?>index.php/category/edit/<?=$v['id']?>">修改</a> | <a onclick="return ConfirmDel();"  href="<?=base_url();?>index.php/category/del/<?=$v['id']?>">删除</a></td>
				</tr>
               
                   <?php if(!empty($v['child'])){ foreach ($v['child'] as $v){
	      $m=substr_count($v['path'],',')-1;//统计路径的层次，判断分隔符出现的次数
	    $strpad=str_pad('',$m*25,'|&nbsp;&nbsp;&nbsp;&nbsp;');
		if($m==0){$font="font-weight:bold";}elseif($m==2){$font="color:#008ED2";}else{$font="";}
	?>
    
     <tr>
					<td align='center'><input name='listorder[<?=$v['id']?>]' type='text' size='3' value='<?=$v['listorder']?>' class='input-text-c'></td>
					<td align='center'><?=$v['id']?></td>
					<td   style="<?=$font?>"><?=$strpad?>|- <?=$v['catname']?></td>
					
					<td align='center'><font <?php if($v['tablename']=='page'){echo "class='blue'";}elseif($v['tablename']=='url'){echo "class='red'";}?>><?=$v['name']?></font></td>
					<td align='center' ><a href="<?=base_url();?>index.php/category/add/<?=$v['id']?>">添加子栏目</a> | <a href="<?=base_url();?>index.php/category/edit/<?=$v['id']?>">修改</a> | <a onclick="return ConfirmDel();"  href="<?=base_url();?>index.php/category/del/<?=$v['id']?>">删除</a></td>
				</tr>
                
    
    
    <?php }} ?>  
    
    
    <?php }} ?> 
    
    <?php }} ?>      
    
    
    <?php }} ?> 
    
                  
                  
    
    
    <?php }} ?> 	
	      
                
                
 <?php }}else{?>
				<tr>
					<td colspan="5">暂无数据！</td>
				</tr>	
	<?php } ?>   				
				
                   </tbody>
    </table>
    <div class="btn">
<input type="button" class="button" value="排序" onclick="myform.action='<?=base_url();?>index.php/category/order';myform.submit();"/>
	
	</div>  </div>
</form>
</body>
</html>
