<?php
session_start();

if(!isset($_SESSION['email']) && !isset($_SESSION['role'])){
    header("location: ../index.php");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/styles-dashboard.css">
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
                        <small>SuperAdmin</small>
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
                                <h5>SuperAdmin</h5>
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
                    <li ><i class="fa fa-home"></i><b> Home</b></li>
                    <li ><i class="fa fa-calendar-plus"></i><b> Create</b></li>
                    <li ><i class="fa fa-folder"></i><b> Manage</b></li>
                    <li ><i class="fa fa-calendar" ></i><b> Schedule Gallery</b></li>
                    <li ><i class="fa fa-th"  ></i><b> Available</b></li>
                    <li class="configure_show" ><i class="fa fa-wrench"></i><b> Configuration</b></li>
                </ul>
            </div>
            <a href="#"><i class="fa fa-sign-out" ><b> Logout</b></i></a>
        </div>
        <div class="content">
            
        </div>
    </section>
    <script src="../../assets/js/jquery-3.6.4.js"></script>
    <script src="../../assets/js/customs.js"></script>
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