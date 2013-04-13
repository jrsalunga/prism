<?php
// If it's going to need the database, then it's 
// probably smart to require it before we start.
require_once(ROOT.DS.'classes'.DS.'database.php');

class Todo extends DatabaseObject{
	
	protected static $table_name="todo";
	protected static $db_fields = array('id', 'description' ,'status' );
	
	/*
	* Database related fields
	*/
	public $id;
	public $description;
	public $status;
	
	
}

