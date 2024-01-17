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
                    <div class="" Style="text-align:center;">
                      <h3>Gukusanya Amakuru y'ibiti by'umuhinzi!!!</h3>
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
                        <label for="name">Farmer ID <b style="color:red;">*</b></label>
                        <input type="text" name="farmer_ID" class="form-control" required>
                      </div>
                      <div class="form-group">
                        <label for="name">Farmer Name <b style="color:red;">*</b></label>
                        <input type="text" name="farmer_name" class="form-control" required>
                      </div>
                      <div class="form-group">
                        <label for="name">National ID <b style="color:red;">*</b></label>
                        <input type="text" name="national_ID" class="form-control" required>
                      </div>
                      <div class="form-group">
                        <label for="name">Group ID <b style="color:red;">*</b></label>
                        <input type="text" name="group_ID" class="form-control" required>
                      </div>
                      <div class="form-group">
                        <label for="name"> Number of received seedlings <b style="color:red;">*</b></label>
                        <input type="number" name="received_seedling" class="form-control" required>
                      </div>
                      <div class="form-group">
                        <label for="name">Number of survived seedlings <b style="color:red;">*</b></label>
                        <input type="number" name="survived_seedling" class="form-control" required>
                      </div>
                      <div class="form-group">
                        <label for="name">Year planted of the received seedlings <b style="color:red;">*</b></label>
                        <input type="number" name="planted_year" class="form-control" required>
                      </div>
                      <div class="form-group">
                        <label for="name">Number of old trees <b style="color:red;">*</b></label>
                        <input type="number" name="old_trees" class="form-control" required>
                      </div>
                      <div class="form-group">
                        <label for="name">Year of planted for the old trees <b style="color:red;">*</b></label>
                        <input type="number" name="old_trees_planted_year" class="form-control" required>
                      </div>
                      <div class="form-group">
                        <label for="name">Number of coffee plots/Farms in general <b style="color:red;">*</b></label>
                        <input type="number" name="coffee_plot" class="form-control" required>
                      </div>
                      <div class="form-group">
                        <label for="name">Total of nitrogen fixing shade trees <b style="color:red;">*</b></label>
                        <input type="number" name="nitrogen" class="form-control" required>
                      </div>
                      <div class="form-group">
                        <label for="name">Total of natural shade trees <b style="color:red;">*</b></label>
                        <input type="number" name="natural_shade" class="form-control" required>
                      </div>
                      <div class="form-group">
                        <label for="name">Total number of shade tree <b style="color:red;">*</b></label>
                        <input type="number" name="shade_trees" class="form-control" required>
                      </div>
                    </div>
                    <p>It's required to fill all fields</p>
                    </div>
                    <div class="modal-footer">
                      
                      <button type="submit" name="btn_register_trees" class="btn btn-primary">Register</button>

                    </div>
                    </form>            
                  </div>
                </div>
              </div>
              
             </div>
           </div>
         </div>
         <!-- /page content -->

         <!-- Large modal -->

         
         <?php include '../includes/footer.php'; ?>
