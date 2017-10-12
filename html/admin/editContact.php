<?php
	date_default_timezone_set("UTC");
    session_start();
    include 'global.php';
    require_once('loginCredentials.php');
?>
<!DOCTYPE html>
<html ng-app="myApp">
<!-- ***************************************************
THIS PAGE USE  <ng-view>
editContactNewAudience.html
editContactAudience.html
*************************************************** -->
<meta http-equiv="expires" content="-1">
<meta http-equiv="Pragma" content="no-cache" />
<meta http-equiv="Cache-Control" content="no-cache" />
<head>
    <?php include "header.php"; ?>
    <script src="css/sweet/sweetalert-dev.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular-route.js"></script>     
</head>
<body class="fixed-sidebar">
    <div id="wrapper">
	<!-- left wrapper -->
	  <?php include 'leftWrapper.php'; ?>
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

<div ng-view></div>


<!--/ content -->           
			<div class="footer">			
			<?php include 'footer.php'; ?>
			</div>
		</div><!--  end page-wrapper -->
</div>

<!-- Mainly scripts -->
<script src="js/bootstrap.min.js"></script>
<script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<script type="text/JavaScript" src="global.js?n=1"></script> 
<!-- Custom and plugin javascript -->
<script src="js/inspinia.js"></script>
<script src="js/plugins/pace/pace.min.js"></script>
 
 <!-- Page-Level Scripts -->
<script src="js/jquery.md5.js"></script>
<script src="js/davinci.js"></script>
<script>
		var dbName = "<?php echo $dbName; ?>";
        $(document).ready(function() {
			//angular.element('#myCtrl').scope.Load();
			$.ajax({
				url: 'getFieldList.php', // point to server-side PHP script 
				dataType: 'json',  // what to expect back from the PHP script, if anything
				cache: false,
				contentType: false,
				processData: false,
				data: '',                         
				type: 'get',
				success: function(json){										
					if (json.success) {
						FieldOption = json.fieldOption;			
						FilterClick();
					}					
				}
			 });

        });	
</script>
<script src="js/editContact.js"></script>
</body>
</html>
