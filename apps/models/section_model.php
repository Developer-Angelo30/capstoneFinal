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

            $sql_check = "SELECT * FROM `sections` WHERE SectionName = '$section' AND SectionYearLevel = '$yearLevel' ";
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

            $sql = "INSERT INTO `sections`(`SectionName`, `SectionYearLevel`) VALUES ('$section', '$yearLevel')";
            $result = DB::DBConnection()->query($sql);
        }

        DB::DBClose();

        return json_encode(array("status"=>true, "message"=>"Successfully Inserted." ));
    }

    protected function readSection(){

        $output = array();

        $sql  ="SELECT * FROM `sections`  GROUP BY `SectionName`  ";
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

    protected function deleteSection(){

        $id = mysqli_real_escape_string(DB::DBConnection(),$this->getID());

        $sql_check = "SELECT SectionID FROM sections WHERE SectionID = '$id' ";
        $result_check = DB::DBConnection()->query($sql_check);

        if($result_check->num_rows == 1){
            $sql =  "DELETE FROM `sections` WHERE SectionID = '$id' ";
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