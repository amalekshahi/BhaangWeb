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
										<button class="btn btn-primary btn-block"><i class="fa fa-upload" aria-hidden="true"></i> Upload a New File</button>
										<div class="hr-line-dashed"></div>
										<h5>Shortcuts</h5>
										<ul class="folder-list" style="padding: 0">
											<li class="pull-right"><button class="btn btn-white btn-xs" ng-click="ViewReport()"><i aria-hidden="true" class="fa fa-plus"></i> New Folder</button></li>
											<li><a href=""><i class="fa fa-files-o"></i> Uploads</a></li>
											<li ng-repeat="folder in folders"><a href=""><i class="fa fa-folder" style="color:orange"></i> {{folder}}</a></li>
										</ul>
										<!--
											<h5 class="tag-title">Tags</h5>
											<ul class="tag-list" style="padding: 0" ng-repeat="tag in tags">
												<li><a href="">{{tag}}</a></li>
											</ul>
											-->
										<div class="clearfix"></div>
									</div>



									<div class="ibox-content">

										<h5>Preview</h5>
										<div class="clearfix"></div>
										<div class="text-center">
												<img ng-src="{{showPreviewFile}}" class="img-responsive">
											
											<p class="text-muted small">
												<br>95 x 55
											</p>
										</div>
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
												<div class="ibox-tools pull-left">
													<button class="btn btn-white btn-xs" ng-click="ViewReport()"><i aria-hidden="true" class="fa fa-trash-o"></i> Delete</button>
													<button class="btn btn-white btn-xs" ng-click="ViewReport()"><i aria-hidden="true" class="fa fa-arrows"></i> Move</button>

												</div>


												<table class="footable table table-hover toggle-arrow-tiny" data-page-size="15">
													
													<thead>
														<tr>
															<th data-toggle="true"> </th>
															<th data-toggle="true"> </th>
															<th data-toggle="true"> </th>

															<th data-hide="all"></th>
															<th class="text-right" data-sort-ignore="true"></th>

														</tr>
													</thead>
													<tbody>
														<tr ng-repeat="file in files | filter:search">
															<td> 
																<input type="checkbox">
															</td>
															<td><i class="fa fa-circle" aria-hidden="true" style="color:green; font-size: 8px"></i><small class="text-muted"></small></td>

															<td ng-mouseover=showPreview(file.Thumbnail)>
																<img ng-src="{{file.Thumbnail}}" class="img-thumbnail" width="95">
															</td>
															<td ng-mouseover=showPreview(file.Thumbnail)>
															 {{file.Name.fileName}}<br><small class="text-muted">{{file.Description}}</small> 
															</td>
															

															<td class="text-right">
 <div class="ibox-tools">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                  <button class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="top" title="" data-original-title="Mark as read"><i class="fa fa-cogs" aria-hidden="true"></i></button>  
                                </a>
                                <ul class="dropdown-menu dropdown-user">
                                    <li><a href="#">Grab URL</a>
                                    </li>
                                    <li><a href="#">Replace</a>
                                    </li>
                                    <li><a href="#">Rename</a>
                                    </li>

	 </ul>
                            </div>
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