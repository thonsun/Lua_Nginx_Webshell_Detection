<?php 
/*
前台，AJAX控制器

这里没有继承自定义MY_Controller,原因是因为验证表单的时候用户没有登录，会员模块的MY_Controller，必须登录才能范围

*/

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Qt_ajax extends CI_Controller {

   public function __construct(){
		parent::__construct();
		
		//判断是否登陆,获取登录用户信息
	    $this->load->library("session");
	    $this->member_info =$this->session->userdata('member_info');
	}

	
//前端文章收藏	
 public  function ajax_shoucang(){	
          
          if(empty($this->member_info['username'])){
		     exit('1');//用户没登陆
		  }else{
		     $data=$_POST;
			 $data['uptime']=time();
			 $data['username']=$this->member_info['username'];
			 $data['userid']=$this->member_info['id'];
			 $where=array('userid'=>$data['userid'],'model'=>$data['model'],'articleid'=>$data['articleid']);
			 $count= $this->db->from('member_shoucang')->where($where)->count_all_results();
			 if($count>0){
			   exit('3');//您已经收藏过
			 }else{
			     $this->db->insert('member_shoucang', $data);
			    exit('2');//收藏成功
			 }
		  }
       
 }
 
	
}
?>