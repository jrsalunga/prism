<?php
include_once('../../lib/initialize.php');
error_reporting(E_ALL);
ini_set('display_errors','On');

$x = (object) array("fullname" => "Jefferson R. Salunga");
$x->age = 1;


echo json_encode($x);


?>