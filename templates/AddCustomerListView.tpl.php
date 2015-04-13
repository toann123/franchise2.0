
<?php
	$this->assign('title','FRANCHISE | Customers');
	$this->assign('nav','customers');

	$this->display('_Header.tpl.php');
?>

<body>
    
<div class="workplace">
    <div class="row-fluid">
    <div class="span6">
        <div class="span12">
            <div class="head">
                <div class="isw-documents"></div>
                <h1>Address</h1>
                <div class="clear"></div>
            </div>
            <div class="block-fluid">
                <!--CONTACT INPUT STARTS HERE-->
                <div class="row-form">
                    <div class="span3">
                        First Name:
                    </div>
                    <div class="span5">
                        <input id="fname" type="text" class="form-control" >
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="row-form">
                    <div class="span3">
                        Last Name:
                    </div>
                    <div class="span5">
                        <input id="lname" type="text" class="form-control" >
                    </div>
                    <div class="clear"></div>
                </div>

                <div class="row-form">
                    <div class="span3">
                        Company Name:
                    </div>
                    <div class="span7">
                        <input id="companyName" type="text" class="form-control" >
                    </div>
                    <div class="clear"></div>
                </div>

                <div class="row-form">
                    <div class="span3">
                        Phone number:
                    </div>
                    <div class="span5">
                        <input id="phoneNumber" type="text" class="form-control" >
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="row-form">
                    <div class="span3">
                        Mobile number:
                    </div>
                    <div class="span5">
                        <input id="mobile" type="text" class="form-control" >
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="row-form">
                    <div class="span3">
                        Email:
                    </div>
                    <div class="span7">
                        <input id="email" type="text" class="form-control" >
                    </div>
                    <div class="clear"></div>
                </div>
            </div>
            </div>
        </div>

        <div class="span6">
            <div class="head">
                <div class="isw-documents"></div>
                <h1>Contact</h1>
                <div class="clear"></div>
            </div>
            <div class="block-fluid">
                <!--ADDRESS INPUT STARTS HERE-->
                <div class="row-form">
                    <div class="span3">
                        Address
                    </div>
                    <div class="span5">
                        <input id="address" type="text" class="form-control" value="31 myuna drive">
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="row-form">
                    <div class="span3">
                        Suburb
                    </div>
                    <div class="span5">
                        <input id="suburb" type="text" class="form-control" value="kings park">
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="row-form">
                    <div class="span3">
                        Postcode
                    </div>
                    <div class="span5">
                        <input id="postcode" type="text" class="form-control" value="3021">
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="row-form">
                    <div class="span3">
                        State
                    </div>
                    <div class="span5">
                        <select id="state" name="select">
                            <option>Victoria</option>
                            <option>Queensland</option>
                            <option>Tasmania</option>
                            <option>Western Australia</option>
                            <option>South Australia</option>
                            <option>Northern Territory</option>
                            <option>New South Wales</option>
                        </select>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="row-form">
                    <div class="span3">
                        City
                    </div>
                    <div class="span9">
                        <input id="city" type="text" class="form-control"  value="Melbourne">
                    </div>
                    <div class="clear"></div>
                </div>  
                 <div class="row-form">
                    <div class="span3">
                        Validate Address
                    </div>
                    <div class="span9">
                        <a class="btn btn-success" href="https://www.google.com.au/maps/" target="_blank">Validate</a>
                    </div>
                    <div class="clear"></div>
                </div>   

            </div>
        </div>

        <div class="span12">
            <div class="row-form">
                <div class="span3"></div>
                <div class="span9">
                    <button id="addCustomerButton" class="btn" type="submit" type="button" onclick="submit_addcustomer();">Add</button>
                    <button class="btn btn-warning" type="button">Clear</button>
                </div>
                <div class="clear"></div>
            </div>
        </div>
    </div>
    <div class="dr">
        <span></span>
    </div>
</div>
    <script src="custom_js/customer.js"></script>
</body>

<?php
	$this->display('_Footer.tpl.php');
?>
