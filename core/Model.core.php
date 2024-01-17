<?php 

class Model extends Dbh {
    #####################################################################################
                # login form function 
    #####################################################################################

    public function login_form($post){
        $username = $_POST['username'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $password = $_POST['password'];
        $sql = "SELECT * FROM `dg_users` WHERE username = '$username'";
        $result = $this->conn->query($sql);
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                if(password_verify($_POST["password"], $row["password"])){
                    $_SESSION['user_id']            = $row['id'];
                    $_SESSION['status']             = $row['status'];
                    $_SESSION['pass_updated']       = $row['pass_updated'];
                    $_SESSION['__kp_user']          = $row['__kp_user'];
                    $user                           = $row['__kp_user'];
                    $user_roles                     = $row['_kf_role'];
                    $branch                         = $row['_kf_branch'];
                    $institute                      = $row['_kf_institution'];
                    $_SESSION['_kf_institution']    = $row['_kf_institution'];
                    $_SESSION['full_name']          = $row['full_name'];
                    $_SESSION['email']              = $row['email'];
                    $_SESSION['phone']              = $row['phone'];
                    $_SESSION['last_time']          = time();
                    $sql_sta =$this->conn->query("SELECT * FROM `dg_institution` WHERE __kp_institution = '$institute'");
                    if($sql_sta->num_rows > 0){
                        $rows = $sql_sta->fetch_object();
                        $_SESSION['institution_Name'] = $rows->Institute_name;
                        $branch_type = $rows->_kf_branch_type;
                        $category = $rows->_kf_category;
                        $sql_cate =$this->conn->query(" SELECT * FROM `dg_category` WHERE __kp_category = '$category'");
                        if($sql_cate){
                            $rowst = $sql_cate->fetch_object();
                            $_SESSION['type_institute'] = $rowst->Category_Name;
                            $sql_roles =$this->conn->query("SELECT * FROM `dg_role` WHERE __kp_role = '$user_roles'");
                            if($sql_roles){
                                $rowsr = $sql_roles->fetch_object();
                                $_SESSION['__kp_role'] = $rowsr->__kp_role;
                                $_SESSION['role'] = $rowsr->Role_Name;
                                $sql_bran =$this->conn->query("SELECT * FROM `dg_branch_type` WHERE `__kp_branch_type`= '$branch_type'");
                                if($sql_bran){
                                    $rowsbra = $sql_bran->fetch_object();
                                    $_SESSION['__kp_branch_type'] = $rowsbra->__kp_branch_type;
                                    $_SESSION['type_Name'] = $rowsbra->type_Name;
                                    if($_SESSION['type_Name'] != 'UNIQUE' && $_SESSION['role'] != 'ADMIN'){
                                        $sql_branch =$this->conn->query("SELECT * FROM `dg_branch` 
                                        WHERE `_kf_institution` = '$institute' AND `__kp_branch`= '$branch' ");
                                        if($sql_branch){
                                            $rowsbranch = $sql_branch->fetch_object();
                                            $_SESSION['__kp_branch'] = $rowsbranch->__kp_branch;
                                            $_SESSION['branch_Name'] = $rowsbranch->branch_Name;
                                        }
                                    }
                                }
                            }
                        }
                        // exit();
                        if ($_SESSION['status'] == 1){
                            if($_SESSION['pass_updated'] == 1){

                                $sql_up =$this->conn->query("UPDATE `dg_users` SET  is_type = 'online', last_activity= now() WHERE __kp_User = '$user'");
                                if($sql_up){
                                    if($_SESSION['type_institute'] == 'ADMNISTRATION'){
                                        header('location:../views/Admin/home');
                                    }
                                    if($_SESSION['type_institute'] == 'HEALTHCARE'){
                                        header('location:../views/Health/home');
                                    }
                                    if($_SESSION['type_institute'] == 'PHARMACIE'){
                                        header('location:../views/Pharmacie/home');
                                    }
                                }
                            }else{
                                header('location:../views/update_password');
                            }
                        } 
                        else{
                            $_SESSION['message'] = '
                            <div style="color: #900;" class="alert alert-danger"> <i class="fas fa-lock"></i> 
                                <strong>Please contact Administrator for your account</strong>
                            </div>';
                            echo'<script>setTimeout(function(){ window.location.href = "../index";}, 0);</script>';
                        }
                    }else{
                        $_SESSION['message'] = '
                        <div style="color: #900;" class="alert alert-danger"> <i class="fas fa-lock"></i> 
                            <strong>Please contact Administrator for your account</strong>
                        </div>';
                        echo'<script>setTimeout(function(){ window.location.href = "../index";}, 0);</script>';
                    }
                    
                }else{
                    $_SESSION['message'] = '
                    <div style="color: #900;" class="alert alert-danger">
                        <i class="fas fa-lock"></i> <strong>Wrong Password</strong>
                    </div>';
                    echo'<script>setTimeout(function(){ window.location.href = "../index";}, 0);</script>';
                }
            }
        }else{
            $_SESSION['message'] = '
            <div style="color: #900;"class="alert alert-danger">
                <i class="fas fa-lock"></i> <strong>Wrong Username</strong>
            </div>';
            echo'<script>setTimeout(function(){ window.location.href = "../index";}, 0);</script>';
        }
    }
    #####################################################################################
                # function of getting user out 
    #####################################################################################
    public function getUserOut($getSession){
        $loggout_user = "UPDATE `dg_users` SET  is_type = 'offline', last_seen= now() WHERE id='$getSession'";
        $set_off = $this->conn->query($loggout_user);
        if($set_off){
            session_destroy();
            header('location:../index');
        }
    }
    #####################################################################################
                # function of saving system role 
    #####################################################################################
    public function send_role_data($post){
        $role_name              =  $_POST['role_name'];
        $dot = "-"; $leng = 8; $lengt = 4; $led = 4;  $len = 4;  $le = 12;    
        $d1 = substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'),1,$leng);
        $d2 = substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'),1,$lengt);
        $d3 = substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'),1,$len);
        $d4 = substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'),1,$led);
        $d5 = substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'),1,$le);
        $result = $d1.$dot.$d2.$dot.$d3.$dot.$d4.$dot.$d5;
        $institute = $_SESSION['_kf_institution'];
        $sql_result = $this->conn->query("INSERT INTO `dg_role`(id,__kp_role,_kf_institution,Role_Name,reg_date,status) 
        VALUES (null,'$result','$institute','$role_name',now(),1)");
        if($sql_result){
            $_SESSION['mess'] = '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>The data have been inserted successfully!!!!</strong>
            </div>';
            if($_SESSION['type_institute'] == 'ADMNISTRATION'){
                $url = "../views/Admin/setting";
            }
            if($_SESSION['type_institute'] == 'HEALTHCARE'){
                $url = "../views/Health/setting";
            }
            if($_SESSION['type_institute'] == 'PHARMACIE'){
                $url = "../views/Pharmacie/setting";
            }
            
        }else{
            $_SESSION['mess'] = '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>The data not yet inserted!!!!</strong>
            </div>';
            if($_SESSION['type_institute'] == 'ADMNISTRATION'){
                $url = "../views/Admin/setting";
            }
            if($_SESSION['type_institute'] == 'HEALTHCARE'){
                $url = "../views/Health/setting";
            }
            if($_SESSION['type_institute'] == 'PHARMACIE'){
                $url = "../views/Pharmacie/setting";
            }
        }
        header('location: '.$url);
    }
    #####################################################################################
                # function of saving system category
    #####################################################################################
    public function send_Category_data($post){
        $category_name              =  $_POST['category_name'];
        $dot = "-"; $leng = 8; $lengt = 4; $led = 4;  $len = 4;  $le = 12;    
        $d1 = substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'),1,$leng);
        $d2 = substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'),1,$lengt);
        $d3 = substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'),1,$len);
        $d4 = substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'),1,$led);
        $d5 = substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'),1,$le);
        $result = $d1.$dot.$d2.$dot.$d3.$dot.$d4.$dot.$d5;
        $sql_result = $this->conn->query("INSERT INTO `dg_category`(id,__kp_category,Category_Name,createAt,status) 
        VALUES (null,'$result','$category_name',now(),1)");
        if($sql_result){
            $_SESSION['mess'] = '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>The data have been inserted successfully!!!!</strong>
            </div>';
            $url = "../views/Admin/setting.php?msg=&done";
        }else{
            $_SESSION['mess'] = '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>The data not yet inserted!!!!</strong>
            </div>';
            $url = "../views/Admin/setting.php?msg=&error";
        }
        header('location: '.$url);
    }
    #####################################################################################
                # function of save the instituition data
    #####################################################################################
    public function send_Institution_data($post){
        $dot = "-"; $leng = 8; $leng1 = 8; $lengt = 4; $led = 4; $led = 4;  
        $len = 4; $len1 = 4; $le = 12; $le1 = 12;  $lengt1 = 4; $led1 = 4;
        $d11 = substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'),1,$leng1);
        $d1 = substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'),1,$leng);
        $d2 = substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'),1,$lengt);
        $d21 = substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'),1,$lengt1);
        $d3 = substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'),1,$len);
        $d31 = substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'),1,$len1);
        $d4 = substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'),1,$led);
        $d41 = substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'),1,$led1);
        $d5 = substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'),1,$le);
        $d51 = substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'),1,$le1);
        $__kp_institute = $d1.$dot.$d2.$dot.$d3.$dot.$d4.$dot.$d5;
        $__kp_user = $d1.$dot.$d21.$dot.$d31.$dot.$d41.$dot.$d5;
        $__kp_role = $d11.$dot.$d2.$dot.$d3.$dot.$d41.$dot.$d51;
        $roleName = 'ADMIN';
        $institution_name   =  $_POST['institution_name'];
        $category_name      =  $_POST['category_name'];
        $branch_type        =  $_POST['branch_type'];
        $email              =  $_POST['email'];
        $phone_number       =  $_POST['phone_number'];
        $TIN_number         =  $_POST['TIN_number'];
        $location           =  $_POST['location'];
        $full_name          =  $_POST['full_name'];
        $representor_email  =  $_POST['representor_email'];
        $representor_phone  =  $_POST['representor_phone'];
        $username           =  $_POST['username'];
        $pwd2               =  "pace@123";
        $pwd                =  password_hash($pwd2, PASSWORD_DEFAULT);
        $userID             = $_POST['userID'];
        $result_institute = $this->conn->query("INSERT INTO `dg_institution`(id,__kp_institution,_kf_user,
        _kf_category,_kf_branch,Institute_name,email,phone,TIN,location,createdBy,createAt,status) 
        VALUES(null,'$__kp_institute','$__kp_user','$category_name','$branch_type','$institution_name',
        '$email','$phone_number','$TIN_number','$location','$userID',now(),1)");
        if($result_institute){
            $result_role = $this->conn->query("INSERT INTO `dg_role`(id,__kp_role,_kf_institution,Role_Name,reg_date,status) 
            VALUES(null,'$__kp_role','$__kp_institute','$roleName',now(),1)");
            if($result_role){
                $result_user = $this->conn->query("INSERT INTO `dg_users`(id,__kp_user,_kf_institution,_kf_role,_kf_branch,full_name,
                email,phone,username,password,usercode,createdBy,createAt,status,pass_updated,is_type,last_activity,last_seen) 
                VALUES(null,'$__kp_user','$__kp_institute','$__kp_role','$branch_type','$full_name',
                '$representor_email','$representor_phone','$username','$pwd','$pwd2','$userID',now(),1,0,'Offline','','')");
                if($result_user){
                    $_SESSION['mess'] = '<div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>The data are created successfully!!!!</strong>
                    </div>';
                    $url = "../views/Admin/setting.php?msg=&done";
                }else{
                    $_SESSION['mess'] = '<div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>the user is not yet created!!!</strong>
                    </div>';
                    $url = "../views/Admin/setting.php?msg=&error";
                }
            }else{
                $_SESSION['mess'] = '<div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>The user role is not yet created!!!!</strong>
                </div>';
                $url = "../views/Admin/setting?msg=&error";
            }
        }else{
            $_SESSION['mess'] = '<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>The Institution is not yet created!!!!</strong>
            </div>';
            $url = "../views/Admin/setting?msg=&error";
        }
        header('location: '.$url);
    }
    #####################################################################################
                # function of creating user system 
    #####################################################################################
    public function create_new_user($post){
        $_kf_institution    =  $_POST['_kf_institution'];
        $userID             =  $_POST['userID'];
        $full_name          =  $_POST['full_name'];
        $email              =  $_POST['email'];
        $phone              =  $_POST['phone'];
        $branch_type        =  $_POST['branch_type'];
        $user_role          =  $_POST['user_role'];
        $username           =  $_POST['username'];
        $pwd2               =  "pace@123";
        $pwd                =  password_hash($pwd2, PASSWORD_DEFAULT);
        $dot = "-"; $leng = 8; $leng1 = 8; $lengt = 4; $led = 4;  $len = 4; $len1 = 4;  $le = 12; $le1 = 12;   
        $d1 = substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'),1,$leng);
        $d11 = substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'),1,$leng1);
        $d2 = substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'),1,$lengt);
        $d3 = substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'),1,$len);
        $d31 = substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'),1,$len1);
        $d4 = substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'),1,$led);
        $d5 = substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'),1,$le);
        $d51 = substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'),1,$le1);
        $result = $d1.$dot.$d2.$dot.$d3.$dot.$d4.$dot.$d51;
        $result1 = $d11.$dot.$d2.$dot.$d31.$dot.$d4.$dot.$d5;
        $sql_result = $this->conn->query("INSERT INTO `dg_users`(id,__kp_user,_kf_institution,_kf_role,_kf_branch,
        full_name,email,phone,username,password,usercode,createdBy,createAt,status,pass_updated,is_type,last_activity,
        last_seen) VALUES (null,'$result','$_kf_institution','$user_role','$branch_type','$full_name','$email',
        '$phone','$username','$pwd','$pwd2','$userID',now(),1,1,'Offline','','')");
        if($sql_result){
            $user = $sql_result->last_inserted_id;
            $sql_access = $this->conn->query("INSERT INTO `dg_user_access`(id,__kp_access,user_ID,created_At)
            VALUES (null,'$result1','$user',now())");
            if($sql_access){
                $_SESSION['mess'] = '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>a user have been created successfully!!!!</strong>
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
        }
        header('location: '.$url);
    }
    #####################################################################################
                # function of creating system department 
    #####################################################################################
    public function send_Department_data($post){
        $department_name              =  $_POST['department_name'];
        $dot = "-"; $leng = 8; $lengt = 4; $led = 4;  $len = 4;  $le = 12;    
        $d1 = substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'),1,$leng);
        $d2 = substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'),1,$lengt);
        $d3 = substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'),1,$len);
        $d4 = substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'),1,$led);
        $d5 = substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'),1,$le);
        $result = $d1.$dot.$d2.$dot.$d3.$dot.$d4.$dot.$d5;
        $institute = $_SESSION['_kf_institution'];
        $sql_result = $this->conn->query("INSERT INTO `dg_department`(id,__kp_department,_kf_institution,department_Name,reg_date,status) 
        VALUES (null,'$result','$institute','$department_name',now(),1)");
        if($sql_result){
            $_SESSION['mess'] = '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>The data have been inserted successfully!!!!</strong>
            </div>';
            $url = "../views/Health/setting";
            
            
        }else{
            $_SESSION['mess'] = '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>The data not yet inserted!!!!</strong>
            </div>';
            $url = "../views/Health/setting";
        }
        header('location: '.$url);
    }
    #####################################################################################
                # function of creating system pharmacie branches 
    #####################################################################################
    public function send_Branch_data($post){
        $branch_name              =  $_POST['branch_name'];
        $dot = "-"; $leng = 8; $lengt = 4; $led = 4;  $len = 4;  $le = 12;    
        $d1 = substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'),1,$leng);
        $d2 = substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'),1,$lengt);
        $d3 = substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'),1,$len);
        $d4 = substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'),1,$led);
        $d5 = substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'),1,$le);
        $result = $d1.$dot.$d2.$dot.$d3.$dot.$d4.$dot.$d5;
        $institute = $_SESSION['_kf_institution'];
        $sql_result = $this->conn->query("INSERT INTO `dg_branch`(id,__kp_branch,_kf_institution,branch_Name,reg_date,status) 
        VALUES (null,'$result','$institute','$branch_name',now(),1)");
        if($sql_result){
            $_SESSION['mess'] = '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>The data have been inserted successfully!!!!</strong>
            </div>';
            $url = "../views/Pharmacie/setting";
            
            
        }else{
            $_SESSION['mess'] = '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>The data not yet inserted!!!!</strong>
            </div>';
            $url = "../views/Pharmacie/setting";
        }
        header('location: '.$url);
    }
    #####################################################################################
                # function of creating medical category
    #####################################################################################
    public function send_Medical_Category_data($post){
        $category_name              =  $_POST['category_name'];
        $category_desc              =  $_POST['category_desc'];
        $dot = "-"; $leng = 8; $lengt = 4; $led = 4;  $len = 4;  $le = 12;    
        $d1 = substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'),1,$leng);
        $d2 = substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'),1,$lengt);
        $d3 = substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'),1,$len);
        $d4 = substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'),1,$led);
        $d5 = substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'),1,$le);
        $result = $d1.$dot.$d2.$dot.$d3.$dot.$d4.$dot.$d5;
        $sql_result = $this->conn->query("INSERT INTO `dg_medical_category`(category_ID,__kp_mede_category,category_name,category_desc,category_status) 
        VALUES (null,'$result','$category_name','$category_desc',1)");
        if($sql_result){
            $_SESSION['mess'] = '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>The data have been inserted successfully!!!!</strong>
            </div>';
            if($_SESSION['type_institute'] == 'ADMNISTRATION'){
                $url = "../views/Admin/medical_category";
            }
            if($_SESSION['type_institute'] == 'HEALTHCARE'){
                $url = "../views/Health/medical_category";
            }
            if($_SESSION['type_institute'] == 'PHARMACIE'){
                $url = "../views/Pharmacie/medical_category";
            }
        }else{
            $_SESSION['mess'] = '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>The data not yet inserted!!!!</strong>
            </div>';
            if($_SESSION['type_institute'] == 'ADMNISTRATION'){
                $url = "../views/Admin/medical_category";
            }
            if($_SESSION['type_institute'] == 'HEALTHCARE'){
                $url = "../views/Health/medical_category";
            }
            if($_SESSION['type_institute'] == 'PHARMACIE'){
                $url = "../views/Pharmacie/medical_category";
            }
        }
        header('location: '.$url);
    }
    #####################################################################################
                # function of creating system pharmacie branches 
    #####################################################################################
    public function send_Income_data($post){
        $income_amount              =  $_POST['income_amount'];
        $income_reason              =  $_POST['income_reason'];
        $dot = "-"; $leng = 8; $lengt = 4; $led = 4;  $len = 4;  $le = 12;    
        $d1 = substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'),1,$leng);
        $d2 = substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'),1,$lengt);
        $d3 = substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'),1,$len);
        $d4 = substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'),1,$led);
        $d5 = substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'),1,$le);
        $result = $d1.$dot.$d2.$dot.$d3.$dot.$d4.$dot.$d5;
        $institute = $_SESSION['_kf_institution'];
        $user = $_SESSION['user_id'];
        if($_SESSION['type_Name'] != 'UNIQUE' && $_SESSION['role'] != 'ADMIN'){
        $branches = $_SESSION['__kp_branch'];}else{ $branches = $_SESSION['__kp_branch_type'];}
        $institute = $_SESSION['_kf_institution'];
        $sql_result = $this->conn->query("INSERT INTO `dg_income`(id,__kp_income,_kf_institution,_kf_branch,income_amount,income_reason,created_at,created_by,income_status) 
        VALUES (null,'$result','$institute','$branches','$income_amount','$income_reason','$user',now(),1)");
        if($sql_result){
            $_SESSION['mess'] = '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>The data have been inserted successfully!!!!</strong>
            </div>';
            if($_SESSION['type_institute'] == 'ADMNISTRATION'){
                $url = "../views/Admin/incomes";
            }
            if($_SESSION['type_institute'] == 'HEALTHCARE'){
                $url = "../views/Health/incomes";
            }
            if($_SESSION['type_institute'] == 'PHARMACIE'){
                $url = "../views/Pharmacie/incomes";
            }
        }else{
            $_SESSION['mess'] = '<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>The data not yet inserted!!!!</strong>
            </div>';
            if($_SESSION['type_institute'] == 'ADMNISTRATION'){
                $url = "../views/Admin/incomes";
            }
            if($_SESSION['type_institute'] == 'HEALTHCARE'){
                $url = "../views/Health/incomes";
            }
            if($_SESSION['type_institute'] == 'PHARMACIE'){
                $url = "../views/Pharmacie/incomes";
            }
        }
        header('location: '.$url);
    }
    #####################################################################################
                # function of checking user privilegies 
    #####################################################################################

    public function user_privilege($get_session){
        $sql = "SELECT * FROM `rtc_users_modules_access` 
                WHERE rtc_users_modules_access.user_ID ='$get_session'";
        $result = $this->conn->query($sql);
        if($result->num_rows > 0){
            $row = $result->fetch_assoc();
            return $row;
        }
    }
    #####################################################################################
                # function user profile update 
    #####################################################################################  
    
    public function updateProfile($get_session){
        if ($_POST['password1']==$_POST['password2']) {
            $fname    =  $_POST['FIRSTNAME'];
            $Lname    =  $_POST['LASTNAME'];
            $user_id   =  $_POST['USER_ID'];
            $email   =  $_POST['EMAIL'];
            $tel      =  $_POST['CONTACTNUMBER'];
            $username =  $_POST['USERNAME'];
            $pwd1     =  $_POST['password1'];
            $pwd2     =  $_POST['password2'];
            $pwd     =  password_hash($pwd1, PASSWORD_DEFAULT);
            if($_POST['password1'] == $_POST['password2']){
                $new_info = "UPDATE `rtc_users`
                        SET first_name='$fname', last_name='$Lname' , phone='$tel', email='$username'
                        , username='$username', password='$pwd', user_code='$pwd1' WHERE user_id ='$get_session'";
                $result_info = $this->conn->query($new_info);
                if($result_info){
                    session_destroy();
                    header('location:../login.php');
                }
            }else{
                header('location:profile.php?error=password not match');
            }
        }else{
            header('location:profile.php?error=password not match');
        }
    }
    
    
    
    #####################################################################################
                # function of activating the assigned privilege to a user
    #####################################################################################

    public function UserAccessRight($id,$status,$col){
        $sql = "UPDATE rtc_users_modules_access SET $col = '$status' 
                WHERE rtc_users_modules_access.user_ID = '$id'";
        $result = $this->conn->query($sql);
        if ($result) {
            $url = "../views/user_access?id=".$id."&done";
        }
        else{
            $url = "../views/user_access?id=".$id."&error=active not performed".$this->conn->error;
        }
            header('location: '.$url);
    }

    #####################################################################################
                # function of registering a user in system
    #####################################################################################

    public function User_Registion_Form($post){
        $_SESSION['reg_msg'] = "";
        $first_name   = $_POST['first_name'];
        $last_name    = $_POST['last_name'];
        $full_name   = $first_name.$last_name."1234567890";
        $length      = 5;
        ##function for generating user password
        function random_alphanumeric($full_name,$length) {
            $my_string = '';
            for ($i = 0; $i < $length; $i++) {
                $pos = mt_rand(0, strlen($full_name) -1);
                $my_string .= substr($full_name, $pos, 1);
            }
        return $my_string;
        }
        $user_email   = $_POST['user_email'];
        $user_phone   = $_POST['user_phone'];
        $Department_ID_t   = $_POST['Department_ID_t'];
        $username     = $_POST['username'];
        //$pass         = random_alphanumeric($full_name ,5);
        $pass         = 'rtc123';
        $passcode     = password_hash($pass, PASSWORD_DEFAULT);
        $user_ids     = $_SESSION['user_id'];
        $user_status  = '0';
        $pass_update  = '0';
        $reg_date     = date('Y-m-d');

        $sql_check_username = "SELECT * FROM `rtc_users` WHERE username = '$username' ";
        $sql_check_user_email = "SELECT * FROM `rtc_users` WHERE email = '$user_email' ";
        $sql_user_name = $this->conn->query($sql_check_username);
        $sql_user_email= $this->conn->query($sql_check_user_email);

        if ($sql_user_name->num_rows > 0) {
    
            $_SESSION['reg_msg'] = '<div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Username taken</strong></div>';
            echo '<script>
                    setTimeout(function(){
                        window.location.href = "../views/rtc_users";
                    }, 0);
                </script>';
        }elseif ($sql_user_email->num_rows > 0) {
            $_SESSION['reg_msg'] = '<div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Email taken</strong></div>';
            echo '<script>
                    setTimeout(function(){
                        window.location.href = "../views/rtc_users";
                    }, 0);</script>';
        }else{
            $sql = "INSERT INTO `rtc_users`(user_id,first_name,last_name,phone,username,password,
                                user_code,email,Department_ID_t,registered_by,reg_date,user_status,pass_updated,
                                is_type,last_activity,last_seen)
                    VALUES(null,'$first_name','$last_name','$user_phone','$username','$passcode',
                                '$pass','$user_email','$Department_ID_t','$user_ids','$reg_date','$user_status',
                                '$pass_update','offline',now(),now())";
            $result = $this->conn->query($sql);
            $last_id = $this->conn->insert_id;
            if($result){
                $sql_priv = "INSERT INTO `rtc_users_modules_access`(user_ID) 
                            VALUES('$last_id')";
                $results = $this->conn->query($sql_priv);
                if($results){
                    $ppp = '<div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <strong>well inserted in the system</strong>
                            <p><i style="color: #000;">Username is: </i><b>'.$username.'</b>';
                    $user_pass = '<i style="color: #000;">Password is:</i> <b>'.$pass.'</b>';
                    $ppp2 = '</div>';
                    $user_info = '<p> Password and username is sent to this email <strong>'.$user_email.'</strong></p>';
                    $_SESSION['reg_msg'] = $ppp." and ".$user_pass.$ppp2;
                    echo '<script>
                            setTimeout(function(){
                                window.location.href = "../views/rtc_users";
                            }, 0);</script>';
                }else{
                    echo  "not yet inserted data".$this->conn->error;
                    die();
                }
            }else{
                echo  "not yet inserted data";
                die();
                $_SESSION['reg_msg'] = '<div class="alert alert-warning alert-dismissible">
                                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                                            <strong>User data not saved</strong>
                                        </div>';
                echo '<script>
                        setTimeout(function(){
                        window.location.href = "../views/rtc_users";
                        }, 0);
                    </script>';
            }
        }
    }
    #####################################################################################
                # function of registering the supplied coffee
    #####################################################################################
    public function supplied_coffee($post){

        $Delivery_ID_t                  = $_POST['Delivery_ID_t'];
        $Delivery_Supplier_ID_t         = $_POST['Delivery_Supplier_ID_t'];
        $Delivery_Certification_ID_t    = $_POST['Delivery_Certification_ID_t'];
        $Delivery_Grade_ID_t            = $_POST['Delivery_Grade_ID_t'];
        $Delivery_Product_Type_ID_t     = $_POST['Delivery_Product_Type_ID_t'];
        $Delivery_Product_Category_ID_t = $_POST['Delivery_Product_Category_ID_t'];
        $Delivery_Warehouse_ID_t        = $_POST['Delivery_Warehouse_ID_t'];
        $Delivery_Bag_Type              = $_POST['Delivery_Bag_Type'];
        $Delivery_Number_Bags           = $_POST['Delivery_Number_Bags'];
        $Delivery_Weight_Parchment      = $_POST['Delivery_Weight_Parchment'];
        $Delivery_MC                    = $_POST['Delivery_MC'];
        if ($Delivery_Bag_Type=='Poly'){
            $Delivery_Weight_Bags       = round($Delivery_Number_Bags/6);
        }else {
            $Delivery_Weight_Bags       = round($Delivery_Number_Bags/4);
        }
        
        $Delivery_NetWeight_Parchment   = $Delivery_Weight_Parchment - $Delivery_Weight_Bags;
        $created_by                     = $_SESSION['user_id'];
        $Delivery_Status                = '0';
        $Delivery_Receiving_Date        = date('Y-m-d');
       
        $sql = "INSERT INTO `rtc_delivery`(id,Delivery_ID_t,Delivery_Supplier_ID_t,Delivery_Certification_ID_t,
                    Delivery_Grade_ID_t,Delivery_Product_Type_ID_t,Delivery_Product_Category_ID_t,Delivery_Warehouse_ID_t,
                    Delivery_Bag_Type,Delivery_Number_Bags,Delivery_Weight_Bags,Delivery_Weight_Parchment,
                    Delivery_NetWeight_Parchment,Delivery_Status,Delivery_MC,Delivery_Receiving_Date,created_by)
                VALUES(null,'$Delivery_ID_t','$Delivery_Supplier_ID_t','$Delivery_Certification_ID_t','$Delivery_Grade_ID_t',
                    '$Delivery_Product_Type_ID_t','$Delivery_Product_Category_ID_t','$Delivery_Warehouse_ID_t',
                    '$Delivery_Bag_Type','$Delivery_Number_Bags','$Delivery_Weight_Bags','$Delivery_Weight_Parchment',
                    '$Delivery_NetWeight_Parchment','$Delivery_Status','$Delivery_MC','$Delivery_Receiving_Date','$created_by')";
        $result = $this->conn->query($sql);
        $last_id = $this->conn->insert_id;
        if($result){
                echo '<script>
                        setTimeout(function(){
                            window.location.href = "../views/rtc_prod_parchment";
                        }, 0);</script>';
        }else{
            echo  "not yet inserted data".$this->conn->error;
        }
    }
    #####################################################################################
                # function of register new module is just menu and submenu
    #####################################################################################
    public function module_Form($post){
        $module_name = $_POST['post'];
        $platform = $_POST['platform'];
        $sql_module = $this->conn->query("INSERT INTO `rtc_modules`(module_name,platform)
                    VALUES('$module_name','$platform')");
        if($sql_module){
            if($module_name == 'General Setting'){
                $module_name = 'General_Setting';
            }elseif($module_name == 'Human Resource'){
                $module_name = 'Human_resource';
            }else{
                $module_name;
            }
            $sql_ = "ALTER TABLE rtc_users_modules_access ADD $module_name enum('0','1') NOT NULL DEFAULT '0'";
            $result = $this->conn->query($sql_);
            if($result){
                echo '<script>
                        setTimeout(function(){
                            window.location.href = "../views/rtc_module";
                        }, 0);</script>';
            }
        }
    }
    #####################################################################################
                # function of setting a new warehouse 
    #####################################################################################
    public function warehouse_setting($post){
        $Warehouse_Name     = $_POST['Warehouse_Name'];
        $Warehouse_Address  = $_POST['Warehouse_Address'];
        $Warehouse_Status  = '0';
        $created_by = $_SESSION['user_id'];
        //check if there is a Warehouse code for a house
        $www = "SELECT Warehouse_ID_t FROM `rtc_warehouse` 
                ORDER BY rtc_warehouse.id DESC LIMIT 1";
        $tr = $this->conn->query($www);
        $tr_num =$tr->fetch_assoc();
        if ($tr){
            $row = $tr->num_rows;
            if ($row == 0) { 
                 $last = 'WH000';
                
            }else{
                $warehouse_code = $tr_num['Warehouse_ID_t']; // This is fetched from database
                $last = $warehouse_code;
            }
            $last++;
        }
        $Warehouse_ID_t =  $last;
        
        $sql_warehouse = "INSERT INTO `rtc_warehouse`(id,Warehouse_ID_t,Warehouse_Name,Warehouse_Address,Warehouse_Status,created_by)
                            VALUES(null,'$Warehouse_ID_t','$Warehouse_Name','$Warehouse_Address','$Warehouse_Status','$created_by')";
        $result_warehouse = $this->conn->query($sql_warehouse);
        if($result_warehouse){
            echo '<script>
                        setTimeout(function(){
                            window.location.href = "../views/rtc_gen_setting";
                        }, 0);</script>';
        }else{
            echo $this->conn->error;
            header('location:../views/rtc_gen_setting');
        }
    }
    #####################################################################################
                # function of setting a new certification 
    #####################################################################################

    public function rtc_certification_setting($post){
        $Certification_Name = $_POST['Certification_Name'];
        $created_by         = $_SESSION['user_id'];
        //check if there is a Warehouse code for a house
        $www = "SELECT Certification_ID_t FROM `rtc_certification` 
                ORDER BY rtc_certification.id DESC LIMIT 1";
        $tr = $this->conn->query($www);
        $tr_num =$tr->fetch_assoc();
        if ($tr){
            $row = $tr->num_rows;
            if ($row == 0) { 
                 $last = 'CT000';
                
            }else{
                $certification_code = $tr_num['Certification_ID_t']; // This is fetched from database
                $last = $certification_code;
            }
            $last++;
        }
        $Certification_ID_t =  $last;
        $sql_certification = "INSERT INTO `rtc_certification`(id,Certification_ID_t,Certification_Name,created_by)
                                VALUES(null,'$Certification_ID_t','$Certification_Name','$created_by')";
        $result_certification = $this->conn->query($sql_certification);
        if($result_certification){
            echo '<script>
                        setTimeout(function(){
                            window.location.href = "../views/rtc_gen_setting";
                        }, 0);</script>';
        }else{
            echo $this->conn->error;
            header('location:../views/rtc_gen_setting');
        }
    }
    #####################################################################################
                # function of setting a new product type 
    #####################################################################################
    public function rtc_product_type_setting($post){
        $Product_Type_Name = $_POST['Product_Type_Name'];
        $created_by         = $_SESSION['user_id'];
        //check if there is a Warehouse code for a house
        $www = "SELECT Product_Type_ID_t FROM `rtc_product_type` 
                ORDER BY rtc_product_type.id DESC LIMIT 1";
        $tr = $this->conn->query($www);
        $tr_num =$tr->fetch_assoc();
        if ($tr){
            $row = $tr->num_rows;
            if ($row == 0) { 
                 $last = 'PT000';
                
            }else{
                $product_type_code = $tr_num['Product_Type_ID_t']; // This is fetched from database
                $last = $product_type_code;
            }
            $last++;
        }
        $Product_Type_ID_t =  $last;
        $sql_product_type = "INSERT INTO `rtc_product_type`(id,Product_Type_ID_t,Product_Type_Name,created_by)
                                VALUES(null,'$Product_Type_ID_t','$Product_Type_Name','$created_by')";
        $result_product_type = $this->conn->query($sql_product_type);
        if($result_product_type){
            echo '<script>
                        setTimeout(function(){
                            window.location.href = "../views/rtc_gen_setting";
                        }, 0);</script>';
        }else{
            echo $this->conn->error;
            header('location:../views/rtc_gen_setting');
        }
    }
    #####################################################################################
                # function of setting a new product category 
    #####################################################################################
    public function rtc_product_category_setting($post){
        $Prodcut_Category_Name = $_POST['Prodcut_Category_Name'];
        $created_by         = $_SESSION['user_id'];
        //check if there is a Warehouse code for a house
        $www = "SELECT Product_Category_ID_t FROM `rtc_product_category` 
                ORDER BY rtc_product_category.id DESC LIMIT 1";
        $tr = $this->conn->query($www);
        $tr_num =$tr->fetch_assoc();
        if ($tr){
            $row = $tr->num_rows;
            if ($row == 0) { 
                 $last = 'PC000';
                
            }else{
                $product_category_code = $tr_num['Product_Category_ID_t']; // This is fetched from database
                $last = $product_category_code;
            }
            $last++;
        }
        $Product_Category_ID_t =  $last;
        $sql_product_category = "INSERT INTO `rtc_product_category`(id,Product_Category_ID_t,Prodcut_Category_Name,created_by)
                                VALUES(null,'$Product_Category_ID_t','$Prodcut_Category_Name','$created_by')";
        $result_product_category = $this->conn->query($sql_product_category);
        if($result_product_category){
            echo '<script>
                        setTimeout(function(){
                            window.location.href = "../views/rtc_gen_setting";
                        }, 0);</script>';
        }else{
            echo $this->conn->error;
            header('location:../views/rtc_gen_setting');
        }
    }
    #####################################################################################
                # function of setting a new coffee grade
    #####################################################################################
    public function rtc_coffee_grade_setting($post){
        $Grade_Label = $_POST['Grade_Label'];
        $created_by  = $_SESSION['user_id'];
        //check if there is a Warehouse code for a house
        $www = "SELECT Grade_ID_t FROM `rtc_grade` 
                ORDER BY rtc_grade.id DESC LIMIT 1";
        $tr = $this->conn->query($www);
        $tr_num =$tr->fetch_assoc();
        if ($tr){
            $row = $tr->num_rows;
            if ($row == 0) { 
                 $last = 'CG000';
            }else{
                $coffee_grade_code = $tr_num['Grade_ID_t']; // This is fetched from database
                $last = $coffee_grade_code;
            }
            $last++;
        }
        $Grade_ID_t =  $last;
        $sql_grade = "INSERT INTO `rtc_grade`(id,Grade_ID_t,Grade_Label,created_by)
                                VALUES(null,'$Grade_ID_t','$Grade_Label','$created_by')";
        $result_grade = $this->conn->query($sql_grade);
        if($result_grade){
            echo '<script>
                        setTimeout(function(){
                            window.location.href = "../views/rtc_gen_setting";
                        }, 0);</script>';
        }else{
            echo $this->conn->error;
            header('location:../views/rtc_gen_setting');
        }
    }
    #####################################################################################
                # function of setting a new rtc department
    #####################################################################################
    public function rtc_department_setting($post){
        $Department_Name = $_POST['Department_Name'];
        $created_by  = $_SESSION['user_id'];
        //check if there is a Warehouse code for a house
        $www = "SELECT Department_ID_t FROM `rtc_department` 
                ORDER BY rtc_department.id DESC LIMIT 1";
        $tr = $this->conn->query($www);
        $tr_num =$tr->fetch_assoc();
        if ($tr){
            $row = $tr->num_rows;
            if ($row == 0) { 
                 $last = 'RD000';
            }else{
                $department_code = $tr_num['Department_ID_t']; // This is fetched from database
                $last = $department_code;
            }
            $last++;
        }
        $Department_ID_t =  $last;
        $sql_department = "INSERT INTO `rtc_department`(id,Department_ID_t,Department_Name,created_by)
                                VALUES(null,'$Department_ID_t','$Department_Name','$created_by')";
        $result_department = $this->conn->query($sql_department);
        if($result_department){
            echo '<script>
                        setTimeout(function(){
                            window.location.href = "../views/rtc_gen_setting";
                        }, 0);</script>';
        }else{
            echo $this->conn->error;
            header('location:../views/rtc_gen_setting');
        }
    }
    #####################################################################################
                # function of setting a new hopper data
    #####################################################################################
    public function Setting_new_hopper($post){
        $PRB_Hopper_Name = $_POST['PRB_Hopper_Name'];
        $created_by  = $_SESSION['user_id'];
        $PRB_creation = date('Y-m-d');
        $year = date('Y');
        $month = date('m');
        $day = date('d');
        $hour = date('h');
        $minute = date('i');
        $second = date('s');

        //check if there is a Warehouse code for a house
        $www = "SELECT Defect_ID_t FROM `rtc_coffee_defects` 
                ORDER BY rtc_coffee_defects.id DESC LIMIT 1";
        $tr = $this->conn->query($www);
        $tr_num =$tr->fetch_assoc();
        if ($tr){
            $row = $tr->num_rows;
            if ($row == 0) { 
                 $last = 'CD000';
            }else{
                $defects_code = $tr_num['Defect_ID_t']; // This is fetched from database
                $last = $defects_code;
            }
            $last++;
        }
        $Defect_ID_t =  $last;
        
        //check if there is a Warehouse code for a house
        $PRB_ID_t = 'PRB'.$year.''.$month.''.$day.''.$hour.''.$minute;
        
        $sql_hopper = "INSERT INTO `rtc_production_hopper`(id,PRB_ID_t,PRB_Hopper_Name,PRB_creation,created_by)
                                VALUES(null,'$PRB_ID_t','$PRB_Hopper_Name','$PRB_creation','$created_by')";
        $result_hopper = $this->conn->query($sql_hopper);
        if($result_hopper){
            $sql_insert = "INSERT INTO `rtc_production_batch`(id,PRB_ID_t) 
            VALUES(null,'$PRB_ID_t')";
            $result_insert = $this->conn->query($sql_insert);
            if($result_insert){
                $sql_defects = "INSERT INTO `rtc_coffee_defects`(id,Defect_ID_t,Defect_PRB_ID_t)
                                VALUES(null,'$Defect_ID_t','$PRB_ID_t')";
                $result_defects = $this->conn->query($sql_defects);
                if($result_defects){
                    echo '<script>
                            setTimeout(function(){
                                window.location.href = "../views/rtc_prod_parchment";
                            }, 0);</script>';
                }else{
                    echo $this->conn->error;
                    header('location:../views/rtc_prod_parchment');
                }
            }else{
            echo $this->conn->error;
            header('location:../views/rtc_prod_parchment');
            }
        } else{
            echo $this->conn->error;
            header('location:../views/rtc_prod_parchment');
        }
    }
    #####################################################################################
                # function of setting a green coffee defects
    #####################################################################################
    public function green_defects_setting($post){
        $Defect_Name = $_POST['Defect_Name'];
        $created_by  = $_SESSION['user_id'];
        //check if there is a Warehouse code for a house
        $www = "SELECT Defect_ID_t FROM `rtc_coffee_defects` 
                ORDER BY rtc_coffee_defects.id DESC LIMIT 1";
        $tr = $this->conn->query($www);
        $tr_num =$tr->fetch_assoc();
        if ($tr){
            $row = $tr->num_rows;
            if ($row == 0) { 
                 $last = 'CD000';
            }else{
                $defects_code = $tr_num['Defect_ID_t']; // This is fetched from database
                $last = $defects_code;
            }
            $last++;
        }
        $Defect_ID_t =  $last;
        $sql_defects = "INSERT INTO `rtc_coffee_defects`(id,Defect_ID_t,Defect_Name,created_by)
                                VALUES(null,'$Defect_ID_t','$Defect_Name','$created_by')";
        $result_defects = $this->conn->query($sql_defects);
        if($result_defects){
            echo '<script>
                        setTimeout(function(){
                            window.location.href = "../views/rtc_gen_setting";
                        }, 0);</script>';
        }else{
            echo $this->conn->error;
            header('location:../views/rtc_gen_setting');
        }
    }
    #####################################################################################
                # function of inserting a green coffee defects
    #####################################################################################
    public function save_coffee_defects_data($post){
        $Defect_ID_t = $_POST['Defect_ID'];
        $Defect_values_data = $_POST['Defect_values_data'];
        $arrlength =  count($_POST['Defect_ID']);
        
        for($x = 0; $x < $arrlength; $x++){
            echo $Defect_ID_t[$x]." == ".$Defect_values_data[$x]."<br>";
        }

        die();
        $created_by  = $_SESSION['user_id'];
        //check if there is a Warehouse code for a house
        $www = "SELECT Defect_ID_t FROM `rtc_coffee_defects` 
                ORDER BY rtc_coffee_defects.id DESC LIMIT 1";
        $tr = $this->conn->query($www);
        $tr_num =$tr->fetch_assoc();
        if ($tr){
            $row = $tr->num_rows;
            if ($row == 0) { 
                 $last = 'CD000';
            }else{
                $defects_code = $tr_num['Defect_ID_t']; // This is fetched from database
                $last = $defects_code;
            }
            $last++;
        }
        $Defect_ID_t =  $last;
        $sql_defects = "INSERT INTO `rtc_coffee_defects`(id,Defect_ID_t,Defect_Name,created_by)
                                VALUES(null,'$Defect_ID_t','$Defect_Name','$created_by')";
        $result_defects = $this->conn->query($sql_defects);
        if($result_defects){
            echo '<script>
                        setTimeout(function(){
                            window.location.href = "../views/rtc_gen_setting";
                        }, 0);</script>';
        }else{
            echo $this->conn->error;
            header('location:../views/rtc_gen_setting');
        }
    }
    #####################################################################################
                # function of setting a new rtc bank account 
    #####################################################################################
    public function New_Bank_Account($post){
        $bank_name     = $_POST['bank_name'];
        $bank_account  = $_POST['bank_account'];
        $bank_Status  = '0';
        $created_by = $_SESSION['user_id'];
        //check if there is a bank code
        $www = "SELECT Bank_ID_t FROM `rtc_bank_account` 
                ORDER BY rtc_bank_account.id DESC LIMIT 1";
        $tr = $this->conn->query($www);
        $tr_num =$tr->fetch_assoc();
        if ($tr){
            $row = $tr->num_rows;
            if ($row == 0) { 
                 $last = 'BA000';
                
            }else{
                $bank_code = $tr_num['Bank_ID_t']; // This is fetched from database
                $last = $bank_code;
            }
            $last++;
        }
        $Bank_ID_t =  $last;
        
        $sql_bank = "INSERT INTO `rtc_bank_account`(id,Bank_ID_t,Bank_Name,Bank_account,Bank_Status,created_by)
                    VALUES(null,'$Bank_ID_t','$bank_name','$bank_account','$bank_Status','$created_by')";
        $result_bank = $this->conn->query($sql_bank);
        if($result_bank){
            echo '<script>
                    setTimeout(function(){
                        window.location.href = "../views/rtc_bank";
                    }, 0);</script>';
        }else{
            echo $this->conn->error;
            header('location:../views/rtc_bank');
        }
    }
    #####################################################################################
                # function of submitting or creating an export delivery contract 
    #####################################################################################
    public function Submit_Export_Deliveries($post){
        $EL_Order_ID            = $_POST['EL_Order_ID'];
        $PRB_ID_t               = $_POST['PRB_ID_t'];
        $EL_quality             = $_POST['EL_quality'];
        $EL_green_type          = $_POST['EL_green_type'];
        $EL_bags_number         = $_POST['EL_bags_number'];
        $EL_net_weight          = $_POST['EL_net_weight'];
        $EL_Destination         = $_POST['EL_Destination'];
        $EL_Additonal_comment   = $_POST['EL_Additonal_comment'];
        $EL_Status_EMS          = '0';
        $EL_Status             = '0';
        $created_by             = $_SESSION['user_id'];
        /// combination of PRB and export Lot
        $www = "SELECT Lot_list_ID_t FROM `rtc_export_lot_list` 
                ORDER BY rtc_export_lot_list.id DESC LIMIT 1";
        $tr = $this->conn->query($www);
        $tr_num =$tr->fetch_assoc();
        if ($tr){
            $row = $tr->num_rows;
            if ($row == 0) { 
                 $last = 'EL000';
                
            }else{
                $export_code = $tr_num['Lot_list_ID_t']; // This is fetched from database
                $last = $export_code;
            }
            $last++;
        }
        $Lot_list_ID_t =  $last;
        $sql_lot_list = "INSERT INTO `rtc_export_lot_list`(id,Lot_list_ID_t,EL_Order_ID,PRB_ID,created_by)
                        VALUES(null,'$Lot_list_ID_t','$EL_Order_ID','$PRB_ID_t','$created_by')";
        $result_lot_list = $this->conn->query($sql_lot_list);
        if($result_lot_list){
            $lot_list = "SELECT Lot_list_ID_t FROM `rtc_export_lot_list` 
                ORDER BY rtc_export_lot_list.id DESC LIMIT 1";
            $re_lot = $this->conn->query($lot_list);
            $row_lot = $re_lot->fetch_assoc();
            $EL_export_lot = $row_lot['Lot_list_ID_t'];
      
            $sql_export_delivery = "INSERT INTO `rtc_export_lot`(id,EL_Order_ID,EL_export_lot,EL_quality,EL_green_type,
                        EL_bags_number,EL_net_weight,EL_Destination,EL_Additonal_comment,EL_Status_EMS,EL_Status,Created_by)
                        VALUES(null,'$EL_Order_ID','$EL_export_lot','$EL_quality','$EL_green_type','$EL_bags_number',
                        '$EL_net_weight','$EL_Destination','$EL_Additonal_comment','$EL_Status_EMS','$EL_Status','$created_by')";
            $result_export_delivery = $this->conn->query($sql_export_delivery);
            // echo $this->conn->error;
            // die();
            if($result_export_delivery){
                echo '<script>
                        setTimeout(function(){
                            window.location.href = "../views/rtc_prod_green";
                        }, 0);</script>';
            }else{
                echo $this->conn->error;
                header('location:../views/rtc_prod_green');
            }
        }
    }
    #####################################################################################
                # function of impoting the IT Tools for recording in Human resource 
    #####################################################################################
    public function Import_IT_Tools($post){
        $conn = mysqli_connect('localhost', 'root', '','rtc_online_services');
        $allowedFileType = ['application/vnd.ms-excel','text/xls','text/xlsx','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];
        if(in_array($_FILES["file"]["type"],$allowedFileType)){
            $targetPath = '../uploads/'.$_FILES['file']['name'];
            move_uploaded_file($_FILES['file']['tmp_name'], $targetPath);
            $Reader = new SpreadsheetReader($targetPath);
            $sheetCount = count($Reader->sheets());
            for($i=0;$i<$sheetCount;$i++){
                $Reader->ChangeSheet($i);
                foreach ($Reader as $Row){
                    $Device_Name = "";
                    if(isset($Row[0])) {
                        $Device_Name = mysqli_real_escape_string($conn,$Row[0]);
                    }
                    $Processor = "";
                    if(isset($Row[1])) {
                        $Processor = mysqli_real_escape_string($conn,$Row[1]);
                    }
                    $Memory_RAM = "";
                    if(isset($Row[2])) {
                        $Memory_RAM = mysqli_real_escape_string($conn,$Row[2]);
                    }
                    $Edition = "";
                    if(isset($Row[3])) {
                        $Edition = mysqli_real_escape_string($conn,$Row[3]);
                    }
                    $Serial_Number = "";
                    if(isset($Row[4])) {
                        $Serial_Number = mysqli_real_escape_string($conn,$Row[4]);
                    }
                    $Hardware_Device_ID = "";
                    if(isset($Row[5])) {
                        $Hardware_Device_ID = mysqli_real_escape_string($conn,$Row[5]);
                    }
                    $System_type = "";
                    if(isset($Row[6])) {
                        $System_type = mysqli_real_escape_string($conn,$Row[6]);
                    }
                    $IMEI = "";
                    if(isset($Row[7])) {
                        $IMEI = mysqli_real_escape_string($conn,$Row[7]);
                    }
                    $Received_at = "";
                    if(isset($Row[8])) {
                        $Received_at = mysqli_real_escape_string($conn,$Row[8]);
                    }
                    $Returned_at = "";
                    if(isset($Row[9])) {
                        $Returned_at = mysqli_real_escape_string($conn,$Row[9]);
                    }
                    $Device_Return_Condition = "";
                    if(isset($Row[10])) {
                        $Device_Return_Condition = mysqli_real_escape_string($conn,$Row[10]);
                    }
                    $User_Name = "";
                    if(isset($Row[11])) {
                        $User_Name = mysqli_real_escape_string($conn,$Row[11]);
                    }
                    $Station_name = "";
                    if(isset($Row[12])) {
                        $Station_name = mysqli_real_escape_string($conn,$Row[12]);
                    }
                    if (!empty($Device_Name) && !empty($User_Name) ) {
                        $registed_at = date('y-m-d');
                        $query = "INSERT INTO `rtc_it_tools`(Device_Name,Processor,Memory_RAM,Edition,Serial_Number,Hardware_Device_ID,System_type,IMEI,branch_ID,Received_at, Returned_at,Device_Return_Condition,User_Name,Station_name,registed_at,registered_by) 
                        values('".$Device_Name."','".$Processor."','".$Memory_RAM."','".$Edition."','".$Serial_Number."','".$Hardware_Device_ID."','".$System_type."','".$IMEI."','".$Received_at."','".$Returned_at."','".$Device_Return_Condition."','".$User_Name."','".$Station_name."','".$registed_at."','".$_SESSION['user_id'].")";
                        $result = mysqli_query($conn, $query);
                        if (!empty($result)) {
                            $type = "success";
                            $_SESSION['imported_it'] = '<strong class="alert alert-success">Excel Data Imported into the Database</strong>'.'<script>
                                setTimeout(function(){
                                    window.location.href = "rtc_it_tools";
                                }, 1000);
                            </script>';
                            header('location: rtc_it_tools');
                        }else {
                            $type = "error";
                            $_SESSION['imported_it'] ='                        
                                                    <strong class="alert alert-success">
                                                    Problem in Importing Excel Data</strong>
                                                '.$conn->error;
                            //header('location:../views/rtc_it_tools');                    
                        }
                    }
                }
        
            }
        }else{ 
            $type = "error";
            $message = "Invalid File Type. Upload Excel File.";
        }
    }
    #####################################################################################
                # function of insert the IT Tools data for recording in Human resource 
    #####################################################################################
    public function Register_IT_Tools($post){
        $Device_Name        = htmlspecialchars($_POST['Device_Name'], ENT_QUOTES);
        $Processor          = htmlspecialchars($_POST['Processor'], ENT_QUOTES);
        $Memory_RAM         = htmlspecialchars($_POST['Memory_RAM'], ENT_QUOTES);
        $Edition            = htmlspecialchars($_POST['Edition'], ENT_QUOTES);
        $Serial_Number      = htmlspecialchars($_POST['Serial_Number'], ENT_QUOTES);
        $Hardware_Device_ID = htmlspecialchars($_POST['Hardware_Device_ID'], ENT_QUOTES);
        $System_type        = htmlspecialchars($_POST['System_type'], ENT_QUOTES);
        $IMEI               = htmlspecialchars($_POST['IMEI'], ENT_QUOTES);
        $Received_at        = htmlspecialchars($_POST['Received_at'], ENT_QUOTES);
        $Device_Return_Condition  = htmlspecialchars($_POST['Device_Return_Condition'], ENT_QUOTES);
        $User_Name                = htmlspecialchars($_POST['User_Name'], ENT_QUOTES);
        $Station_name             = htmlspecialchars($_POST['Station_name'], ENT_QUOTES);
        $created_by               = $_SESSION['user_id'];

        $sql_it_tools = "INSERT INTO `rtc_it_tools`(Tool_Id ,Device_Name,Processor,Memory_RAM,Edition,
                        Serial_Number,Hardware_Device_ID,System_type,IMEI,Received_at,Device_Return_Condition,User_Name,Station_name,registered_by)
                        VALUES(null,'$Device_Name','$Processor','$Memory_RAM','$Edition','$Serial_Number',
                        '$Hardware_Device_ID','$System_type','$IMEI','$Received_at','$Device_Return_Condition','$User_Name','$Station_name','$created_by')";
        $result_it_tools = $this->conn->query($sql_it_tools);
        if($result_it_tools){
            echo '<script>
                    setTimeout(function(){
                        window.location.href = "../views/rtc_it_tools";
                    }, 0);</script>';
        }else{
            echo $this->conn->error;
            header('location:../views/rtc_it_tools');
        }
    }

}