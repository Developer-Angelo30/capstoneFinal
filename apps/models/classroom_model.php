<?php
include_once("../database/connection.php");

class Classroom {

    private $id;
    private array $array;

    protected function createClassRoom(){

        $slot = 1;

        foreach($this->getArray() as $room=>$type){

            $number = mysqli_real_escape_string(DB::DBConnection(), $room);
            $sql_check = "SELECT `ClassroomNumber` FROM `classrooms` WHERE  `ClassroomNumber` = '$number' AND ClassroomDeleted = 1  ";
            $result_check = DB::DBConnection()->query($sql_check);

            if($result_check->num_rows > 0){
                return json_encode(array('status'=>false,'message'=>"Slot#{$slot} Classroom {$room} already recoreded."));
            }
            $slot += 1;
        }


        foreach($this->getArray() as $room=>$type){

            $classNumber = mysqli_real_escape_string(DB::DBConnection(), $room );
            $classType = ucwords(mysqli_real_escape_string(DB::DBConnection(), $type));

            $sql_CheckDeleted = "SELECT * FROM `classrooms` WHERE  ClassroomNumber = '$classNumber'  AND ClassroomDeleted = 0 ";
            $result_CheckDelete = DB::DBConnection()->query($sql_CheckDeleted);
            
            if($result_CheckDelete->num_rows > 0){
                $sql_updateActiveDeleted = "UPDATE `classrooms` SET ClassroomType = '$classType' , `ClassroomDeleted`= 1 WHERE `ClassroomNumber`='$classNumber' ";
                $result_updateActiveDeleted = DB::DBConnection()->query($sql_updateActiveDeleted);
            }
            else{
                $sql_insert = "INSERT INTO `classrooms`(`ClassroomNumber`, `ClassroomType` ,`ClassroomDeleted` ) VALUES ('$classNumber', '$classType' , 1 )";
                $result_insert = DB::DBConnection()->query($sql_insert);
            }

        }
        DB::DBClose();
        return json_encode(array('status'=>true,'message'=>'Successfully Inserted'));
    }

    protected function readClassRoom(){

        $output = array();

        $sql = "SELECT * FROM `classrooms` WHERE `ClassroomDeleted` = 1 ";
        $result = DB::DBConnection()->query($sql);

        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $classroom = array(
                    "number"=> $row['ClassroomNumber'],
                    "type" => $row['ClassroomType']
                );
                $output[] = $classroom; 
            }
            
        }

        DB::DBConnection();
        return json_encode($output);
    }

    protected function deleteClassRoom(){

        $id = mysqli_real_escape_string(DB::DBConnection(), $this->getID());
        $sql_check = "SELECT ClassroomNumber FROM classrooms WHERE `ClassroomNumber` = '$id' ";
        $result_check = DB::DBConnection()->query($sql_check);

        if($result_check->num_rows == 1){
            $sql =  "UPDATE `classrooms` SET `ClassroomDeleted`= 0 WHERE `ClassroomNumber` = '$id'";
            $result = DB::DBConnection()->query($sql);

            if($result){
                $output = json_encode(array("status"=>true, "message"=>"Successfully Deleted!"));
            }
        }
        else{
            $output = json_encode(array("status"=>false, "message"=>"Do not edit inspect element!."));
        }

        DB::DBClose();
        return $output;

    }

    protected function setID($id){
        $this->id = $id;
     }
 
     protected function getID(){
        return $this->id;
     }

    protected function setArray(array $array){
        $this->array = $array;
    }

    protected function getArray(){
        return $this->array;
    }

}

?>