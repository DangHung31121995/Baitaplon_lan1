<?php
require_once('Model/News/NewsViewModel.php');
class VIEWNEWS_CONTROLLER{
	var $model;
	public function __construct(){
		$this->model=new NEWS_MODEL();
 	 }
	public function run(){

		$idnews=isset($_GET['id'])?$_GET['id']:'';
		if(empty($idnews)){
			$data= $this->model->GETALLNEWS();
			// print_r($data);

	 		require_once('View/user/news.php');
 		}else{
 			$data =$this->model->GetDetailNews($idnews);
 			// print_r($data);
 			require_once('View/user/newsdetail.php');

 		}
 		
 	}
}

?>