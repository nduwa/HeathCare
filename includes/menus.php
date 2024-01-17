<?php
if(!isset($_SESSION["user_id"])){ header('location: index.php');  }
################## display the user privilegies on system  ###########
$obj  = new Model();
$get_session = $_SESSION['user_id'];
//$rows  = $obj->user_privilege($get_session);

###############################################
if(!isset($_SESSION['user_id'])){
  header("location:../index");
}
if ((time() - $_SESSION['last_time']) >3600 ) {
	header("location:../logout.php");
}
if(time() - $_SESSION['last_time'] < 3600){
  $_SESSION['last_time'] = time();
}
?>
<body class="nav-md">
  <div class="container body">
    <div class="main_container">
      <div class="col-md-3 left_col">
        <div class="left_col scroll-view">
          <div class="navbar nav_title" id="title" style="border: 0;" >
            <a href="home" class="site_title"><i class="glyphicon glyphicon-header"></i> <span>DG  Health  </span></a><br>
          </div>

          <div class="clearfix"></div>
          <br />
          <!-- sidebar menu -->
          <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
              
                <ul class="nav side-menu">
                  <li class="active" ><a href="#"><i class="fa fa-home"></i> DASHBOARD <span class="fa fa-chevron-down"></span></a>
                  </li>
                  
                 
                </ul>
              
            </div>


          </div>
          <!-- /sidebar menu -->
          <!-- /menu footer buttons -->
          <div class="sidebar-footer hidden-small" >
            <a data-toggle="tooltip" data-placement="top" title="Settings">
              <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="FullScreen">
              <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Lock">
              <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Logout" href="logout">
              <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
            </a>
          </div>
          <!-- /menu footer buttons -->
        </div>
      </div>

      <!-- top navigation -->
      
      <div class="top_nav" >
            <div class="nav_menu" id="top_nav">
                <div class="nav toggle" style="">
                  <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                </div>
                <div class="nav toggle" style="width:20%">
                  <span style="margin-top:16px; font-size:1.2rem"><?php echo $_SESSION['institution_Name']; ?></span>
                </div>
                <div class="nav toggle" style="width:40%">
                  <span style="margin-top:16px; font-size:1.2rem"><?php echo $_SESSION['role']; ?></span>
                </div>
                <nav class="nav navbar-nav">
                  <ul class=" navbar-right" >
                    <li class="nav-item dropdown open" >
                      <a  class="user-profile dropdown-toggle"  data-toggle="dropdown" aria-expanded="false">
                        <img src="../../images/Logo.jpg" alt="">
                        <span><?php echo $_SESSION['full_name']; ?></span>
                      </a>
                      <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown" style="margin-top:20px;font-size:16px;">
                        <a class="dropdown-item"  href="profile"> <i class="fa fa-user pull-right"></i> Profile</a>
                          
                        <a class="dropdown-item"  href="../logout"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                      </div>
                    </li>
                  </ul>
                </nav>
            </div>
          </div>
      <!-- /top navigation -->
