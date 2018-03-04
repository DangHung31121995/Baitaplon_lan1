<?php
require_once('Model/city_hotel_model.php');
class VIEWHOTEL_CONTROLlER{

	var $model;
	public function __construct(){
		$this->model=new city_hotel_model();
 	 }
	public function run(){
	
	

 		$countHotel=$this->model->getCityHotel();
 		// print_r($countHotel);
 	

 		require_once('View/user/hotels.php');
 	}
}

?>