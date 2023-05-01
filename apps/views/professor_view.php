<?php
// require_once("../models/professor_model.php");
require_once("../validation/validation.php");
require_once("../database/connection.php");

class ProfessorView {

    function readProfessors(){
        $sql = "SELECT * FROM `professors` WHERE ProfessorDeleted = 1 ";
        $result = DB::DBConnection()->query($sql);
        
        $output = array();

        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){

                if($row['ProfessorRank'] == 1){
                    $designated = "W/Designated";
                }
                else{
                    $designated = "W/O Designated";
                }

                $array = array(
                    "id"=>$row['ProfessorID'],
                    "fullname"=>$row['ProfessorFirstName'].' '.$row['ProfessorLastName'],
                    "rank"=>$row['ProfessorRank'],
                    "designated" => $designated
                );

                $output[] = $array;
            }
        }

        DB::DBClose();
        return json_encode($output);
    }

}

$action = $_POST['action'];

if(!empty($action)){
    $view = new ProfessorView;
    if($action == "readProfessors"){
        echo $view->readProfessors();
    }
}
else{
    die(array("status"=>false , "message"=>"There is a problem; please contact the developer."));
}

?>