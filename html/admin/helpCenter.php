<?php
    date_default_timezone_set('America/Los_Angeles');
    session_start();
    include 'global.php';
    require_once('loginCredentials.php');
    $dbName = $_SESSION['DBNAME'];
    $accountID = $_SESSION['ACCOUNTID'];
    $accountName = $_SESSION['ACCOUNNAME'];
?>

<!DOCTYPE html>
<html>
<head>
    <?php include "header.php"; ?>
</head>

<body class="">
<!-- hhhh -->
    <div id="wrapper">
	<!-- left wrapper -->
	<div w3-include-html="leftWrapper.php"></div>
	<!-- /end left wrapper -->
	<div id="page-wrapper" class="gray-bg">
		<div class="row border-bottom">
				 <nav class="navbar navbar-static-top  " role="navigation" style="margin-bottom: 0">
				<!-- top wrapper -->
				<div w3-include-html="topWrapper.php"></div>
				<!-- / top wrapper -->
				</nav>
		</div>	
<!-- content -->

        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-10">
                <h2>Get Help</h2>
                <ol class="breadcrumb">
                    <li>
                        <a href="welcome.php">Home</a>
                    </li>
                    <li>
                        <strong><a>Get Help</a></strong>
                    </li>
                    
                </ol>
            </div>
            <div class="col-lg-2">

            </div>
        </div>
        <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Everyone needs a little help sometimes. <small>For now, this is internal documentation.</small></h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                    <i class="fa fa-wrench"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-user">
                                    <li><a href="#">Config option 1</a>
                                    </li>
                                    <li><a href="#">Config option 2</a>
                                    </li>
                                </ul>
                                <a class="close-link">
                                    <i class="fa fa-times"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <form method="post" class="form-horizontal" action="dv.php?page=myProfileSettings&action=submit">
                                <div><h2>How to Create Da Vinci-friendly MAML Templates</h2></div>
                                <div><p>1. To allow a user to edit the campaign's content, insert slugs into the MAML using the following syntax:</p>
                                  <p><pre>{{varName}}</pre> for slugs that are replaced at initial Publish, usually a string of content.  </p>
                                  <p><pre>{{URL-varName}}</pre> for slugs that pull content from a URL, usually for content edited by the DV end-user </p>
                                  <p>2.  When Da Vinci opens the MAML template, it replaces:</p>
                                  <p><pre>{{varName}}</pre> with a string literal.</p>
                                  <p><pre>{{URL-varName}}</pre> with <pre>##URL SRC="md5HASH-varName"##</pre></p>
                                  <p>You need to set the Program Name in the MAML using the following special slug:</p>
                                  <p><pre>{ {PROGRAM-NAME} }</pre></p>
                                  <p>4. For each slug it finds, DV will add to config.json. DV stores this json as STUDIO_ACCOUNT_ID-STUDIO_PROGRAM_ID-config.json, then publishes the Program.</p>
                                  <p></p>
                                  <div class="hr-line-dashed"></div>
                                  <div><h2>Creating Da Vinci Web UI</h2></div>
                                  <p>1. When you create your web UI to configure the campaign, you tell DV how to update URL-based content as follows:</p>
                                  <p><pre>&lt;input type="text" name="URL-varName" value="{{URL-varName}}"&gt;</pre></p>
                                  <p>2. When you want to save values in your web UI, use:</p>
                                  <p><pre><code class="html">&lt;form method="post" action="updateCampaignValues"&gt;&lt;input type="submit" value="update"&gt;</code></pre></p>
                                  <p>3. DV will take the submitted names (varName), and place the "value" into appropriate URL snippet.</p>

                            </form>
                        </div>
                    </div>
                </div>
            
            </div>        

<!--/ content -->           
			<div class="footer">
			<!-- footer -->
			<div w3-include-html="footer.php"></div>
			<!-- / footer -->			
			</div>
		</div><!--  end page-wrapper -->
</div>

    <!-- Mainly scripts -->
	<script src="js/w3data.js"></script>	
	<script>w3IncludeHTML();</script>
    <script src="js/jquery-3.1.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
	<script type="text/JavaScript" src="global.js?n=1"></script> 

    <!-- Custom and plugin javascript -->
    <script src="js/inspinia.js"></script>
    <script src="js/plugins/pace/pace.min.js"></script>

	 <!-- Page-Level Scripts -->
	  <script>
			$(document).ready(function(e) {  					
					var canLogin = readCookie("canLogin");
					if (canLogin != "Yes") {
							 location.href = 'login.html';
					}
		   });
	</script>	
	

</body>

</html>
