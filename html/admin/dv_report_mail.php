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
			<div class="col-xs-1"><small class="stats-label"><i aria-hidden="true" class="fa" style="color:green"></i>Email #</small></div>
			<div class="col-xs-2"><small class="stats-label"><i aria-hidden="true" class="fa fa-users" style="color:green"></i> Targeted People</small></div>
			<div class="col-xs-2"><small class="stats-label"><i aria-hidden="true" class="fa fa-envelope-o" style="color:blue"></i>	Delivered</small></div>
			<div class="col-xs-2"><small class="stats-label"><i aria-hidden="true" class="fa fa-envelope-open-o" style="color:blue"></i>	Opens</small></div>
			<div class="col-xs-2"><small class="stats-label"><i aria-hidden="true" class="fa fa-mouse-pointer" style="color:purple"></i> Clicks to Blog Post</small></div>
			<div class="col-xs-2"><small class="stats-label"><i aria-hidden="true" class="fa fa-times-circle" style="color:red"></i> Unsubscribes</small></div>
			<div class="col-xs-1"><small class="stats-label"><i aria-hidden="true" class="fa fa-check-square" style="color:blue"></i> Conversions</small></div>
		</div>
		<div class="row" ng-repeat="item in campaign.report">
			<div class="col-xs-1"><h3>{{item.emailName }}</h3></div>
			<div class="col-xs-2"><h3>{{item.Sent | number}}</h3></div>
			<div class="col-xs-2"><h3>{{item.Delivered | number}} ({{item.DeliveredRate | number:0}}%)</h3></div>
			<div class="col-xs-2"><h3>{{item.Opened | number}} ({{item.OpenedRate | number:0}}%)</h3></div>
			<div class="col-xs-2"><h3>{{item.Clicked | number}} ({{item.ClickedRate | number:0}}%)</h3></div>
			<div class="col-xs-2"><h3>{{item.Unsubscribed | number}} ({{item.UnsubscribedRate | number:0}}%)</h3></div>
			<div class="col-xs-1"><h3>{{item.Conversions | number}} ({{item.ConversionsRate | number:0}}%)</h3></div>
		</div>
		<div class="row">
			<div class="col-xs-1"><h3>Summary</h3></div>
			<div class="col-xs-2"><h3>{{campaign.reportSumarySent | number}}</h3></div>
			<div class="col-xs-2"><h3>{{campaign.reportSumaryDelivered | number}} ({{campaign.reportSumaryDeliveredRate | number:0}}%)</h3></div>
			<div class="col-xs-2"><h3>{{campaign.reportSumaryOpened | number}} ({{campaign.reportSumaryOpenedRate | number:0}}%)</h3></div>
			<div class="col-xs-2"><h3>{{campaign.reportSumaryClicked | number}} ({{campaign.reportSumaryClickedRate | number:0}}%)</h3></div>
			<div class="col-xs-2"><h3>{{campaign.reportSumaryUnsubscribed | number}} ({{campaign.reportSumaryUnsubscribedRate | number:0}}%)</h3></div>
			<div class="col-xs-1"><h3>{{campaign.reportSumaryConversions | number}} ({{campaign.reportSumaryConversionsRate | number:0}}%)</h3></div>
		</div>
	</div>
</div>
<script src="js/dv_report_mail.js"></script>
<!-- report End-->