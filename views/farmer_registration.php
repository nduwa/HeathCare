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
                      <h3>Field here the farmer information !!!!</h3>
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
                    <form action="../router/action_page" method="post" style="font-size: 16px;">
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
                        <label for="name">Amazina y'umuhinzi<b style="color:red;">*</b></label>
                        <input type="text" name="farmer_name" id="farmer_name" class="form-control" required placeholder="Name...">
                      </div>
                      <div class="form-group">
                        <label for="name">Igitsina <b style="color:red;">*</b></label>
                        <select name="gender" id="gender" class="form-control" required>
                            <option selected="selected" disabled="disabled">Hitamo igitsina</option>
                            <option value="F">Umugore</option>
                            <option value="M">Umugabo</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="name">Nomero ya telephone <b style="color:red;">*</b></label>
                        <input type="number" name="phone"id="phone" class="form-control" required placeholder="Phone number...">
                      </div>
                      <div class="form-group">
                        <label for="name"> Umwaka w'amavuko <b style="color:red;">*</b></label>
                        <input type="number" name="Year_Birth" id="Year_Birth" class="form-control" required placeholder="Year of birth...">
                      </div>
                      <div class="form-group">
                        <label for="name"> Nomero y'indangamuntu <b style="color:red;">*</b></label>
                        <input type="number" name="id_number" id="id_number" class="form-control" required placeholder="National ID or Passport...">
                      </div>
                      <div class="form-group">
                        <label for="name"> Itsinda arimo <b style="color:red;">*</b></label>
                        <input type="text" name="Group_ID" id="Group_ID" class="form-control" required placeholder="Group belong in...">
                      </div>
                      <div class="form-group">
                        <label for="name">Umudugudu <b style="color:red;">*</b></label>
                        <input type="text" name="village" id="village" class="form-control" required placeholder="Village...">
                      </div>
                      <div class="form-group">
                        <label for="name">Akagali <b style="color:red;">*</b></label>
                        <input type="text" name="cell" id="cell" class="form-control" required placeholder="cell...">
                      </div>
                      <div class="form-group">
                        <label for="name">Umurenge <b style="color:red;">*</b></label>
                        <input type="text" name="sector" id="sector" class="form-control" required placeholder="Sector...">
                      </div>
                      <div class="form-group">
                        <label for="name">Umubare w'ibiti byose <b style="color:red;">*</b></label>
                        <input type="number" name="trees" id="trees" class="form-control" required placeholder="Trees...">
                      </div>
                      <div class="form-group">
                        <label for="name">Umubare w'ibiti byera <b style="color:red;">*</b></label>
                        <input type="number" name="productive_trees" id="productive_trees" class="form-control" required placeholder="Productive trees...">
                      </div>
                      <div class="form-group">
                        <label for="name">Umubare w'ibipimo bya kawa <b style="color:red;">*</b></label>
                        <input type="number" name="plot_number" id="plot_number" class="form-control" required placeholder="Plot Number...">
                      </div>
                      <div class="form-group">
                        <label for="name">Ubumenyi bwo gusoma <b style="color:red;">*</b></label>
                        <select name="skills" id="skills" class="form-control" required>
                            <option selected="selected" disabled="disabled">Hitamo ukurikije uko bimeze</option>
                            <option value="A">Nta bumenyi</option>
                            <option value="B">Abifashijwemo</option>
                            <option value="C">Yakwisomera</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="name">Ubumenyi bw'imibare <b style="color:red;">*</b></label>
                        <select name="math_skills" id="math_skills" class="form-control" required>
                            <option selected="selected" disabled="disabled">Hitamo ukurikije uko bimeze</option>
                            <option value="A">Nta bumenyi</option>
                            <option value="B">Abifashijwemo</option>
                            <option value="C">Yayikorera</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="name">Urwego rw'uburezi <b style="color:red;">*</b></label>
                        <select name="education_level" id="education_level" class="form-control" required>
                            <option selected="selected" disabled="disabled">Hitamo ukurikije uko bimeze</option>
                            <option value="A">Ntabwo yize</option>
                            <option value="B">Yizeho Abanza</option>
                            <option value="C">Yarangije Abanza</option>
                            <option value="D">Yizeho Ayisumbuye</option>
                            <option value="E">Yarangije Ayisumbuye</option>
                            <option value="E">Yizeho Kaminuza</option>
                            <option value="E">Yarangije Kaminuza</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="name">Irangamimerere <b style="color:red;">*</b></label>
                        <select name="marital_status" id="marital_status" class="form-control" required>
                            <option selected="selected" disabled="disabled">Hitamo ukurikije uko bimeze</option>
                            <option value="S">Ingaragu</option>
                            <option value="M">Arubatse</option>
                            <option value="D">Baratandukanye</option>
                            <option value="W">Umupfakazi (kare)</option>
                        </select>
                      </div>
                    </div>
                    <p>It's required to fill all fields</p>
                    </div>
                    <div class="modal-footer">
                      <button type="submit" name="btn_register_farmers" class="btn btn-success">Save info</button>
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
