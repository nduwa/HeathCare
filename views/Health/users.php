<?php
include "../../includes/auto_load.req.php";
include "../../includes/header.php";
include '../../includes/menu.php';
#####################################################
$obj  = new Display();
$data  = $obj->getUsers();
$data_role  = $obj->getRole();
?>
  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
    <!-- page content -->
    <div class="right_col" role="main">
        <div class="page-title">
            <div class="title_left">
            <h3>Users</h3>
            </div>
        </div>
        
        <div class="col-md-12 col-sm-12 ">
            <div>
            <?php 
            if (isset($_SESSION['mess'])) {
                # code...
                echo $_SESSION['mess'];
                unset($_SESSION['mess']);
            }
            ?>
            </div>
            <div class="x_panel">
                <div class="x_title">
                    <h2>Health Employees</h2>
                    <div class="pull-right">
                        <button type="button" id="butts" class="btn btn-secondary btn-sm" data-toggle="modal" data-target=".bs-example-modal-sm">
                            <i class="fa fa-user"></i></a>
                            New user
                        </button>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card-box table-responsive">
                                <table id="datatable" class="table table-striped table-bordered" >
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Created At</th>
                                            <th>Name</th>
                                            <th>email</th>
                                            <th>Phone</th>
                                            <th>username</th>
                                            <th>Role</th>
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
                                        foreach($data as $row) {
                                        if($row["user_status"] == '0') { 
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
                                            <td><?php echo $row["full_name"]; ?></td>
                                            <td><?php echo $row["email"]; ?></td>
                                            <td><?php echo $row["phone"]; ?></td>
                                            <td><?php echo $row["username"]; ?></td>
                                            <td><?php echo $row["Role_Name"]; ?></td>
                                            <td>
                                                <a href="../../router/action_page?user_status&status=<?php echo $user_; ?>&&user_ID=<?php echo $row["userID"]; ?>" class="btn-sm btn btn-default">
                                                    <i class="fa <?php echo $user_status_view; ?>" style="<?php echo $st; ?>"> <?php echo $status; ?></i> 
                                                </a>
                                                <?php if($row["user_status"] == '1'){ ?>
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
        </div>
    </div>
    <!-- Small modal -->
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
                        <div class="mb-3">
                            <label for="username" class="form-label">Full Name</label>
                            <input type="hidden" id="_kf_institution" name="_kf_institution" value="<?php echo $_SESSION['_kf_institution']; ?>" >
                            <input type="hidden" id="userID" name="userID" value="<?php echo $_SESSION['user_id']; ?>" >
                            <input type="text" id="full_name" name="full_name" class="form-control" placeholder="Full Name" required="required" autofocus="autofocus">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="email" required="required" autofocus="autofocus">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Phone</label>
                            <input type="number" name="phone" id="phone" class="form-control" placeholder="phone" required="required" autofocus="autofocus">
                        </div>
                        <?php if($_SESSION['branch_Name'] != 'ADMIN'){ ?>
                            <input type="hidden" id="branch_type" name="branch_type" value="<?php echo $_SESSION['__kp_branch']; ?>" >
                        <?php }else{ ?>
                        <div class="mb-3">
                            <label for="systemRole" class="form-label">Branch Type</label>
                            <select name="branch_type" id="branch_type" class="form-control" required>
                                <option selected="selected" disabled="disabled">Branch Type</option>
                                <?php foreach($data_role as $row) { ?>
                                <option value="<?php echo $row["__kp_branch"]; ?>"><?php echo $row["branch_Name"]; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <?php } ?>
                        <div class="mb-3">
                            <label for="systemRole" class="form-label">Role</label>
                            <select name="user_role" id="user_role" class="form-control" required>
                                <option selected="selected" disabled="disabled">Role</option>
                                <?php foreach($data_role as $row) { ?>
                                <option value="<?php echo $row["__kp_role"]; ?>"><?php echo $row["Role_Name"]; ?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Username</label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Username" required="required" >
                        </div>
                        <div class="text-center">
                            <input type="submit" class="btn btn-dark form-control" name="create_user_button" value="save" >
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /modals -->
<?php include '../../includes/footer.php'; ?>
