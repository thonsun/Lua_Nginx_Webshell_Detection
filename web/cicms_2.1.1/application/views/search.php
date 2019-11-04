<?php $this->load->view('head');?>

<style>
.content{ width:1000px; margin:0 auto; text-align:left}

/*搜索列表*/
.resultlist { float:left; width:600px; font-family:arial; line-height:20px; font-size:14px;}
.resultlist ul li { margin-bottom:20px;}
.resultlist ul li .img{ width:120px; float:left;}
.resultlist ul li .img img{ width:120px; height:120px;}
.resultlist ul li .des{ width:470px; float:left; margin-left:10px;}
.resultlist ul li .des_noimg{ width:100%;}
.resultlist ul li span.red{ color:#FF0000}

.resultlist ul li h3{ line-height:20px; display:block; margin:0px; padding:0px;}
.resultlist ul li h3 a{line-height: 1.54;font-weight: normal;font-size: medium; color:#00C; text-decoration:underline;line-height:40px; font-size:16px;}
.resultlist ul li h3 a span{ color:#ff0000}
.resultlist ul li span.ccc{ color:#666}
.result_content{ padding:5px 15px;}
.resultbar{ height:30px; line-height:30px; background:#CCCCCC; padding-left:25px;}
.fc_03c{ color:#0066FF}

/*热门搜索词*/
.hot_search{ width:300px; float:right; border-left:1px solid #ddd; padding-left:30px; min-height:500px;}
.hot_search table{ width:100%;border-collapse: collapse;border-spacing: 0px; font-size:14px;}

.hot_search table tr{ height:30px; border-bottom:1px solid #F0F0F0;}
.hot_search table tr th{ background:#FAFAFA; font-size:14px; font-weight:bold; text-align:left; color:#999999}
.hot_search table tr td { padding:5px 0px;}
.hot_search table tr td a{ font-size:14px; color:#00c; display:inline-block;line-height:20px;}
.hot_search table tr td a:hover{ text-decoration:underline;}
.hot_search table tr td span{ display:inline-block; color:#fff; background:#8EB9F5; line-height:20px; width:20px; height:20px; text-align:center; margin-top:5px;}
.hot_search table tr td span.c1{ background:#F54545}
.hot_search table tr td span.c2{ background:#FF8547}
.hot_search table tr td span.c3{ background:#FFAC38}
.hot_search .opr-toplist-right{ text-align:right;}
.cr-title{ margin-top:15px; line-height:30px; font-size:14px; font-weight:bold;}
</style>
<div class="nav10" style="height:50px;"></div>

<div style="background:#fff">
<div class="content">

<div class="resultlist" style="min-height:350px;">
  <ul>
  
  <?php if(!empty($data['list'])){ foreach ($data['list'] as $v){?>
   <li> 
          <h3><a href="product/show/<?=$v['id']?>.html" target="_blank"><?=str_replace($data['q'],'<span>'.$data['q'].'</span>',$v['title'])?></a></h3>
          <?php  if(!empty($v['image'])){?>
                <div class="img"><img src="<?=$v['image']?>"></div>     				
                <div class="des">
                  <span class="ccc"><?=date('Y',$v['uptime'])?>年<?=date('m',$v['uptime'])?>月<?=date('d',$v['uptime'])?>日&nbsp;&nbsp;</span><?=str_replace($data['q'],'<span class=red>'.$data['q'].'</span>',$v['des'])?><br>
                  <span><a href="product/show/<?=$v['id']?>.html" style=" color:#009900"  target="_blank"><?=base_url()?>product/show/<?=$v['id']?>.html</a></span>  
                </div>  
          <?php }else{?>
               <span class="ccc"><?=date('Y-m-d',$v['uptime'])?>&nbsp;&nbsp;</span><?=str_replace($data['q'],'<span class=red>'.$data['q'].'</span>',$v['des'])?><br>
               <span><a href="product/show/<?=$v['id']?>.html" style=" color:#009900"  target="_blank"><?=base_url()?>product/show/<?=$v['id']?>.html</a></span>

          <?php }?>
      </li>
      <div style="width: 100%;height: 5px;clear: both;overflow: hidden;"></div>
 <?php }}else{?>
				
					<div style="margin:30px; color:#ff0000; font-size:14px;">暂无数据!</div>
					
	<?php } ?> 
    

			</ul>
 <div style="width: 100%;height: 20px;clear: both;overflow: hidden;"></div>
			 <div class="page"><?=$pages?></div>
</div>
    <div class="hot_search">
    
 <div class="cr-title">周围人都在搜</div>

    <table>
        <tbody><tr>
            <th >身边热词 </th>
            <th class="opr-toplist-right">人气指数</th>
        </tr>
 <?php
  $nn=1;
  foreach($this->p->get_search(10) as $v){
 ?>
  <tr >
     <td>
         <span class="c<?=$nn?>"><?=$nn?></span>
         <a target="_top" href="search/?q=<?=$v['title']?>" title="<?=$v['title']?>"><?=$v['title']?></a>            </td>
     <td class="opr-toplist-right"><?=$v['hits']?></td>
  </tr>	
<?php $nn++; }?>
                    </tbody></table>

    </div>
</div>
</div>
<div style="width: 100%;height: 20px;clear: both;overflow: hidden;"></div>
<?php $this->load->view('foot');?>