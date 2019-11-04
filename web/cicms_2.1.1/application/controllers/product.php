<?php
/**
 *  控制器
 */
class Product extends MY_Controller{
	public function __construct(){
		parent::__construct();
		$this->m=$this->load->model("Productm");//加载新闻模型
		$this->m=$this->Productm;//重命名新闻模型
		$this->model=$this->router->class;//当前模块名称
		
		 $this->category=$data['category']=$this->p->get_category_info();//读取当前栏目和顶级栏目信息
		 if($data['category']!=false){
			$this->load->vars('category',$data['category']);//当前栏目
			$this->load->vars('top_category',$data['category']['top']);//顶级栏目
			$this->load->vars('parent_category',$data['category']['parent']);//父级栏目
		 }
		
	}
	
	public function index(){
	   $this->lists();
	}
	public function lists(){
	     if($this->category==false){$this->load->view('error_404'); return false;}
	    $catid=$pagecatid=intval($this->uri->segment(3));//当前栏目catid
		 if($catid){
		    $catid=$this->p->ar_catid($catid);//获取栏目下所有子类ID
			$where="catid in({$catid})";
		 }else{
		    $where='';
		 }
		
	     //统计数量
		$count = $this->m->lists('','',$where,'count');
		//配置分页
		$GLOBALS['wl_page']['product']=isset($GLOBALS['wl_page']['product'])?$GLOBALS['wl_page']['product']:10;
		$page_list = config_page($count,$this->model.'/lists/'.$pagecatid,$GLOBALS['wl_page']['product']);
		$this->my_page->initialize($page_list);
		$data['list'] = $this->m->lists($page_list['perpage'],$page_list['nowindex'],$where);
		$pages=trim($this->my_page->show()) ? $this->my_page->show() : " ";
		
		$this->load->vars('data',$data);
		$this->load->vars('pages',$pages);
		$this->load->view($this->model.'_list');
	}
	
	public function show(){
	       if($this->category==false){$this->load->view('error_404'); return false;}
		   $data=$this->p->get_model_info();
		    //获取产品品牌信息
		   $this->load->model("Brandm");
		   $data['res']['brand']=$this->Brandm->get_one($data['res']['bid']);
		   
		   $this->load->vars('data',$data);	
		   $this->load->view($this->model.'_show');
	}

}
	