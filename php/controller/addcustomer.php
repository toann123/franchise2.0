<?php
	session_start();
	require("../model/customer.php");
	if (isset($_SESSION['userid']) && isset($_SESSION['roleid']) && isset($_POST['fname'])
			&& isset($_POST['lname'])&& isset($_POST['company_name'])&& isset($_POST['phone'])&& isset($_POST['mobile'])&& isset($_POST['email'])&& isset($_POST['address'])
			&& isset($_POST['suburb'])&& isset($_POST['postcode']))
	{

		$customer = new customer();
		
		$creatorid = $_SESSION['userid'];
		$role = $_SESSION['roleid'];
		
		//user info
		$fname = $_POST['fname'];
		$lname = $_POST['lname'];
		$company_name = $_POST['company_name'];
		$phone = $_POST['phone'];
		$mobile = $_POST['mobile'];
		$email = $_POST['email'];
		$address = $_POST['address'];
		$suburb = $_POST['suburb'];
		$postcode = $_POST['postcode'];
		$state = $_POST['state'];
		$city = $_POST['city'];
		
		$return = $customer->createCustomer($creatorid, $fname, $lname, $company_name, $phone, $mobile, $email, $address, $suburb, $postcode, $state, $city);
		
		if($return === "exists") {
			echo "This customer already exists";
		} elseif($return === "success") {
			echo "New user created";
		}
		
	} else {
		
		echo "something missing";
	}
?>