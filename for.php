<?php

require_once("./apps/database/connection.php");

$ProfessorID = 1;
$subjectCode = "ITMS-01";
$section = 20;
$classroom  = 101;
$day = "Mon";
$startClass = 7;
$endClass = 10;


$useLoad  = 0;
$countOne = 1;
        
// calculate useLoad
$useLoad_sql = "SELECT ScheduleStartClass , ScheduleEndClass FROM schedules WHERE ScheduleProfessor = '$ProfessorID'";
$useLoad_result = DB::DBConnection()->query($useLoad_sql);
        
if($useLoad_result->num_rows> 0){
    $calculate = array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
    while($useLoad_row = $useLoad_result->fetch_assoc()){
        for($i = 1; $i < 27; $i++){

            if(($i >= $useLoad_row['ScheduleStartClass'] ) && ($i <= $useLoad_row['ScheduleEndClass'] ) ){
                $calculate[$i] = 1;
                echo "loop:".$countOne."<br>";
                $countOne++;
                
            }
            else{
                if($calculate[$i] != 1 ){
                    $calculate[$i] = 0;
                }
            }
        }
    }
    $useLoad += countCoverter($countOne);
}

echo "UseLoad: ".$useLoad."<br>";
echo $countOne;

// -------

$sql = "SELECT professors.* , professorranking.ProfessorLoad , subjects.* , sections.*  , classrooms.* FROM professors INNER JOIN professorranking ON professorranking.ProfessorRank = professors.ProfessorRank , subjects , sections ,classrooms  WHERE ProfessorID = '$ProfessorID'";
$result = DB::DBConnection()->query($sql);

if($result->num_rows > 0){
    $row = $result->fetch_assoc();

    $load = $row['ProfessorLoad'];
    $has_designated = $row['Professor_has_designation'];
    $has_lab = $row['Subject_has_laboratory'];
    $roomType = $row['ClassroomType'];

    $DBSchedule = array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
    
    $DBDate_sql = "SELECT * FROM schedules WHERE  ScheduleClassroom = '$classroom' AND ScheduleSection = '$section' AND ScheduleDay = '$day' ";
    $DBDate_result = DB::DBConnection()->query($DBDate_sql);

    if($result->num_rows > 0){
        while($DBDate_row = $DBDate_result->fetch_assoc()){
            for($i = 0; $i < 27; $i++){

                if(($i >= $DBDate_row['ScheduleStartClass'] ) && ($i <= $DBDate_row['ScheduleEndClass']) ){
                    $DBSchedule[$i] = 1;
                }
                else{
                    if($DBSchedule[$i] != 1 ){
                        $DBSchedule[$i] = 0;
                    }
                }
    
            }
        }
    }
    
    // DB SCHEDULE DISPLAY
    echo"SCHEDULE DATABASE<br>";
    foreach($DBSchedule as $schedule){
        echo $schedule.",";
    }
    echo "<br><br>";

    // Convert Input to Schedule
    $InputSchedule = array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
    $InputChecker = 0;
    for($i = 0; $i < 27; $i++){

        if(($i >= $startClass) && ($i <= $endClass) ){
            $InputSchedule[$i] = 1;
            $InputChecker++;
        }
        else{
            $InputSchedule[$i] = 0;
        }
    }

    // INPUT SCHEDULE DISPLAY
    echo"SCHEDULE INPUT <br>";
    foreach($InputSchedule as $schedule){
        echo $schedule.",";
    }
    echo "<br><br>";

    // compare ScheduleInput and ScheduleDB;
    $check = 0;
    for($i = 0; $i < 27; $i++){
        if($InputSchedule[$i] == 1){

            if($DBSchedule[$i] == 1){
                
                if($startClass == $i){
                    // echo "success<br>";
                    $check++;
                }else if($endClass == $i){
                    // echo "success<br>";
                    $check++;
                }
                else{
                    // echo "TIme conflict<br>";
                }
            }
            else{
                // echo "success<br>";
                $check++;
            }
        }
    }

    if($check == $InputChecker){
        
            // INPUT SCHEDULE DISPLAY
            echo"SCHEDULE CALCULATE <br>";
            foreach($InputSchedule as $schedule){
                echo $schedule.",";
            }
            echo "<br>";

    

        // check designated 
        if($has_designated == 1){
            $load = 10;
        }

            echo "useLoad: ".$useLoad."<br>";
            echo "load: ".$load."<br>";

        // check if load not meet condition
        if($useLoad >= $load){
            echo "Meet Load ty!";
        }
        else{

            $sql_check = "SELECT * FROM schedules WHERE  ScheduleClassroom = '$classroom' AND ScheduleSection = '$section' AND ScheduleDay = '$day' AND ScheduleStartClass = '$startClass' AND ScheduleEndClass = '$endClass' AND ScheduleDeleted = 1 ;";
            $result_check = DB::DBConnection()->query($sql_check);
            if($result_check->num_rows == 0){
                $sql = "INSERT INTO `schedules`( 
                    `ScheduleProfessor`, 
                    `ScheduleSubject`, 
                    `ScheduleClassroom`, 
                    `ScheduleSection`, 
                    `ScheduleDay`, 
                    `ScheduleStartClass`, 
                    `ScheduleEndClass`, 
                    `ScheduleDeleted`
                ) VALUES (
                    '$ProfessorID',
                    '$subjectCode',
                    '$classroom',
                    '$section', 
                    '$day',
                    '$startClass' , 
                    '$endClass',
                    1
                )";

                $result = DB::DBConnection()->query($sql);
                if($result){
                    echo "Load: ". $load."<br>";
                    echo "my load: ".$useLoad."<br>";
                    echo "success";
                }
            }
            else{
                echo "Classroom: {$classroom}<br>";
                echo "Section: {$section}<br>";
                echo "You have a conflict in ".timeConverter($startClass)."-".timeConverter($endClass);
            }

        }
    }
    else{
        echo "Classroom: {$classroom}<br>";
        echo "Section: {$section}<br>";
        echo "You have a conflict in ".timeConverter($startClass)."-".timeConverter($endClass);
    }
}


    function timeConverter($time){
        switch($time){
            case 0:{
                return "7:00 AM";
            }
            case 1:{
                return "7:30 AM";
            }
            case 2:{
                return "8:00 AM";
            }
            case 3:{
                return "8:30 AM";
            }
            case 4:{
                return "9:00 AM";
            }
            case 5:{
                return "9:30 AM";
            }
            case 6:{
                return "10:00 AM";
            }
            case 7:{
                return "10:30 AM";
            }
            case 8:{
                return "11:00 AM";
            }
            case 9:{
                return "11:30 AM";
            }
            case 10:{
                return "12:00 NN";
            }
            case 11:{
                return "12:30 PM";
            }
            case 12:{
                return "1:00 PM";
            }
            case 13:{
                return "1:30 PM";
            }
            case 14:{
                return "2:00 PM";
            }
            case 15:{
                return "2:30 PM";
            }
            case 16:{
                return "3:00 PM";
            }
            case 17:{
                return "3:30 PM";
            }
            case 18:{
                return "4:00 PM";
            }
            case 19:{
                return "4:30 PM";
            }
            case 20:{
                return "5:00 PM";
            }
            case 21:{
                return "5:30 PM";
            }
            case 22:{
                return "6:00 PM";
            }
            case 23:{
                return "6:30 PM";
            }
            case 24:{
                return "7:00 PM";
            }
            case 25:{
                return "7:30 PM";
            }
            case 26:{
                return "8:00 PM";
            }
        }
    }

    function countCoverter($time){
        switch($time){
            case 1:{
                return 0;
            }
            case 2:{
                return 0.30;
            }
            case 3:{
                return 1;
            }
            case 4:{
                return 1.30;
            }
            case 5:{
                return 2;
            }
            case 6:{
                return 2.30;
            }
            case 7:{
                return 3;
            }
            case 8:{
                return 3.30;
            }
            case 9:{
                return 4;
            }
            case 10:{
                return 4.30;
            }
            case 11:{
                return 5;
            }
            case 12:{
                return 5.30;
            }
            case 13:{
                return 6;
            }
            case 14:{
                return 6.30;
            }
            case 15:{
                return 7;
            }
            case 16:{
                return 7.30;
            }
            case 17:{
                return 8;
            }
            case 18:{
                return 8.30;
            }
            case 19:{
                return 9;
            }
            case 20:{
                return 9.30;
            }
            case 21:{
                return 10;
            }
            case 22:{
                return 10.30;
            }
            case 23:{
                return 11;
            }
            case 24:{
                return  11.30;
            }
            case 25:{
                return 12;
            }
            case 26:{
                return  12.30;
            }
            case 27:{
                return  13;
            }
        }
    }


?>