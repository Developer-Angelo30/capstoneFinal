<?php
include_once('../models/classroom_model.php');

class ClassroomView extends Classroom {

    function readClassRooms(){
        return $this->readClassRoom();
    }

}


$action = $_POST['action'];

if(!empty($action)){

    $view = new ClassroomView;

    if($action === "readClassRooms"){
        echo $view->readClassRooms();
    }

}
else{
    die(array("status"=>false , "message"=>"There is a problem; please contact the developer."));
}

?>