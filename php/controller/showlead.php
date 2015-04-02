<?php 
	session_start();
	require("../model/lead.php");
	
	$lead = new lead();
	
	//query: select all leads
	echo $lead->showLead();
	
 ?>
