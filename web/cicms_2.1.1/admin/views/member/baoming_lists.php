<?php $this->load->view('head');?>
<div class="pad-10">
<div class="cate_top">
  </div>
<form name="myform" id="myform" action="" method="post" >
<div class="table-list">
    <table width="100%">
        <thead>
            <tr>
			 <th width="20"><input type="checkbox" value=""  id="chkAll" onclick="CheckAll(this.form)"></th>
            <th width="37">ID</th>
			<th>报名课程</th>
            <th width="70">姓名</th>
			 <th width="70">手机</th>
            <th width="118">报名时间</th>
			<th width="72">管理操作</th>
            </tr>
        </thead>
<tbody>
     
<?php if(!empty($data['list'])){ foreach ($data['list'] as $v){?>
    <tr>
		<td align="left"><input class="inputcheckbox " name="id[]" value="<?=$v['id']?>" type="checkbox" /> </td>
		<td align='center' ><?=$v['id']?></td>
		<td>
		<a href="<?=base_url().'../'.$v['model'].'/show/'.$v['articleid'].'.html'?>" target="_blank"><?=$v['title']?></a>
        </td>
		
		<td align='center'><?=$v['name']?></td>
		<td align='center'><?=$v['tel']?></td>
		<td align='center'><?=date('Y-m-d H:i:s',$v['uptime'])?></td>
		<td align='center'><a href="javascript:void(0)" onclick="show('<?=$v['id']?>');">详情</a></td>
	</tr>
<!--layer弹窗显示的内容-->	
<div id='show_<?=$v['id']?>' style="display:none">
   <div style=" width:90%; line-height:20px; margin:0 auto">
     <p style="margin:3px 0px; border-bottom:1px dashed #ddd;"><span style="font-weight:bold; color:#386790">课程名称：</span><?=$v['title']?></p>
	 <p style="margin:3px 0px; border-bottom:1px dashed #ddd;"><span style="font-weight:bold; color:#386790">姓名：</span><?=$v['name']?></p>
	 <p style="margin:3px 0px; border-bottom:1px dashed #ddd;"><span style="font-weight:bold; color:#386790">电话：</span><?=$v['tel']?></p>
	 <p style="margin:3px 0px; border-bottom:1px dashed #ddd;"><span style="font-weight:bold; color:#386790">QQ：</span><?=$v['qq']?></p>
	 <p style="margin:3px 0px; border-bottom:1px dashed #ddd;"><span style="font-weight:bold; color:#386790">报名时间：</span><?=date('Y-m-d H:i:s',$v['uptime'])?></p>
	 <p style="margin:3px 0px; border-bottom:1px dashed #ddd;"><span style="font-weight:bold; color:#386790">会员名：</span><?=$v['username']?></p>
	 <p style="margin:3px 0px; border-bottom:1px dashed #ddd;"><span style="font-weight:bold; color:#386790">课程链接：</span><?=str_replace('/admin','',base_url()).$v['model'].'/show/'.$v['articleid'].'.html'?></p>
  </div>
</div>
 <?php }}else{?>
				<tr>
					<td colspan="8">暂无数据！</td>
				</tr>	
	<?php } ?> 
    


     </tbody>
     </table>
     <div class="btn">
		<input type="button" class="button" value="删除" onclick="javascript:if(ConfirmDel()){myform.action='<?=base_url();?>index.php/member/baoming_del';myform.submit();}"/>
	</div>
            
        <div class="pages"><?=$pages?></div>
</div>
</form>
</div>
<script>
 function show(id) {
     layer.open({
         type: 1,
		 title:'详情',
		 btn: '我知道了',
         skin: 'layui-layer-rim', //加上边框
         area: ['420px', '280px'], //宽高
         content: $('#show_'+id)
    });
 }
  
</script>


</body>
</html>
