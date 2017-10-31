<?php
    session_start();
    include 'global.php';
    require_once('loginCredentials.php');
    $dbname = $_SESSION['DBNAME'];
?>

<!-- ***************************************************
THIS PAGE USE  <ng-view>
formEditorEdit.html
formEditorNew.html
*************************************************** -->

<!DOCTYPE html>
<html ng-app="myApp">
<head>
	<title>Form Builder</title>
    <?php include "header.php"; ?>	    
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular-route.js"></script>    
	<script src="js/plugins/datapicker/bootstrap-datepicker.js"></script>
</head>
<body class="fixed-sidebar">

<div id="wrapper">
<!-- left wrapper -->
	  <?php include 'leftWrapper.php'; ?>
<!-- left wrapper -->
<div class="gray-bg" id="page-wrapper">
<!-- top wrapper -->
			<nav class="navbar navbar-static-top  " role="navigation" style="margin-bottom: 0">
				<!-- top wrapper -->
				<?php include 'topWrapper.php'; ?>
				<!-- / top wrapper -->
				<div class="row wrapper border-bottom white-bg page-heading">
					<div class="col-lg-10">
						<h2>Form Builder</h2>
						<ol class="breadcrumb">
							<li>
								<a href="dv.php?page=formLibrary">Create a Form</a>
							</li>
							<li class="active"><strong></strong></li>
						</ol>
					</div>
					<div class="col-lg-2"></div>
				</div>
			</nav>
			
<!-- top wrapper -->
<!-- Content -->
<div ng-view></div>	
<!-- /Content -->
<div class="footer">
	<?php include 'footer.php'; ?>
</div>
</div><!-- page-wrapper -->
</div><!-- wrapper -->
	<!-- Mainly scripts -->
	<!--<script src="js/bootstrap.min.js"></script>-->
	<script src="js/plugins/metisMenu/jquery.metisMenu.js">	</script> 
	<script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script> 
	<!-- jquery UI -->	 
	<script src="js/plugins/jquery-ui/jquery-ui.min.js"></script> 	
	<script src="js/inspinia.js"></script> 
	<script src="js/plugins/pace/pace.min.js"></script> 
	<script type="text/JavaScript" src="global.js?n=1"></script> 	
	<!-- Custom and plugin javascript -->	 
 	<script src="js/jquery.md5.js"></script>	
	<script src="js/davinci.js"></script>

<script>
	var dbname = "<?php echo $dbName; ?>";	
</script>
<script src="js/formEditor.js"></script>
</body>
</html>