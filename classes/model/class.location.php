<?php
// If it's going to need the database, then it's 
// probably smart to require it before we start.
require_once(ROOT.DS.'classes'.DS.'database.php');

class Location extends DatabaseObject{
	
	protected static $table_name="location";
	protected static $db_fields = array('id', 'code', 'descriptor');
	
	/*
	* Database related fields
	*/
	public $id;
	public $code;
	public $descriptor;

	
	/*
	* Additional fields
	*/

	
	
	
	
	
}

