<?php
include_once('../../lib/initialize.php');
error_reporting(E_ALL);
ini_set('display_errors','On');

$x = explode("id","itemid");

echo $x[0]."<br>";

$x = strpos("itemid","id");

echo $x."<br>";

echo substr_compare("itemid", "id", -2, 2); // 0
echo "<br>";
echo substr_compare("id", "id", -2, 2); 
echo "<br>";
echo substr_compare("unitcount", "id", -2, 2); 
echo "<br>";
echo substr_compare("unitcoidks", "id", -2, 2)


?>