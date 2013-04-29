<?php
// If it's going to need the database, then it's 
// probably smart to require it before we start.
require_once(ROOT.DS.'classes'.DS.'database.php');

class vCvhdr extends DatabaseObject{
	
	protected static $table_name="vcvhdr";
	protected static $db_fields = array('id', 'refno' ,'date', 'supplier', 'bankcode' ,'checkno', 'totamount' ,'posted');
	
	public $id;
	public $refno;
	public $date;
	public $supplier;
	public $bankcode;
	public $checkno;
	public $totamount;
	public $posted;
	
	function __construct(){
		
	}


}

