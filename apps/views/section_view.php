<?php
include ("../models/section_model.php");

class SectionView extends Section {

    function readSections(){
        return $this->readSection();
    } 

    function updateSectionShows($id){
        $this->setID($id);
        return $this->updateSectionShow();
    }

}

$action = $_POST['action'];

if(!empty($action)){
    $view = new SectionView;
    if($action == "readSections"){
        echo $view->readSections();
    }
    else if($action == "updateSectionShows"){
       echo  $view->updateSectionShows($_POST['id']);
    }
}
else{
    die(array("status"=>false , "message"=>"There is a problem; please contact the developer."));
}

?>