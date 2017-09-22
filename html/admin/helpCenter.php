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
				<?php include 'topWrapper.php'; ?>
				<!-- / top wrapper -->
				</nav>
		</div>	
<!-- content -->
<div ng-controller="myCtrl">
	<div class="row">
		<div class="col-lg-12">
			<div class="wrapper wrapper-content animated fadeInRight">
				
				
				<div class="ibox-content m-b-sm border-bottom" style="background-image: url(https://itmeo.com/public/webgradients_png/076%20Premium%20Dark.png)">
					<div class="p-xs">
						<div class="pull-left m-r-md">
							<i class="fa fa-question-circle text-navy mid-icon" style="color:white"></i>
						</div>
						<h2 style="color:white">Da Vinci Help Center</h2><span style="color:white">Advice and answers from the MindFire Team</span>
					</div>
				</div>


				<div class="ibox-content forum-container">					
					<div class="forum-item">
						<div class="row">
							<div class="col-md-10">
								<div class="forum-icon">
									<i class="fa fa-calendar-check-o"></i>
								</div><a class="forum-item-title" href="fileManager.php">Getting Started</a>
								<div class="forum-sub-title">
									Easy steps to get up and running with Da Vinci -- quickly.
								</div>
							</div>
							<div class="col-md-1 forum-info">
								<span class="views-number">4</span>
								<div>
									<small>articles in this collection</small>
								</div>
							</div>
							<div class="col-md-1 forum-info">
								<span class="views-number"></span>
								<div>
									<small></small>
								</div>
							</div>
						</div>
					</div>
					<div class="forum-item">
						<div class="row">
							<div class="col-md-10">
								<div class="forum-icon">
									<i class="fa fa-money"></i>
								</div><a class="forum-item-title" href="formLibrary.php">Generating More Leads</a>
								<div class="forum-sub-title">
									Get insider info on how to create more leads, more quickly.
								</div>
							</div>
							<div class="col-md-1 forum-info">
								<span class="views-number">2</span>
								<div>
									<small>articles in this collection</small>
								</div>
							</div>
							<div class="col-md-1 forum-info">
								<span class="views-number"></span>
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



</div>
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
	<script type="text/JavaScript" src="global.js?n=1"></script> 

    <!-- Custom and plugin javascript -->
    <script src="js/inspinia.js"></script>
    <script src="js/plugins/pace/pace.min.js"></script>

	 <!-- Page-Level Scripts -->	  
	

</body>

</html>
