<?php
    date_default_timezone_set('UTC');
?>
<!DOCTYPE html>
<html ng-app="myApp" style="height: 100%">

<head>
<!-- Google Tag Manager -->
<script>
	(function(w, d, s, l, i) {
		w[l] = w[l] || [];
		w[l].push({
			'gtm.start': new Date().getTime(),
			event: 'gtm.js'
		});
		var f = d.getElementsByTagName(s)[0],
			j = d.createElement(s),
			dl = l != 'dataLayer' ? '&l=' + l : '';
		j.async = true;
		j.src =
			'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
		f.parentNode.insertBefore(j, f);
	})(window, document, 'script', 'dataLayer', 'GTM-KWJ66T');
</script>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="cache-control" content="max-age=0" />
<meta http-equiv="cache-control" content="no-cache" />
<meta http-equiv="expires" content="0" />
<meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
<meta http-equiv="pragma" content="no-cache" />
<title>Da Vinci Sign Up</title>
<link href="css/bootstrap.min.css" rel="stylesheet"/>
<link href="font-awesome/css/font-awesome.css" rel="stylesheet"/>
<link href="css/animate.css" rel="stylesheet"/>
<link href="css/style.css" rel="stylesheet"/>
<link href="https://s3.amazonaws.com/mindfiredavinci/img/DV-logo.png" rel="icon" type="image/x-icon" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.0/chosen.min.css" data-require="chosen@*" data-semver="1.0.0" rel="stylesheet" />
<link href="css/plugins/chosen/bootstrap-chosen.css" rel="stylesheet" />

<!-- Angular -->
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js"></script>

		<!-- Custom and plugin javascript -->
<script src="js/inspinia.js"></script>
<script src="js/plugins/pace/pace.min.js"></script>
<script src="js/davinci.js"></script>
	
<script src="https://netdna.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		
<style>
		html,body,.container
		{
				height:100%;
		}
		.container
		{
				display:table;
				width: 100%;
				margin-bottom: 0px;
				margin-top: 0px;
				padding: 0px 0 0 0; /*set left/right padding according to needs*/
				-moz-box-sizing: border-box;
				box-sizing: border-box;
			
		}
		.row
		{
				height: 100%;
				display: table-row;
		}
		@media (min-width: 992px) {
			.row .no-float {
					display: table-cell;
					float: none;
			}
		}
	.col-md-7 {   
    background: white;
		}
		.col-md-5 {
				background: #ff6633;
				display: inline-block;
		    vertical-align: middle; 
		}
	</style>
</head>
<body>
		
<div class="container">
    <div class="row">
      <div class="col-md-7 no-float">
					<div>
						<h1><span class="text-navy">2 Simple Steps to Get Started</span></h1>
						<div class="well" style="padding-bottom: 0px; padding-top: 5px;"><button type="button" class="btn btn-success btn-lg pull-right"><span class="fa fa-smile-o" aria-hidden="true"></span> $0/mo</button>
							<h2><strong>Starter Plan</strong></h2>
							This plan includes 100 Contacts and unlimited Email sends per month. You'll have access to all Da Vinci features, allowing you to start generating more leads and sales immediately. All plans come with a money-back guarantee.</p>
						</div>
						<p></p>
						<form method="get" class="form-horizontal">
							<div class="form-group"><label class="col-sm-4 control-label"></label>
								<div class="col-sm-8">
									<h3>First, we need some basic information to set up your account:</h3>
								</div>
							</div>
							<div class="form-group"><label class="col-sm-4 control-label">Your Name</label>
								<form role="form" class="form-inline">
									<div class="col-sm-8">
										<input type="text" placeholder="Leo" class="form-control input-lg m-b" autofocus="">
										<input type="text" placeholder="Da Vinci" class="form-control input-lg m-b">
									</div>
							</div>
							<div class="form-group"><label class="col-sm-4 control-label">Your Company's Website</label>
								<div class="col-sm-8">
									<input type="text" placeholder="http://www.something.com" class="form-control input-lg m-b">
								</div>
							</div>
							<div class="form-group"><label class="col-sm-4 control-label">Email Address</label>
								<div class="col-sm-8">
									<input type="text" placeholder="you@email.com" class="form-control input-lg m-b">
								</div>
							</div>
							<div class="form-group"><label class="col-sm-4 control-label">Password (at least 5 characters)</label>
								<div class="col-sm-8">
									<input type="password" placeholder="pencil" class="form-control input-lg m-b">
								</div>
							</div>
							<div class="form-group"><label class="col-sm-4 control-label">How'd you find Da Vinci?</label>
								<div class="col-sm-8">
									<input type="text" placeholder="I found Da Vinci via ..." class="form-control input-lg m-b">
									<p>
									</p>
									<button class="btn btn-primary btn-lg" type="submit"><i class="fa fa-arrow-right" aria-hidden="true"></i> Next Step</button>
							<p class="text-muted" style="font-size: .65em"><br>Copyright ©2017 MindFire, Inc ®. All Rights Reserved. • <a href="http://www.mindfireinc.com/privacy">Privacy Policy</a> • <a href="http://www.mindfireinc.com/static/images/mindfire_acceptable_use_policy.pdf" target="_blank">Acceptable Use Policy</a>								• <a href="http://www.mindfireinc.com/terms ">Terms of Service</a></p>

								</div>
							</div>
								</form>
					</div>
			</div>
       <div class="col-md-5 no-float">
						<blockquote class="testimonial">
							<h1><q class="quote" style="color:white">We've seen 11x more leads since we started using Da Vinci. It's a must-have for any company.</q></h1>
							<div class="attribution">
								<img class="img-rounded" src="https://daruaaogzxkn2.cloudfront.net/assets/ambassador-jeff-f9e2427426db1c88db92c6afeb1f83c4d68e67f35cdf7f120ef04b5e807b5e84.jpg" alt="Ambassador jeff" width="25" height="25">
								<span style="color:white">Mike Robinson, Summit Print & Mail</span>
							</div>
						</blockquote>
				</div>
    </div>
</div>		

<!-- Custom and plugin javascript -->
<script src="js/inspinia.js"></script>
<script src="js/plugins/pace/pace.min.js"></script>
<script src="js/davinci.js"></script>

</body>

</html>