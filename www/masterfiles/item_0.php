<?php
include_once('../../lib/initialize.php');
#error_reporting(E_ALL);
#ini_set('display_errors','On');

#!$session->is_logged_in() ? redirect_to($relativeslash."../login"): "";
$cleanUrl->setParts('categoryid');
?>
<!DOCTYPE HTML>
<html lang="en-ph">
<head>
<meta charset="utf-8">
<title>Prism</title>


<link rel="stylesheet" href="../css/bootstrap.css">
<link rel="stylesheet" href="../css/globals.css">
<link rel="stylesheet" href="../css/styles.css">


<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<script src="../js/jquery.dataTables.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script>
$(document).ready(function(e) {
    $('#datatable').dataTable();
});
</script>
</head>

<body>
<div id="container">
	<header>
    	<div id="h-main">
			<div id="h-main-logo">
                <img src="file:///C|/myserver/htdocs/images/75x75.png" /> 
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
          				<div id="menu1" class="nav active">
                        	<div class="bb">
	                        	<div class="Sj"></div>
								<div class="yb"></div>
								<div class="kk">Masterfiles</div>
                          	</div>
                            <ul class="fd">
                            	<li><a href="category">Category</a></li>
                                <li class="active"><a href="item">Items</a></li>
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
                    		<h1>Item Management</h1>
                        </header>
                        <div id="breadcrum">
                        	<ul>
                            	<li><a href="#">Home</a></li>
                                <li><a href="#">Masterfiles</a></li>     
                                <li>Item</li>                        
                            </ul>
                        </div>
                        <div id="c-content-toolbar">
                        	<button  id="frm-item-new" class="toolbar-minibutton" type="button" data-toggle="modal" data-target="#mdl-frm-item">New</button>
                        </div>
                        <div id="c-frm-container">
                        	<form id="frm-item" name="frm-item" class="table-model" action="" method="post">
                            	<table cellpadding="0" cellspacing="0" border="0">
                                	<tbody>
                                    	<tr>
                                        	<td><label for="code">Code:</label></td>
                                            <td><input type="text" id="code" name="code" maxlength="20" required /></td>
                                        </tr>
                                        <tr>
                                        	<td><label for="descriptor">Descriptor:</label></td>
                                            <td><input type="text" id="descriptor" name="descriptor" maxlength="50" required /></td>
                                        </tr>
                                        <tr>
                                        	<td><label for="type">Type:</label></td>
                                            <td>
                                            	<select id="type" name="type" style="width:155px;">
                                            		<option value="1">Product/Service</option>
                                					<option value="2">Expense</option>
                                            	</select>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </form>
                            <div class="btn-container">
                            	<button id="frm-btn-save" class="minibutton">Save</button>
                    			<button id="frm-btn-cancel" class="minibutton">Cancel</button>
                            </div>
                        </div>
                        <div id="c-content-tb-data">
                        	<table class="tb-data" bordercolor="#ccc" border="1">
                            	<thead>
                                	<tr>
										<th>#</th>
                                        <th>Code</th>
                                        <th>Descriptor</th>
                                        <th>Type</th>
                                        <th>&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody>
                                	<tr>
                                    	<td>1</td>
                                        <td>dfsf</td>
                                        <td>fdsaf</td>
                                        <td>fdasfa</td>
                                        <td>
                                        	<a href="#">Edit</a>
                                            <a href="#">Delete</a>
                                        </td>
                                    </tr>
                                    <tr>
                                    	<td>2</td>
                                        <td>dfsf</td>
                                        <td>fdsaf</td>
                                        <td>fdasfa</td>
                                        <td>
                                        	<a href="#">Edit</a>
                                            <a href="#">Delete</a>
                                        </td>
                                    </tr>
                                    <tr>
                                    	<td>3</td>
                                        <td>dfsf</td>
                                        <td>fdsaf</td>
                                        <td>fdasfa</td>
                                        <td>
                                        	<a href="#">Edit</a>
                                            <a href="#">Delete</a>
                                        </td>
                                    </tr>
                                    <tr>
                                    	<td>4</td>
                                        <td>dfsf</td>
                                        <td>fdsaf</td>
                                        <td>fdasfa</td>
                                        <td>
                                        	<a href="#">Edit</a>
                                            <a href="#">Delete</a>
                                        </td>
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
