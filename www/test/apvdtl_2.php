<?php
include_once('../../lib/initialize.php');
error_reporting(E_ALL);
ini_set('display_errors','On');










$_SESSION['header']->add_detail("2","item",10,100);
$_SESSION['header']->add_detail("3","item3",2,10);
$_SESSION['header']->add_detail("4","item4",2,50);
$session->apvhdr->add_detail("4","item4",2,50);



?>

<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>


<table cellpadding="5" cellspacing="0" border="1" style="border-collapse:collapse">
<?php

foreach($_SESSION['header']->entries as $item) {
	
	echo "<tr>";
	echo "<td>$item->apvhdrid</td>
		  <td>$item->itemid</td>
		  <td>$item->qty</td>
		  <td>$item->unitcost</td>
		  <td>$item->amount</td>";
	echo "</tr>";	
	
}




?>
</table>



<?php
echo "<br>";
echo "<br>";
echo var_export($session->apvhdr,TRUE);


?>
</body>
</html>
