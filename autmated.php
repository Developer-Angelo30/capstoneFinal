<?php
require_once("./apps/database/connection.php");


$ProfessorID = 1;
$subjectCode = "CC-101";
$classroom  = 107;
$section = "BSIT-1A";
$day = "Mon";
$startClass = 5;
$endClass = 7;

$timeFrame = 0;

    //      array(7,7,8,8,9,9,10,10,11,11,12,12, 1, 1, 2, 2, 3, 3, 4, 4, 5, 5, 6, 6, 7, 7, 8);
    //      array(1,2,3,4,5,6, 7, 8, 9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27);
    $time = array(0,0,0,0,0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);



    for($i = 1; $i < 27; $i++){

            if(($i >= $startClass) && ($i <= $endClass) ){
                $time[$i] = 1;
                $timeFrame++;
            }
            else{
                $time[$i] = 0;
            }

            // $time[11] = 1;
            // $time[12] = 1;
    }

    $db_time = array(0,0,0,0,0,0, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

    $check = 0;

    for($k = 1; $k < 27; $k++){
        if($time[$k] == 1){

            if($db_time[$k] == 1){
                
                if($startClass == $k){
                    echo "success<br>";
                    $check++;
                }else if($endClass == $k){
                    echo "success<br>";
                    $check++;
                }
                else{
                    echo "TIme conflict<br>";
                }
            }
            else{
                echo "success<br>";
                $check++;
            }
        }
    }

    if($check == $timeFrame){
        echo "<br><br>push<br>";
    }
    else{
        echo "You have a conlict in ".timeConverter($startClass)."-".timeConverter($endClass);
        echo "<br><br>time conflict<br>";
    }

    echo "FROM USER INPUT<br>";
    foreach($time as $convert){
        echo $convert.",";
    }
    echo "<br><br>";
    echo "FROM DB<br>";
    foreach($db_time as $convert){
        echo $convert.",";
    }


    function timeConverter($time){
        switch($time){
            case 1:{
                return "7:00 AM";
            }
            case 2:{
                return "7:30 AM";
            }
            case 3:{
                return "8:00 AM";
            }
            case 4:{
                return "8:30 AM";
            }
            case 5:{
                return "9:00 AM";
            }
            case 6:{
                return "9:30 AM";
            }
            case 7:{
                return "10:00 AM";
            }
            case 8:{
                return "10:30 AM";
            }
            case 9:{
                return "11:00 AM";
            }
            case 10:{
                return "11:30 AM";
            }
            case 11:{
                return "12:00 NN";
            }
            case 12:{
                return "12:30 PM";
            }
            case 13:{
                return "1:00 PM";
            }
            case 14:{
                return "1:30 PM";
            }
            case 15:{
                return "2:00 PM";
            }
            case 16:{
                return "2:30 PM";
            }
            case 17:{
                return "3:00 PM";
            }
            case 18:{
                return "3:30 PM";
            }
            case 19:{
                return "4:00 PM";
            }
            case 20:{
                return "4:30 PM";
            }
            case 21:{
                return "5:00 PM";
            }
            case 22:{
                return "5:30 PM";
            }
            case 23:{
                return "6:00 PM";
            }
            case 24:{
                return "6:30 PM";
            }
            case 25:{
                return "7:00 PM";
            }
            case 26:{
                return "7:30 PM";
            }
            case 27:{
                return "8:00 PM";
            }
        }
    }



?>