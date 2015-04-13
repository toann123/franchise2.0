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

function showCustomer() {

	var url = "php/controller/showcustomer.php";
	
	html_str = "";

	$.post(url, function(data) {
		var arr = JSON.parse(data);
		
		var table_header = "<thead>"+
					  			"<tr>"+
					 				"<th>" + "Full name" + "</th>"+
					 				"<th>" + "Company name" + "</th>"+
					 				"<th>" + "Phone number" + "</th>"+
					 				"<th>" + "Mobile number" + "</th>"+
					 				"<th>" + "Email" + "</th>"+
					 				"<th>" + "Address" + "</th>"+
					 				"<th><a href='#'>" + "View Leads" + "</a></th>"+
                                    "<th>" + "Edit" + "</th>" +
                                    "<th>" + "Delete" + "</th>" +
				 				 "</tr>";  
						   "</thead>";
		var html_str = ""; //array of customers
			
		for(var i = 0; i <arr.length; i++) {
			
			 html_str += "<tr>"+
			 				"<td><a href='editpick.php'>" + arr[i].customer_name + "</a></td>"+
			 				"<td>" + arr[i].company_name + "</td>"+
			 				"<td>" + arr[i].phone + "</td>"+
			 				"<td>" + arr[i].mobile + "</td>"+
			 				"<td>" + arr[i].email + "</td>"+
			 				"<td>" + arr[i].address + "</td>"+
			 				"<td><a href='#'>" + "View Leads" + "</a></td>"+
                            "<td><a href='#'>"+"Update"+"</a></td>"+
			 				"<td><a href='/franchise2/customers' onclick='deleteCustomer(" + arr[i].id + ");'>"+"Delete"+"</a></td>"+
		 				 "</tr>";
			
		}
		$("#customer-table").html(table_header + html_str);
	 });
}

function deleteCustomer(id) {
    
    var delete_confirmation = confirm("Are you sureyou want to delete this customer?");
    
    if(delete_confirmation == true) {
        
        var url = "php/controller/deletecustomer.php?id="+id;
        
        $.post(url,
            function(data) {
                alert(data);
            }
        );
        
    } else {
        alert("Nope");
    }
    
}



