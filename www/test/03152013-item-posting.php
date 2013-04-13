<?php
include_once('../../lib/initialize.php');
error_reporting(E_ALL);
ini_set('display_errors','On');

/*$apledger = new Apledger();

$apledger->supplierid = '9a5f24f2824111e2b7ed5404a67007de';
$apledger->txndate = '2013-03-11';
$apledger->txncode = 'APV';
$apledger->txnrefno = '005';
$apledger->amount = 5161;
$apledger->prevbal = 47471.7;
$apledger->currbal = $apledger->get_currbal();*/
//$apledger->save();



$apvhdr = Apvhdr::find_by_id('a99830df847511e289925404a67007de');
$apvdtl_items = Apvdtl::find_all_by_field_id('apvhdr','a99830df847511e289925404a67007de');
//$apvdtl_items = Apvdtl::find_all_by_field_id('apvhdr',$id);
	foreach ($apvdtl_items as $apv_items) {
            
            $item = Item::find_by_id($apv_items->itemid);  
            
            if($item->is_product()){
				
				//echo "<br> is product - ";
				
				
                // $itu = item to be updated
                $itu = new Item();
                $itu->onhand = $item->onhand + $apv_items->qty;
				$itu->id = $item->id;
				
                if($itu->lock_record()) {
							
                    if(!$itu->save()){
                        echo json_encode($itu->result_respone(1)); 
						exit();
                    }
                } else {
                   	echo json_encode($itu->result_respone(2)); 
					exit();
                }

				
				

                //$last_stockcard = Stockcard::get_latest();
               $last_stockcard->currbal = $item->onhand;

                $stockcard = new Stockcard();
                $stockcard->itemid      = $item->id;
                $stockcard->locationid  = $apvhdr->locationid;
                $stockcard->txndate     = $apvhdr->date;
                $stockcard->txncode     = 'APV';
                $stockcard->txnrefno    = $apvhdr->refno;
                $stockcard->qty         = $apv_items->qty;
                $stockcard->prevbal     = $last_stockcard->currbal;
                $stockcard->currbal     = $stockcard->get_currbal();
                //$stockcard->prevbalx    =;
                //$stockcard->currbalx    =;

                if($stockcard->lock_record()){

                    if(!$stockcard->save()){
                         
                       echo json_encode($stockcard->result_respone(1)); 
                       exit();

                    } else {
						echo "succes on saving <br>";	
					}
                } else {
                   echo json_encode($stockcard->result_respone(2));  
                    exit();
                }
				
            } // end is product
        } // end foreach item





?>