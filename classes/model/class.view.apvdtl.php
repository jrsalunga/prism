<?php
// If it's going to need the database, then it's 
// probably smart to require it before we start.
require_once(ROOT.DS.'classes'.DS.'database.php');

class vApvdtl extends DatabaseObject{
	
	protected static $table_name="vapvdtl";
	protected static $db_fields = array('id' ,'item' ,'qty' ,'unitcost' ,'amount');
	
	
	public $id;
	public $item;
	public $qty;
	public $unitcost;
	public $amount;
	
	
	
	
	
	
}

