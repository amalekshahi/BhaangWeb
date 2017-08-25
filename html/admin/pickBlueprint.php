<?php
    date_default_timezone_set('America/Los_Angeles');
    session_start();
    include 'global.php';
    require_once('loginCredentials.php');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main Template</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>
<body class="">
    <div id="wrapper">
	<!-- left wrapper -->
	<div w3-include-html="leftWrapper.php"></div>
	<!-- /end left wrapper -->
	<div id="page-wrapper" class="gray-bg">
		<div class="row border-bottom">
				 <nav class="navbar navbar-static-top  " role="navigation" style="margin-bottom: 0">
				<!-- top wrapper -->
				<div w3-include-html="topWrapper.php"></div>
				<!-- / top wrapper -->
				</nav>
		</div>	
<!-- content -->
<div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-10">
                <h1><strong>What sort of campaign would you like to make?</strong></h1>
            </div>
            <div class="col-lg-2">

            </div>
        </div>
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-md-3">
                    <div class="ibox">
                        <div class="ibox-content product-box">
                            <img src="http://www.solostream.com/wp-content/uploads/2016/08/wordpress-custom-post-types.jpg" class="img-responsive"/>
                            <div class="product-desc">
                                <span class="product-price">
                                    Awareness
                                </span>
                                <small class="text-muted">Average CTR: 1.49%</small>
                                <a href="#" class="product-name"> Promote a Blog Post</a>



                                <div class="small m-t-xs">
                                    New piece of great content?  Don't let it gather dust.  Promote the b*tch and drive some leads in the process.
                                </div>
                                <div class="m-t text-righ">

                                    <!--<a href="dv.php?page=createCampaign" class="btn btn-xs btn-outline btn-primary">Launch <i class="fa fa-long-arrow-right"></i> </a>-->
                                    <a data-toggle="modal" class="btn btn-xs btn-outline btn-primary" href="#modal-form">Launch <i class="fa fa-long-arrow-right"> </i></a> 
                                </div>
                                
                                <div aria-hidden="true" class="modal fade" id="modal-form">
                                		<div class="modal-dialog">
                                			<div class="modal-content">
                                				<div class="modal-body">
                                					<div class="row">
                                						<div class="col-sm-6 b-r">
                                							<h3 class="m-t-none m-b">Let's Get Started!</h3>
                                							<p>Starting by naming your campaign.</p>
                                							<form role="form" method="get" action="editPromoteBlog.php">
                                								<div class="form-group">
                                									<!--<label>Name</label>--> <input class="form-control" placeholder="My fancy first campaign" type="input" name="campaign_name">
                                									<span class="help-block m-b-none">A good campaign name helps you easily identify the campaigns you've created in your Dashboard.</span>
                                								</div>
                                								<div>

                                									<button class="btn btn-lg btn-primary" type="submit" name="action" value="newCampaign"><strong>Got it.  Let's Go!</strong></button>
                                								</div>
                                							</form>
                                						</div>
                                						<div class="col-sm-6">
                                							<h4>Not feeling creative yet?</h4>
                                							<p>Don't worry.  You can always change this later.</p>
                                							<p class="text-center"><a href=""><i class="fa fa-plus big-icon"></i></a></p>
                                						</div>
                                					</div>
                                				</div>
                                			</div>
                                		</div>
                                	</div>                                
                                
                                
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="ibox">
                        <div class="ibox-content product-box">

                            <img src="https://cdn.elegantthemes.com/blog/wp-content/uploads/2017/01/wordpress-webinar.jpg" class="img-responsive"/>
                            <div class="product-desc">
                                <span class="product-price">
                                    Lead Gen
                                </span>
                                <small class="text-muted">Average Conversion Rate: 33.4%</small>
                                <a href="#" class="product-name"> Drive Webinar Signups</a>



                                <div class="small m-t-xs">
                                    Need to XYZ?  Get started now, and drive some leads while you're at it.
                                </div>
                                <div class="m-t text-righ">

                                    <a href="#" class="btn btn-xs btn-outline btn-primary">Launch <i class="fa fa-long-arrow-right"></i> </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="ibox">
                        <div class="ibox-content product-box">

                            <img src="https://cdn.shopify.com/s/files/1/0191/2296/files/nanotech2017_1_grande.JPG?v=1495623768" class="img-responsive"/>
                            <div class="product-desc">
                                <span class="product-price">
                                    Lead Gen
                                </span>
                                <small class="text-muted">Average Appointment Requests: 17</small>
                                <a href="#" class="product-name"> Get Tradeshow Appointments</a>



                                <div class="small m-t-xs">
                                    Need to XYZ?  Get started now, and drive some leads while you're at it.
                                </div>
                                <div class="m-t text-righ">

                                    <a href="#" class="btn btn-xs btn-outline btn-primary">Launch <i class="fa fa-long-arrow-right"></i> </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="ibox">
                        <div class="ibox-content product-box">

                            <img src="http://spdc.wpengine.com/wp-content/uploads/2013/04/postcard-example-thank-you.jpg" class="img-responsive"/>
                            <div class="product-desc">
                                <span class="product-price">
                                    Lead Gen
                                </span>
                                <small class="text-muted">Average Visit Rate: 1.09%</small>
                                <a href="#" class="product-name"> Get More Leads From Direct Mail</a>



                                <div class="small m-t-xs">
                                    Add PURLs, trackable 800 #s, and QR Codes to super-charge your Direct Mail.
                                </div>
                                <div class="m-t text-righ">

                                    <a href="#" class="btn btn-xs btn-outline btn-primary">Launch <i class="fa fa-long-arrow-right"></i> </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>






            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="ibox">
                        <div class="ibox-content product-box">

                            <img src="https://cdn.elegantthemes.com/blog/wp-content/uploads/2014/08/wordpress-chat-plugins.jpg" class="img-responsive"/>
                            <div class="product-desc">
                                <span class="product-price">
                                    Nuture
                                </span>
                                <small class="text-muted">Average Response Rate: 22.54%</small>
                                <a href="#" class="product-name"> Run an NPS Survey</a>



                                <div class="small m-t-xs">
                                    Need to XYZ?  Get started now, and drive some leads while you're at it.
                                </div>
                                <div class="m-t text-righ">

                                    <a href="#" class="btn btn-xs btn-outline btn-primary">Launch <i class="fa fa-long-arrow-right"></i> </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="ibox">
                        <div class="ibox-content product-box">

                            <img src="https://cdn.elegantthemes.com/blog/wp-content/uploads/2015/01/creative-ways-to-drive-traffic-awesomeness-package.png" class="img-responsive"/>
                            <div class="product-desc">
                                <span class="product-price">
                                    Awareness
                                </span>
                                <small class="text-muted">Average Ad Recall: 34%</small>
                                <a href="#" class="product-name"> Air Cover my Prospects</a>



                                <div class="small m-t-xs">
                                    Get 'em warmed up.  Even if they don't click, you win fool.
                                </div>
                                <div class="m-t text-righ">

                                    <a href="#" class="btn btn-xs btn-outline btn-primary">Launch <i class="fa fa-long-arrow-right"></i> </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

				<div class="col-md-3">
                    <div class="ibox">
                        <div class="ibox-content product-box">
                            <img src="http://www.solostream.com/wp-content/uploads/2016/08/wordpress-custom-post-types.jpg" class="img-responsive"/>
                            <div class="product-desc">
                                <span class="product-price">
                                    Awareness
                                </span>
                                <small class="text-muted">Average CTR: 1.49%</small>
                                <a href="#" class="product-name"> Email Marketing</a>



                                <div class="small m-t-xs">
                                    New piece of great content?  Don't let it gather dust.  Promote the b*tch and drive some leads in the process.
                                </div>
                                <div class="m-t text-righ">

                                    <!--<a href="dv.php?page=createCampaign" class="btn btn-xs btn-outline btn-primary">Launch <i class="fa fa-long-arrow-right"></i> </a>-->
                                    <a data-toggle="modal" class="btn btn-xs btn-outline btn-primary" href="#modal-emkform">Launch <i class="fa fa-long-arrow-right"> </i></a> 
                                </div>
                                
                                <div aria-hidden="true" class="modal fade" id="modal-emkform">
                                		<div class="modal-dialog">
                                			<div class="modal-content">
                                				<div class="modal-body">
                                					<div class="row">
                                						<div class="col-sm-6 b-r">
                                							<h3 class="m-t-none m-b">Let's Get Started!</h3>
                                							<p>Starting by naming your campaign.</p>
                                							<form role="form" method="get" action="editEmailMarketing.html">
                                								<div class="form-group">
                                									<!--<label>Name</label>--> <input class="form-control" placeholder="My fancy first campaign" type="input" name="campaign_name">
																	<span class="help-block m-b-none">A good campaign name helps you easily identify the campaigns you've created in your Dashboard.</span>
                                								</div>
                                								<div>

                                									<button class="btn btn-lg btn-primary" type="submit" name="action" value="newCampaign"><strong>Got it.  Let's Go!</strong></button>
                                								</div>
                                							</form>
                                						</div>
                                						<div class="col-sm-6">
                                							<h4>Not feeling creative yet?</h4>
                                							<p>Don't worry.  You can always change this later.</p>
                                							<p class="text-center"><a href=""><i class="fa fa-plus big-icon"></i></a></p>
                                						</div>
                                					</div>
                                				</div>
                                			</div>
                                		</div>
                                	</div>                                
                                
                                
                            </div>
                        </div>
                    </div>
                </div>

				<div class="col-md-3">
                    <div class="ibox">
                        <div class="ibox-content product-box">
                            <img src="http://www.solostream.com/wp-content/uploads/2016/08/wordpress-custom-post-types.jpg" class="img-responsive"/>
                            <div class="product-desc">
                                <span class="product-price">
                                    Awareness
                                </span>
                                <small class="text-muted">Average CTR: 1.49%</small>
                                <a href="#" class="product-name"> eNewsletters or eCoupons</a>



                                <div class="small m-t-xs">
                                    New piece of great content?  Don't let it gather dust.  Promote the b*tch and drive some leads in the process.
                                </div>
                                <div class="m-t text-righ">

                                    <!--<a href="dv.php?page=createCampaign" class="btn btn-xs btn-outline btn-primary">Launch <i class="fa fa-long-arrow-right"></i> </a>-->
                                    <a data-toggle="modal" class="btn btn-xs btn-outline btn-primary" href="#modal-enewsform">Launch <i class="fa fa-long-arrow-right"> </i></a> 
                                </div>
                                
                                <div aria-hidden="true" class="modal fade" id="modal-enewsform">
                                		<div class="modal-dialog">
                                			<div class="modal-content">
                                				<div class="modal-body">
                                					<div class="row">
                                						<div class="col-sm-6 b-r">
                                							<h3 class="m-t-none m-b">Let's Get Started!</h3>
                                							<p>Starting by naming your campaign.</p>
                                							<form role="form" method="get" action="editeNewsLetters.html">
                                								<div class="form-group">
                                									<!--<label>Name</label>--> <input class="form-control" placeholder="My fancy first campaign" type="input" name="campaign_name">
																	<span class="help-block m-b-none">A good campaign name helps you easily identify the campaigns you've created in your Dashboard.</span>
                                								</div>
                                								<div>

                                									<button class="btn btn-lg btn-primary" type="submit" name="action" value="newCampaign"><strong>Got it.  Let's Go!</strong></button>
                                								</div>
                                							</form>
                                						</div>
                                						<div class="col-sm-6">
                                							<h4>Not feeling creative yet?</h4>
                                							<p>Don't worry.  You can always change this later.</p>
                                							<p class="text-center"><a href=""><i class="fa fa-plus big-icon"></i></a></p>
                                						</div>
                                					</div>
                                				</div>
                                			</div>
                                		</div>
                                	</div>                                
                                
                                
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
<!--/ content -->           
			<div class="footer">
			<!-- footer -->
			<div w3-include-html="footer.php"></div>
			<!-- / footer -->			
			</div>
		</div><!--  end page-wrapper -->
</div>

    <!-- Mainly scripts -->
	<script src="js/w3data.js"></script>	
	<script>w3IncludeHTML();</script>
    <script src="js/jquery-3.1.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="js/inspinia.js"></script>
    <script src="js/plugins/pace/pace.min.js"></script>
	
	

</body>

</html>
