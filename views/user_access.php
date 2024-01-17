<?php
include "../router/auto_load.req.php";
include "../includes/headers.php";
include "../includes/menus.php";
?>
   <!-- page content -->
   <div class="right_col" role="main">
      <?php
        $object = new Display();
        $id = $_REQUEST['id'];
        $row_access = $object->AccessPrivilege($id);
        //$module_data = $object->ListOfModule();
      ?>
<!-- ##################  menu party ################################# -->
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
          <h2 class="box-title">Menu Access Autorisation </h2>
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
            
            <!-- starting of first menu access table column -->
            <div class="col-md-4">
              <table class="table table-striped">
                <tr>
                  <th>Menu</th>
                  <th style="width: 40px">Access</th>
                </tr>
                <?php // ####### Action On  Users access
                   $status = "ON"; $act_st = "fa-toggle-on";$act = 0;$st = "color: green;";
                  
                ?>
                <!-- row data of Dashboard  -->
                  <tr>
                    <td>Dashboard</td>
                    <td>
                      <a href="#">
                        <i class="fa <?php echo $act_st; ?>" style="<?php echo $st; ?>"> <?php echo $status; ?></i>
                      </a>
                    </td>
                  </tr>
                  <!-- end of Dashboard row data -->

                <?php // ####### Action On  Users access
                  if ($row_access['registers'] == '0') { 
                    $status = "OFF";$act_st = "fa-toggle-off color: red;";$act = 1;$st = "color: #00b8ff;";}
                  else { $status = "ON"; $act_st = "fa-toggle-on";$act = 0;$st = "color: green;";}
                  $col = 'registers';
                ?>
                <!-- row data of General Settings  -->
                  <tr>
                    <td>General Settings</td>
                    <td>
                      <a href="../router/action_page?access_right=<?php echo $col; ?>&&status=<?php echo $act; ?>&&user=<?php echo $id;?>">
                        <i class="fa <?php echo $act_st; ?>" style="<?php echo $st; ?>"> <?php echo $status; ?></i>
                      </a>
                    </td>
                  </tr>
                  <!-- end of General Settings row data -->
              </table> 
            </div>
            <!-- end of column  -->

            <!-- starting of second menu access table column -->
            <div class="col-md-4">
              <table class="table table-striped">
                <tr>
                  <th>Menu</th>
                  <th style="width: 40px">Access</th>
                </tr>

                <?php // ####### Action On  Users access
                  if ($row_access['inspection'] == '0') { 
                    $status = "OFF";$act_st = "fa-toggle-off color: red;";$act = 1;$st = "color: #00b8ff;";}
                  else { $status = "ON"; $act_st = "fa-toggle-on";$act = 0;$st = "color: green;";}
                  $col = 'inspection';
                ?>
                <!-- row data of production  -->
                  <tr>
                    <td>Inspection</td>
                    <td>
                      <a href="../router/action_page?access_right=<?php echo $col; ?>&&status=<?php echo $act; ?>&&user=<?php echo $id;?>">
                        <i class="fa <?php echo $act_st; ?>" style="<?php echo $st; ?>"> <?php echo $status; ?></i>
                      </a>
                    </td>
                  </tr>
                  <!-- end of row data -->

                  

                  <?php // ####### Action On  Users access
                  if ($row_access['farmer_inspection'] == '0') { 
                    $status = "OFF";$act_st = "fa-toggle-off color: red;";$act = 1;$st = "color: #00b8ff;";}
                  else { $status = "ON"; $act_st = "fa-toggle-on";$act = 0;$st = "color: green;";}
                  $col = 'farmer_inspection';
                ?>
                <!-- row data of Human Resource  -->
                  <tr>
                    <td>Farmer Inspection</td>
                    <td>
                      <a href="../router/action_page?access_right=<?php echo $col; ?>&&status=<?php echo $act; ?>&&user=<?php echo $id;?>">
                        <i class="fa <?php echo $act_st; ?>" style="<?php echo $st; ?>"> <?php echo $status; ?></i>
                      </a>
                    </td>
                  </tr>
                  <!-- end of Human Resource row data -->

                  <?php // ####### Action On  Users access
                  if ($row_access['training'] == '0') { 
                    $status = "OFF";$act_st = "fa-toggle-off color: red;";$act = 1;$st = "color: #00b8ff;";}
                  else { $status = "ON"; $act_st = "fa-toggle-on";$act = 0;$st = "color: green;";}
                  $col = 'training';
                ?>
                <!-- row data of production  -->
                  <tr>
                    <td>Training</td>
                    <td>
                      <a href="../router/action_page?access_right=<?php echo $col; ?>&&status=<?php echo $act; ?>&&user=<?php echo $id;?>">
                        <i class="fa <?php echo $act_st; ?>" style="<?php echo $st; ?>"> <?php echo $status; ?></i>
                      </a>
                    </td>
                  </tr>
                  <!-- end of row data -->

                  <?php // ####### Action On  Users access
                  if ($row_access['weekly_report'] == '0') { 
                    $status = "OFF";$act_st = "fa-toggle-off color: red;";$act = 1;$st = "color: #00b8ff;";}
                  else { $status = "ON"; $act_st = "fa-toggle-on";$act = 0;$st = "color: green;";}
                  $col = 'weekly_report';
                ?>
                <!-- row data of production  -->
                  <tr>
                    <td>Weekly Report</td>
                    <td>
                      <a href="../router/action_page?access_right=<?php echo $col; ?>&&status=<?php echo $act; ?>&&user=<?php echo $id;?>">
                        <i class="fa <?php echo $act_st; ?>" style="<?php echo $st; ?>"> <?php echo $status; ?></i>
                      </a>
                    </td>
                  </tr>
                  <!-- end of row data -->
                  
                  
              </table> 
            </div>
            <!-- end of column  -->

            <!-- starting of third menu access table column -->
            <div class="col-md-4">
              <table class="table table-striped">
                <tr>
                  <th>Menu</th>
                  <th style="width: 40px">Access</th>
                </tr>

                
                <?php // ####### Action On  Users access
                  if ($row_access['manage_user'] == '0') { 
                    $status = "OFF";$act_st = "fa-toggle-off color: red;";$act = 1;$st = "color: #00b8ff;";}
                  else { $status = "ON"; $act_st = "fa-toggle-on";$act = 0;$st = "color: green;";}
                  $col = 'manage_user';
                ?>
                <!-- row data of Finance  -->
                  <tr>
                    <td>Manage Users</td>
                    <td>
                      <a href="../router/action_page?access_right=<?php echo $col; ?>&&status=<?php echo $act; ?>&&user=<?php echo $id;?>">
                        <i class="fa <?php echo $act_st; ?>" style="<?php echo $st; ?>"> <?php echo $status; ?></i>
                      </a>
                    </td>
                  </tr>
                  <!-- end of Finance row data -->
                  
                <?php // ####### Action On  Users access
                  if ($row_access['list_user'] == '0') { 
                    $status = "OFF";$act_st = "fa-toggle-off color: red;";$act = 1;$st = "color: #00b8ff;";}
                  else { $status = "ON"; $act_st = "fa-toggle-on";$act = 0;$st = "color: green;";}
                  $col = 'list_user';
                ?>
                <!-- row data of Logistics  -->
                  <tr>
                    <td>List of users</td>
                    <td>
                      <a href="../router/action_page?access_right=<?php echo $col; ?>&&status=<?php echo $act; ?>&&user=<?php echo $id;?>">
                        <i class="fa <?php echo $act_st; ?>" style="<?php echo $st; ?>"> <?php echo $status; ?></i>
                      </a>
                    </td>
                  </tr>
                  <!-- end of Logistics row data -->


              </table> 
            </div>
            <!-- end of column  -->
          </div>
        </div>
      </div>



    <div class="row"><hr></div>
</div>
</div>
<?php include '../includes/footers.php'; ?>
