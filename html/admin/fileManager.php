<?php
    date_default_timezone_set('UTC');
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
	<!-- Sweet alert -->
	<script src="css/sweet/sweetalert-dev.js"></script>
</head>

<body class="fixed-sidebar">
		<div id="wrapper" ng-controller="assetList">
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
<!-- 
										<div class="hr-line-dashed"></div>
										<button class="btn btn-primary btn-block"><i class="fa fa-upload" aria-hidden="true"></i> Upload a New File</button>
										<div class="hr-line-dashed"></div>
 -->

										<h5>Shortcuts</h5>
										<form method="post" id="initForm">
											<input type="hidden" name="initAccID" id="initAccID">
											<input type="hidden" name="initFolder" id = "initFolder">
										</form>
										<ul class="folder-list" style="padding: 0">
											<!-- <li class="pull-right"><button class="btn btn-white btn-xs" ng-click="ViewReport()"><i aria-hidden="true" class="fa fa-plus"></i> New Folder</button></li>
											<li><a href=""><i class="fa fa-files-o"></i> Uploads</a></li> -->
											<li ng-repeat="folder in folders"><a href="fileManager.php?folder={{folder}}"><i ng-if="folder!=host" class="fa fa-folder" style="color:orange"></i><i ng-if="folder==host" class="fa fa-folder-open" style="color:green;"></i> {{folder}}</a></li>
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
								<div class="ibox-content">
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
													<button class="btn btn-white btn-xs" ng-model="file" ngf-select="upload($file,'001')" href="" data-toggle="tooltip" data-placement="top" title="Upload and replace this email's hero image."><i aria-hidden="true" class="fa fa-cloud-upload"></i> Upload</button>

													<!-- <a ng-model="file" ngf-select="upload($file,'001')" href="" class="btn btn-default btn-file" data-toggle="tooltip" data-placement="top" title="Upload and replace this email's hero image."> <span ng-show="state['UpdFiles'] == 'Uploading'"><i class="glyphicon glyphicon-refresh spinning"></i></span><i class="fa fa-cloud-upload" ng-show="state['UpdFiles'] != 'Uploading'"></i>  Upload</a>	 -->

													<button class="underConstruction btn btn-white btn-xs" ng-click="ViewReport()"><i aria-hidden="true" class="fa fa-plus-circle"></i> New Folder</button>
													<select name="actionCmd" class="btn btn-white btn-xs" >
														<option value="Action" selected><i aria-hidden="true" class="fa fa-tasks"></i><span color="#808080">-- Action --</span></option>
														<!-- <option value="Copy URL">Copy URL</option> -->
														<option value="Download" class="underConstruction">Download</option>
														<option value="Rename" class="underConstruction">Rename</option>
														<option value="Delete" class="underConstruction">Delete</option>
														<option value="Move" class="underConstruction">Move</option>
													</select>
													

													<!-- 
													<button class="btn btn-white btn-xs" ng-click="ViewReport()"><i aria-hidden="true" class="fa fa-trash-o"></i> Delete</button>
													<button class="btn btn-white btn-xs" ng-click="ViewReport()"><i aria-hidden="true" class="fa fa-arrows"></i> Move</button> -->

												</div>&nbsp;&nbsp;
												<i ng-show="state['showfile'] != 'finish'"></i><span ng-show="state['showfile'] == 'loading'"><i class="glyphicon glyphicon-refresh spinning"></i></span>												
												<i ng-show="state['UpdFiles'] != 'uploading'"></i><span ng-show="state['UpdFiles'] == 'uploading'"><i class="glyphicon glyphicon-refresh spinning"></i></span> 

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
														<tr ng-if="nofile=='yes'">
															<td colspan='5'>No file exists.</td>
														</tr>
														<tr ng-repeat="file in files | filter:search">
															<td> 
																<input type="checkbox" id="check{{file.ID}}">
															</td>
															<td><i class="fa fa-circle" aria-hidden="true" style="color:green; font-size: 8px"></i><small class="text-muted"></small></td>

															<td ng-mouseover=showPreview(file.Thumbnail) a href="https://www.yahoo.com">
																<img ng-src="{{file.Thumbnail}}" class="img-thumbnail" width="95">
															</td>
															<td ng-mouseover=showPreview(file.Thumbnail)>
															 <span id="{{file.ID}}">{{file.Name.fileName}}</span><br><small class="text-muted">{{file.Description}}</small> 
															</td>															

															<td class="text-right">
																	<div class="ibox-tools">
																			<a class="dropdown-toggle" data-toggle="dropdown" href="#">
																			  <button class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="top" title="" data-original-title="Mark as read"><i class="fa fa-cogs" aria-hidden="true"></i></button>  
																			</a>
																			<ul class="dropdown-menu dropdown-user">
																				<li><a href="#"  ng-click="copyToClipboard(file.ID);">Grab URL</a>
																				</li>
																				<li><a href="#" class="underConstruction">Replace</a>
																				</li>
																				<li><a href="#" class="underConstruction">Rename</a>
																				</li>

																			</ul>
																		<!-- </div> -->
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
<script type="text/JavaScript" src="global.js?n=1"></script> 
<script>
	function uuidv4() {
		return 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function(c) {
			var r = Math.random() * 16 | 0,
				v = c == 'x' ? r : (r & 0x3 | 0x8);
			return v.toString(16);
		});
	}

	var dbName = "<?php echo $dbName; ?>";
	var accID = "<?php echo $accountID; ?>";
	//var pathUpload = "Images"; 
	var pathUpload = getParameterByName("folder");

</script>
<script src="js/assetLibrary.js"></script>

<style type="text/css">
	.underConstruction{
		pointer-events: none;
		color:#cccccc !important; 
	}
</style>

</body>

</html>