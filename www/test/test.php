<?php
include_once('../../lib/initialize.php');
error_reporting(E_ALL);
ini_set('display_errors','On');


$table = "item";

$sTable = ucfirst($table);
$oTable = new $sTable();
$oTable->code = 'jeff5';
$oTable->categoryid = '02471a4b1c0b11e293185404a67007de';
#$oTable->id = '01b880d41fcc11e293185404a67007de';

if($oTable->save()){
	echo "saved <br>";	
} else {
	echo "not saved <br>";	
}

echo $database->last_query;

echo "<br>";

echo $oTable->id ."<br>";

$id =  $oTable->id;

#$vTable = substr_replace($sTable, 'v', 0, 0);

#echo $vTable ."<br>";

#$ovTable = $vTable::find_by_id($oTable->id);

#echo $ovTable->code ."<br>";
$vTable = "vItem";
echo $vTable."<br>";


$item = $vTable::find_by_id('cb50b0211ffd11e293185404a67007de');
echo $database->last_query;

echo "<br>";
var_dump($item);
echo "<br>";
echo $item->code ."<br>";
echo "category = ".$item->category ."<br>";



/*
echo $studentid."<br>";
echo $id."<br>";





$sql	= "SELECT a.lastname, a.firstname, a.middlename, a.id as teacherid, "
		. "b.code as class_code, b.descriptor as class_descriptor, b.id as classid, "
		. "c.code as section_code, c.descriptor as section_descriptor, c.id as sectionid, "
		. "d.code as gradelevel_code, d.descriptor as gradelevel_descriptor, d.id as gradelevelid, d.departmentid, d.ordinal, "
		. "e.code as sy_code, e.descriptor as sy_descriptor, e.id as schoolyearid, "
		. "f.code as subject_code, f.descriptor as subject_descriptor, f.id as subjectid, f.ordinal as subject_ordinal "
		. "FROM teacher a, class b, section c, gradelevel d, schoolyear e, subject f "
		. "WHERE a.id = b.teacherid AND b.sectionid = c.id AND c.gradelevelid = d.id AND c.schoolyearid = e.id AND b.subjectid = f.id AND f.schoolyearid = e.id "
		. "ORDER BY sy_code, ordinal, subject_ordinal, class_code";
		
echo $sql;

*/

#$gradelevels = Gradelevel::find_all("ORDER BY ordinal ASC");

#foreach ($gradelevels as $gradelevel){
#    echo $gradelevel->descriptor."<BR>";
#}


#$unixdatetime = strtotime("now");
 # echo strftime("%Y-%m-%d", $unixdatetime);


/*
$gradebkdtl = new Gradebkdtl();

$gradebkdtl->gradebkhdrid = "5e3de8b5dffc11e1b7170019d1ffe145";
$gradebkdtl->id = "5e3de8b5dffc11e1b7170019d1ffe145";
echo $gradebkdtl->save() ? "saved":"error";
*/



#echo preg_match('/^[A-Fa-f0-9]{32}+$/',"2d785c1dd3bd11e1a5b100b795c51e4");

?>