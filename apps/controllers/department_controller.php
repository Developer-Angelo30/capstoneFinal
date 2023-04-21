<?php
require_once("../validation/validation.php");
require_once("../models/department_model.php");
class DepartmentController extends Department {

    function createDepartments($departments , $names){
        $arrays = array_combine($departments, $names);
        
        foreach($arrays as $department=>$name ){
            $slot = 1;    
            if(empty($department)){
                return json_encode(array("status"=>false , "message"=>"slot# {$slot}, Department Fields are empty."));
            }
            else if(empty($name)){
                return json_encode(array("status"=>false , "message"=>"slot# {$slot}, Deparment Fullname Fields are empty."));
            }else{
                //check if validate string

                if(!validation::AlphaSpace($department)){
                    die(json_encode(array("status"=>false , "message"=>"slot# {$slot}, Deparment, accept alpha and whitespace only!")));
                }
                else if(!validation::AlphaSpace($name)){
                    die(json_encode(array("status"=>false ,"message"=>"slot# {$slot}, Deparment Fullname accept alpha and whitespace only!")));
                }
            }

            $slot += 1;
        }

        // check if there duplication in department
        for ($i = 0; $i < count($departments); $i++) {
            $slotDuplicate = $i + 1;
            for ($j = $i + 1; $j < count($departments); $j++) {
                if ($departments[$i] == $departments[$j]) {
                    $Duplicate = $j + 1;
                    die(json_encode(array("status"=>false , "message"=>"Slot #{$slotDuplicate} : {$departments[$i]} - slot#{$Duplicate} : {$departments[$j]}")));
                }
            }
        }

        // check if there duplication in department
        for ($i = 0; $i < count($names); $i++) {
            $slotDuplicate = $i + 1;
            for ($j = $i + 1; $j < count($names); $j++) {
                if ($names[$i] == $names[$j]) {
                    $Duplicate = $j + 1;
                    die(json_encode(array("status"=>false , "message"=>"Slot #{$slotDuplicate} : {$names[$i]} - slot#{$Duplicate} : {$names[$j]}"))) ;
                }
            }
        }

        $this->setArray($arrays);
        return $this->createDepartment();

    }

    function deleteDepartments($id){
        $this->setCode($id);
        return $this->deleteDepartment();
    }

    function updateDepartments($departments , $names){
        

        if(empty($departments) && empty($names)){
            return json_encode(array("status"=>false, "message"=>"Inputs are empty!"));
        }

        $arrays = array_combine($departments, $names);
        $this->setArray($arrays)
;       return $this->updateDepartment();

    }

}

$action = $_POST['action'];

if(!empty($action)){
    $controller = new DepartmentController;
    if($action == "createDepartments"){
        echo $controller->createDepartments($_POST['add-department'], $_POST['add-departmentName']);
    }
    else if($action == "deleteDepartments"){
        echo $controller->deleteDepartments($_POST['id']);
    }
    else if($action == "updateDepartments"){
        echo $controller->updateDepartments($_POST['update-department'], $_POST['update-departmentName']);
    }
}
else{
    return json_encode(array("status"=>false , "message"=>"There is a problem; please contact the developer."));
}

?>