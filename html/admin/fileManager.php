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
	<html ng-app="assetLibrary" ng-cloak>

	<head>
		<?php include "header.php"; ?>
		
	</head>

	<body class="">
		<div id="wrapper" ng-controller="assetList">
			<!-- left wrapper -->
			<!--<div w3-include-html="leftWrapper.php"></div>-->
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
				<div>

					<div class="wrapper wrapper-content">
						<div class="row">
							<div class="col-lg-3">
								<div class="ibox float-e-margins">
									<div class="ibox-content">
										<!-- Not sure how useful this is
										<div class="file-manager">
											<h5>Show:</h5>
											<a href="" class="file-control active">All</a>
											<a href="" class="file-control">Images</a>
											<a href="" class="file-control">HTML Emails</a>
											<a href="" class="file-control">HTML Pages</a>
											<a href="" class="file-control">eBooks</a>
										-->

											<div class="hr-line-dashed"></div>
											<button class="btn btn-primary btn-block">Upload a New File</button>
											<div class="hr-line-dashed"></div>
											<h5>Folders</h5>
											<ul class="folder-list" style="padding: 0">
												<i class="fa fa-folder" style="color:green"></i> &nbsp;&nbsp;<button class="btn btn-default btn-xs"> + New Folder</button>
												<li ng-repeat="folder in folders"><a href=""><i class="fa fa-folder" style="color:orange"></i> {{folder}}</a></li>
											</ul>
											<h5 class="tag-title">Tags</h5>
											<ul class="tag-list" style="padding: 0" ng-repeat="tag in tags">
												<li><a href="">{{tag}}</a></li>
											</ul>
											<div class="clearfix"></div>
										</div>
									</div>
							</div>
							<div class="col-lg-9">
								    <div class="ibox-content m-b-sm border-bottom">
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <input type="text" id="product_name" name="product_name" value="" placeholder="Search: Start typing the name of a file ..." class="form-control" ng-model="search">
                </div>
            </div>
        </div>

    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-content">

                    <table class="footable table table-hover toggle-arrow-tiny" data-page-size="15">
                        <thead>
                        <tr>

                            <th data-toggle="true"> </th>
                            <th data-toggle="true">File Name</th>
                            <th data-hide="phone">Type</th>
                            <th data-hide="all">Description</th>
                            <th data-hide="phone">Size</th>
                            <th class="text-right" data-sort-ignore="true">Action</th>

                        </tr>
                        </thead>
                        <tbody>
                        <tr ng-repeat="file in files | filter:search">
                            <td>
                                <img ng-src="{{file.Thumbnail}}" class="img-thumbnail" width="25">
                            </td>													
                            <td>
                                {{file.Name.fileName}}
                            </td>
                            <td>
                                <span class="badge">{{file.Type}}</span>
                            </td>
                            <td>
                                {{file.Description}}
                            </td>
                            <td>
                                {{file.Size}}
                            </td>
                            <td class="text-right">
                                <div class="btn-group">
                                    <button class="btn-white btn btn-xs">View</button>
                                    <button class="btn-white btn btn-xs">Edit</button>
                                </div>
                            </td>
                        </tr>
                     


                        </tbody>
                        <tfoot>
                        <tr>
                            <td colspan="6">
                                <ul class="pagination pull-right"></ul>
                            </td>
                        </tr>
                        </tfoot>
                    </table>

                </div>
            </div>
        </div>
    </div>

							</div>
						</div>
					</div>


					<div class="row">
						<div class="col-lg-12">
							<div class="wrapper wrapper-content animated fadeInUp">
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

			<script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
			<script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

			<!-- Custom and plugin javascript -->
			<script src="js/inspinia.js"></script>
			<script src="js/plugins/pace/pace.min.js"></script>
			<script src="js/davinci.js"></script>
			<!-- Page-Level Scripts -->

			<script>
				var dbName = "<?php echo $dbName; ?>";
			</script>
			<script src="js/assetLibrary.js"></script>

	</body>

	</html>