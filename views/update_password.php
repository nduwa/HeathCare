<?php
include "../router/auto_load.req.php";
include "../includes/headers.php";
include "../includes/menus.php";
?>
          <!-- page content -->
          <div class="right_col" role="main">
           
             <!-- top tiles -->
              <div class="row">
                <div class=" tile_stats_count" style="text-align:center;margin-left:20px;">
                  <h1>Welcome!!!!
                    <span style="color:#0c1e2e;font-size:1.5rem;font-weight:bold">
                      <?php echo $_SESSION['full_name']; ?>
                    </span>
                  </h1> 
                </div>
              </div>
            
             <!-- /top tiles -->
             
             <div class="row">
             <div class="col-md-12 col-sm-12 col-xs-12">
             <div class="x_panel">
                <div class="x_title">
                  <h2>Update Your Password!!!</h2>
                  
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">

                  <div class="row">
                    <div class="col-md-6">
                      <form action="../router/action_page" method="post">
                        <div class="mb-3">
                          <label for="password" class="form-label">Old Password</label>
                          <input type="password" name="current_password" id="current_password" class="form-control" placeholder="Old Password" required="required" autofocus="autofocus">
                        </div>
                        <div class="mb-3">
                          <label for="password" class="form-label">New Password</label>
                          <input type="password" name="newer_password" id="newer_password" class="form-control" placeholder="New Password" required="required" autofocus="autofocus">
                        </div>
                        <div class="mb-3">
                          <label for="password" class="form-label">Confirm Password</label>
                          <input type="password" name="new_password" id="new_password" class="form-control" placeholder="New Password" required="required" autofocus="autofocus">
                        </div>
                        <div class="mb-3">
                          <input class="btn btn-dark" type="submit" name="change_password_botton" id="change_password_botton" class="form-control" value="Save Changes">
                        </div>
                      </form>
                    </div>
                    <div class="col-md-6">
                      <div>
                        <?php 
                        if (isset($_SESSION['mess'])) {
                            # code...
                            echo $_SESSION['mess'];
                            unset($_SESSION['mess']);
                        }
                        ?>
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

         
         <?php include '../includes/footers.php'; ?>
