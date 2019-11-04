<?php
/**
 *  网站首页控制器
 */
class Index extends MY_Controller{
	public function __construct(){
		parent::__construct();
	}
	public function index(){
	 
	
	  if($GLOBALS['wl_ts']['cache']==true){
	     $this->output->cache(1440);//输出缓存设置，单位分钟
	  }
		$this->load->view('index');
	}
	

}
	