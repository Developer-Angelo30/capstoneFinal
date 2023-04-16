<?php

class DB {

    private static $server = "localhost";
    private static $username = "root";
    private static $passowrd = "";
    private static $dbname = "schedler_database";
    
    public static function DBConnection (){

        $conn = mysqli_connect(self::$server , self::$username , self::$passowrd);
        
        $database = mysqli_select_db($conn, self::$dbname);
        if($database){
            return $conn;
        }
        else{
            $createDB = "CREATE DATABASE  IF NOT EXISTS schedler_database";
            $queryDB = mysqli_query($conn, $createDB);
        }

    }

    public static function DBClose(){
        return mysqli_close(self::DBConnection());
    }

}


?>