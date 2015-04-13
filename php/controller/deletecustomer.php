<?php 
	session_start();
	require("../model/customer.php");
	
	$customer = new customer();
    $id = $_GET['id'];
	
	//query: delete lead via id
	echo $customer->deleteCustomer($id);
 ?>
