<?php
require_once("../database/connection.php");
class Department {

    private $id;
    private array $array;

    protected function createDepartment(){

        //check if there duplicate in DB
        foreach($this->getArray() as $deparments=>$fullnames ){
            $department = mysqli_real_escape_string(DB::DBConnection(), $deparments);
            $fullname = ucwords(mysqli_real_escape_string(DB::DBConnection(), $fullnames));

            $slot = 1;

            $sql = "SELECT * FROM `departments` WHERE  department = '$department' AND DepartmentName = '$fullname' ";
            $result = DB::DBConnection()->query($sql);

            if($result->num_rows > 0){
                return json_encode(array("status"=>false, "message"=>"Slot#{$slot}, $department is already recoreded in database."));
            }
        }

        foreach($this->getArray() as $deparments=>$fullnames){
            $department = mysqli_real_escape_string(DB::DBConnection(), $deparments);
            $fullname = mysqli_real_escape_string(DB::DBConnection(), $fullnames);

            $sql = "INSERT INTO `departments`(`Department`, `DepartmentName`) VALUES ('$department', '$fullname')";
            $result = DB::DBConnection()->query($sql);
        }
        DB::DBClose();
        return json_encode(array("status"=>true, "message"=>"Successfully Inserted!"));

    }

    protected function readDepartment(){
        $sql = "SELECT * FROM departments ";
        $result = DB::DBConnection()->query($sql);

        $output = array();

        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $deparments = array(
                    "code" => $row['Department'],
                    "name" => $row['DepartmentName']
                );
                $output[] = $deparments;
            }
        }

        DB::DBClose();
        return json_encode($output);

    }

    protected function deleteDepartment(){
        $id = mysqli_real_escape_string(DB::DBConnection(),$this->getID());

        $sql_check = "SELECT Department FROM departments WHERE Department = '$id' ";
        $result_check = DB::DBConnection()->query($sql_check);

        if($result_check->num_rows == 1){
            $sql =  "DELETE FROM `departments` WHERE Department = '$id' ";
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

    protected function setArray($array){
        $this->array = $array;
    }

    protected function getArray(){
        return $this->array;
    }

}

?>