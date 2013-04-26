<?php
include_once('../../lib/initialize.php');
#error_reporting(E_ALL);
#ini_set('display_errors','On');


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
<script src="../js/NumberFormat154.js"></script>
<script src="../js/FixedHeader.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/common.js"></script>
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
	
	var oTable = $('.tb-data').dataTable( {
		"aaSorting": [[ 0, "desc" ],[ 1, "desc" ]],
        "sPaginationType": "full_numbers",
		"bProcessing": true,
        "bServerSide": true,
        "sAjaxSource": "../www/api/datatables/v/apvhdr",
	//	"sAjaxSource": "../www/test/datatable_test.php"
		"fnHeaderCallback":  function( nHead, aData, iStart, iEnd, aiDisplay ) { 
				
				var title = ["Ref. #","Date","Location","Supplier","Terms","Total Quantity","Total Amount","Total Debit","Total Credit","Balance","Posted"];
				//console.log(title.length);
				for(i=0; i<=title.length-1; i++) {
					$('th:eq('+ i +')', nHead).text(title[i]);
				}		
			},
		"aoColumns": [
            { "mData": "refno" },
			{ "mData": "date" },
			{ "mData": "location" },
			{ "mData": "supplier" },
			//{ "mData": "supprefno" },
			//{ "mData": "porefno" },
			{ "mData": "terms" },
			{ "mData": "totqty" },
			{ "mData": "totamount" },
			{ "mData": "totdebit" },
			{ "mData": "totcredit" },
            { "mData": "balance" },
			 { "mData": "posted" }
			],
	  
		"fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
				//console.log(aData);
	            $(nRow).attr("data-id", aData.id);
				$(nRow).attr("id", aData.id);
				
				$('td:eq(6),td:eq(7),td:eq(8),td:eq(9)', nRow).addClass("currency").each(function(){
					$(this).toCurrency();
				});
				$('td:eq(4), td:eq(5)', nRow).addClass("number");
				
				
				var post = $('td:eq(10)', nRow).text();
				if(post==='0'){
					$('td:eq(10)', nRow).text('✖');
				} else {
					$('td:eq(10)', nRow).text('✔');
				}
				 
				//console.log(post);
				
				
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
	
	//new FixedHeader(oTable);
		
	var clicks = 0,
	    timer = null;
	$(".tb-data tbody tr").live("dblclick", function(e){
        e.preventDefault();  //cancel system double-click event
		console.log('Double click');
	})
	.live("click", function(e){
		var tr = $(this);		
        var id = tr.data('id');
		
		clicks++;  //count clicks
        if(clicks === 1) {
            timer = setTimeout(function() {
            
			
			console.log('accounts-payable/'+id);
			
			window.location.href = "accounts-payable/"+id;
			
					
		
			
            clicks = 0;  //after action performed, reset counter
            }, 200);
        } else {
            clearTimeout(timer);  //prevent single-click action
			e.preventDefault()
			
            console.log('double click '+ id);  //perform double-click action
			
            clicks = 0;  //after action performed, reset counter
        }

    });
	
	/*
	$('body').keypress(function(event){
		var keycode = (event.keyCode ? event.keyCode : event.which);
		console.log(keycode);
		if(keycode===110 || keycode===78){
			window.location.href = "accounts-payable";	
		}
	});
	*/
	
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
                </td>
                <td></td>
				<td>
                	<div id="c-content">
                    	<header>
                    		<h1>Checks</h1>
                        </header>
                        <div id="breadcrum">
                        	<ul>
                            	<li><a href="<?=$relativeslash?>../index">Home</a></li>
                                <li><a href="#">Transactions</a></li>     
                                <li>Checks</li>                        
                            </ul>
                        </div>
                        <div id="c-content-toolbar">
                        	<!--
                            <button  id="frm-item-new" class="toolbar-minibutton" type="button" data-toggle="modal" data-target="#mdl-frm-category">New</button>
                            -->
                            <a href="check" class="toolbar-minibutton" accesskey="n">New</a>
                        </div>
                        <!--
                        <div id="c-frm-container">
                        	
                        </div>
                        -->
                        <div id="c-content-tb-data">
                        	<table id="datatable-apvhdr" class="tb-data" cellpadding="0" cellspacing="0" width="100%">
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
