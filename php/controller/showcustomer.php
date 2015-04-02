<?php 
	session_start();
	require("../model/customer.php");
	
	$customer = new customer();
	
	//query: select all customers
	echo $customer->showCustomer();
	
 ?>
