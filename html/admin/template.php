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
<html ng-app="myApp">
<head>
    <?php include "header.php"; ?>
</head>	

<body class="">
    <div id="wrapper">
	<!-- left wrapper -->
	<div w3-include-html="leftWrapper.php"></div>
	<!-- /end left wrapper -->
	<div id="page-wrapper" class="gray-bg">
		<div class="row border-bottom">
				 <nav class="navbar navbar-static-top  " role="navigation" style="margin-bottom: 0">
				<!-- top wrapper -->
				<?php include 'topWrapper.php'; ?>
				<!-- / top wrapper -->
				</nav>
		</div>	
<!-- content -->
<div ng-controller="myCtrl">
	

        

</div><!-- myCtrl -->
<!--/ content -->           
			<div class="footer fixed">
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

    <!-- Custom and plugin javascript -->
    <script src="js/inspinia.js"></script>
    <script src="js/plugins/pace/pace.min.js"></script>


	 <!-- Page-Level Scripts -->



    <script>
        $(document).ready(function() {
			//angular.element('#myCtrl').scope.Load();
        });

	</script>



</body>
</html>
