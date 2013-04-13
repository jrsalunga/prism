<?php
// If it's going to need the database, then it's 
// probably smart to require it before we start.
require_once(ROOT.DS.'classes'.DS.'database.php');

class ItemType extends DatabaseObject{
	
	protected static $table_name="item_type";
	protected static $db_fields = array('code', 'descriptor');
	
	/*
	* Database related fields
	*/
	public $code;
	public $descriptor;
	
	/*
	* Additional fields
	*/
}

