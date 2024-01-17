<?php

class MakeChange extends Dbh {

    #####################################################################################
                # function of giving access to user in system 
    #####################################################################################
    public function SystemUserAccess($status,$id){
        $sql_user = $this->conn->query("UPDATE `dg_users` SET `status` = '$status' WHERE `id` = '$id'");
        if($sql_user){
            $_SESSION['mess'] = '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>User have been given access successfully!!!!</strong>
            </div>';
            if($_SESSION['type_institute'] == 'ADMNISTRATION'){
                $url = "../views/Admin/users";
            }
            if($_SESSION['type_institute'] == 'HEALTHCARE'){
                $url = "../views/Health/users";
            }
            if($_SESSION['type_institute'] == 'PHARMACIE'){
                $url = "../views/Pharmacie/users";
            }
        }else{
            $_SESSION['mess'] = '<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>User is not yet created!!!!</strong>
            </div>';
            if($_SESSION['type_institute'] == 'ADMNISTRATION'){
                $url = "../views/Admin/users";
            }
            if($_SESSION['type_institute'] == 'HEALTHCARE'){
                $url = "../views/Health/users";
            }
            if($_SESSION['type_institute'] == 'PHARMACIE'){
                $url = "../views/Pharmacie/users";
            }
        }
        header('location: '.$url);
    }
    #####################################################################################
                # function of giving access to user in system 
    #####################################################################################
    public function SystemInstituteAccess($status,$id){
        $sql_user = $this->conn->query("UPDATE `dg_institution` SET `status` = '$status' WHERE `id` = '$id'");
        if($sql_user){
            $_SESSION['mess'] = '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Institute have been given access successfully!!!!</strong>
            </div>';
            $url = "../views/Admin/setting";
            
        }else{
            $_SESSION['mess'] = '<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Institute access is not asigned!!!!</strong>
            </div>';
            $url = "../views/Admin/setting";
            
        }
        header('location: '.$url);
    }


    #####################################################################################
                # function user update password
    #####################################################################################
    public function UserUpdatePassword($get_session){
        if ($_POST['newer_password'] == $_POST['new_password']) {
            $pwd1  =  password_hash($_POST['new_password'], PASSWORD_DEFAULT);
            $pwd = $_POST['new_password'];
            $update_user_password = "UPDATE `dg_users` SET `password` = '$pwd1', `pass_updated` ='1',
                                     `usercode` = '$pwd' WHERE id ='$get_session'";
		    $pass_update = $this->conn->query($update_user_password);
            if ($pass_update) {
		    	$_SESSION['mess'] = '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>User have been given access successfully!!!!</strong>
            </div>';
            $url = "../views/logout";
                
		    }else{ 
                $_SESSION['mess'] = '<div class="alert alert-dander alert-dismissible">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>User password not yet updated!!!!</strong>
            </div>';
            $url = "../views/update_password";
            }  
        }else{ 
            $_SESSION['mess'] = '<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>User have been given access successfully!!!!</strong>
            </div>';
            $url = "../views/update_password";
        } 
        header('location: '.$url);
    }
    #####################################################################################
                # function of deleting the different data in different database table
    #####################################################################################
    public function delete_data($id,$table_name){
        $sql_delete = "DELETE FROM $table_name WHERE $table_name.id = $id";
        $result_delete = $this->conn->query($sql_delete);
        if($result_delete){
            echo '<script>
                    setTimeout(function(){
                        window.location.href = "../views/rtc_gen_setting";
                    }, 0);</script>';
        }
    }
    #####################################################################################
                # function of editing the different data in different database table
    #####################################################################################
    public function edit_data($post){
        $edit_id = $_POST['edit_id'];
        //$edit_code = $_POST['edit_code'];
        $edit_Name = $_POST['edit_Name'];
        $table_name = $_POST['table_name'];
        $column_name = $_POST['column_name'];
        $sql_edit = "UPDATE $table_name 
                    SET $table_name.$column_name = '$edit_Name',
                    $table_name.modified_at = 'now()',
                    $table_name.modified_by = '$_SESSION[user_id]'
                    WHERE $table_name.id = $edit_id";
        $result_edit = $this->conn->query($sql_edit);
        echo $this->conn->error;
        if($result_edit){
            echo '<script>
                    setTimeout(function(){
                        window.location.href = "../views/rtc_gen_setting";
                    }, 0);</script>';
        }
    }

    #####################################################################################
                # function of adding a lot number on delivery
    #####################################################################################
    public function Store_delivery_lot($post){
        $Delivery_ID_t        = $_POST['Delivery'];
        $Delivery_Lot_ID_t    = $_POST['Delivery_Lot_ID_t'];

        $sql_edit = "UPDATE `rtc_delivery` 
                    SET Delivery_Lot_ID_t = '$Delivery_Lot_ID_t'
                    WHERE Delivery_ID_t = '$Delivery_ID_t'";
        $result_edit = $this->conn->query($sql_edit);
        if($result_edit){
            
            echo '<script>
                    setTimeout(function(){
                        window.location.href = "../views/rtc_prod_parchment";
                    }, 0);</script>';
        }
    }

    #####################################################################################
                # function of adding a production batch number
    #####################################################################################
    public function PRB_Assignment_Delivery($post){
        $Delivery_ID_t        = $_POST['Delivery_hopper'];
        $Delivery_PRB_ID_t    = $_POST['Delivery_PRB_ID_t'];
        $close_hopper         = $_POST['close_hopper'];
        
        if($close_hopper == 'option2'){
            $PRB_status = 1;
            $sql_edit = "UPDATE `rtc_delivery` 
                    SET Delivery_PRB_ID_t = '$Delivery_PRB_ID_t'
                    WHERE Delivery_ID_t = '$Delivery_ID_t'";
            $result_edit = $this->conn->query($sql_edit);
            if($result_edit){
                $sql_PRB = "UPDATE `rtc_production_hopper` 
                            SET PRB_status = '$PRB_status'
                            WHERE PRB_ID_t = '$Delivery_PRB_ID_t'";
                $result_PRB = $this->conn->query($sql_PRB);
                if($result_PRB){
                    echo '<script>
                        setTimeout(function(){
                            window.location.href = "../views/rtc_prod_parchment";
                        }, 0);</script>';
                }
            }
        }else{
            $sql_edit = "UPDATE `rtc_delivery` 
                    SET Delivery_PRB_ID_t = '$Delivery_PRB_ID_t'
                    WHERE Delivery_ID_t = '$Delivery_ID_t'";
            $result_edit = $this->conn->query($sql_edit);
            if($result_edit){
                echo '<script>
                    setTimeout(function(){
                        window.location.href = "../views/rtc_prod_parchment";
                    }, 0);</script>';
                  
            }
        }
    }
    #####################################################################################
                # function of saving the result produced green coffee
    #####################################################################################
    public function save_produced_green($post){
        $Delivery_PRB_ID_t          = $_POST['Delivery_PRB_ID_t'];
        $PRB_Total_Weight           = $_POST['PRB_Total_Weight'];
        $PRB_Number_Bags_15         = $_POST['PRB_Number_Bags_15'];
        $PRB_Number_Bags_13         = $_POST['PRB_Number_Bags_13'];
        $PRB_Number_Bags_UG         = $_POST['PRB_Number_Bags_UG'];
        $PRB_Number_Bags_TR         = $_POST['PRB_Number_Bags_TR'];
        $PRB_Chips_Number_Bags      = $_POST['PRB_Chips_Number_Bags'];
        $PRB_Agaciro_Number_Bags    = $_POST['PRB_Agaciro_Number_Bags'];
        // to get total number of bags
        $PRB_Number_Bags_Total = $PRB_Number_Bags_15 + 
        $PRB_Number_Bags_13 + $PRB_Number_Bags_UG + $PRB_Number_Bags_TR
        + $PRB_Chips_Number_Bags + $PRB_Agaciro_Number_Bags;
        // to get the weight for each type we knwon that one bag has 60kgs.
        $PRB_Weight_Green_15        = $PRB_Number_Bags_15*60;
        $PRB_Weight_Green_13        = $PRB_Number_Bags_13*60;
        $PRB_Weight_Green_UG        = $PRB_Number_Bags_UG*60;
        $PRB_Weight_Green_TR        = $PRB_Number_Bags_TR*60;
        $PRB_Chips_Weight_Green     = $PRB_Chips_Number_Bags*60;
        $PRB_Agaciro_Weight_Green   = $PRB_Agaciro_Number_Bags*60;
        // to get total weight of green
        $PRB_Weight_Green_Total = $PRB_Weight_Green_15 + 
        $PRB_Weight_Green_13 + $PRB_Weight_Green_UG + $PRB_Weight_Green_TR + 
        $PRB_Chips_Weight_Green + $PRB_Agaciro_Weight_Green;
        // get delevery data according to PRB ID
        $sql_delivery = "SELECT * FROM `rtc_delivery`
                        WHERE Delivery_PRB_ID_t = '$Delivery_PRB_ID_t'";
        $result_delivery = $this->conn->query($sql_delivery);
        if($result_delivery->num_rows > 0){
            while($rows = $result_delivery->fetch_assoc()){
                $Delivery_Weight_Green_15 = round(($PRB_Weight_Green_15 *
                $rows['Delivery_NetWeight_Parchment'])/$PRB_Total_Weight,2);
                $Delivery_Weight_Green_13 = round(($PRB_Weight_Green_13 *
                $rows['Delivery_NetWeight_Parchment'])/$PRB_Total_Weight,2);
                $Delivery_Weight_Green_UG = round(($PRB_Weight_Green_UG *
                $rows['Delivery_NetWeight_Parchment'])/$PRB_Total_Weight,2);
                $Delivery_Weight_Green_TR = round(($PRB_Weight_Green_TR *
                $rows['Delivery_NetWeight_Parchment'])/$PRB_Total_Weight,2);
                $Delivery_Chips_Weight_Green = round(($PRB_Chips_Weight_Green *
                $rows['Delivery_NetWeight_Parchment'])/$PRB_Total_Weight,2);
                $Delivery_Agaciro_Weight_Green = round(($PRB_Agaciro_Weight_Green *
                $rows['Delivery_NetWeight_Parchment'])/$PRB_Total_Weight,2);
                $Delivery_Weight_Green_Total = $Delivery_Weight_Green_15 +
                $Delivery_Weight_Green_13 + $Delivery_Weight_Green_UG + 
                $Delivery_Weight_Green_TR + $Delivery_Chips_Weight_Green + 
                $Delivery_Agaciro_Weight_Green;
                $Delivery_ID = $rows['Delivery_ID_t']; 
                // updating every delivery
                $update_delivery = "UPDATE `rtc_delivery` 
                SET Delivery_Weight_Green_Total = '$Delivery_Weight_Green_Total',
                Delivery_Weight_Green_15 = '$Delivery_Weight_Green_15',
                Delivery_Weight_Green_13 = '$Delivery_Weight_Green_13',
                Delivery_Weight_Green_UG = '$Delivery_Weight_Green_UG',
                Delivery_Weight_Green_TR = '$Delivery_Weight_Green_TR',
                Delivery_Chips_Weight_Green = '$Delivery_Chips_Weight_Green',
                Delivery_Agaciro_Weight_Green = '$Delivery_Agaciro_Weight_Green'
                WHERE Delivery_ID_t = '$Delivery_ID' 
                AND Delivery_PRB_ID_t = '$Delivery_PRB_ID_t'";
                $update_result = $this->conn->query($update_delivery);
            }
            if($update_result){
                $update_PRB = "UPDATE `rtc_production_batch`
                SET PRB_Number_Bags_Total = '$PRB_Number_Bags_Total',
                PRB_Number_Bags_15 = '$PRB_Number_Bags_15',
                PRB_Number_Bags_13 = '$PRB_Number_Bags_13',
                PRB_Number_Bags_UG = '$PRB_Number_Bags_UG',
                PRB_Number_Bags_TR = '$PRB_Number_Bags_TR',
                PRB_Weight_Green_Total = '$PRB_Weight_Green_Total',
                PRB_Weight_Green_15 = '$PRB_Weight_Green_15',
                PRB_Weight_Green_13 = '$PRB_Weight_Green_13',
                PRB_Weight_Green_UG = '$PRB_Weight_Green_UG',
                PRB_Weight_Green_TR = '$PRB_Weight_Green_TR',
                PRB_Chips_Number_Bags = '$PRB_Chips_Number_Bags',
                PRB_Chips_Weight_Green = '$PRB_Chips_Weight_Green',
                PRB_Agaciro_Number_Bags = '$PRB_Agaciro_Number_Bags',
                PRB_Agaciro_Weight_Green = '$PRB_Agaciro_Weight_Green'
                WHERE PRB_ID_t = '$Delivery_PRB_ID_t'";
                $PRB_result = $this->conn->query($update_PRB);
                if($PRB_result){
                    echo '<script>
                    setTimeout(function(){
                        window.location.href = "../views/rtc_prod_green";
                    }, 0);</script>';
                }
            }
        }else{
            echo 'Please select production batch ID';
            die();
        }
    }
    #####################################################################################
                # function of adding a production batch number
    #####################################################################################
    public function save_PRB_coffee_defects_data($post){
        $Defect_PRB_ID_t        = $_POST['Defect_PRB_ID_t'];
        $Defect_sample        = $_POST['Defect_sample'];
        $Defect_servere        = $_POST['Defect_servere'];
        $Defect_slight        = $_POST['Defect_slight'];
        $Defect_shell        = $_POST['Defect_shell'];
        $Defect_broken        = $_POST['Defect_broken'];
        $Defect_full_black        = $_POST['Defect_full_black'];
        $Defect_full_sour        = $_POST['Defect_full_sour'];
        $Defect_Dried_cherry        = $_POST['Defect_Dried_cherry'];
        $Defect_fungus        = $_POST['Defect_fungus'];
        $Defect_foreign        = $_POST['Defect_foreign'];
        $Defect_partial_black        = $_POST['Defect_partial_black'];
        $Defect_partial_sour        = $_POST['Defect_partial_sour'];
        $Defect_pergamino        = $_POST['Defect_pergamino'];
        $Defect_floater        = $_POST['Defect_floater'];
        $Defect_immature        = $_POST['Defect_immature'];
        $Defect_withered    = $_POST['Defect_withered'];
        $Defect_hull_husk    = $_POST['Defect_hull_husk'];
        $Defect_water_damage    = $_POST['Defect_water_damage'];
        $Defect_Total_defects    = $_POST['Defect_Total_defects'];
        $Defect_Total_Grams    = $_POST['Defect_Total_Grams'];
        $sql_edit = "UPDATE `rtc_coffee_defects` 
                SET Defect_Samples = '$Defect_sample',
                Servere_insect = '$Defect_servere',
                Slight_insect = '$Defect_slight',
                Shell = '$Defect_shell',
                Broken = '$Defect_broken',
                Full_black = '$Defect_full_black',
                Full_sour = '$Defect_full_sour',
                Dried_cherry = '$Defect_Dried_cherry',
                Fungus_damage = '$Defect_fungus',
                Foreign_matter = '$Defect_foreign',
                Partial_black = '$Defect_partial_black',
                Partial_sour = '$Defect_partial_sour',
                Parchment_Pergamino = '$Defect_pergamino',
                Floater = '$Defect_floater',
                Immature = '$Defect_immature',
                Withered = '$Defect_withered',
                Hull_Husk = '$Defect_hull_husk',
                Water_damage = '$Defect_water_damage',
                Total_defects = '$Defect_Total_defects',
                Total_grams = '$Defect_Total_Grams',
                modified_at = 'now()',
                modified_by = '$_SESSION[user_id]'
                WHERE Defect_PRB_ID_t = '$Defect_PRB_ID_t'";
        $result_edit = $this->conn->query($sql_edit);
        if($result_edit){
            echo '<script>
                setTimeout(function(){
                    window.location.href = "../views/rtc_prod_green";
            }, 0);</script>';
        }else{
            echo 'Please select production batch ID';
            die();
        }
    }
}