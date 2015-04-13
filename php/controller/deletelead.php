<?php 
	session_start();
	require("../model/lead.php");
	
	$lead = new lead();
    $id = $_GET['id'];
	
	//query: delete lead via id
	echo $lead->deleteLead($id);
 ?>
