<?php
// If it's going to need the database, then it's 
// probably smart to require it before we start.
require_once(ROOT.DS.'classes'.DS.'database.php');

class vCustomer extends DatabaseObject{
	
	protected static $table_name="vcustomer";
	protected static $db_fields = array('id', 'code', 'descriptor', 'cperson' ,'ctitle' ,'salesman' ,'terms' ,'balance' );
	
	/*
	* Database related fields
	*/
	public $id;
	public $code;
	public $descriptor;
	public $cperson;
	public $ctitle;
	public $salesman;
	public $terms;
	public $balance;


	
	
	
}

