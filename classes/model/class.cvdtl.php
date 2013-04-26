<?php
// If it's going to need the database, then it's 
// probably smart to require it before we start.
require_once(ROOT.DS.'classes'.DS.'database.php');

class Cvhdr extends DatabaseObject{
	
	protected static $table_name="cvhdr";
	protected static $db_fields = array('id', 'refno' ,'date' ,'supplierid' ,'payee' ,'bankcode' ,'checkno' ,'notes' ,'totline' ,'totamount' ,'posted' ,'cancelled' );
	
	/*
	* Database related fields
	*/
	public $id;
	public $refno;
	public $date;
	public $supplierid;
	public $payee;
	public $bankcode;
	public $checkno;
	public $notes;
	public $totline;
	public $totamount;
	public $posted;
	public $cancelled;
	
	
}

