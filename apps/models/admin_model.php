<?php
session_start();
date_default_timezone_set("Asia/Manila");
require_once("../validation/validation.php");
include_once("../database/connection.php");

class Admin{

    protected $email;
    protected $password;

    protected function login(){

        $email = mysqli_real_escape_string(DB::DBConnection(), $this->getEmail());
        $password = mysqli_real_escape_string(DB::DBConnection(), $this->getPassword());

        $output = null;

        if(!empty($email)){
            if(!empty($password)){
                if(validation::Email($email)){
                     $sql = "   SELECT 
                                    users.UserID as id,
                                    users.UserEmail as email,
                                    users.UserPassword as password , 
                                    users.UserRole as role ,
                                    login_attempts.UserAttempt as attempt,
                                    login_attempts.UserLast_attempt as lastAttempt
                                FROM `users` 
                                INNER JOIN login_attempts 
                                ON login_attempts.UserID = users.UserID 
                                WHERE users.UserEmail = '$email' AND users.UserDeleted = 1;";
                     $result = DB::DBConnection()->query($sql);
                     $row = $result->fetch_assoc();
                     if($result->num_rows > 0){

                        $curentDate = date("Y-m-d H:i");
                        $newDate = strtotime($curentDate)+ (3 * 60) ;
                        $dbdate = date("Y-m-d H:i", $newDate);
                        $attempt_reset = 3;
                        $attempt_minus = $row['attempt'] - 1;

                        $sql_reset_attempt = "UPDATE `login_attempts` SET `UserAttempt`='$attempt_reset' WHERE  UserID = '$row[id]'";
                        $sql_update_attempt = "UPDATE `login_attempts` SET `UserAttempt`='$attempt_minus',`UserLast_attempt`='$dbdate' WHERE  UserID = '$row[id]'";

                        if(password_verify($password,$row['password'])){

                            if($row['attempt'] != 0 ){
                                $result_reset_attempt = DB::DBConnection()->query($sql_reset_attempt);
                                if($result_reset_attempt){
                                    $_SESSION['email'] = $row['email'];
                                    $_SESSION['password'] = $row['password'];
                                    $output = ($row['role'] == 1 )? json_encode(array('status'=>true , "message"=>"./superAdmin/dashboard.php")) :  json_encode(array('status'=>true , "message"=>"./admin/dashboard.php"));
                                }
                            }
                            else{
                                if(strtotime($curentDate) >= strtotime($row['lastAttempt'])){
                                    $result_reset_attempt = DB::DBConnection()->query($sql_reset_attempt);
                                    if($result_reset_attempt){
                                        $_SESSION['email'] = $row['email'];
                                        $_SESSION['password'] = $row['password'];
                                        $output = ($row['role'] == 1 )? json_encode(array('status'=>true , "message"=>"./superAdmin/dashboard.php")) :  json_encode(array('status'=>true , "message"=>"./admin/dashboard.php"));
                                    }
                                }
                                else{
                                    $output = json_encode(array("status"=>false , "error"=>"date" ,"message"=>"Please try again in ".date('h:i A', strtotime($row['lastAttempt']))));
                                }
                            }
                        }
                        else{
                            if($row['attempt'] != 0){
                                
                                $result_update_attempt = DB::DBConnection()->query($sql_update_attempt);
                                if($result_update_attempt){
                                    $output = json_encode(array("status"=>false , "error"=>"password" ,"message"=>"Password is not matched!"));
                                }
                            }
                            else{
                                if(strtotime($curentDate) >= strtotime($row['lastAttempt'])){
                                    $result_reset_attempt = DB::DBConnection()->query($sql_reset_attempt);
                                    if($result_reset_attempt){

                                        $result_update_attempt = DB::DBConnection()->query($sql_update_attempt);
                                        if($result_update_attempt){
                                            $output = json_encode(array("status"=>false , "error"=>"password" ,"message"=>"Password is not matched!"));
                                        }
                                    }
                                }
                                else{
                                    $output = json_encode(array("status"=>false , "error"=>"date" ,"message"=>"Your reach maximun attempt, Please try again in ".date('h:i A', strtotime($row['lastAttempt']))));
                                }
                            }
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