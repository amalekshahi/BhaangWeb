<?php
    date_default_timezone_set('America/Los_Angeles');
    session_start();
    include 'global.php';
    require_once('loginCredentials.php');
?>
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
        <li>
          <span class="m-r-sm text-muted welcome-message">Hi <?php echo $USERNAME;?>, you're logged in to <?php echo $accountName;?>.</span>
        </li>    
        <!--<li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-cog" ></i> Utils <span class="caret"></span></a>
             <ul class="dropdown-menu">-->
               <li><a onClick="dbgClick('DBView')"><i class="fa fa-cog" ></i> DBView</a></li>
               <li><a onClick="dbgClick('Issue')"><i class="fa fa-bug" ></i> Issue</a></li>
        <!--     </ul>
        </li>                -->
        <li>
            <a href="logout.php"><i class="fa fa-sign-out"></i> Log out </a>
        </li>        
</ul>
