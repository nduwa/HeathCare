<?php
include "../../includes/auto_load.req.php";
include "../../includes/header.php";
include '../../includes/menu.php';
#####################################################
$obj  = new Display();
$data_institute  = $obj->getInstitution();
$data_department  = $obj->getDepartment();
$data_role  = $obj->getRole();
$data_branch  = $obj->getBranch();
?>
  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
    <div class="right_col" role="main">
      <div class="">
        <div class="page-title">
          <div class="title_left">
            <h3> <small>Healthcare Settings</small></h3>
          </div>
        </div>
        <?php 
          if (isset($_SESSION['mess'])) {
            # code...
            echo $_SESSION['mess'];
            unset($_SESSION['mess']);
          }
        ?>
        <div class="clearfix"></div>
        <!-- ================== Institution ============================= -->
        
        <!-- ==================== Category =========================== -->
        <div class="row" >
          <div class="col-md-6 col-sm-6 col-lg-6 ">
            <div class="x_panel">
              <div class="x_title">
                <h2>List of Department</h2>
                <div class="pull-right">
                    <button type="button" id="butts" class="btn btn-secondary btn-sm" data-toggle="modal" data-target=".bs-example_category">
                        <i class="fa fa-user"></i> New department
                    </button>
                </div>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">

                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>DATE</th>
                      <th>DEPARTMENT NAME</th>
                      <th>ACTION</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                        if (isset($_SESSION['reg_msg'])) {
                            echo $_SESSION['reg_msg'];
                            unset($_SESSION['reg_msg']);
                        }
                        $n = 1;
                        foreach($data_department as $row) {
                        if($row["status"] == '0') { 
                            $status = "OFF"; 
                            $user_status_view = "fa-toggle-off "; 
                            $st = "color: red;";
                            $user_ = 1; 
                        }else { 
                            $status = "ON"; 
                            $user_status_view = "fa-toggle-on";
                            $st = "color: green;";
                            $user_ = 0; 
                        }
                    ?>
                    <tr>
                        <td><?php echo $n; ?></td>
                        <td><?php echo $row["reg_date"]; ?></td>
                        <td><?php echo $row["Department_Name"]; ?></td>
                        <td>
                            <a href="../router/action_page.php?user_status&status=<?php echo $user_; ?>&&user_ID=<?php echo $row["id"]; ?>" class="btn-sm btn btn-info">
                                <i class="fa fa-edit"> </i> Edit 
                            </a>
                            
                            <a href="user_access?id=<?php echo $row['id']; ?>" class="btn-sm btn btn-danger">
                                <i class="fa fa-trash"></i> Delete
                            </a>
                        </td>
                    </tr>
                    <?php $n++; } ?>
                  </tbody>
                </table>

              </div>
            </div>
          </div>
          <div class="col-md-6 col-sm-6 col-lg-6 ">
            <div class="x_panel">
              <div class="x_title">
                <h2>List of Roles</h2>
                <div class="pull-right">
                    <button type="button" id="butts" class="btn btn-secondary btn-sm" data-toggle="modal" data-target=".bs-example_role">
                        <i class="fa fa-user"></i> New role
                    </button>
                </div>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">

                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>DATE</th>
                      <th>ROLE NAME</th>
                      <th>ACTION</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                        if (isset($_SESSION['reg_msg'])) {
                            echo $_SESSION['reg_msg'];
                            unset($_SESSION['reg_msg']);
                        }
                        $n = 1;
                        foreach($data_role as $row) {
                        if($row["status"] == '0') { 
                            $status = "OFF"; 
                            $user_status_view = "fa-toggle-off "; 
                            $st = "color: red;";
                            $user_ = 1; 
                        }else { 
                            $status = "ON"; 
                            $user_status_view = "fa-toggle-on";
                            $st = "color: green;";
                            $user_ = 0; 
                        }
                    ?>
                    <tr>
                        <td><?php echo $n; ?></td>
                        <td><?php echo $row["reg_date"]; ?></td>
                        <td><?php echo $row["Role_Name"]; ?></td>
                        <td>
                            <a href="../router/action_page.php?user_status&status=<?php echo $user_; ?>&&user_ID=<?php echo $row["id"]; ?>" class="btn-sm btn btn-info">
                                <i class="fa fa-edit"> </i> Edit 
                            </a>
                            
                            <a href="user_access?id=<?php echo $row['id']; ?>" class="btn-sm btn btn-danger">
                                <i class="fa fa-trash"></i> Delete
                            </a>
                        </td>
                    </tr>
                    <?php $n++; } ?>
                  </tbody>
                </table>

              </div>
            </div>
          </div>
        </div>
        <!-- =================== Role ============================ -->
          <!--  -->
        
        <!-- =============================================== -->

        <!-- =============================================== -->
        
      </div>
    </div>
    <!-- Small modal -->
    
    <!-- =================== Category ============================ -->
    <div class="modal fade bs-example_category" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header" id="butts">
                    <h4 class="modal-title " id="myModalLabel2">New System Department</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                  <form action="../../router/action_page" method="post" id="form">
                    <div class="mb-3">
                      <label for="systemRole" class="form-label">Department Name</label>
                      <input type="text" id="department_name" name="department_name" class="form-control" placeholder="Department Name" required="required" autofocus="autofocus">
                    </div>
                    
                    <div class="text-center">
                      <input type="submit" class="btn btn-dark form-control" name="send_department_button" value="save" >
                    </div>
                    <hr>
                  </form>
                </div>
            </div>
        </div>
    </div>
    <!-- =================== Role ============================ -->
    <div class="modal fade bs-example_role" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header" id="butts">
                    <h4 class="modal-title " id="myModalLabel2">New System Role</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="../../router/action_page" method="post" id="form">
                    
                        <div class="mb-3">
                        <label for="systemRole" class="form-label">Role Name</label>
                        <input type="text" id="role_name" name="role_name" class="form-control" placeholder="Role Name" required="required" autofocus="autofocus">
                        </div>
                        
                        <div class="text-center">
                        <input type="submit" class="btn btn-dark form-control" name="send_role_button" value="save" >
                        </div>
                        <hr>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /modals -->
<?php include '../../includes/footer.php'; ?>
