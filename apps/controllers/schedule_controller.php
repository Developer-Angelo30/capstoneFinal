<?php
require_once("../validation/validation.php");
require_once("../models/schedule_model.php");

class ScheduleController extends Schedule{
    function manuallyCreateds($professorID, $subject , $section , $classroom, $day, $startClass , $endClass){
        $this->setProfessorID($professorID);
        $this->setSubject($subject);
        $this->setSection($section);
        $this->setClassroom($classroom);
        $this->setDay($day);
        $this->setStartClass($startClass);
        $this->setEndClass($endClass);
        return $this->ManuallyCreated();
    }
}

$action = $_POST['action'];

if(!empty($action)){
    $controller = new ScheduleController;
    if($action === "manuallyCreated"){
        echo $controller->manuallyCreateds(
                        $_POST['professorID'] , $_POST['subject'] , 
                        $_POST['section']  , $_POST['room'] ,
                        $_POST['day']  , $_POST['startClass'] , $_POST['endClass'] );
    }
}
else{
    return json_encode(array("status"=>false , "message"=>"There is a problem; please contact the developer."));
}



?>