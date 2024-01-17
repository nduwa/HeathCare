<?php 
include "../includes/auto_load.req.php";
include "../includes/header.php";
include '../includes/menu.php';
// $result_cell = $conn->query("SELECT * FROM `schools`");
// $rows1 = $result_cell->num_rows;
 ?>
         <!-- page content -->
         <div class="right_col" role="main">
           <div class="">
            

             <div class="clearfix"></div>

             <div class="row">
               <div class="col-md-12 col-sm-12 col-xs-12">
                 <div class="x_panel">
                   <div class="x_title">
                     <h2>USER PROFILE DATA</h2>
                     <ul class="nav navbar-right panel_toolbox">
                       <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                       </li>
                       <li class="dropdown">
                         <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                         <ul class="dropdown-menu" role="menu">
                           <li><a href="#">Settings 1</a>
                           </li>
                           <li><a href="#">Settings 2</a>
                           </li>
                         </ul>
                       </li>
                       <li><a class="close-link"><i class="fa fa-close"></i></a>
                       </li>
                     </ul>
                     <div class="clearfix"></div>
                   </div>
                   <div class="x_content">
                   <div class="" role="tabpanel" data-example-id="togglable-tabs">
                        <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist" >
                          <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Basic Information</a>
                          </li>
                        </ul>
                        <div id="myTabContent" class="tab-content">
                          <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">

                            <!-- start recent activity -->
                            <ul class="list-group">
                              <div class="row">
                                <div class="col-xl-6 col-sm-6 mb-6" >
                                  <div class="card text-white bg-info o-hidden h-100">
                                    <div class="card-body" style="padding: 20px;">
                                      <div class="card-body-icon">
                                        <i class="fas fa-fw fa-info"></i>
                                      </div>
                                      <div class="mr-5" style="font-size:16px;"><span class="badge badge-default">
                                        <img class="img-circle" src="../images/img.jpg" alt="profile photo" width="auto" height="auto" />
                                      </span> Name: <?php echo $_SESSION['Name_Full']; ?></div>
                                    </div>
                                    <a class="card-footer text-white clearfix small z-1" href="#">
                                      <span class="float-left">AS: <?php echo $_SESSION['staff_Role']; ?></span>
                                      <span class="float-right">
                                        <i class="fas fa-angle-right"></i>
                                      </span>
                                    </a>
                                  </div>
                                </div>
                                <?php
                                  // $get_branch ="SELECT * FROM `phar_branch` WHERE branch_ID='$_SESSION[branch]'";
                                  // $branch_n = $conn->query($get_branch);
                                  // $bra_name = $branch_n->fetch_assoc();
                                ?>
                                <div class="col-xl-6 col-sm-6 mb-6">
                                  <div class="tab-pane" id="messages">                            
                                    <ul class="list-group">   
                                      <!-- user basic information -->
                                      <li class="list-group-item text-left">
                                        <strong>Name:</strong><i> <?php echo $_SESSION['Name_Full']; ?></i> </li>
                                      <li class="list-group-item text-left">
                                        <strong>AS: </strong><i><?php echo $_SESSION['staff_Role']; ?></i></li>
                                      <li class="list-group-item text-left">
                                        <strong>Username: </strong><i><?php echo $_SESSION['Name_User']; ?></i></li> 
                                      <li class="list-group-item text-left">
                                        <strong>Contact :</strong> <i><?php echo $_SESSION['Email']; ?></i></li>                                     
                                    </ul>
                                  </div><!--/tab-pane-->
                                </div>
                              </div>
                              
                            </ul> 
                            <!-- end recent activity -->

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
         <!-- /page content -->


         <?php include '../includes/footer.php'; ?>
