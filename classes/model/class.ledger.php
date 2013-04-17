<?php
// If it's going to need the database, then it's 
// probably smart to require it before we start.
require_once(ROOT.DS.'classes'.DS.'database.php');

/*
class Ledger extends DatabaseObject {
	
	public $IncTxnCodeList
	public $DecTxnCodeList
	
	function GetChange( tcTxnCode, tnValue )
	   IF tnValue isfoundin This.IncTxnCodeList
	      return tnValue
	   else
	      return tnValue * (-1)
	   endif
	
	function Update()
}

class APLedger extends Ledger {
     $table_name = "apledger" ;
     this.IncTxnCodeList = "APV,CM" ;
	 this.DecTxnCodeList = "CV,DM" ;
	 
     function Update( tcTxnCode, tcRefno, tdTxnDate, tnAmount, tnCurrBalance )
	     $tnAmount = This.GetChange( tcTxnCode, tnAmount )
		 $tnPrevBal = tnCurrBalance
		 $tnCurrBal = tnPrevBal + tnAmount
		 this.Add( tcTxnCode, tcRefno, tdTxnDate, tnAmount, tnCurrBalance )

}

*/


class Ledger extends DatabaseObject {
	
	public static $IncTxnCodeList = array();
	public static $DecTxnCodeList = array();
	
	public function GetChange($tcTxnCode, $tnValue) {
	   if(array_search($tnValue, static::$IncTxnCodeList)) {
	      return $tnValue;
	   } else {
	      return $tnValue * (-1);
	   }
	}
	

}

class Apledger2 extends Ledger{
	
	protected static $table_name="apledger";
	protected static $db_fields = array('id', 'supplierid' ,'postdate' ,'txndate' ,'txncode' ,'txnrefno' ,'amount' ,'prevbal' ,'currbal');
	
	/*
	* Database related fields
	*/
	public $id;
	public $supplierid;
	public $postdate;
	public $txndate;
	public $txncode;
	public $txnrefno;
	public $amount;
	public $prevbal;
	public $currbal;
	
	
	public static $IncTxnCodeList = array('APV','CM');
	public static $DecTxnCodeList = array('CV','DM');
	 
    public function create($tcTxnCode, $tcRefno, $tdTxnDate, $tnAmount, $tnCurrBalance, $tnSupplierId ) {
		
		$apledger 				= new self();
		$apledger->amount 		= $apledger->GetChange($tcTxnCode, $tnAmount);
		$apledger->prevbal 		= $tnCurrBalance;
		$apledger->currbal 		= $apledger->prevbal + $apledger->amount;
		$apledger->date 		= $tdTxnDate;
		$apledger->txnrefno 	= $tcRefno;
		$apledger->txncode  	= $tcTxnCode; 	
		$apledger->supplierid 	= $tnSupplierId;
		
		return parent::create() ? true : false;
		
		
	}
	
	

	
	
}

