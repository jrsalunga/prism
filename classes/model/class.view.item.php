<?php
// If it's going to need the database, then it's 
// probably smart to require it before we start.
require_once(ROOT.DS.'classes'.DS.'database.php');

class vItem extends DatabaseObject{
	
	protected static $table_name="vitem";
	protected static $db_fields = array('id', 'code' ,'descriptor' ,'type' ,'category', 'onhand' ,'unitprice', 'floorprice' ,'unitcost' ,'umeasure');
	
	public $id;
	public $code;
	public $descriptor;
	public $type;
	public $category;
	public $onhand;
	public $unitprice;
	public $floorprice;
	public $unitcost;
	public $umeasure;
	
	function __construct(){
		
	}


}

