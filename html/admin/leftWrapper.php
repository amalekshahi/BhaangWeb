	<nav class="navbar-default navbar-static-side" role="navigation">
		<div class="sidebar-collapse">
			<ul class="nav metismenu" id="side-menu">
				<!-- 
				<li class="nav-header" style="padding:0;">
                    <div class="dropdown profile-element" style="padding-bottom: 10px;"> 
						<span><img alt="image" class="img-circle" src="img/logo.jpg" width="220" height="120"></span>     
                    </div>    
                </li>			
				 -->
				<li class="nav-header">
					<div class="dropdown profile-element">
						<a data-toggle="dropdown" class="dropdown-toggle">
							<span class="clear"> 
								<span class="block m-t-xs"><a href="myProfileSettings.php"><strong class="font-bold"><br><br><br><br></strong></a>
								</span>
						</span>
						</a>
					</div>
					<!-- Dave commented this out so that we don't see top of DV's head when left nav is minimized
										<div class="logo-element"></div>
						-->
				</li>
				<li>
					<a href="welcome.php"><i class="fa fa-home" aria-hidden="true" title="Home"></i> <span class="nav-label">Home</span></a>
				</li>
				<li>
					<a href="pickBlueprint.php"><i class="fa fa-plus" aria-hidden="true" title="Create a Campaign"></i> <span class="nav-label">Create a Campaign</span></a>
				</li>
				<li>
					<a href="myCampaigns.php"><i class="fa fa-paper-plane-o" aria-hidden="true" title="My Campaigns"></i> <span class="nav-label">My Campaigns</span></a>
				</li>
				<li>
					<a href="assetLibrary.php"><i class="fa fa-files-o" aria-hidden="true" title="Asset Library"></i> <span class="nav-label">Asset Library</span></a>
				</li>
				<li>
					<a href="audiences.php"><i class="fa fa-address-book" aria-hidden="true" title="Audiences"></i> <span class="nav-label">Audiences</span></a>
				</li>
				<li>
					<a href="accountSetting.php"><i class="fa fa-wrench" aria-hidden="true" title="Settings"></i> <span class="nav-label">Settings</span></a>
				</li>
				<li>
					<a href="helpCenter.php"><i class="fa fa-question-circle" aria-hidden="true" title="Help"></i> <span class="nav-label">Help Center</span></a>
				</li>
			</ul>
		</div>
		
		<!-- begin olark code -->
			<script type="text/javascript" async>
			;(function(o,l,a,r,k,y){if(o.olark)return;
			r="script";y=l.createElement(r);r=l.getElementsByTagName(r)[0];
			y.async=1;y.src="//"+a;r.parentNode.insertBefore(y,r);
			y=o.olark=function(){k.s.push(arguments);k.t.push(+new Date)};
			y.extend=function(i,j){y("extend",i,j)};
			y.identify=function(i){y("identify",k.i=i)};
			y.configure=function(i,j){y("configure",i,j);k.c[i]=j};
			k=y._={s:[],t:[+new Date],c:{},l:a};
			})(window,document,"static.olark.com/jsclient/loader.js");
			/* Add configuration calls below this comment */
			olark.configure('system.hb_position', 'left');
			olark.configure('system.hb_chatbox_size', 'sm'); // Small
			olark.configure("features.prechat_survey", true);
			olark.configure('system.ask_for_name', 'hidden' );
			olark.configure('system.ask_for_email', 'hidden' );
			olark.configure('system.ask_for_phone', 'hidden' );
			olark.configure("locale.welcome_title", "LIVE CHAT SUPPORT");
			olark.configure("locale.chatting_title", "CHATTING");  
			olark('api.visitor.updateEmailAddress', {
				emailAddress: '<?php echo $email; ?>'
			});
			olark('api.visitor.updateFullName', {
				fullName: '<?php echo $USERNAME; ?>'
			});
	    olark('api.chat.updateVisitorStatus', {
        snippet: 'Is in the <?php echo $accountName; ?> sub-account'
    	});			
			olark('api.chat.sendNotificationToOperator', {
      	body: '<?php echo $USERNAME; ?> is a Da Vinci User on the <?php echo basename($_SERVER[REQUEST_URI]);?> page [INFO: <?php echo "dbName: $dbName accountID: $accountID accountName: $accountName"; ?>]'
       });	
			olark.identify('3553-726-10-4591');</script>
		<!-- end olark code -->
		
	</nav>