<?php

class sAPVhdr {
/*	
  var $refno;
  var $date;
  var $locationid;
  var $supplierid;
  var $supprefno;
  var $porefno;
  var $terms;
  var $notes;
  */
  var $refno;
  var $totqty;
  var $totalamount;
  var $id;
  var $entries;
  
  
  function __construct(){
	$this->totqty = 0;
	$this->totalamount = 0;
	$this->entries = array();
	#$this->check_toyqty();	  
	
  }
  
   
  
  public function add_detail($apvhdrid, $itemid, $qty, $unitcost, $id) {
	if(isset($apvhdrid) && $apvhdrid != NULL){
		$this->entries[$itemid] = new sAPVdtl($apvhdrid, $itemid, $qty, $unitcost, $id);  
		#$amount = $qty * $unitcost;
		$this->check_totqty();
		$this->check_totalamount();
		#$this->totqty = $this->totqty + $qty;
		#$this->totalamount = $this->totalamount + $amount;
	} 
  }
  
  public function delete_detail($itemid){
	  
		unset($this->entries[$itemid]);
		$this->check_totqty();
		$this->check_totalamount();
  }
  
  public function check_totqty() {
	  foreach($this->entries as $item) {
		  $total = $total + number_format($item->qty,0);
	  }
	  $this->totqty = $total;
  }
  
  public function check_totalamount() {
	   foreach($this->entries as $item) {
		  $total = $total + $item->amount;
	  }
	  $this->totalamount = number_format($total,2);
	  
  }



}







?>