<?php
require_once('Model/Hotel/HotelViewModel.php');
class VIEWHOTEL_CONTROLlER{

	var $model;
	public function __construct(){
		$this->model=new HOTEL_MODEL();
 	 }
	public function run(){
		require_once('Model/City/CityViewModel.php');
		$city = new CITY_MODEL();

 		$countHotel=$this->model->GETALLHOTEL();
 	

 		require_once('View/user/hotels.php');
 	}
}

?>