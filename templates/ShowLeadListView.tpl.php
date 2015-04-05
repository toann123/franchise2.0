<?php
	$this->assign('title','FRANCHISE | Leads');
	$this->assign('nav','leads');

	$this->display('_Header.tpl.php');
?>
<script type='text/javascript' src='custom_js/lead.js'></script>
<script>showLead();</script>

 <div class="fluid-container">
   
    <div class="workplace">
        <div class="row-fluid">
            <div class="span12">
                <div class="head">
                    <div class="isw-documents"></div>
                    <h1>Search</h1>
                    <div class="clear"></div>
                </div>
                <div class="block-fluid">
                    <div class="row-form">
                        <div class="span3">
                            Name
                        </div>
                        <div class="span9">
                            <input type="text" class="form-control">
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="row-form">
                        <div class="span3">
                            Phone
                        </div>
                        <div class="span9">
                            <input type="text" class="form-control">
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="row-form">
                        <div class="span3">
                            Address
                        </div>
                        <div class="span9">
                            <input type="text" class="form-control">
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="row-form">
                        <div class="span3">
                            Service Code
                        </div>
                        <div class="span9">
                            <input type="text" class="form-control">
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="row-form">
                        <div class="span3">
                            Price
                        </div>
                        <div class="span9">
                            <input type="text" class="form-control">
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="row-form">
                        <div class="span3"></div>
                        <div class="span9">
                            <button class="btn" type="button">
                                Search
                            </button>
                            <button class="btn btn-warning" type="button">
                                Clear
                            </button>
                        </div>
                        <div class="clear"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="dr">
            <span></span>
        </div>
        <div class="row-fluid">
            <div class="span12">
                <div class="head">
                    <div class="isw-grid"></div>
                    <h1>Regular Client (49) Total: $384,00 (inc GST/VAT)</h1>
                    <div class="clear"></div>
                </div>
                <div class="block-fluid">
                    <table cellpadding="0" cellspacing="0" width="100%" class="table">
                        <tbody id="lead-table">
                           
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
	$LAB.script("scripts/app/leads.js").wait(function(){
		$(document).ready(function(){
			page.init();
		});
		
		// hack for IE9 which may respond inconsistently with document.ready
		setTimeout(function(){
			if (!page.isInitialized) page.init();
		},1000);
	});
</script>


<?php
	$this->display('_Footer.tpl.php');
?>

</html>