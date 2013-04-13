<?php
include_once('../lib/initialize.php');
!$session->is_logged_in() ? redirect_to("login"): "";


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

<link rel="stylesheet" href="css/bootstrap.css">
<link rel="stylesheet" href="css/globals.css">
<link rel="stylesheet" href="css/styles.css">


<script src="js/jquery-1.8.2.min.js"></script>
<script src="js/jquery-ui-1.8.min.js"></script>
<script src="js/jquery.blockUI.js"></script>
<script src="js/jquery.validate.min.js"></script>
<script src="js/jquery.dataTables.js"></script>
<script src="js/FixedHeader.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/common.js"></script>
<script>

function initMenu() {

  $('nav .fd').hide();
  
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
  
  
  /*
  $('nav .nav .bb').click(
    function() {
		
	 
      var checkElement = $(this).next();
      	if((checkElement.is('.fd')) && (checkElement.is(':visible'))) {
			checkElement.slideUp('normal');
			checkElement.closest('nav').removeClass('active'); 
        	return false;
        }
     	
		 if((checkElement.is('.fd')) && (!checkElement.is(':visible'))) {
			$('nav .fd:visible').slideUp('normal');
			checkElement.closest('nav').addClass('active');
			checkElement.slideDown('normal');
        return false;
        }
		
      }
    );
	
	*/
  }




$(document).ready(function() {
	
	initMenu();
	
	
});
</script>


</head>

<body>
<div id="container">
	<header>
    	<div id="h-main">
			<div id="h-main-logo">
                <img src="images/75x75.png" /> 
                <h1>Header</h1>
                <h2>System</h2>
            </div>
            <div id="h-main-user">
                <div>
                    <a href="#"><?=$session->fullname?></a>
                    <a href="logout" class="logout">Log out</a>
                </div>
                <img src="images/silhouette36.png" >
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
                            	<li><a href="masterfiles/category">Category</a></li>
                                <li><a href="masterfiles/item">Items</a></li>
                                <li><a href="masterfiles/salesman">Salesman</a></li>
                                <li><a href="masterfiles/supplier">Supplier</a></li>
                                <li><a href="masterfiles/customer">Customer</a></li>
                                <li><a href="masterfiles/location">Location</a></li>
                            </ul>
                        </div>
                        <div id="menu2" class="nav">
                        	<div class="bb">
	                            <div class="Sj"></div>
								<div class="yb"></div>
								<div class="kk">Transactions</div>
                           	</div>
                            <ul class="fd">
                            	
                                <li><a href="transactions/accounts-payable-voucher">Accounts Payable </a></li>
                               
                            </ul>
                        </div>	
                        <div id="menu3" class="nav">
                        	<div class="bb">
	                        	<div class="Sj"></div>
								<div class="yb"></div>
								<div class="kk">Reports</div>
                           	</div>
                             <ul class="fd">
                            	<li><a href="#">Sample Menu</a></li>
                                <li><a href="#">Sample Menu</a></li>
                                <li><a href="#">Sample Menu</a></li>
                            </ul>
                        </div>
                        <div id="menu4" class="nav">
                        	<div class="bb">
	                        	<div class="Sj"></div>
								<div class="yb"></div>
								<div class="kk">Utilities</div>
                            </div>
                             <ul class="fd">
                            	
                               <li><a href="#">Sample Menu</a></li>
                               
                            </ul>
                        </div>			
                   	</nav>
                </td>
                <td></td>
				<td>
                	<div id="c-content">
                    	<header>
                    		<h1>Dashboard</h1>
                        </header>
                        <div id="breadcrum">
                        	<ul>
                            	<li><a href="index">Home</a></li>                         
                            </ul>
                        </div>
                        <div id="c-content-toolbar">
                        	
                        </div>
                        <div id="c-frm-container" style="height:300px;">
                        	
                        	
                            
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



</body>
</html>
