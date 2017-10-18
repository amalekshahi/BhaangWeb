<!-- report Start -->
<div class="ibox float-e-margins" ng-show="showreport">
	<div class="ibox-title" >
		<h5><i aria-hidden="true" class="fa fa-bar-chart" style="color:black"></i> Performance Snapshot</h5>
		<div class="ibox-tools">
			<button class="btn btn-white btn-xs" ng-click="ViewReport()"><i aria-hidden="true" class="fa fa-external-link" style="color:blue"></i> VIEW MORE PERFORMANCE REPORTS</button>
			<a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
		</div>
	</div>
	<div class="ibox-content" id="reportDiv">
		<div class="row">
			<div class="col-xs-3"><small class="stats-label"><i aria-hidden="true" class="fa" style="color:green"></i>Email #</small></div>
			<div class="col-xs-2"><small class="stats-label"><i aria-hidden="true" class="fa fa-users" style="color:green"></i> Targeted People</small></div>
			<div class="col-xs-2"><small class="stats-label"><i aria-hidden="true" class="fa fa-envelope-open-o" style="color:blue"></i>	Opens</small></div>
			<div class="col-xs-2"><small class="stats-label"><i aria-hidden="true" class="fa fa-mouse-pointer" style="color:purple"></i> Clicks to Blog Post</small></div>
			<div class="col-xs-2"><small class="stats-label"><i aria-hidden="true" class="fa fa-times-circle" style="color:red"></i> Unsubscribes</small></div>
		</div>
		<div class="row" ng-repeat="item in campaign.report">
			<div class="col-xs-3"><h2>{{item.emailName}}</h2></div>
			<div class="col-xs-2"><h2>{{item.Sent}}</h2></div>
			<div class="col-xs-2"><h2>{{item.Opened}}</h2></div>
			<div class="col-xs-2"><h2>{{item.Clicked}}</h2></div>
			<div class="col-xs-2"><h2>{{item.Unsubscribed}}</h2></div>
		</div>
	</div>
</div>
<!-- report End-->