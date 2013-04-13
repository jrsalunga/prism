<?php
// If it's going to need the database, then it's 
// probably smart to require it before we start.
require_once(ROOT.DS.'classes'.DS.'database.php');

class Customer extends DatabaseObject{
	
	protected static $table_name="customer";
	protected static $db_fields = array('id', 'code', 'descriptor', 'cperson' ,'ctitle' ,'salesmanid' ,'terms' ,'balance' ,'address' ,'phone' ,'fax' ,'mobile' ,'email' ,'notes');
	
	/*
	* Database related fields
	*/
	public $id;
	public $code;
	public $descriptor;
	public $salesmanid;
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

