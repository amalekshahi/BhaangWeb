<!-- ebook report Start -->
<div class="ibox float-e-margins" ng-show="showreportebook==true" ng-controller="dvebookreport">
	<div class="ibox-title" >
		<h5><i aria-hidden="true" class="fa fa-bar-chart" style="color:black"></i> Performance Snapshot [Reach : {{reportebookReach}} Conversion : {{reportebookConversion}}%]</h5>
		<div class="ibox-tools">
			<button class="btn btn-white btn-xs" ng-click="ViewReport()"><i aria-hidden="true" class="fa fa-external-link" style="color:blue"></i> VIEW MORE PERFORMANCE REPORTS</button>
			<a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
		</div>
	</div>
	<div class="ibox-content" id="reportDiv">
		<div class="row">
			<div class="col-xs-3"><small class="stats-label"><i aria-hidden="true" class="fa" style="color:green"></i>Page</small></div>
			<div class="col-xs-2"><small class="stats-label"><i aria-hidden="true" class="fa fa-users" style="color:green"></i> Reach</small></div>
			<div class="col-xs-2"><small class="stats-label"><i aria-hidden="true" class="fa fa-envelope-open-o" style="color:blue"></i>	Submits</small></div>
			<div class="col-xs-2"><small class="stats-label"><i aria-hidden="true" class="fa fa-mouse-pointer" style="color:purple"></i> Clicks</small></div>
			<div class="col-xs-2"><small class="stats-label"><i aria-hidden="true" class="fa fa-times-circle" style="color:red"></i> Responses</small></div>
		</div>
		<div class="row" ng-repeat="item in campaign.reportebook | orderBy:'+orderid'">
			<div class="col-xs-3"><h2>{{item.Page}}</h2></div>
			<div class="col-xs-2"><h2>{{item.Visitors}}</h2></div>
			<div class="col-xs-2"><h2>{{item.Submits}}</h2></div>
			<div class="col-xs-2"><h2>{{item.Clicks}}</h2></div>
			<div class="col-xs-2"><h2>{{item.Responses}}</h2></div>
		</div>
	</div>
</div>
<script src="js/dv_report_ebook.js"></script>
<!-- ebook report End-->