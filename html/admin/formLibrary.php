<?php
    session_start();
    include 'global.php';
    require_once('loginCredentials.php');
    $dbName = $_SESSION['DBNAME'];
?>

<!DOCTYPE html>
<html ng-app="myApp">
<head>
    <?php include "header.php"; ?>
	<script src="js/date.format.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.7.0/sweetalert2.css" rel="stylesheet">
</head>

<body class="fixed-sidebar">
    <div id="wrapper">
	<?php include 'leftWrapper.php'; ?>
	<div id="page-wrapper" class="gray-bg">
		<div class="row border-bottom">
				 <nav class="navbar navbar-static-top  " role="navigation" style="margin-bottom: 0">
				<?php include 'topWrapper.php'; ?>
				</nav>
		</div>	
<!-- content -->
<div ng-controller="myCtrl">
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center m-t-lg">
                        <div class="jumbotron" style="background-color:#ffffff">
                          <h1><strong>Form Library</strong></h1>
                          <h4>Build your database by collecting user information.  Build once, use anywhere.</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="wrapper wrapper-content animated fadeInUp">
                    <div class="ibox">
                        <div class="ibox-title">
                            <h5>Your Forms</h5>
                            <div class="ibox-tools">
                                <a href="formEditor.php#!new" class="btn btn-primary btn">+ Create New Form</a>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <div class="project-list">

                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th>Status</th>
                                        <th>Form Name</th>
                                        <th># of Fields</th>
                                        <th>Fields</th>
                                        <th>Submissions</th>
                                        <th>&nbsp;</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr ng-repeat="item in formLib.items | orderBy:'-modifiedDate'" ng-cloak>
                                        <td class="project-reach">
                                                <medium>Active</medium><br><small class="text-muted">&nbsp;</small> 
                                        </td>
                                        <td class="project-title">
                                            <a href="formEditor.php?fID={{item.formID}}">{{item['formName']}}</a>
                                            <br/>
                                            <a href="formEditor.php?fID={{item.formID}}"><small class="text-muted">Modified <time am-time-ago="item.modifiedDate"></time></small></a>
                                        </td>
                                        <td class="project-reach">
                                                <medium>{{item.fieldLists.length}}</medium><br><small class="text-muted">&nbsp;</small> 
                                        </td>
                                        <td class="project-completion">
                                                <medium>{{item.allFieldName}}</medium><br><small class="text-muted">&nbsp;</small> 
                                                
                                            
                                        </td>
                                        <td class="project-completion">
                                                <medium>{{item.submission}}</medium><br><small class="text-muted">people submitted this form</small>
                                        </td>

                                        <td class="project-actions">
                                            <!-- <a href="formEditorCopy.php?fID={{item.formID}}" class="btn btn-white btn-sm" ><i class="fa fa-clone" style="color:green"></i> Copy </a> -->
											
                                            <a href="#" class="btn btn-white btn-sm" ng-click="DuplicateFormClick(item.formID,item.formName)"><i class="fa fa-clone" style="color:green"></i> Copy </a>
                                            <a href="formEditor.php?fID={{item.formID}}" class="btn btn-white btn-sm"><i class="fa fa-pencil" style="color:green"></i> Edit </a>
                                        </td>
                                        
                                    </tr>                                   
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


</div><!-- myCtrl -->
<!--/ content -->           
			<div class="footer fixed">
				<?php include 'footer.php'; ?>
			</div>
		</div><!--  end page-wrapper -->
</div>

    <!-- Mainly scripts -->
    <script src="js/jquery-3.1.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="js/inspinia.js"></script>
    <script src="js/plugins/pace/pace.min.js"></script>

	 <!-- Page-Level Scripts -->
	<script type="text/JavaScript" src="global.js?n=1"></script> 	
 	<script src="js/jquery.md5.js"></script>	
	<script src="js/davinci.js"></script>

	<!-- user version 2 to support modal input -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>        
	<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.7.0/sweetalert2.min.js"></script>
	<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.7.0/sweetalert2.common.js"></script>-->

	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
	<script src="https://cdn.jsdelivr.net/angular.moment/1.0.1/angular-moment.min.js"></script>

<script>
	var dbName = "<?php echo $dbName; ?>";
</script>
<script src="js/formLibrary.js"></script>
</body>
</html>
