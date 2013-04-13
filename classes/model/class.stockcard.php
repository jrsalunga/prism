<?php
// If it's going to need the database, then it's 
// probably smart to require it before we start.
require_once(ROOT.DS.'classes'.DS.'database.php');

class Stockcard extends DatabaseObject{
	
	protected static $table_name="stockcard";
	protected static $db_fields = array('id', 'itemid' ,'locationid' ,'postdate' ,'txndate' ,'txncode' ,'txnrefno' ,'qty' ,'prevbal' ,'currbal' ,'prevbalx' ,'currbalx');
	
	/*
	* Database related fields
	*/
	public $id;
	public $itemid;
	public $locationid;
	public $postdate;
	public $txndate;
	public $txncode;
	public $txnrefno;
	public $qty;
	public $prevbal;
	public $currbal;
	public $prevbalx;
	public $currbalx;
	
	
	
	function get_currbal(){
		return $this->currbal = $this->qty + $this->prevbal;	
	}
	
	
	public static function get_latest(){
		$sql = "SELECT * FROM ".self::$table_name." ORDER BY postdate DESC LIMIT 1";
		$result_array = self::find_by_sql($sql);
		return !empty($result_array) ? array_shift($result_array) : false;	
	}
	
	

	
	
}

