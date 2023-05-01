<?php
include_once("../database/connection.php");

class Section{
    
    private $id;
    private array $array;

    protected function createSection(){

        $slot = 1;

        //check if data is already save in database.
        foreach($this->getArray() as $sections=>$yearLevels){
            $section = mysqli_real_escape_string(DB::DBConnection(),$sections);
            $yearLevel = mysqli_real_escape_string(DB::DBConnection(),$yearLevels);

            $sql_check = "SELECT * FROM `sections` WHERE SectionName = '$section' AND SectionYearLevel = '$yearLevel' AND SectionDeleted = 1 ";
            $result_check = DB::DBConnection()->query($sql_check);
            if($result_check->num_rows > 0){
                if($yearLevel == 1 ){
                    $sectionYear = "{$section} 1st year";
                }
                else if($yearLevel == 2){
                    $sectionYear = "{$section} 2nd year";
                }
                else if($yearLevel == 3){
                    $yearLevel = "{$section} 3rd year";
                }
                else if($yearLevel == 4){
                    $sectionYear = "{$section} 4th year";
                }
                else{
                    $sectionYear = "{$section} 5th year";
                }

                return json_encode(array("status"=>false , "message"=>"slot#{$slot}, Section {$sectionYear}   is already recorded in database." ));
            }
            $slot += 1;
        }

        // insert in arraybase
        foreach($this->getArray() as $sections=>$yearLevels){
            $section = mysqli_real_escape_string(DB::DBConnection(),$sections);
            $yearLevel = mysqli_real_escape_string(DB::DBConnection(),$yearLevels);

            $sql_CheckDeleted = "SELECT * FROM `sections` WHERE  SectionName = '$section' AND SectionYearLevel = '$yearLevel' AND SectionDeleted = 0 ";
            $result_CheckDelete = DB::DBConnection()->query($sql_CheckDeleted);
            
            if($result_CheckDelete->num_rows > 0){
                $row = $result_CheckDelete->fetch_assoc();
                $id = $row['SectionID'];
                $sql_updateActiveDeleted = "UPDATE `sections` SET `SectionDeleted`= 1 WHERE SectionID  = '$id' ";
                $result_updateActiveDeleted = DB::DBConnection()->query($sql_updateActiveDeleted);
            }
            else{
                $sql_insert = "INSERT INTO `sections`(`SectionName`, `SectionYearLevel` , `SectionDeleted` ) VALUES ('$section', '$yearLevel' , 1)";
                $result_insert = DB::DBConnection()->query($sql_insert);
            }
        }

        DB::DBClose();
        return json_encode(array("status"=>true, "message"=>"Successfully Inserted." ));
    }

    protected function readSection(){

        $output = array();

        $sql  ="SELECT * FROM `sections` WHERE `SectionDeleted` = 1  ORDER BY `SectionName`   ";
        $result = DB::DBConnection()->query($sql);

        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){

                if($row['SectionYearLevel'] == 1){
                    $year = "1st Year";
                }
                else if($row['SectionYearLevel'] == 2){
                    $year = "2nd Year";
                }
                else if($row['SectionYearLevel'] == 3){
                    $year = "3rd Year";
                }
                else if($row['SectionYearLevel'] == 4){
                    $year = "4th Year";
                }
                else{
                    $year = "5th Year";
                }

                $section = array(
                    'id' => $row['SectionID'],
                    'section' => $row['SectionName'],
                    'year' => $year
                );
                $output[] = $section;
            }
        }

        DB::DBClose();
        return json_encode($output);
    }

    protected function updateSection(){
        $id = mysqli_real_escape_string(DB::DBConnection(), $this->getArray()[0]);
        $name = mysqli_real_escape_string(DB::DBConnection(), $this->getArray()[1]);
        $year = mysqli_real_escape_string(DB::DBConnection(), $this->getArray()[2]);

        $sql_check = "SELECT * FROM sections WHERE SectionID = '$id' AND SectionDeleted = 1 ";
        $result_check = DB::DBConnection()->query($sql_check);
        if($result_check->num_rows > 0){

            $sql_check_new_data = "SELECT * FROM sections WHERE SectionName = '$name' AND SectionYearLevel = '$year' ";
            $sql_result_new_data = DB::DBConnection()->query($sql_check_new_data);

            if($sql_result_new_data->num_rows == 0){
                $sql = "UPDATE `sections` SET `SectionName`='$name',`SectionYearLevel`='$year' WHERE SectionID = $id ";
                $result = DB::DBConnection()->query($sql);

                $output = json_encode(array("status"=>true, "message"=>"Successfully Updated.")); 
            }
            else{
                $output = json_encode(array("status"=>false, "message"=>"Already recoreded in database.")); 
            }
        }
        else{
            $output = json_encode(array("status"=>false, "message"=>"Do not edit inspect element!")); 
        }

        DB::DBClose();
        return $output;

    }

    protected function updateSectionShow(){
        $id = mysqli_real_escape_string(DB::DBConnection(), $this->getID());

        $sql = "SELECT * FROM sections  WHERE SectionID = '$id' AND SectionDeleted = 1 ";
        $result = DB::DBConnection()->query($sql);

        $output = array();

        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $deparments = array(
                    "id"=> $row['SectionID'] ,
                    "name" => $row['SectionName'],
                    "year" => $row['SectionYearLevel']
                );
                $output[] = $deparments;
            }
        }

        DB::DBClose();
        return json_encode($output);

    }

    protected function deleteSection(){

        $id = mysqli_real_escape_string(DB::DBConnection(),$this->getID());

        $sql_check = "SELECT SectionID FROM sections WHERE SectionID = '$id' ";
        $result_check = DB::DBConnection()->query($sql_check);

        if($result_check->num_rows == 1){
            $sql =  "UPDATE `sections` SET  `SectionDeleted`= 0 WHERE SectionID = '$id' ";
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

    protected function searchSection(){
        
        $name = mysqli_real_escape_string(DB::DBConnection(), $this->getArray()[0]);
        $sql = "SELECT * FROM sections WHERE SectionName LIKE '%$name%' AND `SectionDeleted` = 1   ORDER BY `SectionName`  ";
        $result = DB::DBConnection()->query($sql);
        $output = array();

        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){

                if($row['SectionYearLevel'] == 1){
                    $year = "1st Year";
                }
                else if($row['SectionYearLevel'] == 2){
                    $year = "2nd Year";
                }
                else if($row['SectionYearLevel'] == 3){
                    $year = "3rd Year";
                }
                else if($row['SectionYearLevel'] == 4){
                    $year = "4th Year";
                }
                else{
                    $year = "5th Year";
                }

                $sections = array(
                    "id"=> $row['SectionID'] ,
                    "section" => $row['SectionName'],
                    "year" => $year
                );
                $output[] = $sections;
            }
        }

        DB::DBClose();
        return json_encode($output);
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