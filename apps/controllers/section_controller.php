<?php
include_once('../models/section_model.php');
include_once("../validation/validation.php");

class SectionController extends Section {

    function createSubjects ($sections , $yearLevels){
        
        //validate number in sectionss and check empty fields
        foreach($sections as $key => $section){
            $slot = $key + 1;
            if(!empty($section)){

                if($yearLevels[$key] != 1 && $yearLevels[$key] != 2 && $yearLevels[$key] != 3 && $yearLevels[$key] != 4 && $yearLevels[$key] != 5 ){
                    return "Slot#{$slot}, The inspect element must not be modified!";
                }
    
                if(!validation::Numeric($yearLevels[$key])){
                    return json_encode(array("status"=>false, "Slot#{$slot}, Number Only."));
                }

            }
            else{
                return json_encode(array("status"=>false , "message"=>"Slot#{$slot} , Please input a section name."));
            }
        }

        // check if there duplication
        for ($i = 0; $i < count($sections); $i++) {
            $slotDuplicate = $i + 1;
            for ($j = $i + 1; $j < count($sections); $j++) {
                if ($sections[$i] == $sections[$j]) {
                    $Duplicate = $j + 1;
                    return json_encode(array("status"=>false , "message"=>"Slot #{$slotDuplicate} : {$sections[$i]} - slot#{$Duplicate} : {$sections[$j]}"));
                }
            }
        }

        $array = array_combine($sections, $yearLevels);
        $this->setArray($array);
        return $this->createSection();

    }

    function deleteSections($id){

        if(!validation::Numeric($id)){
            return json_encode(array("status"=>false , "message"=>"The inspect element must not be modified!"));
        }
        $this->setID($id);
        return $this->deleteSection();
    }

    function updateSections($id , $sections , $years){

        if( empty($id) && empty($sections) && empty($years)){
            return json_encode(array("status"=>true , "message"=>"Input fields are empty!"));
        }

        $this->setArray(array($id, $sections , $years));
        return $this->updateSection();

    }

}

$action = $_POST['action'];

if(!empty($action)){
    $controller = new SectionController;
    if($action === "createSections"){
        echo $controller->createSubjects($_POST['add-section'] , $_POST['add-year'] );
    }
    else if($action == "deleteSections"){
        echo $controller->deleteSections($_POST['id']);
    }
    else if($action == "updateSections"){
        echo $controller->updateSections($_POST['update-id'], $_POST['update-section'], $_POST['update-year']);
    }
}
else{
    return json_encode(array("status"=>false , "message"=>"There is a problem; please contact the developer."));
}


?>