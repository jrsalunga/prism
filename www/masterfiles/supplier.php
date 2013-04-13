<?php
include_once('../../lib/initialize.php');
#error_reporting(E_ALL);
#ini_set('display_errors','On');

$cleanUrl->setParts('salesmanid');

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

<link rel="stylesheet" href="../css/bootstrap.css">
<link rel="stylesheet" href="../css/globals.css">
<link rel="stylesheet" href="../css/styles.css">
<link rel="stylesheet" href="../css/datatable.css">


<script src="../js/jquery-1.8.2.min.js"></script>
<script src="../js/jquery-ui-1.8.min.js"></script>
<script src="../js/jquery.blockUI.js"></script>
<script src="../js/jquery.validate.min.js"></script>
<script src="../js/jquery.dataTables.js"></script>
<script src="../js/FixedHeader.js"></script>
<script src="../js/NumberFormat154.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/common.js"></script>
<script>

function initMenu() {

  $('nav .fd').hide();
  $('nav #menu1 .fd').show();
  
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
	
	var oTable = $('.tb-data').dataTable( {
        "sPaginationType": "full_numbers",
		"bProcessing": true,
        "bServerSide": true,
        "sAjaxSource": "../www/api/datatables/supplier",
	//	"sAjaxSource": "../www/test/datatable_test.php"
		"fnHeaderCallback":  function( nHead, aData, iStart, iEnd, aiDisplay ) { 
				
				var title = ["Code","Descriptor","Payee","cPerson","cTitle","Terms","Balance","Email"];
				//console.log(title.length);
				for(i=0; i<=title.length-1; i++) {
					$('th:eq('+ i +')', nHead).text(title[i]);
				}		
			},
		"aoColumns": [
            { "mData": "code" },
            { "mData": "descriptor" },
			{ "mData": "payee" },
            { "mData": "cperson" },
			{ "mData": "ctitle" },
            { "mData": "terms" },
			{ "mData": "balance" },
            { "mData": "email" }
			],
		"fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
				//console.log(aData);
	            $(nRow).attr("data-id", aData.id);
				$(nRow).attr("id", aData.id);
				
				$('td:eq(6)', nRow).addClass("currency").each(function(){
					$(this).toCurrency();
				});
				
				$('td:eq(5)', nRow).addClass("number")
				 
				//console.log(aData.type);
				/*
				if ( aData.type == 1 ) {
		        	$('td:eq(2)', nRow).html( 'Product/Service' );
		        } else {
					$('td:eq(2)', nRow).html( 'Expense' );
				}
				*/
	            return nRow;
        	}
			
    });
	
	new FixedHeader(oTable);
		
	var clicks = 0,
	    timer = null;
	$(".tb-data tbody tr").live("click", function(e){
		var tr = $(this);		
        
		clicks++;  //count clicks
        if(clicks === 1) {
            timer = setTimeout(function() {
            
			var id = tr.data('id');
			//console.log(id);
			getData2(id);
					
			$("#frm-btn-delete").removeAttr('disabled');
			
            clicks = 0;  //after action performed, reset counter
            }, 200);
        } else {
            clearTimeout(timer);  //prevent single-click action
			e.preventDefault()
            console.log('double click');  //perform double-click action
            clicks = 0;  //after action performed, reset counter
        }

    })
    .live("dblclick", function(e){
        e.preventDefault();  //cancel system double-click event
		console.log('Double click');
    });
	
	
	$('.table-model').on('click', '#frm-btn-delete', function(){  
	    //var id = $(this).data('id');
		//var table = $(this).data('table');
		//deleteData(table,id);
		
		var id = $(".table-model #id").val();
		
		if(id == undefined || id == null || id == '') {
		  	console.log('undefined id');
		} else {
			deleteData2(id,oTable);
			
				
		}
	});
	
	
	
	function saveData2() {
		var id = $(".table-model #id").val();
		//console.log(id);	
		
		if(id === null || id === undefined || id === ''){
			//console.log("add data2");
			addData(oTable);
		} else {
			//console.log("edit data2");
			updateData(id);
		}	
	}
	
	$('.table-model').validate({
						rules: {
							code: "required"						
						}, 
						messages: {	
						},	
						submitHandler: saveData2
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
          				<div id="menu1" class="nav active">
                        	<div class="bb">
	                        	<div class="Sj"></div>
								<div class="yb"></div>
								<div class="kk">Masterfiles</div>
                          	</div>
                            <ul class="fd">
                            	<li><a href="category">Category</a></li>
                                <li><a href="item">Items</a></li>
                                <li><a href="salesman">Salesman</a></li>
                                <li class="active"><a href="supplier">Supplier</a></li>
                                <li><a href="customer">Customer</a></li>
                                <li><a href="location">Location</a></li>
                            </ul>
                        </div>
                        <div id="menu2" class="nav">
                        	<div class="bb">
	                            <div class="Sj"></div>
								<div class="yb"></div>
								<div class="kk">Transactions</div>
                           	</div>
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
                    		<h1>Supplier Management</h1>
                        </header>
                        <div id="breadcrum">
                        	<ul>
                            	<li><a href="<?=$relativeslash?>../index">Home</a></li>
                                <li><a href="<?=$relativeslash?>../masterfiles/index">Masterfiles</a></li>     
                                <li>Supplier</li>                        
                            </ul>
                        </div>
                        <div id="c-content-toolbar">
                        	<button  id="frm-supplier-new" class="toolbar-minibutton" type="button" data-toggle="modal" data-target="#mdl-frm-supplier">New</button>
                        </div>
                        <div id="c-frm-container">
                        	<div id="frm-alert"></div>
                        	<form id="frm-supplier" name="frm-supplier" class="table-model" data-table="supplier" action="" method="post">
                            	<table cellpadding="0" cellspacing="0" border="0">
                                	<tbody>
                                    	<tr>
                                        	<td><label for="code">Code:</label></td>
                                            <td><input type="text" id="code" name="code" maxlength="20" required /></td>
                                            <td><label for="descriptor">Descriptor:</label></td>
                                            <td><input type="text" id="descriptor" name="descriptor" maxlength="50" /></td>
                                        </tr>
                                        <tr>
                                        	<td><label for="payee">Payee:</label></td>
                                            <td><input type="text" id="payee" name="payee" maxlength="50" />
                                            </td>
                                             <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr>
                                          	<td><label for="cperson">C Person:</label></td>
                                            <td><input type="text" id="cperson" name="cperson" maxlength="50" />
                                            <td><label for="ctitle">C Title:</label></td>
                                            <td><input type="text" id="ctitle" name="ctitle" maxlength="50" />
                                        </tr>
                                        <tr>
                                          	<td><label for="terms">Terms:</label></td>
                                            <td><input type="number" id="terms" name="terms" style="width:100px;" value="0" min="0" max="100"  />
                                            <td><label for="balance">Balance:</label></td>
                                            <td><input type="text" id="balance" name="balance" style="width:100px;" class="number currency"  disabled  />
                                        </tr>
                                        <tr>
                                        	<td><label for="address">Address:</label></td>
                                            <td colspan="3"><input type="text" id="address" name="address" maxlength="120" style="width:500px;" /></td>
                                        </tr>
                                        <tr>
                                          	<td><label for="phone">Tel No.:</label></td>
                                            <td><input type="tel" id="phone" name="phone" maxlength="20" />
                                            <td><label for="fax">Fax:</label></td>
                                            <td><input type="tel" id="fax" name="fax" maxlength="20" />
                                        </tr>
                                         <tr>
                                          	<td><label for="mobile">Mobile:</label></td>
                                            <td><input type="tel" id="mobile" name="mobile" maxlength="20" />
                                            <td><label for="email">Email:</label></td>
                                            <td><input type="email" id="email" name="email" maxlength="120" />
                                        </tr>
                                        <tr>
                                        	<td><label for="notes">Notes:</label></td>
                                            <td colspan="3">
                                            	<textarea id="notes" name="notes" placeholder="Note"></textarea>
                                                <input type="hidden" id="id" name="id" value="" />
                                            </td>
                                        </tr>
                                        <tr>
                                        	<td>&nbsp;</td>
                                            <td>
                                            	<button id="frm-btn-submit" class="minibutton">Submit</button>
				                            	<!--<button id="frm-btn-save" class="minibutton" type="button">Save</button>-->
                                                <button id="frm-btn-delete" class="minibutton" type="button" disabled>Delete</button>
				                    			<button id="frm-btn-cancel" class="minibutton" type="button">Cancel</button>  
                                            </td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
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
                        	<table class="tb-data" cellpadding="0" cellspacing="0" width="100%">
		                       <!-- <thead>
		                          <tr>
                                  	 
		                              <th>Code</th>
		                              <th>Descriptor</th>
                                      <th>Type</th>
                                    
		                            </tr>
		                        </thead>
		                        <tbody>
		                          <tr>
                                  	  
		                              <td>Jefferson</td>
		                              <td>Raga</td>
                                      <td>Salunga</td>
                                    
		                          </tr>
                                  
		                        </tbody>
                                -->
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
