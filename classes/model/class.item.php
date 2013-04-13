<?php
// If it's going to need the database, then it's 
// probably smart to require it before we start.
require_once(ROOT.DS.'classes'.DS.'database.php');

class Item extends DatabaseObject{
	
	protected static $table_name="item";
	protected static $db_fields = array('id', 'code' ,'descriptor' ,'type' ,'categoryid', 'onhand' ,'unitprice', 'floorprice' ,'unitcost' ,'umeasure' ,'longdesc' ,'picfile');
	
	public $id;
	public $code;
	public $descriptor;
	public $type;
	public $categoryid;
	public $onhand;
	public $unitprice;
	public $floorprice;
	public $unitcost;
	public $umeasure;
	public $longdesc;
	public $picfile;
	
	
	#public $category;
	
	function __construct(){
		
	}
	

	function get_category(){
		$sql = "SELECT descriptor WHERE id = '". $this->categoryid ."'";
		$result = $database->query(sql);
		$row = $database->fetch_array($result);
		return !empty($row[0]) ? $row[0] : false;
	}
	
	function is_product(){
		return $this->type==1 ? true : false;
	}
}

