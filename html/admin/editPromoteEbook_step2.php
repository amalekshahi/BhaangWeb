
	<div class="panel-heading">
		<h4 class="panel-title"><a data-parent="#accordion" data-toggle="collapse" href="#collapseTwo"><span class="badge">2</span> &nbsp;Set Up Your Landing Page &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <small class="m-l-sm"><i aria-hidden="true" class="fa fa-file-o"></i> 1 of 2 Pages Configured</small></a></h4>
	</div>
	<div class="panel-collapse collapse" id="collapseTwo">
		<div class="panel-body">
			<div class="row wrapper border-bottom white-bg page-heading">
				<div class="wrapper wrapper-content animated fadeIn gray-bg">
					<div class="row">
						<div class="col-lg-12">
							<div class="tabs-container">
								<ul class="nav nav-tabs">
									<li class="active">
										<a data-toggle="tab" href="#tab-1"><i aria-hidden="true" class="fa fa-file-text-o" style="color:green"></i> Welcome Page</a>
									</li>
									<li class="">
										<a data-toggle="tab" href="#tab-2"><i aria-hidden="true" class="fa fa-file-text-o" style="color:blue"></i> Thank-You Page</a>
									</li>
									<li class="">
										<a data-toggle="tab" href="#tab-3"><i aria-hidden="true" class="fa fa-cogs"></i> <strong>Landing Page Settings</strong></a>
									</li>
								</ul>
								<div class="tab-content">
									<div class="tab-pane active" id="tab-1">
										<div class="mail-box-header">
											<!--<a href="" class="btn btn-success btn-block" data-toggle="tooltip" data-placement="top" title="I'll send you a test of this email to daver@mindfireinc.com"><i class="fa fa-share-square-o"></i> Preview</a>-->
											<div class="pull-right tooltip-demo">
												<a class="btn btn-white fullscreen-link"><i class="fa fa-arrows-alt"></i> Edit in Full Screen</a> <a class="btn btn-white" data-placement="top" data-toggle="tooltip" href="mailbox.html" title="Leave without saving"><i class="fa fa-ban"></i> Cancel</a> <button class="btn btn-primary" name="action" type="submit" value="saveEmail"><i class="fa fa-floppy-o"></i> Save Page</button>
											</div>
											<div class="col-xs-4">
												<select class="chosen-select col-xs-4" data-target=".template_preview" id="template" name="EMAIL-{{email_number}}-template" tabindex="2">
													<option data-show=".Pick" value="Pick">
														Pick a template...
													</option>
													<option data-show=".Plain" value="Plain">
														Plain: Simple Page
													</option>
													<option data-show=".Company_eBook" value="Company_eBook">
														Company Page: Your company logo, call to action button, and address in footer
													</option>
												</select>
											</div><br>
											<br>
										</div>
										<div class="ibox-content">
											<div class="window">
												<div class="titlebar">
													<div class="buttons">
														<div class="close"></div>
														<div class="minimize"></div>
														<div class="zoom"></div>
													</div><small>eBook Landing Page</small> <!-- window title -->
												</div>
												<div class="content">
													<div class="template_preview">
														<div class="Pick">
															<p></p>
															<p>Your landing page preview will display here after you select a template.</p>
															<p></p>
														</div>
														<div class="Plain">
															{{PLAIN-EBOOK}}
														</div>
														<div class="Company_eBook">
															{{COMPANY-EBOOK}}
															<p>&nbsp;</p>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="row"></div>
									</div>
									<div class="tab-pane" id="tab-2">
										<div class="mail-box-header">
											<!--<a href="" class="btn btn-success btn-block" data-toggle="tooltip" data-placement="top" title="I'll send you a test of this email to daver@mindfireinc.com"><i class="fa fa-share-square-o"></i> Preview</a>-->
											<div class="pull-right tooltip-demo">
												<a class="btn btn-white fullscreen-link"><i class="fa fa-arrows-alt"></i> Edit in Full Screen</a> <a class="btn btn-white" data-placement="top" data-toggle="tooltip" href="mailbox.html" title="Leave without saving"><i class="fa fa-ban"></i> Cancel</a> <button class="btn btn-primary" name="action" type="submit" value="saveEmail"><i class="fa fa-floppy-o"></i> Save Page</button>
											</div>
											<div class="col-xs-4">
												<select class="chosen-select col-xs-4" data-target=".template_preview" id="template" name="EMAIL-{{email_number}}-template" tabindex="2">
													<option data-show=".Pick" value="Pick">
														Pick a template...
													</option>
													<option data-show=".PLAIN-EBOOK-THANKS" value="PLAIN-EBOOK-THANKS">
														Plain: Simple Page
													</option>
													<option data-show=".COMPANY-EBOOK-THANKS" value="COMPANY-EBOOK-THANKS">
														Company Page: Your company logo, call to action button, and address in footer
													</option>
												</select>
											</div><br>
											<br>
										</div>
										<div class="ibox-content">
											<div class="window">
												<div class="titlebar">
													<div class="buttons">
														<div class="close"></div>
														<div class="minimize"></div>
														<div class="zoom"></div>
													</div><small>eBook Landing Page</small> <!-- window title -->
												</div>
												<div class="content">
													<div class="template_preview">
														<div class="Pick">
															<p></p>
															<p>Your landing page preview will display here after you select a template.</p>
															<p></p>
														</div>
														<div class="PLAIN-EBOOK-THANKS">
															{{PLAIN-EBOOK-THANKS}}
														</div>
														<div class="COMPANY-EBOOK-THANKS">
															{{COMPANY-EBOOK-THANKS}}
															<p>&nbsp;</p>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="row"></div>
									</div>
									<div class="tab-pane" id="tab-3">
										<div class="panel-body">
											<div class="ibox float-e-margins">
												<div class="ibox-content">
													<form action="" class="form-horizontal" method="post">
														<div class="form-group">
															<label class="col-sm-2 control-label">Welcome Page URL</label>
															<div class="col-sm-10">
																<p><a href="http://www.google.com" id="copytext">http://a-generic-domain-we-buy.com/hash/welcome.html</a> &nbsp;&nbsp;&nbsp;<a class="btn btn-white btn-sm" data-clipboard-target="#copytext"><i class="fa fa-copy"></i> Copy URL</a> <a class="btn btn-white btn-sm" href="http://www.google.com" target="_blank"><i class="fa fa-external-link"></i> Open in New Window</a></p>
															</div>
														</div>
														<div class="form-group">
															<label class="col-sm-2 control-label">Thank-You Page URL</label>
															<div class="col-sm-10">
																<p><a href="http://www.google.com" id="copytext">http://a-generic-domain-we-buy.com/hash/thank-you.html</a> &nbsp;<a class="btn btn-white btn-sm" data-clipboard-target="#copytext"><i class="fa fa-copy"></i> Copy URL</a> <a class="btn btn-white btn-sm" href="http://www.google.com" target="_blank"><i class="fa fa-external-link"></i> Open in New Window</a></p>
															</div>
														</div>
														<div class="form-group">
															<label class="col-sm-2 control-label">Landing Page Domain</label>
															<div class="col-xs-3">
																<select class="chosen-select col-xs-4" id="domain" name="domain" tabindex="2">
																	<option data-show=".Pick" value="Pick">
																		Pick a domain ...
																	</option>
																	<option selected value="d1">
																		a-generic-domain-we-buy.com
																	</option>
																	<option value="d2">
																		another-generic-domain-we-buy.com
																	</option>
																	<option value="d3">
																		A-domain-they-have-purchased.com
																	</option>
																</select>
																<p></p>
																<p><a class="btn btn-success btn-block btn-sm" data-placement="top" data-toggle="tooltip" href="http://www.godaddy.com" target="_blank" title="Domains are cool."><i class="fa fa-share-square-o"></i> Buy my own domain for $11 p/year</a></p>
															</div>
														</div>
														<div class="form-group">
															<label class="col-sm-2 control-label">Meta Title</label>
															<div class="col-sm-10">
																<input class="form-control" name="URL-eBOOK-NAME" placeholder="Crime and Punishment" type="text" value="{{URL-eBOOK-NAME}}"><span class="help-block m-b-none">Enter the name of your eBook. This will appear on your landing page and other key areas.</span>
															</div>
														</div>
													</form>
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