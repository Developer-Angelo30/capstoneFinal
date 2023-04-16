<?php
include_once('../models/classroom_model.php');
include_once("../validation/validation.php");

class ClassroomController extends Classroom {

    function createClassrooms($rooms , $types){

        foreach($rooms as $key=>$room){
            $slot = $key + 1;

            if(!empty($room)){
                if($types[$key] != "Lecture" && $types[$key] != "Laboratory" ){
                    return json_encode(array("status"=>false, "message"=>"Slot#{$slot}, Do not edit inspect element!."));
                }

                if(!validation::Numeric($room)){
                    return json_encode(array("status"=>false, "Slot#{$slot}, Accept only a classroom number."));
                } 

            }
            else{
                return json_encode(array("status"=>false, "message"=>"Slot#{$slot} , Please input a classroom number."));
            }

        }

        // check if there duplication
        for ($i = 0; $i < count($rooms); $i++) {
            $slotDuplicate = $i + 1;
            for ($j = $i + 1; $j < count($rooms); $j++) {
                if ($rooms[$i] == $rooms[$j]) {
                    $Duplicate = $j + 1;
                    return json_encode(array("status"=>false , "message"=>"Slot #{$slotDuplicate} : {$rooms[$i]} - slot#{$Duplicate} : {$rooms[$j]}"));
                }
            }
        }

        //check if there duplication
        for ($i = 0; $i < count($rooms); $i++) {
            for ($j = $i + 1; $j < count($rooms); $j++) {
                if ($rooms[$i] == $rooms[$j]) {
                    return "Slot #{$i} : " . $rooms[$i] . "\n";
                }
            }
        }

        $array = array_combine($rooms, $types);
        $this->setArray($array);
        return $this->createClassRoom();

    }

    function deleteClassRooms($classroomNumber){
        $this->setID($classroomNumber);
        return $this->deleteClassRoom();
    }

}

$action = $_POST['action'];


if(!empty($action)){

    $control = new ClassroomController;

    if($action === "createClassrooms"){
       echo $control->createClassrooms($_POST['add-classroom-number'], $_POST['add-classroom-type']);
    }
    else if($action === "deleteClassRooms"){
        echo $control->deleteClassRooms($_POST['id']);
    }

}
else{
    return json_encode(array("status"=>false , "message"=>"There is a problem; please contact the developer."));
}


?>