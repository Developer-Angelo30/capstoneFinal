<?php
require_once("../models/subject_model.php");
require_once("../validation/validation.php");

class SubjectController extends Subject {

    function createSubjects($codes , $names , $years, $semesters ,$laboratories){
        
        //check if not empty 
        foreach($codes as $key=>$code){
            $slot = $key +1;

            if(empty($code)){
                return json_encode(array("status"=>false, "Slot#{$slot}, Subject Code is empty field!"));
            }
            else{
                if(strlen($code) > 10){
                    return json_encode(array("status"=>false, "Slot#{$slot}, Subject Code maximun lenght must be 10 letters."));
                }
            }

            if(empty($names[$key])){
                return json_encode(array("status"=>false, "Slot#{$slot}, Subject Name is empty field!"));
            }

            if($years[$key] != 1 && $years[$key] != 2 && $years[$key] != 3 && $years[$key] != 4 && $years[$key] != 5 ){
                return "Slot#{$slot} year selection, The inspect element must not be modified!";
            }

            if($semesters[$key] != 1 && $semesters[$key] != 2){
                return "Slot#{$slot} selection semester, The inspect element must not be modified!";
            }

            if($laboratories[$key] != 0 && $laboratories[$key] != 1){
                return "Slot#{$slot} selection laboratory, The inspect element must not be modified!";
            }
        }

        // check if there duplication code
        for ($i = 0; $i < count($codes); $i++) {
            $slotDuplicate = $i + 1;
            for ($j = $i + 1; $j < count($codes); $j++) {
                if ($codes[$i] == $codes[$j]) {
                    $Duplicate = $j + 1;
                    return json_encode(array("status"=>false , "message"=>"Slot #{$slotDuplicate} : {$codes[$i]} - slot#{$Duplicate} : {$codes[$j]}"));
                }
            }
        }

        $this->setCode($codes);
        $this->setName($names);
        $this->setYear($years);
        $this->setSemester($semesters);
        $this->setLaboratory($laboratories);
        return $this->createSubject();

    }

    function deleteSubjects($id){

        if(empty($id)){
            return json_encode(array("status"=>false , "message"=>"The inspect element must not be modified!"));
        }
        $this->setID($id);
        return $this->deleteSubject();
    }
}

$action = $_POST['action'];

if(!empty($action)){
    $controller = new SubjectController;
    if($action == "createSubjects"){
        echo $controller->createSubjects($_POST['add-code'], $_POST['add-name'], $_POST['add-year'], $_POST['add-semester'], $_POST['add-laboratory']);
    }else if($action == "deleteSubjects"){
        echo $controller->deleteSubjects($_POST['id']);
    }
}

?>