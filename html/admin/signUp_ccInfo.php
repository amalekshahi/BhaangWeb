<?php
    date_default_timezone_set('UTC');
?>
<!DOCTYPE html>
<html ng-app="myApp">

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
					<div>
						<h1><span class="text-navy">Almost Done ... </span></h1>
						<div class="well" style="padding-bottom: 0px; padding-top: 5px;"><button type="button" class="btn btn-success btn-lg pull-right"><span class="fa fa-smile-o" aria-hidden="true"></span> $0/mo</button>
							<h2><strong>Starter Plan</strong></h2>
							This plan includes 100 Contacts and unlimited Email sends per month. You'll have access to all Da Vinci features, allowing you to start generating more leads and sales immediately. All plans come with a money-back guarantee.</p>
						</div>
						<p></p>
								<div class="row">
									<div class="col-md-6">
										<h2 style="margin-top: 0px;">Your Starter Plan Awaits</h2>
										<strong>Just enter the billing information for this account and we’ll get started.</strong><br>
										<p class="m-t"><strong>Why do we ask for your credit card?</strong><br>We ask for your credit card to prevent interruption of service should you exceed your plan limits. Your credit card will not be charged as long as you remain on the free plan.</p>
									</div>
									<div class="col-md-6">
										<form role="form" id="payment-form">
											<div class="row">
												<div class="col-xs-12">
													<div class="form-group">
														<label>Credit Card Number</label>
														<div class="input-group">
															<input type="text" class="form-control input-lg m-b" name="Number" placeholder="4128 1234 1234 1234" required="" autofocus="">
															<span class="input-group-addon"><i class="fa fa-credit-card"></i></span>
														</div>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-xs-4 col-md-4">
													<div class="form-group">
														<label>Month</label>
														<select class="form-control input-lg">
															<option>1</option>
															<option>2</option>
															<option>3</option>
															<option>4</option>
															<option>5</option>
															<option>6</option>
															<option>7</option>
															<option>8</option>
															<option>9</option>
															<option>10</option>
															<option>11</option>
															<option>12</option>
														</select>
													</div>
												</div>
												<div class="col-xs-4 col-md-4 pull-center">
													<div class="form-group">
														<label>Year</label>
														<select class="form-control input-lg">
															<option>17</option>
															<option>18</option>
															<option>19</option>
															<option>20</option>
															<option>21</option>
															<option>22</option>
															<option>23</option>
															<option>24</option>
															<option>25</option>
															<option>26</option>
														</select>
													</div>
												</div>												
												<div class="col-xs-4 pull-right">
													<div class="form-group">
														<label>CV CODE</label>
														<input type="text" class="form-control input-lg m-b" name="CVC" placeholder="CVC" required="">
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-xs-12">
													<div class="form-group">
														<label>Name on Card</label>
														<input type="text" class="form-control input-lg m-b" name="nameCard" placeholder="Leo Da Vinci">
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-xs-12">
													<button class="btn btn-primary btn-lg" type="submit"><i class="fa fa-play" aria-hidden="true"></i> Start Using Da Vinci</button>
												</div>
											</div>
										</form>
									</div>
								</div>
								<div class="hr-line-dashed"></div>
								<div class="alert alert-danger" role="alert"><i class="fa fa-bell-o" aria-hidden="true"></i> You are signing up for a free plan and will not be charged unless you exceed your plan limits. You can cancel anytime.</div>
					</div>
				</div>				
			</div>
       <div class="col-md-5 no-float">
				<blockquote class="testimonial">
							<q class="quote" style="color:white">There’s no risk and you can cancel anytime with a single click from your dashboard. All plans come with a money-back guarantee.</q>
							<div class="attribution">
								<img class="img-rounded" src="https://daruaaogzxkn2.cloudfront.net/assets/ambassador-jeff-f9e2427426db1c88db92c6afeb1f83c4d68e67f35cdf7f120ef04b5e807b5e84.jpg" alt="Ambassador jeff" width="25" height="25">
								<span style="color:white">Kushal Dutta, MindFire</span>
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