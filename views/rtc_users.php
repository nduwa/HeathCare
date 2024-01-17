<?php
include "../includes/auto_load.req.php";
include "../includes/header.php";
include '../includes/menu.php';
#####################################################
$obj  = new Display();
$data  = $obj->getUsers();

?>
  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
    <!-- page content -->
    <div class="right_col" role="main">
    <div class="">
            <!-- top tiles -->
              <div class="row tile_count">

             </div>
             <!-- /top tiles -->
             <div class="clearfix"></div>

             <div class="row">
               <div class="col-md-12 col-sm-12 col-xs-12">
                 <div class="x_panel">
                   <div class="x_title">
                     <h2><i class="fa fa-bars"></i>List of RTC users</h2>
                     
                     <div class="clearfix"></div>
                   </div>
                   <div class="x_content">
                   <table id="datatable-keytable" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Created At</th>
                        <th>Name</th>
                        <th>Name User</th>
                        <th>Email</th>
                        <th>username</th>
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
                          if ($row["status"] == '0') { 
                            $status = "OFF"; 
                            $user_status_view = "fa-toggle-off "; 
                            $st = "color: red;";
                            $user_ = 1; 
                        }
                          else { 
                            $status = "ON"; 
                            $user_status_view = "fa-toggle-on";
                            $st = "color: green;";
                            $user_ = 0; 
                            }
                    ?>
                    <tr>
                        <td><?php echo $n; ?></td>
                        <td><?php echo $row["created_at"]; ?></td>
                        <td><?php echo $row["Name"]; ?></td>
                        <td><?php echo $row["Name_User"]; ?></td>
                        <td><?php echo $row["Email"]; ?></td>
                        <td><?php echo $row["Role"]; ?></td>
                        <td>
                        <a href="../router/action_page.php?user_status&status=<?php echo $user_; ?>&&user_ID=<?php echo $row["id"]; ?>" class="btn-sm btn btn-default">
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
         </div>
         <!-- /page content -->
        
         <!-- Large modal -->

         <?php include '../includes/footer.php'; ?>
