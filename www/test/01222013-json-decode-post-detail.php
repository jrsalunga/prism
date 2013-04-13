<?php
include_once('../../lib/initialize.php');
error_reporting(E_ALL);
ini_set('display_errors','On');


$apvdtl = new Apvdtl;

$apvdtl->apvhdrid = "512";
$apvdtl->itemid = "cb50b0211ffd11e293185404a67007de";
$apvdtl->qty = "2.00";
$apvdtl->unitcost = "4.00";
$apvdtl->amount = "8.00";
$apvdtl->id = "75e6ce3ba50a2d6da087dcb81bb1ea7";
$apvdtl->create();

$database;

echo $database->last_query;


/*

$json = '[
			{"apvhdrid":512,"id":"75e6ce3ba50a2d6da087dcb81bb1ea7","itemid":"cb50b0211ffd11e293185404a67007de","qty":2.0,"unitcost":2.00,"amount":4.00},
			{"apvhdrid":512,"id":"15aa2b504a6a414be8b798af48743131","itemid":"e483be441ffd11e293185404a67007de","qty":6.0,"unitcost":6.00,"amount":36.00}
		]';
		
$details = json_decode($json);
$table = "apvdtl";
$sTable = ucfirst($table);

foreach($details as $detail){
	
	$apvdtl = new Apvdtl();
	
	foreach($detail as $key => $value){
		$oTable->$key = $value;
	}
	
	echo json_encode($oTable)."<br>";
	
	$success = $oTable->save();
};

//echo var_dump($json);

*/

?>