<?php
include "../includes/auto_load.req.php";
include "../includes/header.php";
include "../includes/menu.php";
?>
          <!-- page content -->
          
          <div class="right_col" role="main">
           
             <!-- top tiles -->
             <div class="row">
                <div class="">
                  <div class="page-title">
                    <div class="" style="text-align:center;margin-left:20px;">
                      <h3>Field Weekly Report !!!!</h3>
                    </div>
                  </div>
                </div><br><br>
             </div>
             <!-- /top tiles -->

             <div class="clearfix"></div>
             <?php 
                if (isset($_SESSION['mess'])) {
                  # code...
                  echo $_SESSION['mess'];
                  unset($_SESSION['mess']);
                }
              ?>
             <div class="row">
             <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2><i class="fa fa-bars"></i> Fill the form accordingly</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li>
                      <a href="home" class="btn btn-dark" >Get back</a>
                      </li>
                      
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <form action="../router/action_page" method="post" >
                    <div class="col-xl-12 col-md-12 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <input type="hidden" name="full_name" value="<?php echo $_SESSION['Name_Full']; ?>" required>
                        <input type="hidden" name="kp_Staff" value="<?php echo $_SESSION['__kp_Staff']; ?>" required>
                        <input type="hidden" name="kp_User" value="<?php echo $_SESSION['__kp_User']; ?>" required>
                        <input type="hidden" name="kf_Station" value="<?php echo $_SESSION['_kf_Station']; ?>" required>
                        <input type="hidden" name="CW_Name" value="<?php echo $_SESSION['Name']; ?>" required>
                        <input type="hidden" name="kf_Supplier" value="<?php echo $_SESSION['_kf_Supplier']; ?>" required>
                        <input type="hidden" name="user_code" value="<?php echo $_SESSION['userID']; ?>"  required>
                      </div>
                      <div class="form-group">
                        <label for="name">Number Trained <b style="color:red;">*</b></label>
                        <input type="text" name="trained_number" class="form-control" required>
                      </div>
                      <div class="form-group">
                        <label for="name">Men Attended <b style="color:red;">*</b></label>
                        <input type="text" name="men_attended" class="form-control" required>
                      </div>
                      <div class="form-group">
                        <label for="name">Women Attended <b style="color:red;">*</b></label>
                        <input type="text" name="women_attended" class="form-control" required>
                      </div>
                      <div class="form-group">
                        <label for="name"> Groups planned to train next week <b style="color:red;">*</b></label>
                        <input type="number" name="planned_groups" class="form-control" required>
                      </div>
                      <div class="form-group">
                        <label for="name">Number of farms inspected <b style="color:red;">*</b></label>
                        <input type="number" name="farm_inspected" class="form-control" required>
                      </div>
                      <div class="form-group">
                        <label for="name">Farms planned to be inspected <b style="color:red;">*</b></label>
                        <input type="number" name="planned_inspected" class="form-control" required>
                      </div>
                      <div class="form-group">
                        <label for="name">Other Activities and Comment <b style="color:red;">*</b></label>
                        <textarea class="form-control" name="comments"></textarea>
                      </div>
                      
                    </div>
                    <p>It's required to fill all fields</p>
                    </div>
                    <div class="modal-footer">
                      
                      <button type="submit" name="btn_send_weekly_report" class="btn btn-success">Send the report</button>

                    </div>
                    </form>            
                  </div>
                </div>
              </div>
              
             </div>
           </div>
         </div>
         <!-- /page content -->
         
         <?php include '../includes/footer.php'; ?>
