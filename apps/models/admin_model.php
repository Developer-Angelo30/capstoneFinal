<?php
session_start();
include_once("../database/connection.php");
include_once("../validation/validation.php");

class Admin{
    protected function login($_email, $_password){

        $email = mysqli_real_escape_string(DB::DBConnection(), $_email);
        $password = mysqli_real_escape_string(DB::DBConnection(), $_password);
        if(!empty($email)){
            if(!empty($password)){
                if(validation::Email($email)){
                     $sql = "SELECT `adminEmail` , `adminPassword` , `roleID` FROM `admins` WHERE `adminEmail` = '$email' ";
                     $result = mysqli_query(DB::DBConnection(), $sql);
                     if($result->num_rows > 0){
                        $row = $result->fetch_assoc();
                        if(password_verify($password,$row['adminPassword'] )){
                            
                            $_SESSION['email'] = $email;
                            $_SESSION['role'] = $row['roleID'];

                            DB::DBClose();

                            return ($row['roleID'] == 1 )? json_encode(array('status'=>true , "message"=>"./superAdmin/dashboard.php")) :  json_encode(array('status'=>true , "message"=>"./admin/dashboard.php"));
                        }
                        else{
                            return json_encode(array("status"=>false , "error"=>"password" , "message"=>"Password not matched."));
                        }
                     }
                     else{
                        return json_encode(array("status"=>false , "error"=>"email" ,"message"=>"Please double check your email."));
                     }
                }
                else{
                    return json_encode(array("status"=>false , "error"=>"email" ,"message"=>"Please input valid email address."));
                }
            }
            else{
                return json_encode(array("status"=>false , "error"=>"password" , "message"=>"Please input password."));
            }
        }
        else{
            return json_encode(array("status"=>false , "error"=>"email" ,"message"=>"Please input email address."));
        }
    }

}

?>