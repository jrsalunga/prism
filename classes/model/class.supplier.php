<?php
// If it's going to need the database, then it's 
// probably smart to require it before we start.
require_once(ROOT.DS.'classes'.DS.'database.php');

class Supplier extends DatabaseObject{
	
	protected static $table_name="supplier";
	protected static $db_fields = array('id', 'code', 'descriptor', 'payee' ,'cperson' ,'ctitle' ,'terms' ,'balance' ,'address' ,'phone' ,'fax' ,'mobile' ,'email' ,'notes');
	
	/*
	* Database related fields
	*/
	public $id;
	public $code;
	public $descriptor;
	public $payee;
	public $cperson;
	public $ctitle;
	public $terms;
	public $balance;
	public $address;
	public $phone;
	public $fax;
	public $mobile;
	public $email;
	public $notes;

	
	
	
}

