<?php
include_once('../../lib/initialize.php');
error_reporting(E_ALL);
ini_set('display_errors','On');


$todo = new Todo();

#$todo->description = 'Study Backbonejs';
#$todo->status = 'incomplete';
$todo->id = '73494398182b11e2ad9f5404a67007de';
#$todo->create();



$todo = Todo::find_by_id($todo->id);
echo json_encode($todo);



?>