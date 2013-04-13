<?php
// If it's going to need the database, then it's 
// probably smart to require it before we start.
require_once(ROOT.DS.'classes'.DS.'database.php');

class vApvhdr extends DatabaseObject{
	
	protected static $table_name="vapvhdr";
	protected static $db_fields = array('id', 'refno' ,'date' ,'location' ,'supplier' ,'supprefno' ,'porefno' ,'terms' ,'totqty' ,'totamount' ,'totdebit' ,'totcredit' ,'balance','posted');
	
	
	public $id;
	public $refno;
	public $date;
	public $location;
	public $supplier;
//	public $supprefno;
//	public $porefno;
	public $terms;
	public $totqty;
	public $totamount;
	public $totdebit;
	public $totcredit;
	public $balance;
	public $posted;
	
	
	
	
	
	
	
}

