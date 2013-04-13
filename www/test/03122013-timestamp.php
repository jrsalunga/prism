<?php
include_once('../../lib/initialize.php');
error_reporting(E_ALL);
ini_set('display_errors','On');

/*$apledger = new Apledger();

$apledger->supplierid = '9a5f24f2824111e2b7ed5404a67007de';
$apledger->txndate = '2013-03-11';
$apledger->txncode = 'APV';
$apledger->txnrefno = '005';
$apledger->amount = 5161;
$apledger->prevbal = 47471.7;
$apledger->currbal = $apledger->get_currbal();*/
//$apledger->save();


$apledger = Apledger::get_latest();
$apledger->amount = $apledger->amount + 5;

echo json_encode($apledger);





?>