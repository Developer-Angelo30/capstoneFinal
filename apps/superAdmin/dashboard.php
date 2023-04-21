<?php
session_start();
require_once("../database/connection.php");

if(isset($_SESSION['email']) && isset($_SESSION['password'])){
    $email = mysqli_real_escape_string(DB::DBConnection(), $_SESSION['email']);
    $password = mysqli_real_escape_string(DB::DBConnection(), $_SESSION['password']);

    $sql = "SELECT UserEmail , UserPassword, UserRole FROM users WHERE UserEmail = '$email' AND UserPassword = '$password'";
    $result = DB::DBConnection()->query($sql);

    if($result->num_rows > 0){
        $row = $result->fetch_assoc();
        if($row['UserRole'] == 0){
            header("location: ../admin/dashboard.php");
        }
    }else{
        header("location: ../logout.php");
    }
    DB::DBClose();
}
else{
    header("location: ../logout.php");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/dashboard-superadmin.css">
    <link rel="stylesheet" href="../../assets/fontawesome/css/all.css">
    <title>Schedlr</title>
</head>
<body>
    <section id="superadmin-dashboard">
        <!-- <div id="success-modal" >
            <div class="message-box">
                <div class="white">
                    <i  class="fa fa-check-circle" ></i>
                    <h1>Successfully Added.</h1>
                </div>
                <div class="blue">
                    <button class="success-btn" >OK</button>
                </div>
            </div>
        </div> -->
        <nav >
            <div id="navbar-open" class="div">
                <span class="span-image" >
                    <img src="../../assets/images/user.png" alt="">
                </span>
                <span>
                    <div class="span-data">
                        <h1>Prof. Angelo Reyes</h1>
                        <small>SUPER ADMIN</small>
                    </div>
                </span>
            </div>
            <div class="nav-content">
                <div class="user-data">
                <i id="close-navbar" class="fa fa-close" ></i>
                    <div class="gradient">
                        <div class="center" >
                            <center>
                                <img src="../../assets/images/user.png" alt="">
                                <h1>Prof. Angelo Reyes</h1>
                            </center>
                            <div class="center-data" >
                                <h5>SUPER ADMIN</h5>
                                <small>CICT DEPARTMENT</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
        <div class="sidebar">
            <div class="image-group">
                <img src="../../assets/images/icon.gif" height="80px" width="80px" alt="">
                <h1>Sche<strong>dlr</strong></h1>
            </div>
            <div class="ul-group">
                <ul>
                    <li class="home_show" ><i class="fa fa-home"></i><b> Home</b></li>
                    <li ><i class="fa fa-calendar-plus"></i><b> Create</b></li>
                    <li ><i class="fa fa-folder"></i><b> Manage</b></li>
                    <li ><i class="fa fa-calendar" ></i><b> Schedule Gallery</b></li>
                    <li ><i class="fa fa-th"  ></i><b> Available</b></li>
                    <li class="configure_show" ><i class="fa fa-wrench"></i><b> Configuration</b></li>
                </ul>
            </div>
            <a href="../logout.php"><i class="fa fa-sign-out" ><b> Logout</b></i></a>
        </div>
        <div class="content">
        <section id="home" >
    <h1>OVERVIEW</h1>
    <div class="row-up">
        <span class="box" >
            <span>
                <h1 class="" >6</h1>
                <strong>Total Professor</strong>
            </span>
        </span>
        <span class="box" >
            <span>
                <h1 class="" >6</h1>
                <strong>Total Subject</strong>
            </span>
        </span>
        <span class="box" >
            <span>
                <h1 class="" >6</h1>
                <strong>Total Admins</strong>
            </span>
        </span>
    </div>
    <div class="table-schedule-holder">
        <div class="collection-span">
            <span>1st year</span>
            <span>2nd year</span>
            <span>3rd year</span>
            <span>4th year</span>
            <span>5th year</span>
        </div>
        <div class="table-schedule-design-holder">
            <div class="table-schedule">
                <div class="collection-span-clip">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
                <div class="table-header">
                    <span>
                        <select name="" id="">
                            <option value="">BSIT-1A</option>
                            <option value="">BSIT-1A</option>
                            <option value="">BSIT-1A</option>
                        </select>
                    </span>
                    <span>MON</span>
                    <span>TUE</span>
                    <span>WED</span>
                    <span>THU</span>
                    <span>FRI</span>
                    <span>SAT</span>
                </div>
                <div class="table-fetch-row">
                    <table>
                        <tr>
                            <th>7:00 AM</th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr><tr>
                            <th>7:30 AM</th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                        <tr>
                            <th>8:00 AM</th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                        <tr>
                            <th>7:30 AM</th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                        <tr>
                            <th>9:00 AM</th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                        <tr>
                            <th>9:30 AM</th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                        <tr>
                            <th>10:00 AM</th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                        <tr>
                            <th>10:30 AM</th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                        <tr>
                            <th>11:00 AM</th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                        <tr>
                            <th>11:30 AM</th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                        <tr>
                            <th colspan="7">LUNCH BREAK</th>
                        </tr>
                        <tr>
                            <th>1:00 PM</th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                        <tr>
                            <th>1:30 PM</th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                        <tr>
                            <th>2:00 PM</th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                        <tr>
                            <th>2:30 PM</th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                        <tr>
                            <th>3:00 PM</th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                        <tr>
                            <th>3:30 PM</th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                        <tr>
                            <th>4:00 PM</th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                        <tr>
                            <th>4:30 PM</th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                        <tr>
                            <th>5:00 PM</th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                        <tr>
                            <th>5:30 PM</th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                        <tr>
                            <th>6:00 PM</th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                        <tr>
                            <th>6:30 PM</th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                        <tr>
                            <th>7:00 PM</th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                        <tr>
                            <th>7:30 PM</th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </table>
                </div>
            </div>
            
        </div>
    </div>
</section>
        </div>
    </section>
    <script src="../../assets/js/jquery-3.6.4.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../../assets/js/demo.js"></script>
    <script>
        $(document).ready(()=>{

            const showNavbar = () =>{
                $(document).on('click', "#navbar-open", ()=>{
                    $('.nav-content').css({"display":"block"})
                })
            }
            showNavbar()
            
            const close = () =>{
                $(document).on('click',"#close-navbar", ()=>{
                    $('.nav-content').css({"display":"none"})

                })
            }
            close()
        })
    </script>
</body>
</html>