<!-- report Start -->
<div class="ibox float-e-margins" ng-show="showreport==true" ng-controller="dvreport">
	<div class="ibox-title" >
		<h5><i aria-hidden="true" class="fa fa-bar-chart" style="color:black"></i> Performance Snapshot</h5>
		<div class="ibox-tools">
			<button class="btn btn-white btn-xs" ng-click="ViewReport()"><i aria-hidden="true" class="fa fa-external-link" style="color:blue"></i> VIEW MORE PERFORMANCE REPORTS</button>
			<a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
		</div>
	</div>
	<div class="ibox-content" id="reportDiv">
		<div class="row">
			<div class="col-xs-2"><small class="stats-label"><i aria-hidden="true" class="fa" style="color:green"></i>Email #</small></div>
			<div class="col-xs-2"><small class="stats-label"><i aria-hidden="true" class="fa fa-users" style="color:green"></i> Targeted People</small></div>
			<div class="col-xs-2"><small class="stats-label"><i aria-hidden="true" class="fa fa-envelope-o" style="color:blue"></i>	Delivered</small></div>
			<div class="col-xs-2"><small class="stats-label"><i aria-hidden="true" class="fa fa-envelope-open-o" style="color:blue"></i>	Opens</small></div>
			<div class="col-xs-2"><small class="stats-label"><i aria-hidden="true" class="fa fa-mouse-pointer" style="color:purple"></i> Clicks to Blog Post</small></div>
			<div class="col-xs-2"><small class="stats-label"><i aria-hidden="true" class="fa fa-times-circle" style="color:red"></i> Unsubscribes</small></div>
		</div>
		<div class="row" ng-repeat="item in campaign.report">
			<div class="col-xs-2"><h2>{{item.emailName }}</h2></div>
			<div class="col-xs-2"><h2>{{item.Sent | number}}</h2></div>
			<div class="col-xs-2"><h2>{{item.Delivered | number}}</h2></div>
			<div class="col-xs-2"><h2>{{item.Opened | number}}</h2></div>
			<div class="col-xs-2"><h2>{{item.Clicked | number}}</h2></div>
			<div class="col-xs-2"><h2>{{item.Unsubscribed | number}}</h2></div>
		</div>
	</div>
</div>
<script src="js/dv_report_mail.js"></script>
<!-- report End-->