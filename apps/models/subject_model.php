<?php
require_once("../database/connection.php");

class Subject{

    private $id;
    private array $code;
    private array $name;
    private array $year;
    private array $semester;
    private array $laboratory;


    protected function createSubject(){

        //check  code and if already recoreded.
        foreach($this->getCode() as $key=>$codes ){

            $slot = $key + 1;
            $code = mysqli_real_escape_string(DB::DBConnection(), $codes);


            $sql_check= "SELECT SubjectCode FROM subjects WHERE SubjectCode = '$code' AND SubjectDeleted = 1 ";
            $result_check = DB::DBConnection()->query($sql_check);

            if($result_check->num_rows == 1){
                return json_encode(array("status"=>false , "message"=>"Slot#{$slot}, {$code} is already recoreded in database!"));
            }
        }

        foreach($this->getCode() as $key=>$codes){
            $code = mysqli_real_escape_string(DB::DBConnection(), $codes);
            $name = mysqli_real_escape_string(DB::DBConnection(), $this->getName()[$key]);
            $year = mysqli_real_escape_string(DB::DBConnection(),  $this->getYear()[$key]);
            $semester = mysqli_real_escape_string(DB::DBConnection(), $this->getSemester()[$key]);
            $laboratory = mysqli_real_escape_string(DB::DBConnection(),  $this->getLaboratory()[$key]);

            $sql_CheckDeleted = "SELECT * FROM `subjects` WHERE  SubjectCode = '$code' AND SubjectDeleted = 0 ";
            $result_CheckDelete = DB::DBConnection()->query($sql_CheckDeleted);
            
            if($result_CheckDelete->num_rows > 0){
                $row = $result_CheckDelete->fetch_assoc();
                $sql_updateActiveDeleted = "UPDATE `subjects` SET 
                                                `SubjectName`='$name',
                                                `SubjectYearLevel`='$year',
                                                `SubjectSemester`='$semester',
                                                `Subject_has_laboratory`='$laboratory',
                                                `SubjectDeleted`= 1
                                            WHERE SubjectCode  = '$code' ";
                $result_updateActiveDeleted = DB::DBConnection()->query($sql_updateActiveDeleted);
            }
            else{
                $sql_insert = "INSERT INTO `subjects`(
                    `SubjectCode`, 
                    `SubjectName`, 
                    `SubjectYearLevel`, 
                    `SubjectSemester`, 
                    `Subject_has_laboratory`,
                    `SubjectDeleted`
                ) VALUES (
                    '$code', '$name', '$year', '$semester', '$laboratory' , 1
                )";
                $result_insert = DB::DBConnection()->query($sql_insert);
            }
            
        }

        DB::DBClose();
        return json_encode(array("status"=>true , "message"=>"Successfully Inseted!"));

    }

    protected function readSubject(){
        $output = array();

        $sql  ="SELECT * FROM `subjects` WHERE SubjectDeleted = 1  GROUP BY SubjectCode  ";
        $result = DB::DBConnection()->query($sql);

        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){

                if($row['SubjectYearLevel'] == 1){
                    $year = "1st Year";
                }
                else if($row['SubjectYearLevel'] == 2){
                    $year = "2nd Year";
                }
                else if($row['SubjectYearLevel'] == 3){
                    $year = "3rd Year";
                }
                else if($row['SubjectYearLevel'] == 4){
                    $year = "4th Year";
                }
                else{
                    $year = "5th Year";
                }

                $section = array(
                    'code' => $row['SubjectCode'],
                    'name' => $row['SubjectName'],
                    'year' => $year,
                    'semester' => $row['SubjectSemester']
                );
                $output[] = $section;
            }
        }

        DB::DBClose();
        return json_encode($output);
    }

    protected function updateSubject(){

    }

    protected function deleteSubject(){

        $id = mysqli_real_escape_string(DB::DBConnection(),$this->getID());

        $sql_check = "SELECT SubjectCode FROM subjects WHERE SubjectCode = '$id' ";
        $result_check = DB::DBConnection()->query($sql_check);

        if($result_check->num_rows == 1){
            $sql =  "UPDATE `subjects` SET `SubjectDeleted`= 0 WHERE  SubjectCode = '$id' ";
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

    protected function searchSubject(){
        
    }

    protected function setID($id){
        $this->id = $id;
    }

    protected function getID(){
        return $this->id;
    }

    protected function setCode(array $code){
        $this->code = $code;
    }

    protected function getCode(){
        return $this->code;
    }

    protected function setName(array $name){
        $this->name = $name;
    }

    protected function getName(){
        return $this->name;
    }

    protected function setYear(array $year){
        $this->year = $year;
    }

    protected function getYear(){
        return $this->year;
    }

    protected function setSemester(array $semester){
        $this->semester = $semester;
    }

    protected function getSemester(){
        return $this->semester;
    }

    protected function setLaboratory(array $laboratory){
        $this->laboratory = $laboratory;
    }

    protected function getLaboratory(){
        return $this->laboratory;
    }

}

?>