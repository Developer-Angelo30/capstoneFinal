<?php
include ("../models/subject_model.php");

class SubjectView extends Subject {

    function readSubjects(){
        return $this->readSubject();
    }

}

$action = $_POST['action'];

if(!empty($action)){
    $view = new SubjectView;
    if($action == "readSubjects"){
        echo $view->readSubjects();
    }
}
else{
    die(array("status"=>false , "message"=>"There is a problem; please contact the developer."));
}

?>