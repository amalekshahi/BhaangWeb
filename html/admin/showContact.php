<?php
	ini_set("memory_limit","-1");
	set_time_limit(0);
	session_start();
    include 'global.php';
    require_once('loginCredentials.php');
    $dbname = $_SESSION['DBNAME'];
?>
<!DOCTYPE html>
<html ng-app="myApp">
<head>
<?php include "header.php"; ?>
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
		<div class="row" ng-controller="myCtrl" id="myCtrl" ng-cloak>
			<div class="col-lg-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5 id="havCID" style="display:none;">List: "{{item['LIST-NAME']}}" [{{item['LIST-COUNT']}} People]</strong>
						</h5>
						<h5 id="noCID" style="display:none;">Everyone</strong>
						</h5>

						<div class="ibox-tools">
							<button type="button" class="btn btn-default btn-xs" onclick="exportContact()"><i class="fa fa-download" aria-hidden="true" style="color:blue"></i> Download these People</button>
							<div id="exportdiv" style="display:none;"></div>
						</div>
					</div>
					<div class="ibox-content">
						<div>
							<div class="row wrapper border-bottom white-bg page-heading">
								<div>
									<h2 id="havCID" style="display:none;">List: "{{item['LIST-NAME']}}" [{{item['LIST-COUNT']}} People]</h2>
									<h2 id="noCID" style="display:none;">All List</h2>
								</div>
							</div>
							<div id="headTable" style="margin:0 10px;">
								<div>
									<p></p>
								</div>
								<table datatable="ng" dt-options="dtOptions" class="table table-striped table-bordered table-hover dataTables-example ng-isolate-scope dataTable no-footer" style="" id="DataTables_Table_1" aria-describedby="DataTables_Table_1_info" role="grid">
								</table>
								<form id="idForm">
									<input type="hidden" name="LISTDEFINITION" id="LISTDEFINITION">
									<input type="hidden" name="cid" id="cid">
								</form>
							</div>
							<!-- headTable -->
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- myCtrl -->
		<!--/ content -->
		<div class="footer">
			<!-- footer -->
			<?php include 'footer.php'; ?>
			<!-- / footer -->
		</div>
	</div>
	<!--  end page-wrapper -->
</div>
</div>

<!-- Mainly scripts -->
<!--<script src="js/jquery-3.1.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>-->
<script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<!-- Custom and plugin javascript -->
<script src="js/inspinia.js"></script>
<script src="js/plugins/pace/pace.min.js"></script>
<!--<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs/jszip-2.5.0/dt-1.10.16/af-2.2.2/b-1.4.2/b-colvis-1.4.2/b-flash-1.4.2/b-html5-1.4.2/b-print-1.4.2/cr-1.4.1/fh-3.1.3/sl-1.2.3/datatables.min.css"/>-->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
<!--<script type="text/javascript" src="https://cdn.datatables.net/v/bs/jszip-2.5.0/dt-1.10.16/af-2.2.2/b-1.4.2/b-colvis-1.4.2/b-flash-1.4.2/b-html5-1.4.2/b-print-1.4.2/cr-1.4.1/fh-3.1.3/sl-1.2.3/datatables.min.js"></script>-->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css"/>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>

<script src="js/jquery.md5.js"></script>
<script src="js/davinci.js"></script>
<script type="text/JavaScript" src="global.js?n=1"></script>
<!-- Page-Level Scripts -->
<script>
	var dbName = "<?php echo $dbName; ?>";	
</script>
<script src="js/showContact.js"></script>

</body>
</html>