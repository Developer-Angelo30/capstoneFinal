<?php
require_once("../models/department_model.php");
require_once("../validation/validation.php");

class DepartmentVew extends Department {

    function readDepartments(){
        return $this->readDepartment();
    }

}

$action = $_POST['action'];

if(!empty($action)){
    $controller = new DepartmentVew;
    if($action == "readDepartments"){
        echo $controller->readDepartments();
    }
}
else{
    die(array("status"=>false , "message"=>"There is a problem; please contact the developer."));
}

?>