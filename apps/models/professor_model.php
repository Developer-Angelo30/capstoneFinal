<?php
require_once("../database/connection.php");
class Professor{

    private array $FirstName;
    private array $LastName;
    private array $Rank;
    private array $Designation;

    protected function createProfessor(){

        foreach($this->getFirstName() as $key=>$value){

            $firstname = mysqli_real_escape_string(DB::DBConnection(), $value);
            $lastName = mysqli_real_escape_string(DB::DBConnection(), $this->getLastName()[$key]);
            $rank = mysqli_real_escape_string(DB::DBConnection(), $this->getRank()[$key]);
            $designation = mysqli_real_escape_string(DB::DBConnection(), $this->getDesignation()[$key]);

        
            $sql = "INSERT INTO `professors`(
                `ProfessorFirstName`, `ProfessorLastName`, 
                `Professor_has_designation`, `ProfessorDeleted`,
                `ProfessorRank`) 
            VALUES (
                '$firstname','$lastName',
                '$designation',1,
                '$rank'
                )";

            $result = DB::DBConnection()->query($sql);
        
        }
        DB::DBClose();
        return json_encode(array('status'=>true, "message"=>"Successfully added."));
    }

    protected function readProfessor(){
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
                    "rank" => $designated
                );

                $output[] = $array;
            }
        }

        DB::DBClose();
        return json_encode($output);
    }

    protected function setFirstName(array $FirstName){
        $this->FirstName =$FirstName;
    }

    protected function getFirstName(){
        return $this->FirstName;
    }

    protected function setLastName(array $LastName){
        $this->LastName =$LastName;
    }

    protected function getLastName(){
        return $this->LastName;
    }

    protected function setRank(array $Rank){
        $this->Rank =$Rank;
    }

    protected function getRank(){
        return $this->Rank;
    }
    
    protected function setDesignation(array $Designation){
        $this->Designation =$Designation;
    }

    protected function getDesignation(){
        return $this->Designation;
    }
}



?>