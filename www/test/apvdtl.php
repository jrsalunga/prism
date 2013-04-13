<?php
include_once('../../lib/initialize.php');
error_reporting(E_ALL);
ini_set('display_errors','On');



$apv = new sAPVdtl("1","item2",5,100);

echo var_export($apv,TRUE);

echo "<br>";

$_SESSION['header'] = new sAPVhdr();


echo var_export($_SESSION['header'],TRUE);
echo "<br>";

$_SESSION['header']->add_detail("2","item",10,100);
$_SESSION['header']->add_detail("3","item3",2,10);
$_SESSION['header']->add_detail("4","item4",2,50);

echo var_export($_SESSION['header'],TRUE);

echo "<br>";

echo "<br>";
echo json_encode($_SESSION['header']);
echo "<br>";
echo "<br>";
echo $_SESSION['header']->entries['item']->unitcost;
echo "<br>";
echo "<br>";



$_SESSION['header']->delete_detail("item");

echo "<br>";
echo "<br>";
echo var_export($_SESSION['header'],TRUE);






?>