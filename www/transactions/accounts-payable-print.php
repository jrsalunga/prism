<?php

include_once('../../lib/initialize.php');
#error_reporting(E_ALL);
#ini_set('display_errors','On');
$cleanUrl->setParts('apvhdrid');

$apvhdr = Apvhdr::find_by_id($apvhdrid);



?>
<!DOCTYPE HTML>
<html lang="en-ph">
<head>
<meta charset="utf-8">
<title>Accounts Payable : Print Preview</title>

<link rel="stylesheet" href="../css/print.css">
<link rel="stylesheet" href="<?=$relativeslash?>../css/print.css">


<style media="screen">
#page-wrap {
    background-color: #FFFFFF;
    margin-left: auto;
    margin-right: auto;
    width: 814px;
    position:relative;
    
    border: 1px solid #888888;
    margin-top: 20px;
    margin-bottom: 30px;
    
    height: 1046px;
    
    
    -webkit-box-shadow:rgba(0, 0, 0, 0.496094) 0 0 10px;
	-moz-box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
  
}
</style>
<style media="print">
#page-wrap {
    background-color: #FFFFFF;
    margin-left: auto;
    margin-right: auto;
    width: 814px;
    position:relative;
    
    margin-top: 0;
    margin-bottom: 0;
    /*
    border: none;
    height: 1046px;
	*/
/*	border: 1px solid #F00; */
    height: 1054px;
}
</style>


</head>
<body>


<div id="page-wrap">
    <div id="header">
    	<div id="main-logo">
            
        </div>
    	<div id="header-wrap">
        	
        	<h2>Saint Jude Catholic School</h2>
            
            <h1 class="reportLabel">Account Payable Voucher</h1>
        </div>		
    </div>
    <div id="body">
   		<div id="m-container">
   			<div id="hdr">
            	<div id="supplier-title">
                <?php
					$location = Location::find_by_id($apvhdr->locationid);
				?>
                <div><?=$location->code?></div>
                <?=uc_first($location->descriptor)?>
                
                </div>
               	
                <table id="meta">
                	<tbody>
                    	<tr>
                        	<td>Reference #</td><td><?=$apvhdr->refno?></td>
                        </tr>
                        <tr>
                        	<td>Date</td><td><?=short_date($apvhdr->date)?></td>
                        </tr>
                        <tr>
                        	<td>Supplier</td><td><?=Supplier::row($apvhdr->supplierid,1)?></td>
                        </tr>
                        <tr>
                        	<td>Supplier Ref #</td><td><?=$apvhdr->supprefno?></td>
                        </tr>
                        <tr>
                        	<td>PO Ref #</td><td><?=$apvhdr->porefno?></td>
                        </tr>
                    </tbody>
                </table>
                <div style="clear:both"></div>
            </div>
            <table id="items">
            	<thead>
                	<tr>
                    	<th>Code </th>
                        <th>Description</th>
                        <th>Unit Cost</th>
                        <th>Quantity</th>
                        <th>Price</th>
                    </tr>
                </thead>
                <tbody>
                	<?php
					
					$items = Apvdtl::find_all_by_field_id('apvhdr',$apvhdrid);
					
					//echo json_encode($items);
					
					foreach($items as $item){
						$item_code = Item::row($item->itemid,0);
						$item_descriptor = Item::row($item->itemid,1);
						
						echo "<tr>";
						echo "<td>". $item_code ."</td><td>". uc_first($item_descriptor) ."</td><td>". number_format($item->unitcost,2) ."</td><td>". number_format($item->qty) ."</td><td>". number_format($item->amount,2) ."</td>";
						echo "</tr>";
					}
					
					//echo json_encode($items);
					
	
					
					?>
      
                    <tr>
                    	<td class="blank" colspan="2"></td>
                        <td class="total-line" colspan="2">Total Amount</td>
                        <td class="total-value"><?=number_format($apvhdr->totamount,2)?></td>
                    </tr>
                    <tr>
                    	<td class="blank" colspan="2"></td>
                        <td class="total-line" colspan="2">Total Debit</td>
                        <td class="total-value"><?=number_format($apvhdr->totdebit,2)?></td>
                    </tr>
                    <tr>
                    	<td class="blank" colspan="2"></td>
                        <td class="total-line" colspan="2">Total Credit</td>
                        <td class="total-value"><?=number_format($apvhdr->totcredit,2)?></td>
                    </tr>
                    <tr>
                    	<td class="blank" colspan="2"></td>
                        <td class="total-line" colspan="2">Balance</td>
                        <td class="total-value"><?=number_format($apvhdr->balance,2)?></td>
                    </tr>
                </tbody>
            </table>
    	</div>
    </div>
    <div id="footer">
    	<div>&nbsp;</div>
    </div>
</div>

</body>
</html>