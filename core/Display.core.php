<?php
class Display extends Dbh {
    #####################################################################################
                # function of getting user details 
    ##################################################################################### 
    public function getUsers(){
        if($_SESSION['institution_Name'] == 'PACE'){
            $sql = "SELECT *,`dg_users`.`id` as userID,`dg_users`.`status` as user_status FROM `dg_users` 
            INNER JOIN `dg_role` ON `dg_users`.`_kf_role` = `dg_role`.`__kp_role`
            INNER JOIN `dg_institution` ON `dg_users`.`_kf_institution` = `dg_institution`.`__kp_institution`
            ORDER BY `dg_users`.`id` DESC";
        }else{
            $sql = "SELECT *,`dg_users`.`id` as userID,`dg_users`.`status` as user_status FROM `dg_users` 
            INNER JOIN `dg_role` ON `dg_users`.`_kf_role` = `dg_role`.`__kp_role`
            WHERE `dg_users`.`_kf_institution` ='$_SESSION[_kf_institution]' 
            ORDER BY `dg_users`.`id` DESC";
        }
        $result = $this->conn->query($sql);
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $data[] = $row;
            }
            return $data;
        }
    }
    #####################################################################################
                # function of getting role details 
    ##################################################################################### 
    public function getRole(){
        $sql = "SELECT * FROM `dg_role` WHERE `dg_role`.`_kf_institution` ='$_SESSION[_kf_institution]'
        ORDER BY `dg_role`.`id` DESC";
        $result = $this->conn->query($sql);
        if($result->num_rows > 0){
            while($row_role = $result->fetch_assoc()){
                $data_role[] = $row_role;
            }
            return $data_role;
        }
    }
    #####################################################################################
                # function of getting category details 
    ##################################################################################### 
    public function getCategory(){
        $sql = "SELECT * FROM `dg_category`";
        $result = $this->conn->query($sql);
        if($result->num_rows > 0){
            while($row_category = $result->fetch_assoc()){
                $data_category[] = $row_category;
            }
            return $data_category;
        }
    }
    #####################################################################################
                # function of getting department details 
    ##################################################################################### 
    public function getDepartment(){
        $sql = "SELECT * FROM `dg_department` WHERE `dg_department`.`_kf_institution` ='$_SESSION[_kf_institution]'";
        $result = $this->conn->query($sql);
        if($result->num_rows > 0){
            while($row_department = $result->fetch_assoc()){
                $data_department[] = $row_department;
            }
            return $data_department;
        }
    }
    #####################################################################################
                # function of getting institution details 
    ##################################################################################### 
    public function getInstitution(){
        $sql = "SELECT *,`dg_institution`.`id` as inst_ID,`dg_institution`.`status` as inst_status 
        FROM `dg_institution` 
        INNER JOIN `dg_category` ON `dg_institution`.`_kf_category` = `dg_category`.`__kp_category`
        INNER JOIN `dg_branch_type` ON `dg_institution`.`_kf_branch_type` = `dg_branch_type`.`__kp_branch_type`
        ORDER BY `dg_institution`.`id` DESC";
        $result = $this->conn->query($sql);
        if($result->num_rows > 0){
            while($row_institute = $result->fetch_assoc()){
                $data_institute[] = $row_institute;
            }
            return $data_institute;
        }
    }
    #####################################################################################
                # function of getting branch details 
    ##################################################################################### 
    public function getBranchType(){
        $sql = "SELECT * FROM `dg_branch_type` ORDER BY `dg_branch_type`.`id` DESC";
        $result = $this->conn->query($sql);
        if($result->num_rows > 0){
            while($row_branch = $result->fetch_assoc()){
                $data_branch[] = $row_branch;
            }
            return $data_branch;
        }
    }
    #####################################################################################
                # function of getting branch details 
    ##################################################################################### 
    public function getBranch(){
        $sql = "SELECT * FROM `dg_branch` WHERE `dg_branch`.`_kf_institution` ='$_SESSION[_kf_institution]'
        ORDER BY `dg_branch`.`id` DESC";
        $result = $this->conn->query($sql);
        if($result->num_rows > 0){
            while($row_branch = $result->fetch_assoc()){
                $data_branch[] = $row_branch;
            }
            return $data_branch;
        }
    }
    #####################################################################################
                # function of getting medical category details 
    ##################################################################################### 
    public function getMedicalCategory(){
        $sql = "SELECT * FROM `dg_medical_category`";
        $result = $this->conn->query($sql);
        if($result->num_rows > 0){
            while($row_medical_category = $result->fetch_assoc()){
                $data_medi_category[] = $row_medical_category;
            }
            return $data_medi_category;
        }
    }
    #####################################################################################
                # function of getting medical category details 
    ##################################################################################### 
    public function getMedicalProduct(){
        $sql = "SELECT * FROM `dg_medical_product`
        INNER JOIN `dg_medical_category` ON `dg_medical_product`.`_kf_category` = `dg_medical_category`.`__kp_mede_category`";
        $result = $this->conn->query($sql);
        if($result->num_rows > 0){
            while($row_medical_product = $result->fetch_assoc()){
                $data_medi_product[] = $row_medical_product;
            }
            return $data_medi_product;
        }
    }
    #####################################################################################
                # function of accessing the privilegies 
    #####################################################################################

    public function AccessPrivilege($id){
        $sql = "SELECT * FROM `dg_user_access`  
                WHERE `dg_user_access`.`user_ID` = '$id'";
        $result = $this->conn->query($sql);
        if($result->num_rows > 0){
           $row_access = $result->fetch_assoc(); 
            return $row_access;
        }
    }
   
    #####################################################################################
                # function of display the station of rtc
    #####################################################################################

    public function displayedStation(){
        if(($_SESSION['staff_Role'] == 'Washing Station Accountant') || ($_SESSION['staff_Role'] == 'Washing Station Manager') || ($_SESSION['staff_Role'] == 'Field Officer') || ($_SESSION['staff_Role'] == '	Site Collector')){
            $sql_station = $this->conn->query("SELECT * FROM `rtc_household_trees`
            WHERE _kf_Station = '$_SESSION[_kf_Station]' AND _kf_Supplier = '$_SESSION[_kf_Supplier]'");
        }else{
            $sql_station = $this->conn->query("SELECT * FROM `rtc_household_trees`");
        }
        $station_count  = $sql_station->num_rows;
        if($station_count > 0){
            while($row = $sql_station->fetch_assoc()){
                $station_data[] = $row;
            }
            return $station_data;
        }
    }
    #####################################################################################
                # function of display the station of rtc
    #####################################################################################

    public function displayedRegisteredFarmers(){
        if(($_SESSION['staff_Role'] == 'Washing Station Accountant') || ($_SESSION['staff_Role'] == 'Washing Station Manager') || ($_SESSION['staff_Role'] == 'Field Officer') || ($_SESSION['staff_Role'] == '	Site Collector')){
            $sql_farmers = $this->conn->query("SELECT * FROM `rtc_field_farmers`
            WHERE _kf_Station = '$_SESSION[_kf_Station]' AND _kf_Supplier = '$_SESSION[_kf_Supplier]'");
        }else{
            $sql_farmers = $this->conn->query("SELECT * FROM `rtc_field_farmers`");
        }
        $farmer_count  = $sql_farmers->num_rows;
        if($farmer_count > 0){
            while($row = $sql_farmers->fetch_assoc()){
                $farmers_data[] = $row;
            }
            return $farmers_data;
        }
    }
    #####################################################################################
                # function of display rtc module is just menu and submenu
    #####################################################################################

    public function displayWeeklyReport(){
        if(($_SESSION['staff_Role'] == 'Washing Station Accountant') || ($_SESSION['staff_Role'] == 'Washing Station Manager') || ($_SESSION['staff_Role'] == 'Field Officer') || ($_SESSION['staff_Role'] == '	Site Collector')){
            $results = $this->conn->query("SELECT * FROM `rtc_field_weekly_report`
            WHERE _kf_Station = '$_SESSION[_kf_Station]' AND _kf_Supplier = '$_SESSION[_kf_Supplier]'");
        }else{
            $results = $this->conn->query("SELECT * FROM `rtc_field_weekly_report`");
        }
        $module_count  = $results->num_rows;
        if($module_count > 0){
            while($row = $results->fetch_assoc()){
                $module_data[] = $row;
            }
            return $module_data;
        }
    }
    #####################################################################################
                # function of removing farmer trees record
    #####################################################################################

    public function removeTrees($id){
        
        $sql_delete = "DELETE FROM `rtc_household_trees` WHERE `rtc_household_trees`.`ID` = $id";
        $result_delete = $this->conn->query($sql_delete);
        if($result_delete){
            echo '<script>
                setTimeout(function(){
                    window.location.href = "../views/rtc_stations";
                }, 0);
            </script>';
        }
    }

    #####################################################################################
                # function of removing farmer trees record
    #####################################################################################

    public function removeFarmerInfo($id){
        
        $sql_delete = "DELETE FROM `rtc_field_farmers` WHERE `rtc_field_farmers`.`id` = $id";
        $result_delete = $this->conn->query($sql_delete);
        if($result_delete){
            echo '<script>
                setTimeout(function(){
                    window.location.href = "../views/registered_farmers";
                }, 0);
            </script>';
        }
    }
    #####################################################################################
                # function of removing farmer trees record
    #####################################################################################

    public function remove_Weekly_Report($id){
        
        $sql_delete = "DELETE FROM `rtc_field_weekly_report` WHERE `rtc_field_weekly_report`.`ID` = $id";
        $result_delete = $this->conn->query($sql_delete);
        if($result_delete){
            echo '<script>
                setTimeout(function(){
                    window.location.href = "../views/rtc_weekly_report";
                }, 0);
            </script>';
        }
    }
} 