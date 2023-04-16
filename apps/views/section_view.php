<?php
include ("../models/section_model.php");

class SectionView extends Section {

    function readSections(){
        return $this->readSection();
    }

}

$action = $_POST['action'];

if(!empty($action)){
    $view = new SectionView;
    if($action == "readSections"){
        echo $view->readSections();
    }
}
else{
    die(array("status"=>false , "message"=>"There is a problem; please contact the developer."));
}

?>