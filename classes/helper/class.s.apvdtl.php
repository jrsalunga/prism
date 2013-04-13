<?php

class sAPVdtl {
	
	var $apvhdrid;
	var $itemid;
	var $qty;
	var $unitcost;
	var $amount;
	var $id;
	
	function __construct($apvhdrid, $itemid, $qty, $unitcost, $id){
		if(isset($apvhdrid) && $apvhdrid != NULL){
			$this->apvhdrid = $apvhdrid;
			$this->itemid = $itemid;
			$this->qty = $qty;
			$this->unitcost = $unitcost;
			$this->amount = $qty * $unitcost;
			$this->id = $id;
		}
	}	
	
}




?>