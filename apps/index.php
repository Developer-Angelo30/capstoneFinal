<?php
session_start();
require_once("./database/connection.php");

// print_r($_SESSION);

if(isset($_SESSION['email']) && isset($_SESSION['password'])){
    $email = mysqli_real_escape_string(DB::DBConnection(), $_SESSION['email']);
    $password = mysqli_real_escape_string(DB::DBConnection(), $_SESSION['password']);

    $sql = "SELECT UserEmail , UserPassword, UserRole FROM users WHERE UserEmail = '$email' AND UserPassword = '$password' ";
    $result = DB::DBConnection()->query($sql);

    if($result->num_rows > 0){
        $row = $result->fetch_assoc();
        if($row['UserRole'] == 1 ){
            header("location: ./superAdmin/dashboard.php");
        }
        else{
            header("location: ./admin/dashboard.php");
        }
    }

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/styles-login.css">
    <link rel="stylesheet" href="../assets/fontawesome/css/all.css">
    <title>Schedlr</title>
</head>
<body>
    <section id="login-section">
        <div class="center-box">
            <div class="left">
                <span class="yellow" ></span>
                <div class="orange">
                    <h5 ><span>Sc</span>hedlr</h5>
                    <img src="../assets/images/schedule-icon.JPG" alt="schedule-iamge">
                </div>
                <span class="blue" ></span>
            </div>
            <div class="right">
                <span class="yellow" ></span>
                <span class="orange"></span>
                <div class="white">
                    <form id="formLogin" action="../apps/views/admin_view.php" method="POST">
                       <center>
                        <img src="../assets/images/icon.gif" alt="logo-neust">
                        <h4>ADMINISTRATOR</h4>
                       </center> <hr>
                        <div class="form-group">
                            <input type="text" name="login-email" placeholder="Email" id="login-email">
                            <i class="fa fa-envelope"></i>
                        </div>
                        <small class="error-email" >error message</small>
                        <div class="form-group">
                            <input type="password" name="login-password" placeholder="Password" id="login-password">
                            <i class="fa fa-eye"></i>
                        </div>
                        <small class="error-password" >error message</small>
                        <br>
                        <button type="submit" class="btn-loginform" >Login <i  class="fa fa-arrow-right "></i></button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <script src="../assets/js/jquery-3.6.4.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../assets/js/demo.js"></script>
</body>
</html>