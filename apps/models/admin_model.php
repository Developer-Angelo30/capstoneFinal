<?php
session_start();
require_once("../validation/validation.php");
include_once("../database/connection.php");

class Admin{

    protected $email;
    protected $password;

    protected function login(){

        $email = mysqli_real_escape_string(DB::DBConnection(), $this->getEmail());
        $password = mysqli_real_escape_string(DB::DBConnection(), $this->getPassword());
        if(!empty($email)){
            if(!empty($password)){
                if(validation::Email($email)){
                     $sql = "SELECT `UserEmail` , `UserPassword` , `UserRole` FROM `users` WHERE `UserEmail` = '$email' ";
                     $result = DB::DBConnection()->query($sql);
                     if($result->num_rows > 0){
                        $row = $result->fetch_assoc();
                        if(password_verify($password,$row['UserPassword'] )){
                            
                            $_SESSION['email'] = $email;
                            $_SESSION['password'] = $row['UserPassword'];

                            $output = ($row['UserRole'] == 1 )? json_encode(array('status'=>true , "message"=>"./superAdmin/dashboard.php")) :  json_encode(array('status'=>true , "message"=>"./admin/dashboard.php"));
                        }
                        else{
                            $output = json_encode(array("status"=>false , "error"=>"password" , "message"=>"Password not matched."));
                        }
                     }
                     else{
                        $output = json_encode(array("status"=>false , "error"=>"email" ,"message"=>"Please double check your email."));
                     }
                }
                else{
                    $output = json_encode(array("status"=>false , "error"=>"email" ,"message"=>"Please input valid email address."));
                }
            }
            else{
                $output = json_encode(array("status"=>false , "error"=>"password" , "message"=>"Please input password."));
            }
        }
        else{
            $output = json_encode(array("status"=>false , "error"=>"email" ,"message"=>"Please input email address."));
        }

        DB::DBClose();
        return $output;
    }

    protected function setEmail($email){
        $this->email = $email;
    }

    protected function getEmail(){
        return $this->email;
    }

    protected function setPassword($password){
        $this->password = $password;
    }

    protected function getPassword(){
        return $this->password;
    }

}

?>