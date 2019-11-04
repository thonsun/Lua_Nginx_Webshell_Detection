<?php $this->load->view('head');?>
<!--banner-->
<div class="homeBanner">
  <div class="homeBannerImgBox" id="homeBannerImgBox">
    <ul id="bannerScrollUl" class=" clear">
<?php foreach($this->p->get_poster(18) as $v){
  echo "<li class='left bannerScroll_li'><img src='{$v['image']}' alt='{$v['name']}' height='360' /></li>";
 }?>
    </ul>
  </div>
  <div class="homeBannerBtnBox" id="homeBannerBtnBox"> 
<?php $nn=0; foreach($this->p->get_poster(18) as $v){
    if($nn==0){
	   echo " <span class='homeBannerBtn on'></span>";
	}else{
	  echo " <span class='homeBannerBtn'></span>";
	}
$nn++; }?>
  </div>
</div>
<div class="home_main_bj">
  <div class="main" id="main">
    <div class="clear home_main_top">

 <?php $nn=1; foreach ($cat[52]['child'] as $v){ if($nn<4){?>
   
      <div class="left home_main_top_column<?php if($nn==2){echo "2";}?>"> <img src="upload/<?=$v['image']?>" width="316" height="182" alt="<?=$v['catname']?>" />
        <div class="home_main_top_column_bottom">
          <div class="home_main_top_column_bottom_bj">
            <div class="home_main_top_column_bottom_bj_title<?=$nn?>"></div>
          </div>
         <a href="<?=$v['url']?>" class="home_main_top_column_bottom_a"><?=$v['catname']?></a>
          <div class="home_main_top_column_bottom_text">
            <?=$v['content']?>
          </div>
        </div>
      </div>
 <?php $nn++;}}?> 
    </div>
    <div class="clear home_main_bottom">
      <div class="left home_main_bottom_column_1">
        <div class="home_main_bottom_column_title clear"> <span class="f_14 col_3 left">公司简介</span> <a href="<?=base_url();?>article/1.html" class="col_aa844a right">更多>></a> </div>
        <div class="home_contact">
          <p><?php echo str_cut(strip_tags($this->p->get_article(2,'content')),180)?></p>
        </div>
      </div>
      <div class="left home_main_bottom_column_2">
        <div class="home_main_bottom_column_title clear"> <span class="f_14 col_3 left">最新动态</span> <a href="<?=base_url();?>news/" class="col_aa844a right">更多>></a> </div>
        <ul class="home_new">
<?php foreach($this->p->get_list(4,'news') as $v){ ?>
  <li class="clear"> <a href="<?=base_url();?>news/show/<?=$v['id']?>.html" class="left col_3 home_new_a" target="_blank"><?php echo str_cut($v['title'],34)?></a> <span class="right col_4e4e4e"><?=date('Y-m-d',$v['uptime'])?></span> </li>
<?php }?>
        </ul>
      </div>
      <div class="right home_main_bottom_column_1">
        <div class="home_main_bottom_column_title clear"> <span class="f_14 col_3 left">联系我们</span> <a href="<?=base_url();?>article/6.html" class="col_aa844a right">更多>></a> </div>
        <div class="home_lxwm">
        
        <?=$setting['index_tel']?>
          
        </div>
      </div>
    </div>
    <!--友情链接-->
    <div class="friendlink"> <span class="col_194ab0 f_12"><b>友情链接：</b></span> 
    <?php
foreach($this->p->get_links(1) as $v){
 echo "<a href='{$v['url']}' class='col_0 f_12'  target='_blank' >{$v['name']}</a><span class='col_0'>&nbsp;|&nbsp;</span> ";
}
?> 
    
    </div>
  </div>
</div>
 <?php $this->load->view('foot');?>   