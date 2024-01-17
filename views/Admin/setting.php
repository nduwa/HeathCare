<?php
include "../../includes/auto_load.req.php";
include "../../includes/header.php";
include '../../includes/menu.php';
#####################################################
$obj  = new Display();
$data_institute  = $obj->getInstitution();
$data_category  = $obj->getCategory();
$data_role  = $obj->getRole();
$data_branch  = $obj->getBranch();
?>
  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
    <div class="right_col" role="main">
      <div class="">
        <div class="page-title">
          <div class="title_left">
            <h3>PACE <small>Administration Settings</small></h3>
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
        <div class="row">
          <div class="col-md-12 col-sm-12 col-lg-12 ">
            <div class="x_panel">
              <div class="x_title">
                <h2>List of Pace Institution</h2>
                <div class="pull-right">
                    <button type="button" id="butts" class="btn btn-secondary btn-sm" data-toggle="modal" data-target=".bs-example-modal-sm">
                        <i class="fa fa-user"></i> New institution
                    </button>
                </div>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">
                <div class="table-responsive">
                  <table class="table table-striped jambo_table bulk_action">
                    <thead>
                      <tr class="headings">
                        <th>#</th>
                        <th>DATE</th>
                        <th>INSTITUTE NAME</th>
                        <th>INSTITUTE CATEGORY</th>
                        <th>INSTITUTE TYPE</th>
                        <th>EMAIL</th>
                        <th>PHONE</th>
                        <th>TIN</th>
                        <th>LOCATION</th>
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
                      foreach($data_institute as $row) {
                      if($row["inst_status"] == '0') { 
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
                      <tr class="even pointer">
                        <td><?php echo $n; ?></td>
                        <td><?php echo $row["createAt"]; ?></td>
                        <td><?php echo $row["Institute_name"]; ?></td>
                        <td><?php echo $row["Category_Name"]; ?></td>
                        <td><?php echo $row["type_Name"]; ?></td>
                        <td><?php echo $row["email"]; ?></td>
                        <td><?php echo $row["phone"]; ?></td>
                        <td><?php echo $row["TIN"]; ?></td>
                        <td><?php echo $row["location"]; ?></td>
                        <td>
                          <a href="../../router/action_page?institute_status&status=<?php echo $user_; ?>&&user_ID=<?php echo $row["inst_ID"]; ?>" class="btn-sm btn btn-default">
                            <i class="fa <?php echo $user_status_view; ?>" style="<?php echo $st; ?>"> <?php echo $status; ?></i> 
                          </a>
                          <?php if($row["status"] == '1'){ ?>
                          <a href="user_access?id=<?php echo $row['id']; ?>" class="btn-sm btn btn-info">
                            <i class="fa fa-gears"></i> Privilege
                          </a>
                          <?php } ?>
                        </td>
                      </tr>
                      <?php $n++; } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- ================== Category =========================== -->
        <div class="row" >
          <div class="col-md-6 col-sm-6 col-lg-6 ">
            <div class="x_panel">
              <div class="x_title">
                <h2>List of Pace Category</h2>
                <div class="pull-right">
                    <button type="button" id="butts" class="btn btn-secondary btn-sm" data-toggle="modal" data-target=".bs-example_category">
                        <i class="fa fa-user"></i> New category
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
                      <th>CATEGORY NAME</th>
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
                        foreach($data_category as $row) {
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
                        <td><?php echo $row["createAt"]; ?></td>
                        <td><?php echo $row["Category_Name"]; ?></td>
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
                <h2>List of Pace Roles</h2>
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
    <!-- =================== institution ============================ -->
    <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header" id="butts">
                    <h4 class="modal-title " id="myModalLabel2">New System User</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="../../router/action_page" method="post" id="form">
                      <!-- Smart Wizard -->
                      <div class="x_content">
                        <ul class="nav nav-tabs bar_tabs" id="myTab" role="tablist">
                          <li class="nav-item">
                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Home</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Next</a>
                          </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                          <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <div class="mb-3">
                              <label for="systemRole" class="form-label">Institution Name</label>
                              <input type="text" id="institution_name" name="institution_name" class="form-control" placeholder="Institution Name" required="required" autofocus="autofocus">
                              <input type="hidden" id="userID" name="userID" class="form-control" value="<?php echo $_SESSION['user_id']; ?>">
                            </div>
                            <div class="mb-3">
                              <label for="systemRole" class="form-label">Category Name</label>
                              <select name="category_name" id="category_name" class="form-control" required>
                                <option selected="selected" disabled="disabled">Category Name</option>
                                <?php foreach($data_category as $row) { ?>
                                <option value="<?php echo $row["__kp_category"]; ?>"><?php echo $row["Category_Name"]; ?></option>
                                <?php } ?>
                              </select>
                            </div>
                            <div class="mb-3">
                              <label for="systemRole" class="form-label">Branch Type</label>
                              <select name="branch_type" id="branch_type" class="form-control" required>
                                <option selected="selected" disabled="disabled">Branch Type</option>
                                <?php foreach($data_branch as $row) { ?>
                                <option value="<?php echo $row["__kp_branch"]; ?>"><?php echo $row["branch_Name"]; ?></option>
                                <?php } ?>
                              </select>
                            </div>
                            <div class="mb-3">
                              <label for="systemRole" class="form-label">Email</label>
                              <input type="email" id="email" name="email" class="form-control" placeholder="Email" required="required" autofocus="autofocus">
                            </div>
                            <div class="mb-3">
                              <label for="systemRole" class="form-label">Phone Number</label>
                              <input type="number" id="phone_number" name="phone_number" class="form-control" placeholder="Phone number" required="required" autofocus="autofocus">
                            </div>
                            <div class="mb-3">
                              <label for="systemRole" class="form-label">TIN Number</label>
                              <input type="number" id="TIN_number" name="TIN_number" class="form-control" placeholder="TIN number" required="required" autofocus="autofocus">
                            </div>
                            <div class="mb-3">
                              <label for="systemRole" class="form-label">Location</label>
                              <input type="text" id="location" name="location" class="form-control" placeholder="Location" required="required" autofocus="autofocus">
                            </div>
                          </div>
                          <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            <p>Institution Representor</p>
                            <div class="mb-3">
                              <label for="systemRole" class="form-label">Full Name</label>
                              <input type="text" id="full_name" name="full_name" class="form-control" placeholder="Full Name" required="required" autofocus="autofocus">
                            </div>
                            <div class="mb-3">
                              <label for="systemRole" class="form-label">Email</label>
                              <input type="email" id="representor_email" name="representor_email" class="form-control" placeholder="Email" required="required" autofocus="autofocus">
                            </div>
                            <div class="mb-3">
                              <label for="systemRole" class="form-label">Phone</label>
                              <input type="number" id="representor_phone" name="representor_phone" class="form-control" placeholder="Phone Number" required="required" autofocus="autofocus">
                            </div>
                            <div class="mb-3">
                              <label for="systemRole" class="form-label">Username</label>
                              <input type="text" id="username" name="username" class="form-control" placeholder="Userame" required="required" autofocus="autofocus">
                            </div>
                            <div class="text-center">
                              <input type="submit" class="btn btn-dark form-control" name="send_institution_button" value="save" >
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- End SmartWizard Content -->
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- =================== Category ============================ -->
    <div class="modal fade bs-example_category" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header" id="butts">
                    <h4 class="modal-title " id="myModalLabel2">New System Category</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                  <form action="../../router/action_page" method="post" id="form">
                    <div class="mb-3">
                      <label for="systemRole" class="form-label">Category Name</label>
                      <input type="text" id="category_name" name="category_name" class="form-control" placeholder="Category Name" required="required" autofocus="autofocus">
                    </div>
                    
                    <div class="text-center">
                      <input type="submit" class="btn btn-dark form-control" name="send_category_button" value="save" >
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
