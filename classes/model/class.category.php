<?php
// If it's going to need the database, then it's 
// probably smart to require it before we start.
require_once(ROOT.DS.'classes'.DS.'database.php');

class Category extends DatabaseObject{
	
	protected static $table_name="category";
	protected static $db_fields = array('id', 'code', 'descriptor', 'type');
	
	/*
	* Database related fields
	*/
	public $id;
	public $code;
	public $descriptor;
	public $type;
	
	/*
	* Additional fields
	*/
	#public $type_name; 
	
	
	
	function __construct() {
		$this->get_type_name();
		//$this->set_type_name();
	}
	
	public function get_type_name() {
		if($this->type == 1) {
			return 'Product/Service';
			
		} else {
			return 'Expense';
			
		}
	}

	public function set_type_name() {
		if($this->type == 1) {
			//return 'Product/Service';
			$this->$type_name = 'Product/Service';
		} else {
			//return 'Expense';
			$this->$type_name =  'Expense';
		}
	}
	
}

