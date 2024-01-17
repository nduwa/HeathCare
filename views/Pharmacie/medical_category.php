<?php
include "../../includes/auto_load.req.php";
include "../../includes/header.php";
include '../../includes/menu.php';
#####################################################
$obj  = new Display();

$data_medi_category  = $obj->getMedicalCategory();
?>
  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
    <div class="right_col" role="main">
      <div class="">
        <div class="page-title">
          <div class="title_left">
            <h3> <small>Pharmacie Settings</small></h3>
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
          
          <div class="col-md-12 col-sm-12 col-lg-12 ">
            <div class="x_panel">
              <div class="x_title">
                <h2>List of Medical Categories</h2>
                <div class="pull-right">
                    <button type="button" id="butts" class="btn btn-secondary btn-sm" data-toggle="modal" data-target=".bs-example_category">
                        <i class="fa fa-user"></i> New category
                    </button>
                </div>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">

                <table id="datatable" class="table table-striped">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>CATEGORY NAME</th>
                      <th>CATEGORY DESC</th>
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
                        foreach($data_medi_category as $row) {
                        if($row["category_status"] == '0') { 
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
                        <td><?php echo $row["category_name"]; ?></td>
                        <td><?php echo $row["category_desc"]; ?></td>
                        <td>
                            <a href="../router/action_page.php?user_status&status=<?php echo $user_; ?>" class="btn-sm btn btn-info">
                                <i class="fa fa-edit"> </i> Edit 
                            </a>
                            
                            <a href="user_access?id=<?php echo $row['category_ID']; ?>" class="btn-sm btn btn-danger">
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
                    <h4 class="modal-title " id="myModalLabel2">New Medical Category</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                  <form action="../../router/action_page" method="post" id="form">
                    <div class="mb-3">
                      <label for="systemRole" class="form-label">Category Name</label>
                      <input type="text" id="category_name" name="category_name" class="form-control" placeholder="Category Name" required="required" autofocus="autofocus">
                    </div>
                    
                    <div class="mb-3">
                      <label for="systemRole" class="form-label">Category Description</label>
                      <input type="text" id="category_desc" name="category_desc" class="form-control" placeholder="Category Description" required="required" autofocus="autofocus">
                    </div>

                    <div class="text-center">
                      <input type="submit" class="btn btn-dark form-control" name="send_medical_category_button" value="save" >
                    </div>
                    <hr>
                  </form>
                </div>
            </div>
        </div>
    </div>
    <!-- =================== Role ============================ -->
    
    <!-- /modals -->
<?php include '../../includes/footer.php'; ?>
