<?php
// If it's going to need the database, then it's 
// probably smart to require it before we start.
require_once(ROOT.DS.'classes'.DS.'database.php');

class vCategory extends DatabaseObject{
	
	protected static $table_name="vcategory";
	protected static $db_fields = array('id', 'code', 'descriptor', 'type');
	
	public $id;
	public $code;
	public $descriptor;
	public $type;
	


}

