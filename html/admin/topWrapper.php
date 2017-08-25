<?php
    date_default_timezone_set('America/Los_Angeles');
    session_start();
    include 'global.php';
    require_once('loginCredentials.php');
?>
<div class="navbar-header">
    <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
    <form role="search" class="navbar-form-custom" action="#">
        <div class="form-group">
            <input type="text" placeholder="Search...." class="form-control" name="top-search" id="top-search">
        </div>
    </form>
</div>
<ul class="nav navbar-top-links navbar-right">
        <li>
            <?php echo $accountName;?> 
        </li>        
        <li>
            <a href="logout.php"><i class="fa fa-sign-out"></i> Log out</a>
        </li>        
</ul>