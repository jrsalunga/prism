<?php
include_once('../../lib/initialize.php');
error_reporting(E_ALL);
ini_set('display_errors','On');


class piraso {
	public $name;
	public $price;
	
	
	function __construct(){
		$this->name = 'jeff';
		$this->price = floatval($this->price);
	}
}

$item = new piraso;

echo $item->name."<br>";
$item->price = "1,000.00";
echo $item->price;


?>