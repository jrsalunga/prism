<?php
include_once('../lib/initialize.php');
$session->is_logged_in() ? redirect_to("index"): "";
?>
<!DOCTYPE HTML>
<html lang="en-ph">
<head>
<meta charset="utf-8">
<title>Prism</title>



<link rel="stylesheet" href="css/globals.css">
<link rel="stylesheet" href="css/styles.css">


<script src="js/jquery-1.8.2.min.js"></script>
<script src="js/jquery-ui-1.8.min.js"></script>
<script src="js/common.js"></script>



<script type="text/javascript">
	
	function checkLogin(data){
		
		if(data.status==='ok'){
			
			console.log('success logging in');
			$("#msgbox").fadeTo(200,0.1,function() {
				$(this).html('&nbsp;&nbsp;Logging in...&nbsp;&nbsp;')
				       .addClass('messageboxok')
					   .fadeTo(900,1,
							function() {
								document.location='index';
							});
			});
							
		} else {
			
			console.log('failed logging in');
			$("#msgbox").fadeTo(200,0.1,function() {
				$(this).html('&nbsp;&nbsp;Invalid username/password&nbsp;&nbsp;')
				 	   .addClass('messageboxerror')
					   .fadeTo(1000,1);
			});
		}
	}
	
	
	
	function AuthUser() {
		
		var form = $("#frm_login");
		
		
		
		var formData = form.formToJSON();	
		
		console.log(formData);
		
		$("#msgbox").removeClass().html('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;').addClass('messagebox').delay(3000).fadeIn(1000);
		
		
		$.ajax({
	        type: 'POST',
	        contentType: 'application/json',
	        url: 'www/api/AuthUserLogin',
	        dataType: "json",
	        data: formData,
	        success: function(data, textStatus, jqXHR){
				checkLogin(data);
	        },
	        error: function(jqXHR, textStatus, errorThrown){
	         	console.log('problem encounter while sending data');   
	        }
    	});
		
	}

$(document).ready(function() {

	
	$(".fb_submit").on('click', function(){
		AuthUser();			
	});
		
	$(".fb_dialog_shadow").draggable({handle:"h1",containment:"#c-login-container"});
}); 
</script>

</head>

<body>
<div id="container">
	<header>
    	<div id="h-main">
			<div id="h-main-logo">
                <img src="../../images/75x75.png" /> 
                <h1>Header</h1>
                <h2>System</h2>
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
                
                <div id="c-login-container">
                    
                    
                    <div class="fb_dialog_shadow">
                    	<div class="fb_dialog">
                        	<h1 class="fb_dialog_header">Login</h1>
                            <div class="fb_dialog_body">
                            	<form id="frm_login" method="post" action="">
                                	<table width="100%" cellspacing="10" cellpadding="5" border="0">
                                    <tbody>
                                        <tr>
                                            <td align="center" colspan="2">
                                                <div id="msgbox">     </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="32%" align="right">
                                            	<label for="username">Username:</label>
                                            </td>
                                            <td width="68%">
                                            	<input id="username" class="input" type="text" name="username">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="right">
                                            	<label for="password">Password:</label>
                                            </td>
                                            <td>
                                            	<input id="password" class="input" type="password" name="password">
                                            </td>
                                        </tr>
                                        <tr>
                                        <td></td>
                                        <td></td>
                                        </tr>
                                        <tr>
                                        	<td>  </td>
                                        	<td>
                                            <!-- <input class="fb_submit" type="submit" value="Log In"> -->
                                            <button type="button" class="fb_submit">Log In</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                    </table>
                                </form>
                            </div>
                        </div>
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
