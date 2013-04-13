<?php
include_once('../../lib/initialize.php');
#error_reporting(E_ALL);
#ini_set('display_errors','On');

$cleanUrl->setParts('apvhdrid');

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

<link rel="stylesheet" href="../css/bootstrap.css"/>
<link rel="stylesheet" href="../css/globals.css"/>
<link rel="stylesheet" href="../css/styles.css"/>
<link rel="stylesheet" href="../css/datatable.css"/>
<!-- <link rel="stylesheet" href="http://code.jquery.com/ui/1.9.1/themes/base/jquery-ui.css"/> -->
<link rel="stylesheet" href="../css/details-ui.css"/>


<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
<script src="//malsup.github.com/jquery.blockUI.js"></script>
<script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.10.0/jquery.validate.min.js"></script>
<script src="../js/jquery.dataTables.js"></script>
<script src="//datatables.net/release-datatables/extras/FixedHeader/js/FixedHeader.js"></script>
<script src="../js/jquery.filedrop.js"></script>
<script src="../js/upload-image.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/common.js"></script>
<script src="../js/category.js"></script>
<script>
$(document).ready(function() {
	function log( message ) {
            $( "<div>" ).text( message ).prependTo( "#log" );
            $( "#log" ).scrollTop( 0 );
        }
 
        $( "#sdetail" ).autocomplete({
            source: function( request, response ) {
                $.ajax({
					type: 'GET',
                    //url: "http://ws.geonames.org/searchJSON",
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
                                value: item.code
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
				//$(this).val(ui.item.label);
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
                    <a href="#">Jefferson Salunga</a>
                    <a href="../../logout" class="logout">Log out</a>
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
                            	<li class="active"><a href="category">Category</a></li>
                                <li><a href="item">Items</a></li>
                                <li><a href="salesman">Salesman</a></li>
                                <li><a href="supplier">Supplier</a></li>
                                <li><a href="customer">Customer</a></li>
                                <li><a href="location">Location</a></li>
                            </ul>
                        </div>
                        <div id="menu2" class="nav active">
                        	<div class="bb">
	                            <div class="Sj"></div>
								<div class="yb"></div>
								<div class="kk">Transactions</div>
                           	</div>
                             <ul class="fd">
                            	
                                <li class="active"><a href="accounts-payable-voucher">Accounts Payable </a></li>
                               
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
                        	
                        </div>
                        <div id="c-frm-container">
                        	<div id="frm-alert"></div>
                        	<form id="frm-salesman" name="frm-salesman" class="table-model" data-table="salesman" action="" method="post">
                            	<table cellpadding="0" cellspacing="0" border="0">
                                	<tbody>
                                    	<tr>
                                        	<td><label for="refno">Reference No:</label></td>
                                            <td><input type="text" id="refno" name="refno" maxlength="10" style="width:120px;" required /></td>
                                            
                                            <td><label for="date">Date:</label></td>
                                            <td><input type="date" id="date" name="date" style="width:120px;" value="<?php echo iso_date(); ?>" required /></td> 
                                        </tr>
                                        <tr>
                                        	<td><label for="salesmanid">Salesman:</label></td>
                                            <td>
                                            	<select id="salesmanid" name="salesmanid" style="width:155px;">
						                        <?php
						                        
						                        $sSalesmans = Salesman::find_all();
												
						                        foreach( $sSalesmans as  $sSalesman) {
						                            
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
						                            
						                            echo "<option value=\"".strtolower($sLocation->id)."\">". uc_first($sLocation->descriptor) ."</option>";
						                        }  
						                        ?>
						                   		</select>
                                            </td>
                                        </tr>
                                        <tr>
                                        	<td><label for="supprefno">Supplier Ref No:</label></td>
                                            <td><input type="text" id="supprefno" name="supprefno" maxlength="10" style="width:120px;" /></td>
                                            
                                            <td><label for="porefno">PO Ref No:</label></td>
                                            <td><input type="text" id="porefno" name="porefno" maxlength="10" style="width:120px;"/></td> 
                                        </tr>
                                         <tr>
                                          	<td><label for="terms">Terms:</label></td>
                                            <td><input type="number" id="terms" name="terms" style="width:100px;" value="0" min="0" max="100"  />
                                            
                                            <td><label for="totdebit">Total Debit:</label></td>
                                            <td><input type="text" id="totdebit" name="totdebit" maxlength="19" style="width:120px;" value="0.00" disabled /></td>
                                           
                                        </tr>
                                         <tr>
                                        	<td><label for="totqty">Total Quantity:</label></td>
                                            <td><input type="text" id="totqty" name="totqty" maxlength="19" style="width:120px;" value="0" disabled /></td>
                                            
                                            <td><label for="totcredit">Total Credit:</label></td>
                                            <td><input type="text" id="totcredit" name="totcredit" maxlength="19" style="width:120px;" value="0.00" disabled /></td>  
                                        </tr> 
                                         <tr>
                                         	<td><label for="totamount">Total Amount:</label></td>
                                            <td><input type="text" id="totamount" name="totamount" maxlength="19" style="width:120px;" value="0.00" disabled /></td>
                                        	
                                             <td><label for="balance">Balance:</label></td>
                                            <td><input type="text" id="balance" name="balance" style="width:100px;" value="0.00" min="0" step="0.5" max="1000000000" disabled  />
                                            
                                        </tr>    
                                           
                                       
                                        
                                        <tr>
                                        	<td></td>
                                            <td>
                                            	<button id="frm-btn-submit" class="minibutton">Submit</button>
				                            	<!--<button id="frm-btn-save" class="minibutton" type="button">Save</button>-->
                                                <button id="frm-btn-delete" class="minibutton" type="button" disabled>Delete</button>
				                    			<button id="frm-btn-cancel" class="minibutton" type="button">Cancel</button>  
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                             	<!--
                                	<div class="btn-container">
                               		<button id="frm-btn-submit" class="minibutton">Submit</button>
	                            	<button id="frm-btn-save" class="minibutton" type="button">Save</button>
	                    			<button id="frm-btn-cancel" class="minibutton" type="button">Cancel</button>                                   
                                    <span></span>
                            	</div>
                                -->
                            </form>
                            
                        </div>
                        
                        <div id="c-content-tb-data">
                        <div>
                        <form id="apvdtl" name="apvdtl" class="detail"  action="" method="post">
                        	<input type="search" id="sdetail"  />
                             <datalist id="apvdtl-item-list">
                              <?php
						                        
						      	$sItems = Item::find_all();
												
						        foreach($sItems as  $item) {
						        	echo "<option value=\"".strtolower($item->code)."\">". uc_first($item->descriptor) ."</option>";
						        }  
						     ?>
                             </datalist>
                        </form>
                        <div class="ui-widget" style="margin-top: 2em; font-family: Arial;">
					      Result:
					    	<div id="log" style="height: 200px; width: 300px; overflow: auto;" class="ui-widget-content"></div>
					 	</div>
                        
                        </div>
                        	<table class="tb-data" cellpadding="0" cellspacing="0" width="100%">
		                        <thead>
		                          <tr >
                                  	 
		                              <th>Item</th>
		                              <th>Quantity</th>
                                      <th>Unit Cost</th>
                                      <th>Amount</th>
		                            </tr>
		                        </thead>
		                        <tbody>
		                          <tr>
                                  	  
		                              <td>beer</td>
		                              <td>10</td>
                                      <td>50</td>
                                      <td>500</td>
		                          </tr>
                                  
		                        </tbody>
                                
	                        </table>
                        </div>	
                        
                        
                       
                        
                        
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
