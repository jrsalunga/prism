<?php
include_once('../../lib/initialize.php');
#error_reporting(E_ALL);
#ini_set('display_errors','On');

$cleanUrl->setParts('apvhdrid');


if(isset($_SESSION['apvhdr'])) {
	#echo "true<br>";
} else {
	#echo "false<br>";
	$_SESSION['apvhdr'] = new sAPVhdr();
	$_SESSION['apvhdr']->id = $database->get_uid();
}

#echo var_export($_SESSION['apvhdr'])."<br><br>";

#echo var_export($_SESSION['apvhdr']->id)."<br>";



//echo $apvhdrid;

if(isset($_POST['frm-detail-add-item'])) {
	if(isset($_POST['refno'])) {
		$_SESSION['apvhdr']->refno = $_POST['refno'];
	}
	
	$_SESSION['apvhdr']->add_detail($_SESSION['apvhdr']->id, $_POST['itemid'], $_POST['qty'], $_POST['unitcost'], $database->get_uid());																	
}

if(isset($_GET['delete'])) {
	$_SESSION['apvhdr']->delete_detail($_GET['delete']);																	
}


if(isset($_GET['unset'])) {
	unset($_SESSION['apvhdr']);							
}




?>
<!DOCTYPE html>
<html lang="en-ph">
<head>
<meta charset="utf-8">
<meta http-equiv="expires" content="0">

<meta content="no-store, no-cache, must-revalidate" http-equiv="cache-control"/>
<meta content="post-check=0, pre-check=0, false" http-equiv="cache-control"/>
<meta content="no-cache" http-equiv="pragma"/>

<title>Prism</title>

<link rel="stylesheet" href="<?=$relativeslash?>../css/bootstrap.css"/>
<link rel="stylesheet" href="<?=$relativeslash?>../css/globals.css"/>
<link rel="stylesheet" href="<?=$relativeslash?>../css/styles.css"/>
<link rel="stylesheet" href="<?=$relativeslash?>../css/datatable.css"/>
<!-- <link rel="stylesheet" href="http://code.jquery.com/ui/1.9.1/themes/base/jquery-ui.css"/> -->
<link rel="stylesheet" href="<?=$relativeslash?>../css/details-ui.css"/>

<link rel="stylesheet" href="./css/bootstrap.css"/>
<link rel="stylesheet" href="../css/globals.css"/>
<link rel="stylesheet" href="../css/styles.css"/>
<link rel="stylesheet" href="../css/datatable.css"/>
<!-- <link rel="stylesheet" href="http://code.jquery.com/ui/1.9.1/themes/base/jquery-ui.css"/> -->
<link rel="stylesheet" href="../css/details-ui.css"/>


<script src="../js/jquery-1.8.2.min.js"></script>
<script src="../js/jquery-ui-1.8.min.js"></script>
<script src="../js/jquery.blockUI.js"></script>
<script src="../js/jquery.validate.min.js"></script>
<script src="../js/jquery.dataTables.js"></script>
<script src="../js/FixedHeader.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/common.js"></script>
<script src="../js/NumberFormat154.js"></script>
<script>
function initMenu() {

  $('nav .fd').hide();
  $('nav #menu2 .fd').show();
  
  $('nav').on('click', '.bb', function(e){
	  e.preventDefault();
	 
	 var parent = $(this).parent();
	  
	  var checkElement = $(this).next();
      	if((checkElement.is('.fd')) && (checkElement.is(':visible'))) {
			checkElement.slideUp('normal');
			parent.removeClass('active'); 
        	return false;
        }
     	
		 if((checkElement.is('.fd')) && (!checkElement.is(':visible'))) {
			$('nav .fd:visible').slideUp('normal');
			$('nav .fd:visible').parent().removeClass('active'); 
			parent.addClass('active');
			checkElement.slideDown('normal');
        return false;
        }
		
	});
}


$(document).ready(function() {
	
	initMenu();
	
	
	function log( message ) {
            $( "<div>" ).text( message ).prependTo( "#log" );
            $( "#log" ).scrollTop( 0 );
        }
 
        $(".search-detail").autocomplete({
            source: function( request, response ) {
                $.ajax({
					type: 'GET',
					url: "http://localhost/prism/www/api/search/item",
                    dataType: "json",
                    data: {
                        maxRows: 25,
                        q: request.term
                    },
                    success: function( data ) {
                        response( $.map( data, function( item ) {
                            return {
                                label: item.code + ' - ' + item.descriptor,
                                value: item.code,
								id: item.id
                            }
                        }));
                    }
                });
            },
            minLength: 2,
            select: function( event, ui ) {
                log( ui.item ?
                    "Selected: " + ui.item.label :
                    "Nothing selected, input was " + this.value);
				$("#itemid").val(ui.item.id);
            },
            open: function() {
                $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
            },
            close: function() {
                $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
            }
        });
	
});
</script>


</head>

<body>
<div id="container">
	<header>
    	<div id="h-main">
			<div id="h-main-logo">
                <img src="../images/75x75.png" /> 
                <h1>Header</h1>
                <h2>System</h2>
            </div>
            <div id="h-main-user">
                <div>
                    <a href="#"><?=$session->fullname?></a>
                    <a href="<?=$relativeslash?>../logout" class="logout">Log out</a>
                </div>
                <img src="../images/silhouette36.png" >
            </div>  
        </div>
        <div style="clear: both; "/>
        <div id="h-nav">
        	<div id="h-nav-container"></div>
        </div>
        
        <div id="h-subnav">
        	<div id="h-subnav-container"></div>
        </div>
	</header>
    <div id="content">
    	<table>
        <tbody>
        	<tr>
            	<td>
                   	<nav class="main-nav">
          				<div id="menu1" class="nav">
                        	<div class="bb">
	                        	<div class="Sj"></div>
								<div class="yb"></div>
								<div class="kk">Masterfiles</div>
                          	</div>
                           <ul class="fd">
                            	<li><a href="<?=$relativeslash?>../masterfiles/category">Category</a></li>
                                <li><a href="<?=$relativeslash?>../masterfiles/item">Items</a></li>
                                <li><a href="<?=$relativeslash?>../masterfiles/salesman">Salesman</a></li>
                                <li><a href="<?=$relativeslash?>../masterfiles/supplier">Supplier</a></li>
                                <li><a href="<?=$relativeslash?>../masterfiles/customer">Customer</a></li>
                                <li><a href="<?=$relativeslash?>../masterfiles/location">Location</a></li>
                            </ul>
                        </div>
                        <div id="menu2" class="nav active">
                        	<div class="bb">
	                            <div class="Sj"></div>
								<div class="yb"></div>
								<div class="kk">Transactions</div>
                           	</div>
                             <ul class="fd">
                            	
                                
                               	<li><a href="<?=$relativeslash?>accounts-payable-hdr">Accounts Payable Header</a></li>
                                <li class="active"><a href="<?=$relativeslash?>accounts-payable-voucher">Accounts Payable </a></li>
                                <li><a href="<?=$relativeslash?>accounts-payable">Accounts Payable 2</a></li>
                            </ul>
                        </div>	
                        <div id="menu3" class="nav">
                        	<div class="bb">
	                        	<div class="Sj"></div>
								<div class="yb"></div>
								<div class="kk">Reports</div>
                           	</div>
                        </div>
                        <div id="menu4" class="nav">
                        	<div class="bb">
	                        	<div class="Sj"></div>
								<div class="yb"></div>
								<div class="kk">Utilities</div>
                            </div>
                        </div>			
                   	</nav>
                </td>
                <td></td>
				<td>
                	<div id="c-content">
                    	<header>
                    		<h1>Accounts Payable</h1>
                        </header>
                        <div id="breadcrum">
                        	<ul>
                            	<li><a href="#">Home</a></li>
                                <li><a href="#">Transactions</a></li>     
                                <li>Accounts Payable</li>                        
                            </ul>
                        </div>
                        <div id="c-content-toolbar">
                        <form id="frm-salesman" name="frm-salesman" class="table-model" data-table="salesman" action="" method="post">
                        	<button id="frm-category-save" class="toolbar-minibutton">New</button>
                        </form>
                        </div>
                        <form id="frm-apvhdr" name="frm-apvhdr" class="table-model" data-table="apvhdr" action="" method="post">
                        <div id="c-frm-container">
                        	<div id="frm-alert"></div>
                        	
                            	<table cellpadding="0" cellspacing="0" border="0" style="float:left;">
                                	<tbody>
                                    	<tr>
                                        	<td><label for="refno">Reference No:</label></td>
                                            <td><input type="text" id="refno" name="refno" maxlength="10" style="width:120px;" value="<?php echo isset($_SESSION['apvhdr']->refno) ? $_SESSION['apvhdr']->refno : $_POST['refno']?>" required /></td>
                                            
                                            <td><label for="date">Date:</label></td>
                                            <td><input type="date" id="date" name="date" style="width:120px;" value="<?php echo isset($_POST['date']) ? $_POST['date']:iso_date(); ?>" required /></td> 
                                        </tr>
                                        <tr>
                                        	<td><label for="supplierid">Supplier:</label></td>
                                            <td>
                                            	<select id="supplierid" name="supplierid" style="width:155px;">
						                        <?php
						                        
						                        $sSalesmans = Supplier::find_all();
																		
						                        foreach( $sSalesmans as  $sSalesman) {
						                            
													if($_POST['salesmanid']==$sSalesman->id){
														echo "<option value=\"".strtolower($sSalesman->id)."\" selected=\"selected\">". uc_first($sSalesman->descriptor) ."</option>";
													}
						                            echo "<option value=\"".strtolower($sSalesman->id)."\">". uc_first($sSalesman->descriptor) ."</option>";
						                        }  
						                        ?>
						                   		</select>
                                            </td>
                                          	<td><label for="locationid">Location:</label></td>
                                        	<td>
                                            	<select id="locationid" name="locationid" style="width:155px;">
						                        <?php
						                        
						                        $sLocations = Location::find_all();
												
						                        foreach($sLocations as  $sLocation) {
						                            
													if($_POST['locationid']==$sLocation->id){
														echo "<option value=\"".strtolower($sLocation->id)."\" selected=\"selected\">". uc_first($sLocation->descriptor) ."</option>";
													}
						                            echo "<option value=\"".strtolower($sLocation->id)."\">". uc_first($sLocation->descriptor) ."</option>";
						                        }  
						                        ?>
						                   		</select>
                                            </td>
                                        </tr>
                                        <tr>
                                        	<td><label for="supprefno">Supplier Ref No:</label></td>
                                            <td><input type="text" id="supprefno" name="supprefno" maxlength="10" style="width:120px;" value="<?=$_POST['supprefno']?>" /></td>
                                            
                                            <td><label for="porefno">PO Ref No:</label></td>
                                            <td><input type="text" id="porefno" name="porefno" maxlength="10" style="width:120px;"  value="<?=$_POST['supprefno']?>"/></td> 
                                        </tr>
                                         <tr>
                                          	<td><label for="terms">Terms:</label></td>
                                            <td><input type="number" id="terms" name="terms" style="width:100px;"  min="0" max="100"  value="<?=$_POST['terms']?>"  />
                                            
                                            <td><label for="totdebit">Total Debit:</label></td>
                                            <td><input type="text" id="totdebit" name="totdebit" maxlength="19" style="width:120px;" value="0.00" class="number" disabled /></td>
                                           
                                        </tr>
                                         <tr>
                                        	<td><label for="totqty">Total Quantity:</label></td>
                                            <td><input type="text" id="totqty" name="totqty" maxlength="19" style="width:120px;" value="<?=$_SESSION['apvhdr']->totqty?>" class="number" disabled /></td>
                                            
                                            <td><label for="totcredit">Total Credit:</label></td>
                                            <td><input type="text" id="totcredit" name="totcredit" maxlength="19" style="width:120px;"  class="number" value="0.00" disabled /></td>  
                                        </tr> 
                                         <tr>
                                         	<td><label for="totamount">Total Amount:</label></td>
                                            <td><input type="text" id="totamount" name="totamount" maxlength="19" style="width:120px;" value="<?=number_format($_SESSION['apvhdr']->totalamount,2)?>" class="number" disabled />
                                            	<input type="hidden" id="id" name="id" value="" />
                                            </td>
                                        	
                                             <td><label for="balance">Balance:</label></td>
                                            <td><input type="text" id="balance" name="balance" style="width:120px;" value="0.00" class="number" disabled  />
                                            
                                        </tr>    
                                           
                                       
                                        
                                        <tr>
                                        	<td></td>
                                            <td>
                                            	<!--
                                            	<button id="frm-btn-submit" class="minibutton">Submit</button>
				                            	<button id="frm-btn-save" class="minibutton" type="button">Save</button>
                                                <button id="frm-btn-delete" class="minibutton" type="button" disabled>Delete</button>
				                    			<button id="frm-btn-cancel" class="minibutton" type="button">Cancel</button>  
                                                -->
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                
                                <div style="float:left; margin-left:20px;">
                               
                                <?php
								  
								echo $_POST['itemid']."<br>";
								echo $_POST['qty']."<br>";
								echo $_POST['unitcost']."<br>";
								echo $_POST['amount']."<br>";
								;
								
								
								
								?>
                                </div>                      
                                <div style="clear:both">&nbsp;</div>
                                	<div class="btn-container">
                               		
                                    <button id="frm-btn-submit" class="minibutton">Submit</button>
	                            	<!--<button id="frm-btn-save" class="minibutton" type="button">Save</button>
	                    			<button id="frm-btn-cancel" class="minibutton" type="button">Cancel</button>  
                                    -->                                 
                                    <span></span>
                            	</div>
                           
                          
                            
                        </div>
                        
                        <div id="c-content-tb-data">
                        <div class="form-detail">
                       <!-- <form id="apvdtl" name="apvdtl" class="form-detail"  action="" method="post"> -->
                        	<input type="search" class="search-detail" placeholder="Search item" />
                            <input type="hidden" name="itemid" id="itemid" required />
                            <input type="number" name="qty" id="qty" placeholder="Quantity"  />
                            <input type="number" name="unitcost" id="unitcost" placeholder="Unit Cost"  />
                            <input type="hidden" name="amount" id="amount" />
                            <input type="text" name="damount" id="damount" class="number" value="0.00" disabled />
                            <input type="hidden" name="apvdtlid" id="apvdtlid" />
                            <button id="frm-detail-add-item" name="frm-detail-add-item" class="minibutton">Add Item</button>
                        
                       <!-- <div class="ui-widget" style="margin-top: 2em; font-family: Arial;">
					      Result:
					    	<div id="log" style="height: 200px; width: 300px; overflow: auto;" class="ui-widget-content"></div>
					 	</div>
                        -->
                        </div>
                        
                        	<table class="tb-data tb-detail" cellpadding="0" cellspacing="0" width="100%">
		                        <thead>
		                          <tr >
                                  	 
		                              <th>Item</th>
		                              <th>Quantity</th>
                                      <th>Unit Cost</th>
                                      <th>Amount</th>
		                            </tr>
		                        </thead>
		                        <tbody>
                                
                                <?php
									foreach($_SESSION['apvhdr']->entries as $item) {
									
										echo "<tr>";	
										echo "<td>". Item::Row($item->itemid,0) ." - ". Item::Row($item->itemid,1) ."</td><td>". $item->qty ." ". Item::Row($item->itemid,4) ."</td><td>". number_format($item->unitcost,2) ."</td><td>". number_format($item->amount,2) ."</td>";
										echo "</tr>";
									}
								?>
		                         
                                  
		                        </tbody>
                                <tfoot>
                                	<tr>
                                    	<td colspan="2">Total Unit:
                                         <span><?=$_SESSION['apvhdr']->totqty?></span></td>
                                        <td colspan="2">Total Amount:
                                        <span><?=$_SESSION['apvhdr']->totalamount?></span></td>
                                    </tr>
                                </tfoot>
	                        </table>
                            <?php
								echo json_encode($_SESSION['apvhdr'])."<br><br><br>";
							
							
								echo json_encode($_SESSION['apvhdr']->entries)."<br><br><br>";
								
								foreach($_SESSION['apvhdr']->entries as $item) {	
									$arr[] = array('apvhdrid' => $item->apvhdrid,
												'itemid' => $item->itemid,
												'qty' => $item->qty,
												'unitcost' => $item->unitcost,
												'amount' => $item->amount,
												'id' => $item->id
									);	
								}
								
								
								echo json_encode($arr)."<br>";
							
							?>
                        </div>	
                        </form>
                        
                       
                        
                        
                    </div>
                </td>
            </tr>
        </tbody>
        </table>
    </div>	
    <footer>
   
    </footer>
</div>

<div id="mdl-frm-category" class="modal hide fade in" style="display: none;">
            <div class="modal-header">
              <a class="close" data-dismiss="modal">×</a>
              <h3>New Category</h3>
            </div>
            <div class="modal-body">
            <form id="frm-category" name="frm-category" action="" method="post" >
              <table width="100%" cellpadding="0" cellspacing="0" border="0">
                <tbody>
                	<tr>
                    	<td><label>Code</label></td>
                        <td><input type="text" maxlength="10" required></td>
                    </tr>
                    <tr>
                    	<td><label>Descriptor</label></td>
                        <td><input type="text"></td>
                    </tr>
                    <tr>
                    	<td><label>Type</label></td>
                        <td>
                        	<select>
                            	<option value="1">Product/Service</option>
                                <option value="2">Expense</option>
                            </select>
                        </td>
                    </tr>
                </tbody>
              </table>
            </form>		        
            </div>
            <div class="modal-footer">
              <input type="submit" name="submit" class="btn btn-success" value="Save">
              <a href="#" class="btn" data-dismiss="modal">Cancel</a>
            </div>
</div>

</body>
</html>
