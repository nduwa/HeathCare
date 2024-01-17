<?php
include "../includes/auto_load.req.php";
include "../includes/header.php";
include '../includes/menu.php';
#####################################################
$obj  = new Display();
$farmers_data  = $obj->displayedRegisteredFarmers();

?>
  <!-- =============================================== -->

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
                      <h2><i class="fa fa-bars"></i> list of distributed farmer trees</h2>
                      
                      <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                      <table id="datatable-buttons" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                          <tr>
                            <th>Station Name</th>
                            <th>Group ID</th>
                            <th>Farmer Name</th>
                            <th>Gender</th>
                            <th>Year Birth</th>
                            <th>Phone</th>
                            <th>National ID</th>
                            <th>Marital Status</th>
                            <th>Village</th>
                            <th>Cell</th>
                            <th>Sector</th>
                            <th>Trees</th>
                            <th>Producing Trees</th>
                            <th>Plot number</th>
                            <th>Skills</th>
                            <th>Math Skills</th>
                            <th>Education Level</th>
                            <th>Date</th>
                            <th>Collector</th>
                            <th>ACTION</th>
                          </tr>
                        </thead>
                        <tbody>
                            <?php 
                                foreach($farmers_data as $row) {  
                            ?>
                            <tr>
                                <td><?php echo $row["CW_Name"]; ?></td>
                                <td><?php echo $row["Group_ID"]; ?></td>
                                <td><?php echo $row["farmer_name"]; ?></td>
                                <td><?php echo $row["Gender"]; ?></td>
                                <td><?php echo $row["Year_Birth"]; ?></td>
                                <td><?php echo $row["phone"]; ?></td>
                                <td><?php echo $row["National_ID"]; ?></td>
                                <td><?php echo $row["Marital_Status"]; ?></td>
                                <td><?php echo $row["village"]; ?></td>
                                <td><?php echo $row["cell"]; ?></td>
                                <td><?php echo $row["sector"]; ?></td>
                                <td><?php echo $row["Trees"]; ?></td>
                                <td><?php echo $row["Trees_Producing"]; ?></td>
                                <td><?php echo $row["number_of_plots"]; ?></td>
                                <td><?php echo $row["Skills"]; ?></td>
                                <td><?php echo $row["Math_Skills"]; ?></td>
                                <td><?php echo $row["education_level"]; ?></td>
                                <td><?php echo $row["created_at"]; ?></td>
                                <td><?php echo $row["full_name"]; ?></td>
                                <td><a href="../router/action_page.php?remove_farmer_data=<?php echo $row["id"]; ?>" class="btn btn-danger"><span class="fa fa-trash"></span></a></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                      </table>
                    </div>
                 </div>
               </div>
             </div>
           </div>
         </div>
         <!-- /page content -->

       
         <?php include '../includes/footer.php'; ?>
