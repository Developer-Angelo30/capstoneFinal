<?php
require_once("../validation/validation.php");
require_once("../models/professor_model.php");

class ProfessorController extends Professor {
    function createProfessors($FirstName, $LastName , $rank , $designation){
        $this->setFirstName($FirstName);
        $this->setLastName($LastName);
        $this->setRank($rank);
        $this->setDesignation($designation);
        return $this->createProfessor();
    }
}

$action = $_POST['action'];

if(!empty($action)){
    $controller = new ProfessorController;
    if($action === "createProfessors"){
        echo $controller->createProfessors(
                        $_POST['FirstName'] , $_POST['LastName'] ,
                        $_POST['rank'] , $_POST['designation']
                    );
    }
}
else{
    return json_encode(array("status"=>false , "message"=>"There is a problem; please contact the developer."));
}



?>