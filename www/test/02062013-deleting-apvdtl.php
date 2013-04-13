<?php
include_once('../../lib/initialize.php');
error_reporting(E_ALL);
ini_set('display_errors','On');


$table =  "apvdtl";
$table2 = "apvhdr";
$apvhdrid = "972deccea27011e286235404a67007de";

$sTable = ucfirst($table);

$sTable::delete_all_by_field_id($table2,$apvhdrid);    



?>