<?php

$vItem = "SELECT a.id as id, a.code, a.descriptor, c.descriptor as type, b.descriptor as category, 
			a.onhand, a.unitprice, a.floorprice, a.unitcost, a.umeasure
		FROM item a, category b , item_type c
		WHERE a.categoryid = b.id AND a.type = c.code";
		
$vCategory = "SELECT a.id, a.code, a.descriptor, b.descriptor as type
			FROM category a, category_type b
			WHERE a.type = b.code
			ORDER BY a.type ASC";
			
$vCustomer = "SELECT a.id, a.code, a.descriptor, a.cperson, a.ctitle, b.descriptor as salesman, a.terms, a.balance
			FROM customer a, salesman b
			WHERE a.salesmanid = b.id";
			
$vApvhdr = "SELECT a.id, a.refno, a.date, b.descriptor as location, c.descriptor as supplier, a.supprefno, a.porefno, a.terms, a.totqty, a.totamount, a.totdebit, a.totcredit, a.totamount, a.balance, a.posted
			FROM apvhdr a, location b, supplier c
			WHERE a.locationid = b.id AND a.supplierid = c.id
			ORDER BY a.date DESC";
			
$vApvdtl = "SELECT a.id, b.descriptor as item, a.qty, a.unitcost, a.amount
			FROM apvdtl a, item b
			WHERE a.itemid = b.id
			ORDER BY 2";
			
$vCvhdr = "SELECT a.id, a.refno, a.date, b.code as supplier, a.bankcode, a.checkno, a.totamount, a.posted
			FROM cvhdr a, supplier b
			WHERE a.supplierid = b.id
			ORDER BY a.date DESC";
			
$vCvdtl = "SELECT ";			
			
?>