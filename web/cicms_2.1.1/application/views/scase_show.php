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
        	<h2 class="f_16 col_88cfc8 left main_rightTitle_left"><?=$category['catname']?></h2>
            <div class="right main_rightTitle_right">
             <?php $this->load->view('sys_nav');?> 
            </div>
        </div>
        <div class="productBox">
        	<div class="clear">
            	<!--放大镜-->
                <div id="magnifierBox" class="left">
                    <div id="magnifierDiv1" class="divStyle">
                        <img src="<?=$data['res']['image']?>" alt="<?=$data['res']['title']?>" width="264" height="198"><!--小图-->
                        <span id="magnifierSon" style="display: none; left: 52px; top: 92px;"></span><!--浮层-->
                    </div>
                    <div id="magnifierDiv2" class="divStyle" style="display: none;">
                        <img src="<?=$data['res']['image']?>" alt="<?=$data['res']['title']?>" id="magnifierImg1" style="left: -154.747px; top: -340.4px;" width="760" height="570"><!--大图-->
                    </div>
                </div>
                <!--放大镜结束-->
                <div class="left product_topright">
                	<div class="product_topright_t">
                    	<h1 class="col_0 f_16"><?=$data['res']['title']?></h1>
                    </div>
                    <div>
                        <p></p><p><?=$data['res']['des']?><br></p><p></p>
                    </div>
                </div>
            </div>
      		<div class="cpxq_box">
                <div class="cpxqTab_btnBox clear">
                    <span class="cpxqTab_btn left on">产品概述和特点</span>
                </div>
                <div class="cpxqTab_divBox">
                    <div class="cpxqTab_div on">
                        <?=$data['res']['content']?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</div>
<?php $this->load->view('foot');?>
