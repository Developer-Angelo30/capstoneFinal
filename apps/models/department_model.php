<?php
require_once("../database/connection.php");
class Department {

    private $code;
    private array $array;

    protected function createDepartment(){

        //check if there duplicate in DB
        foreach($this->getArray() as $deparments=>$fullnames ){
            $department = mysqli_real_escape_string(DB::DBConnection(), $deparments);
            $fullname = ucwords(mysqli_real_escape_string(DB::DBConnection(), $fullnames));

            $slot = 1;

            $sql = "SELECT * FROM `departments` WHERE  department = '$department' AND DepartmentName = '$fullname' AND DepartmentDeleted = 1 ";
            $result = DB::DBConnection()->query($sql);

            if($result->num_rows > 0){
                return json_encode(array("status"=>false, "message"=>"Slot#{$slot}, $department is already recoreded in database."));
            }
        }

        foreach($this->getArray() as $deparments=>$fullnames){
            $department = mysqli_real_escape_string(DB::DBConnection(), $deparments);
            $fullname = mysqli_real_escape_string(DB::DBConnection(), $fullnames);

            $sql_CheckDeleted = "SELECT * FROM `departments` WHERE  department = '$department' AND DepartmentName = '$fullname' AND DepartmentDeleted = 0 ";
            $result_CheckDelete = DB::DBConnection()->query($sql_CheckDeleted);
            
            if($result_CheckDelete->num_rows > 0){
                $sql_updateActiveDeleted = "UPDATE `departments` SET `DepartmentDeleted`= 1 WHERE `Department`='$department' ";
                $result_updateActiveDeleted = DB::DBConnection()->query($sql_updateActiveDeleted);
            }
            else{
                $sql_insert = "INSERT INTO `departments`(`Department`, `DepartmentName` , `DepartmentDeleted`) VALUES ('$department', '$fullname' , 1)";
                $result_insert = DB::DBConnection()->query($sql_insert);
            }
        }
        DB::DBClose();
        return json_encode(array("status"=>true, "message"=>"Successfully Inserted!"));

    }

    protected function readDepartment(){
        $sql = "SELECT * FROM departments WHERE DepartmentDeleted = 1 ";
        $result = DB::DBConnection()->query($sql);

        

        $output = array();

        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $deparments = array(
                    "code"=> $row['Department'] ,
                    "name" => $row['DepartmentName']
                );
                $output[] = $deparments;
            }
        }

        DB::DBClose();
        return json_encode($output);

    }

    protected function updateDepartmentShow(){
        $code = mysqli_real_escape_string(DB::DBConnection(), $this->getCode());

        $sql = "SELECT * FROM departments  WHERE Department = '$code' AND DepartmentDeleted = 1 ";
        $result = DB::DBConnection()->query($sql);

        $output = array();

        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $deparments = array(
                    "code"=> $row['Department'] ,
                    "name" => $row['DepartmentName']
                );
                $output[] = $deparments;
            }
        }

        DB::DBClose();
        return json_encode($output);

    }


    protected function updateDepartment(){
        
        foreach($this->getArray() as $code=>$name){
            $code = mysqli_real_escape_string(DB::DBConnection(),$code);
            $name = mysqli_real_escape_string(DB::DBConnection(),$name);

            $sql_check = "SELECT * FROM departments WHERE Department = '$code' AND DepartmentDeleted = 1 ";
            $result_check = DB::DBConnection()->query($sql_check);

            if($result_check->num_rows > 0){
                $sql_update = "UPDATE `departments` SET `DepartmentName`='$name' WHERE Department = '$code' ";
                $result_update = DB::DBConnection()->query($sql_update);
                if($result_check){
                    DB::DBClose();
                    return json_encode(array("status"=>true, "message"=>"Successfully Updated!"));
                }
            }
            else{
                DB::DBClose();
                return json_encode(array("status"=>true, "message"=>"The inspect element must not be modified!"));
            }

        }

    }

    protected function deleteDepartment(){
        $code = mysqli_real_escape_string(DB::DBConnection(),$this->getCode());

        $sql_check = "SELECT Department FROM departments WHERE Department = '$code' ";
        $result_check = DB::DBConnection()->query($sql_check);

        if($result_check->num_rows == 1){
            $sql =  "UPDATE `departments` SET`DepartmentDeleted`= 0 WHERE Department = '$code' ";
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

    protected function searchDepartment(){

        $code = mysqli_real_escape_string(DB::DBConnection(), $this->getCode());
        $sql = "SELECT * FROM departments WHERE Department LIKE '%{$code}%' AND DepartmentDeleted = 1 ";
        $result = DB::DBConnection()->query($sql);
        $output = array();

        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $deparments = array(
                    "code"=> $row['Department'] ,
                    "name" => $row['DepartmentName']
                );
                $output[] = $deparments;
            }
        }

        DB::DBClose();
        return json_encode($output);

    }

    protected function setCode($code){
        $this->code= $code;
    }

    protected function getCode(){
        return $this->code;
    }

    protected function setArray($array){
        $this->array = $array;
    }

    protected function getArray(){
        return $this->array;
    }

}

?>