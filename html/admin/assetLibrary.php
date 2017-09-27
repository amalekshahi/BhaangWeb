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
		<script>
			// welcome.js need this
			var dbName = "<?php echo $dbName; ?>";
			var myApp = angular.module('myApp', ['angularMoment', 'davinci', 'localytics.directives']);
		</script>
		<script src="js/welcome.js"></script>
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
	<div class="row">
		<div class="col-lg-12">
			<div class="wrapper wrapper-content animated fadeInRight">
				
				
				<div class="ibox-content m-b-sm border-bottom">
					<div class="p-xs">
						<div class="pull-left m-r-md">
							<i class="fa fa-globe text-navy mid-icon" style="color:green"></i>
						</div>
						<h2>Your Asset Library</h2><span>Forms, eBooks, and other material you share with yourself and others.</span>
					</div>
				</div>


				<div class="ibox-content forum-container">					
					<div class="forum-item">
						<div class="row">
							<div class="col-md-9">
								<div class="forum-icon">
									<i class="fa fa-picture-o"></i>
								</div><a class="forum-item-title" href="fileManager.php">Files</a>
								<div class="forum-sub-title">
									Browse Da Vinci's library of images and other assets, or upload and manage your company's files for use within any of your marketing campaigns.
								</div>
							</div>
							<div class="col-md-1 forum-info">
								<span class="views-number">1,216</span>
								<div>
									<small>Images</small>
								</div>
							</div>
							<div class="col-md-1 forum-info">
								<span class="views-number"></span>
								<div>
									<small></small>
								</div>
							</div>
							<div class="col-md-1 forum-info">
								<a href="" class="btn btn-primary btn"><i class="fa fa-plus-circle" aria-hidden="true"></i> New</a>
								<div>
									<small></small>
								</div>
							</div>
						</div>
					</div>
					<div class="forum-item">
						<div class="row">
							<div class="col-md-9">
								<div class="forum-icon">
									<i class="fa fa-align-justify"></i>
								</div><a class="forum-item-title" href="formLibrary.php">Forms</a>
								<div class="forum-sub-title">
									Da Vinci provides you with some standard (and common) forms.  Use those, or create your own.
								</div>
							</div>
							<div class="col-md-1 forum-info">
								<span class="views-number">2</span>
								<div>
									<small>Forms</small>
								</div>
							</div>
							<div class="col-md-1 forum-info">
								<span class="views-number"></span>
								<div>
									<small></small>
								</div>
							</div>
							<div class="col-md-1 forum-info">
								 <a href="" class="btn btn-primary btn"><i class="fa fa-plus-circle" aria-hidden="true"></i> New</a>
								<div>
									<small></small>
								</div>
							</div>
						</div>
					</div>
					<!--
					<div class="forum-item">
						<div class="row">
							<div class="col-md-9">
								<div class="forum-icon">
									<i class="fa fa-envelope-o"></i>
								</div><a class="forum-item-title" href="forum_post.html">Emails</a>
								<div class="forum-sub-title">
									Every e-mail you send can be re-used elsewhere, making drip sequences a snap.  Manage your emails, or use any of Da Vini's work and call it your own!
								</div>
							</div>
							<div class="col-md-1 forum-info">
								<span class="views-number">68</span>
								<div>
									<small>Emails</small>
								</div>
							</div>
							<div class="col-md-1 forum-info">
								<span class="views-number"></span>
								<div>
									<small></small>
								</div>
							</div>
							<div class="col-md-1 forum-info">
								<a href="" class="btn btn-primary btn"><i class="fa fa-plus-circle" aria-hidden="true"></i> New</a>
								<div>
									<small></small>
								</div>
							</div>
						</div>
					</div>
					<div class="forum-item">
						<div class="row">
							<div class="col-md-9">
								<div class="forum-icon">
									<i class="fa fa-file-text"></i>
								</div><a class="forum-item-title" href="forum_post.html">Pages</a>
								<div class="forum-sub-title">
									Web pages for landing pages, microsites, and other web properties.  Use your own, or tap into Da Vinci's collection.
								</div>
							</div>
							<div class="col-md-1 forum-info">
								<span class="views-number">14</span>
								<div>
									<small>Pages</small>
								</div>
							</div>
							<div class="col-md-1 forum-info">
								<span class="views-number"></span>
								<div>
									<small></small>
								</div>
							</div>
							<div class="col-md-1 forum-info">
								<a href="" class="btn btn-primary btn"><i class="fa fa-plus-circle" aria-hidden="true"></i> New</a>
								<div>
									<small></small>
								</div>
							</div>
						</div>
					</div>
					<div class="forum-item">
						<div class="row">
							<div class="col-md-9">
								<div class="forum-icon">
									<i class="fa fa-book"></i>
								</div><a class="forum-item-title" href="forum_post.html">e-Books</a>
								<div class="forum-sub-title">
									Da Vinci has written numerous e-Books you can put to use immediately.  Or, create your own.  Either way, you get a ready-to-go landing page and a great content piece!
								</div>
							</div>
							<div class="col-md-1 forum-info">
								<span class="views-number">14</span>
								<div>
									<small>e-Books</small>
								</div>
							</div>
							<div class="col-md-1 forum-info">
								<span class="views-number"></span>
								<div>
									<small></small>
								</div>
							</div>
							<div class="col-md-1 forum-info">
								<a href="" class="btn btn-primary btn"><i class="fa fa-plus-circle" aria-hidden="true"></i> New</a>
								<div>
									<small></small>
								</div>
							</div>
						</div>
					</div>	
					-->
				</div><!-- ibox-content -->


			</div>
		</div>
	</div>



</div><!-- myCtrl -->
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

    <script>
        $(document).ready(function() {
			//angular.element('#myCtrl').scope.Load();
        });

	</script>



</body>
</html>
