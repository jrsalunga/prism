<?php
include_once('../../lib/initialize.php');
#error_reporting(E_ALL);
#ini_set('display_errors','On');

$cleanUrl->setParts('cvhdrid');

$cvhdr = Cvhdr::find_by_id($cvhdrid);



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

<?php
if(!isset($relativeslash)){
?>
<link rel="stylesheet" href="../css/bootstrap.css">
<link rel="stylesheet" href="../css/globals.css">
<link rel="stylesheet" href="../css/styles.css">
<link rel="stylesheet" href="../css/datatable.css">
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
<script src="../js/modernizr.js"></script>

<?php    
} else {
?>

<link rel="stylesheet" href="<?=$relativeslash?>../css/bootstrap.css">
<link rel="stylesheet" href="<?=$relativeslash?>../css/globals.css">
<link rel="stylesheet" href="<?=$relativeslash?>../css/styles.css">
<link rel="stylesheet" href="<?=$relativeslash?>../css/datatable.css">
<link rel="stylesheet" href="<?=$relativeslash?>../css/details-ui.css"/>


<script src="<?=$relativeslash?>../js/jquery-1.8.2.min.js"></script>
<script src="<?=$relativeslash?>../js/jquery-ui-1.8.min.js"></script>
<script src="<?=$relativeslash?>../js/jquery.blockUI.js"></script>
<script src="<?=$relativeslash?>../js/jquery.validate.min.js"></script>
<script src="<?=$relativeslash?>../js/jquery.dataTables.js"></script>
<script src="<?=$relativeslash?>../js/FixedHeader.js"></script>
<script src="<?=$relativeslash?>../js/bootstrap.min.js"></script>
<script src="<?=$relativeslash?>../js/common.js"></script>
<script src="<?=$relativeslash?>../js/NumberFormat154.js"></script>
<script src="<?=$relativeslash?>../js/modernizr.js"></script>
<script src="http://ajax.cdnjs.com/ajax/libs/underscore.js/1.1.4/underscore-min.js"></script>
<script src="http://ajax.cdnjs.com/ajax/libs/backbone.js/0.3.3/backbone-min.js"></script>

<?php    
}
?>

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


function log( message ) {
     //  $( "<div>" ).text( message ).appendTo( "#log" );
	$("#log").text(message);
	//$( "#log" ).scrollTop( 0 );
}

function itemSearch(){
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
				//console.log(ui);
                log( ui.item ? "Selected: " + ui.item.label : "Nothing selected, input was " + this.value);
	
				$("#itemid").val(ui.item.id); /* set the selected id */
				
            },
            open: function() {
                $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
				$("#itemid").val('');  /* remove the id when change item */
            },
            close: function() {
                $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
            }
			
       });
}


function saveParentChild() {
	var id = $(".table-model #id").val();
		
	if(id === null || id === undefined || id === ''){
		addParentChild();
	} else {
		updateParentChild(id);
	}	
}
	
	
function saveDetail() {
	var id = $(".table-detail #id").val();
		
	if(id === null || id === undefined || id === ''){
		addToTableDetail();
	} else {
		updateToTableDetail();
	}

	$('.table-detail').clearForm();

	log("Added item!");
}


function checkForm(){
	//console.log($(".table-model #posted").val());
	
	if($(".table-model #posted").val()==='1'){
		return true;
	} else {
		return false;	
	}
}

function disableFormInputs(){
		$(".table-model button").attr('disabled','disabled');
		$(".table-model input").attr('disabled','disabled');
		$(".table-model select").attr('disabled','disabled');
		$(".table-model textarea").attr('disabled','disabled');
		$(".table-detail button").attr('disabled','disabled');
		$(".table-detail input").attr('disabled','disabled');
		$(".tb-detail .tb-data-action").remove();
}


function isPosted(){
	if(postingStatus()){
		disableFormInputs();
	} else {
		//console.log('not posted');	
	}
	
}

function postApvhdr(id){
	var form = $(".table-model");
	var formData = form.formToJSON();	
    var	table = form.data('table');	
	var aData; 

	$.ajax({
        type: 'POST',
        contentType: 'application/json',
		url: 'http://localhost/prism/www/api/txn/post/'+ table +'/'+ id ,
        dataType: "json",
        async: false,
        //data: formData,
        success: function(data, textStatus, jqXHR){
            aData = data;
        },
        error: function(jqXHR, textStatus, errorThrown){
            alert(textStatus + ' Failed on posting data');
        }
    });	
	
	$(".table-model .currency").each(function(){
		$(this).toNumberFormat();	
	});


	return aData;		 
}

function postCancelledApvhdr(id){
	var form = $(".table-model");
	var formData = form.formToJSON();	
    var	table = form.data('table');	
	var aData; 

	$.ajax({
        type: 'POST',
        contentType: 'application/json',
		url: 'http://localhost/prism/www/api/txn/post/'+ table +'/'+ id +'/cancelled',
        dataType: "json",
        async: false,
        //data: formData,
        success: function(data, textStatus, jqXHR){
            aData = data;
        },
        error: function(jqXHR, textStatus, errorThrown){
            alert(textStatus + ' Failed on posting data');
        }
    });	
	
	$(".table-model .currency").each(function(){
		$(this).toNumberFormat();	
	});


	return aData;		 
}



$(document).ready(function() {
	
	//console.log($(".table-model").data("role"));

	initMenu();
	
	isPosted();
	
	itemSearch();
	
	$('.table-model').on('click', '#frm-btn-dtj', function(){	
		var details = $(".table-model").serializeObject();	
		console.log(details);
	});
	

	$('.table-model').on('click', '#frm-btn-delete', function(){  		
		var id = $(".table-model #id").val();
	
		if(id == undefined || id == null || id == '') {
		  	console.log('undefined id: deletion cannot be executed');
		} else {
			//deleteData2(id,oTable);
			//console.log(id);		
			deleteParentChild(id)
		}
	});
	
	$('.table-model').on('click', '#frm-btn-post', function(){	
	  	var id = $(".table-model #id").val();
	
		if(id == undefined || id == null || id == '') {
		  	console.log('undefined id: posting cannot be executed');
		} else {
			
			if($("#cancelled").val()==1) {
				var stat = postCancelledApvhdr(id);
			} else {		
				var stat = postApvhdr(id);
			}
			
			if(stat.status==='success') {
				console.log(stat.data.apvhdr);
				
				renderDetails(stat.data.apvhdr);
				//$('.table-model #balance').val(stat.data.apvhdr.balance);
				//$('.table-model #posted').val(stat.data.apvhdr.balance);
				
				disableFormInputs();
				set_alert(stat.status,'Well done!',stat.message);
			} else {
				set_alert(stat.status,'Oh snap!',stat.message);	
			}	
		}
		
	});
	
	
	$('.table-model').validate({
						rules: {
							code: "required"						
						}, 
						messages: {	
						},	
						submitHandler: saveParentChild
					});
					
	$('.table-detail').validate({
						rules: {
							itemid: "required",
							qty: "required",
							unitcost: "required"	
						}, 
						messages: {	
							qty: "please input quantity",
							unitcost: "please input unit cost"
						},	
						submitHandler: saveDetail
					});
					
	// for testing: logging the json of the data table
	$('.table-detail').on('click', '#frm-detail-dom-to-json', function(){	
		var details = $(".tb-detail").HTMLTableToJSON();	
		console.log(details);
	});
	
	$('.table-detail').on('click', '#frm-detail-post-detail', function(){	
		postDetail()
	});
	
	$('.table-detail').on('click', '#frm-detail-put-detail', function(){	
		putDetail()
	});
	
	$('.table-detail').on('click', '#frm-detail-clear-item', function(){	
		$('.table-detail').clearForm();
	});
	
	$('.table-detail').on('click', '#frm-detail-check-total', function(){	
		checkTotal();
	});
	
	
	
					
					
	$("a.row-edit").live('click', function(){		
		var tr = $(this).closest('tr');
		var td = $(this).parent().parent();
		var child = td.children().remove();
		var itemName = td.text();
		td.append(child);
		//var rowData = tr.HTMLTableRowToJSON();
		var rowData = tr.serializeHTMLTableRow();	
		
		var form = $(".table-detail");
		form.clearForm();
		form.renderDetailsToForm(rowData);
		$(".search-detail", form).val(itemName);
		
	}).live('click',computeAmount);
	
	$(".variable").on('blur',computeAmount);
	
	$("a.row-delete").live('click', function(){
		var id = $(this).data('id');
		var tr = $(this).closest("tr#"+id);
		
		//postingStatus();	
		
		if(confirm('Are you sure you want to delete this item? '+ id)) {
			
			tr.slideUp("slow", function(){
				tr.remove(); 				
				checkTotal();
			});
			console.log('item deleted!');
		} else {
			console.log('deletion aborted!');
		}
		
	});
	
	
	
	
	$('form').removeAttr('novalidate');
});
</script>


</head>

<body>
<div id="container">
	<header>
    	<div id="h-main">
			<div id="h-main-logo">
                <img src="<?=$relativeslash?>../images/75x75.png" /> 
                <h1>Header</h1>
                <h2>System</h2>
            </div>
            <div id="h-main-user">
                <div>
                    <a href="#"><?=$session->fullname?></a>
                    <a href="<?=$relativeslash?>../logout" class="logout">Log out</a>
                </div>
                <img src="<?=$relativeslash?>../images/silhouette36.png" >
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
                            	<li><a href="<?=$relativeslash?>accounts-payable-hdr">Accounts Payable</a></li>
                            	<li class="active"><a href="<?=$relativeslash?>check-hdr">Check </a></li>
                                <li><a href="<?=$relativeslash?>invoice">Invoice</a></li>
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
                    
                <div id="log" style="margin:10px;">
                </div>
                </td>
                <td></td>
				<td>
                	<div id="c-content">
                    	<header>
                    		<h1>Check Voucher</h1>
                        </header>
                        <div id="breadcrum">
                        	<ul>
                            	<li><a href="<?=$relativeslash?>../index">Home</a></li>
                                <li><a href="#">Transactions</a></li>   
                                <li><a href="<?=$relativeslash?>check-hdr">Check</a></li>   
                                <li> Voucher</li>                        
                            </ul>
                        </div>
                        <div id="c-content-toolbar">
                        	<a href="<?=$relativeslash?>accounts-payable-print/<?=$apvhdrid?>" target="_blank" style="float:right;"  class="print-preview" >Print Preview</a>
                        </div>
                        <div id="c-frm-container">
                        	<div id="frm-alert"></div>
                        	<form id="frm-cvhdr" name="frm-cvhdr" class="table-model" data-table="cvhdr" data-role="parent" action="" method="post">
                            	<table cellpadding="0" cellspacing="0" border="0">
                                	<tbody>
                                    	<tr>
                                        	<td><label for="refno">Reference No:</label></td>
                                            <td><input type="text" id="refno" name="refno" maxlength="10" style="width:120px;" value="<?=$cvhdr->refno?>" required /></td>
                                            
                                            <td><label for="date">Date:</label></td>
                                            <td><input type="date" id="date" name="date" style="width:120px;" value="<?php echo isset($cvhdr->date) ? $cvhdr->date:iso_date(); ?>"  placeholder="yyyy-mm-dd"  required /></td> 
                                        </tr>
                                        <tr>
                                        	<td><label for="supplierid">Supplier:</label></td>
                                            <td>
                                            	<select id="supplierid" name="supplierid" style="width:155px;">
						                        <?php
						                        
						                        $sSalesmans = Supplier::find_all();
																		
						                        foreach( $sSalesmans as  $sSalesman) {
						                            
													if($cvhdr->supplierid==$sSalesman->id){
														echo "<option value=\"".strtolower($sSalesman->id)."\" selected=\"selected\">". uc_first($sSalesman->descriptor) ."</option>";
													} else {
						                            	echo "<option value=\"".strtolower($sSalesman->id)."\">". uc_first($sSalesman->descriptor) ."</option>";
													}
						                        }  
						                        ?>
						                   		</select>
                                            </td>
                                          	<td><label for="payee">Payee:</label></td>
                                        	<td><input id="payee" type="text" maxlength="50" name="payee" value="<?=$cvhdr->payee?>" /></td>
                                        </tr>
                                        <tr>
                                        	<td><label for="bankcode">Bank Code:</label></td>
                                            <td><input type="text" id="backcode" name="bankcode" maxlength="5" style="width:120px;" value="<?=$cvhdr->bankcode?>" /></td>
                                            
                                            <td><label for="checkno">Check No:</label></td>
                                            <td><input type="text" id="checkno" name="checkno" maxlength="15" style="width:120px;"  value="<?=$cvhdr->porefno?>" /></td> 
                                        </tr>

                                         <tr>
                                         	<td><label for="totamount">Total Amount:</label></td>
                                            <td><input type="text" id="totamount" name="totamount" maxlength="19" style="width:120px;"  class="number currency" readonly value="<?php echo isset($cvhdr->totamount) ? $cvhdr->totamount:"0.00"; ?>"  />
                                            	<input type="hidden" id="id" name="id" value="<?=$cvhdr->id?>" />
                                                <input type="hidden" id="totline" name="totline" value="<?=$cvhdr->totline?>" />
                                                <input type="hidden" id="posted" name="posted" value="<?=$cvhdr->posted?>" />
                                            </td>
                                        	
                                             <td><label for="cancelled">Cancel:</label></td>
                                            <td>
                                            	<input type="checkbox" class="toggle" data-input="cancelled" <?php echo ($cvhdr->cancelled==1) ? 'checked="checked"':''; ?> />
                                            	<input type="hidden" id="cancelled" name="cancelled" value="<?=$cvhdr->cancelled?>" />
                                            </td>  
                                        </tr>    
                                          <tr>
                                        	<td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>  
                                        </tr>   
                                       
                                        
                                        <tr>
                                        	<td></td>
                                            <td>
                                            	
                                            	<button id="frm-btn-submit" class="minibutton">Save</button>
                                                <button id="frm-btn-post" class="minibutton" type="button" <?php echo isset($cvhdr->id) ? "":"disabled"; ?> >Post</button>
				                            	<!--<button id="frm-btn-save" class="minibutton" type="button">Save</button>-->
                                                <button id="frm-btn-delete" class="minibutton" type="button" <?php echo isset($cvhdr->id) ? "":"disabled"; ?> >Delete</button>
                                                <a href="<?=$relativeslash?>accounts-payable-hdr"  class="minibutton">Cancel</a>
                                                 <button id="frm-btn-dtj" class="minibutton" type="button">Form to JSON</button>
				                    			<!--
                                                <button id="frm-btn-cancel" class="minibutton" type="button">Cancel</button>  
                                                <button id="frm-btn-dtj" class="minibutton" type="button">Form to JSON</button>
                                                -->
                                            </td>
                                            <td></td>
                                            <td></td>
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
                        	<div class="form-detail">
	                        	<form id="frm-apvdtl" name="frm-apvdtl" class="table-detail" method="post" action="" data-table="apvdtl">
                                	<input type="hidden" name="id" id="id"/>
	                            	<input type="search" class="search-detail" placeholder="Search item" required results="10" />
		                            <input type="hidden" name="itemid" id="itemid" />
		                            <input type="number" name="qty" id="qty" step="1" min="0" max="9999999" placeholder="Quantity" class="variable" required  />
		                            <input type="number" name="unitcost" id="unitcost" pattern="^\d*(\.\d{1,2}$)?" step="0.01" placeholder="Unit Cost" class="variable float" required  />
		                            <input type="hidden" name="amount" id="amount" class="variable-result" />
                                    <!--<input type="number" name="amount" id="amount" value="0.00" readonly />-->
		                            <input type="text" name="damount" id="damount" class="number variable-result-view" value="0.00" disabled />
		                            <button id="frm-detail-save-item" class="minibutton">Save Item</button>
                                    <button id="frm-detail-clear-item" class="minibutton" type="button">Clear</button>
                                     <!--
                                    <button id="frm-detail-check-total" class="minibutton" type="button">Check Total</button>
                                    <button id="frm-detail-dom-to-json" class="minibutton" type="button">DOM to JSON</button>
                                    <button id="frm-detail-post-detail" class="minibutton" type="button">post Detail</button>
                                    <button id="frm-detail-put-detail" class="minibutton" type="button">put Detail</button>
                                    -->
	                            </form>
                             </div>
                            <table class="tb-data tb-detail" data-apvhdrid="<?=$cvhdr->id?>" width="100%" cellspacing="0" cellpadding="0">
                            <thead>
								<tr style="display:">
									<th>Item</th>
									<th>Quantity</th>
									<th>Unit Cost</th>
									<th>Amount</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$apvdtls = Apvdtl::find_all_by_field_id('apvhdr',$apvhdr->id);
								
								//echo json_encode($apvdtls);
								$totqty = 0;
								$totamount = 0;
								if($apvdtls!=NULL) {
								
							  	foreach($apvdtls as $apvdtl){
									$item_name = Item::row($apvdtl->itemid,0);
									
									echo '<tr id="'. $apvdtl->id .'" data-id="'. $apvdtl->id .'">';
									echo '<td data-itemid="'. $apvdtl->itemid .'">'. $item_name ;
									echo '<div class="tb-data-action">';
									echo '<a class="row-delete" data-id="'. $apvdtl->id .'" href="#">delete</a>';
									echo '<a class="row-edit" data-id="'. $apvdtl->id .'" href="#">edit</a>';
									echo '</div></td>';
									echo '<td data-qty="'. $apvdtl->qty .'">'. number_format($apvdtl->qty) .'</td>';
									echo '<td data-unitcost="'. $apvdtl->unitcost .'" class="currency">'. number_format($apvdtl->unitcost,2) .'</td>';
									echo '<td data-amount="'. $apvdtl->amount .'" class="float">'. number_format($apvdtl->amount,2) .'</td>';
									echo '</tr>';
									
									$totqty = $totqty + $apvdtl->qty;
									$totamount = $totamount + $apvdtl->amount;
								}	
								}
								?>
							</tbody>
                            <tfoot>
								<tr>
									<td colspan="2">
									Total Unit:
									<span id="f-total-qty" class="total"><?=number_format($totqty)?></span>
									</td>
									<td colspan="2">
									Total Amount:
									<span id="f-total-amount" class="total float"><?=number_format($totamount,2)?></span>
									</td>
								</tr>
							</tfoot>
							</table>
                        </div>	
                        
                        
                        <div style="height:100px;"></div>
                        
                       
                        
                        
                    </div>
                </td>
            </tr>
        </tbody>
        </table>
    </div>	
    <footer>
   
    </footer>
</div>



</body>
</html>
