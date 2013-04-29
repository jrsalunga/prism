<?php
include_once('../../lib/initialize.php');
error_reporting(E_ALL);
ini_set('display_errors','On');


$table = 'item';

//$ar1 = array('refno', 'code', 'descriptor');
$ar2 = array('code', 'descriptor');

/*
print_r(array_merge($ar1, $ar2));
echo "<br>";
print_r(array_unique(array_merge($ar1, $ar2)));
echo "<br>";
print(join(" = LIKE '%. \$q .%' OR ",array_intersect($ar1, $ar2)));

//var_dump(array_merge($ar1, $ar2));
*/


   $sql = "DESCRIBE ". $table;
    #echo $sql ."<br>";
    $rows = $database->query($sql);

    $ar1 = array();

    while($row = $database->fetch_row($rows)) {
        $ar1[] = $row[0];
    }
	
	$ar = array_intersect($ar1, $ar2);
	
	echo str_replace(" , ", " ", implode("`, `", $ar));
	
	
	
	

?>