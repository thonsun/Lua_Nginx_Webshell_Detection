<?php $this->load->view('head');?>
</div>
<!--banner-->
<div class="towBanner">
	<div class="towBannerBox" ><img src="upload/<?=$top_category['image']?>" alt="<?=$top_category['catname']?>" height="360" /></div>
</div>

<div class="main clear" id="main">
	<!--left-->
    <div class="main_left left">
    	<div class="main_leftTitle">
        <h2 class="col_f f_12"><?=$top_category['catname']?></h2>
        </div>
        <ul class="sidebar">
 <?php foreach ($cat[$top_category['id']]['child'] as $v){?>
               <li class="sidebar_li"> <a  class="sidebar_a <?php if($v['id']==$category['id']){echo "active";}?>" href="<?=$v['url']?>"><?=$v['catname']?></a> </li>
<?php }?>
        </ul>    
    </div>
    <!--right-->
	<div class="main_right right">
    	<div class="main_rightTitle clear">
        	<h1 class="f_16 col_88cfc8 left main_rightTitle_left"><?=$category['catname']?></h1>
            <div class="right main_rightTitle_right">
             <?php $this->load->view('sys_nav');?> 
            </div>
        </div>
        <div class="gywm_Box">
        	<?=$data['res']['content']?>
        </div>
    </div>
    
</div>
<?php $this->load->view('foot');?>