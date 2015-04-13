<?php
if (!class_exists("DBConnect")) {
	require_once ("DBConnect.php");
}
class customer {

	public function __construct() {

	}

	public function updateUserOnlineStatus($currentUser_id, $status) {
		$db = new DBConnect();
		$html_return = "";

		if ($db -> getDBConnect()) {
			$currentUser_id = $db -> getDBConnect() -> real_escape_string($currentUser_id);
			$status = $db -> getDBConnect() -> real_escape_string($status);

			$sql = "update socket_user set status='$status' where user_id ='$currentUser_id'";

			if ($db -> getDBConnect() -> query($sql)) {
				$html_return = "success";
			}
		}
		$db -> close();

		return $html_return;
	}

	public function getGuestUserIDBylink($link) {
		$db = new DBConnect();
		$id = "";
		$link = $db -> getDBConnect() -> real_escape_string($link);
		$sql = "select userid
					 from r2_participants
					 where link = '$link';";

		$query = $db -> getDBConnect() -> query($sql);

		if ($query) {
			$info = "";
			while ($result = $query -> fetch_object()) {
				$id = $result -> userid;
			}

			return $id;
		}
		$db -> close();
	}

	public function getUser($pCurrent_userid) {
		$db = new DBConnect();

		$current_userid = $db -> getDBConnect() -> real_escape_string($pCurrent_userid);

		$sql = "select * from socket_user where user_id <> $current_userid";
		//var_dump($sql);
		if ($query = $db -> getDBConnect() -> query($sql)) {
			$user_array = array();
			$user_object = "";
			//var_dump($result);
			while ($result = $query -> fetch_object()) {
				$user_array[$result -> user_id] = $result -> username;
			}

			$user_object = json_encode($user_array);

			$db -> close();
			return $user_object;
		} else
			return "";
		$db -> close();
	}

	public function validate_Mac_address($userid, $mac_address) {
		$db = new DBConnect();

		$userid = $db -> getDBConnect() -> real_escape_string($userid);
		$mac_address = $db -> getDBConnect() -> real_escape_string($mac_address);

		if ($mac_address != "undefined") {

			//validate duplicate
			$sql22 = "select * from user_device where userid = '$userid' and mac_address='$mac_address'";
			//var_dump($sql22);
			$query22 = $db -> getDBConnect() -> query($sql22);

			if ($query22 -> num_rows > 0) {//found
				//set curent active device
				$sql_update = "update user_device set active = '0' where userid = '$userid'";
				$db -> getDBConnect() -> query($sql_update);

				$sql_update2 = "update user_device set active = '1' where userid = '$userid' and mac_address = '$mac_address'";
				$db -> getDBConnect() -> query($sql_update2);

				return "1";
			} else {
				return "0";
			}
		}
	}

	/*
	 * 16-7-2013
	 * update user feedback form
	 */
	public function createCustomer($creatorid, $fname, $lname, $company_name, $phone, $mobile, $email, $address, $suburb, $postcode, $state, $city) {
		$db = new DBConnect();
		
		$creatorid = $creatorid;

		$fname = $db -> getDBConnect() -> real_escape_string($fname);
		$lname = $db -> getDBConnect() -> real_escape_string($lname);
		$company_name = $db -> getDBConnect() -> real_escape_string($company_name);
		$phone = $db -> getDBConnect() -> real_escape_string($phone);
		$mobile = $db -> getDBConnect() -> real_escape_string($mobile);
		$email = $db -> getDBConnect() -> real_escape_string($email);
		$address = $db -> getDBConnect() -> real_escape_string($address);
		$suburb = $db -> getDBConnect() -> real_escape_string($suburb);
		$postcode = $db -> getDBConnect() -> real_escape_string($postcode);
		$state = $db -> getDBConnect() -> real_escape_string($state);
		$city = $db -> getDBConnect() -> real_escape_string($city);
		
		//if customer already exists (same mobile number)
		$sql22 = "select * from customer where mobile ='$mobile'";

		$query22 = $db -> getDBConnect() -> query($sql22);
		$customerid = "";
		if ($query22 -> num_rows > 0) {//found matching item
			return "exists";
		} else {
			
			//add customer to database
			//insert new customer info
			$insert_customer_sql = "insert into customer values(null ,'$fname','$lname','$creatorid', '$company_name','$phone','$mobile','$email','$address','$suburb','$postcode','$state','$city','$creatorid',null,null,1)";
			$db -> getDBConnect() -> query($insert_customer_sql);
			if ($db) {
				return "success"; //tells the controller task was successful
			}
			
			$sql_get_customerid = "select * from customer where mobile ='$mobile'";
			$query_get_customerid = $db -> getDBConnect() -> query($sql_get_customerid);
			if ($query_get_customerid -> num_rows > 0) {//found matching item
				while ($result = $query_get_customerid -> fetch_object()) {
					$customerid = $result -> id;
				}
			}
			
		}
	}

	public function showCustomer() {
		$db = new DBConnect();
		
		//sql query
		$sql = "SELECT * FROM customer ORDER BY postcode";
		$query = $db->getDBConnect()->query($sql);
		
		$customer_array = array();
		
		if ($query -> num_rows > 0) {//found customers
			while ($result = $query -> fetch_object()) {
                $id = $result->id;
				$customer_name = $result->firstname . " " . $result->lastname;
				$company_name = $result->branch_name;
				$address = $result->address . " " . $result->suburb . " " . $result->postcode . " " . $result->state;
				$phone = $result->phone;
				$mobile = $result->mobile;
				$email = $result->email;
				
				array_push($customer_array, array("id"=>$id, "customer_name"=>$customer_name,"address"=>$address,"mobile"=>$mobile, "company_name"=>$company_name, "email"=>$email,"phone"=>$phone));					
			}
			
			return json_encode($customer_array);	
			
		} else { //no leads found
			
			return "no rows found";
		}
		
		
	}
    
    public function deleteCustomer($id) {
        $db = new DBConnect();

        $sql = "DELETE FROM customer WHERE id = $id";
        $query = $db -> getDBConnect() -> query($sql);

        if($query) {
            return "Customer deleted successfully";
        } else {
            return "error customer not deleted";
        } 
    }

}

?>