<?php
require_once("../models/department_model.php");
require_once("../validation/validation.php");

class DepartmentVew extends Department {

    function readDepartments(){
        return $this->readDepartment();
    }

    function updateDepartmentShows($code){
        $this->setCode($code);
        return $this->updateDepartmentShow();
    }

    function searchDepartments($code){
        $this->setCode($code);
        return $this->searchDepartment();
    }

}

$action = $_POST['action'];

if(!empty($action)){
    $view = new DepartmentVew;
    if($action == "readDepartments"){
        echo $view->readDepartments();
    }
    else if($action == "searchDepartments"){
        echo $view->searchDepartments($_POST['code']);
    }
    else if($action == "updateDepartmentShows"){
        echo $view->updateDepartmentShows($_POST['code']);
    }
}
else{
    die(array("status"=>false , "message"=>"There is a problem; please contact the developer."));
}

?>