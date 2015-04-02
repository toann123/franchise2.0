function validate_customer() {
	return true;
	
}

function submit_addcustomer() {
	if(validate_customer()) {
		
		//declare variables for posting
		var fname = $('#fname').val();
		var lname = $('#lname').val();
		var companyName = $('#companyName').val();
		var phoneNumber = $('#phoneNumber').val();
		var mobile = $('#mobile').val();
		var email = $('#email').val();
		var address = $('#address').val();
		var suburb = $('#suburb').val();
		var postcode = $('#postcode').val();
		var state = $('#state').val();
		var city = $('#city').val();
		
		//make post request
		
		var url = "php/controller/addcustomer.php";
		
		$.post(url,
		{
			fname : fname,
			lname : lname,
			company_name : companyName,
			phone : phoneNumber,
			mobile : mobile,
			email : email,
			address : address,
			suburb : suburb,
			postcode : postcode,
			state : state,
			city : city
		},
		function(data) {
			//success function
			alert(data);
		});
	}
	
}


