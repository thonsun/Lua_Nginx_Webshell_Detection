<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php $this->load->view('sys_seo');?>
<base href="<?=base_url();?>" />
<link rel="stylesheet" type="text/css" href="skin/css/base.css" />
<link rel="stylesheet" type="text/css" href="skin/css/style.css" />
<script type="text/javascript" src="skin/js/jquery.min.js"></script>
<script type="text/javascript" src="skin/js/base.js"></script>
<script type="text/javascript" src="skin/js/jquery-juren-slidepattern.js"></script>
</head>
<body>
<div class="headerBj">
  <div class="header_top clear">
    <div class="left logo" > <a href="<?=base_url();?>"> <img src="upload/<?=$setting['logo']?>" alt="logo" height="62" /></a></div>
    <div class="right">
      <div class="clear lxdh"> <span class="col_0 f_12" >全国统一服务电话:</span> <span class="col_0 f_12" ><?=$setting['tel']?></span> </div>
      <div class="clear">
        <div class="right searchBox clear">
          <form action="<?=base_url();?>search/" method="get" target="_blank">
               <input type="text" name="q" placeholder="请输入关键字" class="searchText left" />
               <input type="submit" value="搜索" class="searchBtn  left" />
          </form>
        </div>
      </div>
    </div>
  </div>
  <div class="navBox">
    <ul class="nav clear">
    <li class="nav_li"><a href="<?=base_url();?>" class="nav_a <?php if(empty($top_category['tablename'])){ echo "active";}?>">首页</a></li>
        <?php foreach ($cat as $v){?>
        <li class="nav_li "> <a href="<?=$v['url']?>" class="nav_a <?php if(isset($top_category['id']) && $top_category['id']==$v['id']){echo "active";}?>"><?=$v['catname']?> </a>
          <?php if(!empty($v['child'])){ ?>
            <ul>
            <?php foreach ($v['child'] as $k){?>
            <li><a href="<?=$k['url']?>"><?=$k['catname']?></a></li>
            <?php }?>
          </ul>
          <?php }?>
        </li>
        <?php }?>  
    </ul>
  </div>
</div>