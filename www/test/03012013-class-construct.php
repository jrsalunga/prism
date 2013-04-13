<?php
include_once('../../lib/initialize.php');
error_reporting(E_ALL);
ini_set('display_errors','On');

class Bag {
	public $name;
	public $price;
	
	function __construct(){
	 	$this->name = "Channel";
		$this->price = number_format($this->price, 2);	
	}
}

$b = new Bag();

$b->price = 5000;

echo json_encode($b);

?>