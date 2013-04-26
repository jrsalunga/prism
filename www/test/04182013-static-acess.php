<?php
include_once('../../lib/initialize.php');
error_reporting(E_ALL);
ini_set('display_errors','On');




class A {
	
	public static $IncTxnCodeList = array();
	public static $DecTxnCodeList = array();
	
	public static function foo($txnCode, $amount){
		if(false !== array_search($txnCode, static::$IncTxnCodeList)){
			return $amount;
		} else {
			return $amount * (-1);
		}
	} 
}


class B extends A {
	
	public static $IncTxnCodeList = array('APV','CM');
	public static $DecTxnCodeList = array('CV','DM');
	
	public static function foo2 ($txnCode,$amount){
		return self::foo($txnCode, $amount);
		
	}
}



echo json_encode(B::foo2('APV',100));



?>