<?php
date_default_timezone_set('America/Los_Angeles');
session_start();
$dbName = $_SESSION['DBNAME'];
$accountID = $_SESSION['ACCOUNTID'];
$accountName = $_SESSION['ACCOUNNAME'];
$email = $_SESSION['EMAIL'];
$pwd = $_SESSION['PWD'];
$USERNAME = $_SESSION['USERNAME'];
?>
	<script type="text/javascript">
		var userName = "<?php echo $email; ?>";
		var passWord = "<?php echo $pwd; ?>";
	</script>

	<div class="navbar-header">
		<!-- Commented out for now, until we have Da Vinci wide search
		<a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>		
  <form role="search" class="navbar-form-custom" action="#">
        <div class="form-group">
            <input type="text" placeholder="Search...." class="form-control" name="top-search" id="top-search">
        </div>
    </form>
  -->
	</div>
	<ul class="nav navbar-top-links navbar-right">
		<li><span class="m-r-sm text-muted welcome-message"><?php echo $USERNAME;?>, you're logged in to <?php echo $accountName;?>.</span></li>
		<li>
            <!-- Kwang disable this because it make others page fail due to "seemlessLoginCtrl" not found 
			<div ng-controller="seamlessLoginCtrl">
				<form name="loginForm" id="loginForm" class="form-inline" role="form" method="post">
					<div id="accountDiv" class="form-group" ng-cloak>
						<select style="width:100%;" ng-model="mpsSelect">
								<option value="">-- Switch to another Account ------------------</option>
								<option ng-repeat="option in login.mps | orderBy:'name' " value="{{option.id}}|{{option.name}}">{{option.name}}</option>
								</select>
					</div>
					<button class="btn btn-primary btn-xs" ng-click="Login()" ng-disabled="loginForm.$invalid">Go</button>
				</form>
			</div>
            -->
		</li>
		<li><a onClick="dbgClick('DBView')"><i class="fa fa-cog" ></i><small>Database</small></a></li>
		<li><a onClick="dbgClick('Issue')"><i class="fa fa-bug" ></i><small>GitHub</small></a></li>
		<li><a href="logout.php"><i class="fa fa-sign-out"></i> Log out </a>
		</li>
	</ul>
	<script>
		// default 
		function dbgClick(from) {
			var dbEndpoint = "<?php echo $databaseEndpoint;?>";
			var dbName = "<?php echo $dbName;?>";
			var accountID = "<?php echo $accountID; ?>";

			//alert(dbEndpoint);
			if (from == 'DBView') {
				if (typeof campaignID == 'undefined') {
					window.open(dbEndpoint + "/_utils/document.html?" + dbName + "/campaignlist", '_blank');
				} else {
					window.open(dbEndpoint + "/_utils/document.html?" + dbName + "/" + campaignID, '_blank');
				}
			}
			if (from == 'Issue') {
				window.open("https://github.com/coa0329/BhaangWeb/issues", '_blank');
			}
		}
	</script>