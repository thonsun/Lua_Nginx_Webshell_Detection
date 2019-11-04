<?php $this->load->view('head');?>
<div class="pad-10">

<div class="cate_top">
     <a href="<?=base_url();?>index.php/search/" class="on"><em>内容管理</em></a>
     <span>|</span><a href="<?=base_url();?>index.php/search/add" class="on"><em>添加关键词</em></a> 
	  <span>|</span> <a href="javascript:void(0)"  class="a" onclick="javascript:$('#searchid').css('display','block');">搜索</a>
  </div>
<div id="searchid" <?php if(!isset($data['search'])){?>style="display:none;"<?php }?>>
<form name="searchform" action="<?=base_url();?>index.php/search/sear" method="get" >

<table width="100%" cellspacing="0" class="search-form">
    <tbody>
		<tr>
		<td>
		<div class="explain-col">
		关键字：
				<input name="q" type="text" value="" class="input-text" />
				<input type="submit" name="search" class="button" value="搜索" />
	</div>
		</td>
		</tr>
    </tbody>
</table>
</form>
</div>


<form name="myform" id="myform" action="" method="post" >
<div class="table-list">
    <table width="100%">
        <thead>
            <tr>
			 <th width="20"><input type="checkbox" value=""  id="chkAll" onclick="CheckAll(this.form)"></th>
                   <th width="37">ID</th>
			<th width="300">关键词</th>
            <th width="40">点击量</th>
            <th width="120">初始点击时间</th>
			<th width="120">管理操作</th>
            </tr>
        </thead>
<tbody>
     
<?php if(!empty($data['list'])){ foreach ($data['list'] as $v){?>
    <tr>
		<td align="left"><input class="inputcheckbox " name="id[]" value="<?=$v['id']?>" type="checkbox" /> </td>
        
		<td align='center' ><?=$v['id']?></td>
		<td><?=$v['title']?></td>
		<td align='center'><?=$v['hits']?></td>

		<td align='center'><?=date('Y-m-d H:i:s',$v['uptime'])?></td>
		<td align='center'><a href="<?=base_url();?>index.php/search/edit/<?=$v['id']?>">修改</a> | <a onclick="return ConfirmDel();"  href="<?=base_url();?>index.php/search/del/<?=$v['id']?>">删除</a></td>
	</tr>

 <?php }}else{?>
				<tr>
					<td colspan="8">暂无数据！</td>
				</tr>	
	<?php } ?> 
    


     </tbody>
     </table>
     <div class="btn">
		<input type="button" class="button" value="删除" onclick="javascript:if(ConfirmDel()){myform.action='<?=base_url();?>index.php/search/del';myform.submit();}"/>
	</div>
            
        <div class="pages"><?=$pages?></div>
</div>
</form>
</div>
</body>
</html>
