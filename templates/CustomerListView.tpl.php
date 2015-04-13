<?php
	$this->assign('title','FRANCHISE | Customers');
	$this->assign('nav','customers');

	$this->display('_Header.tpl.php');
?>

<body onload="showCustomer();">
    <div class="workplace">
        <div class="row-fluid">
            <div class="span12">
                <div class="head">
                    <div class="isw-grid"></div>
                    <h1>All customers</h1>
                    <div class="clear"></div>
                </div>
                <div class="block-fluid">
                    <table cellpadding="0" cellspacing="0" width="100%" class="table">
                        <tbody id="customer-table">
                            <tr>
                        	
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="dr">
            <span></span>
        </div>
    </div>
    <script type='text/javascript' src='custom_js/customer.js'></script>

<?php
	$this->display('_Footer.tpl.php');
?>

