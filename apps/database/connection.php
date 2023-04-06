<?php


class DB{

    private static $DBHost = "localhost";
    private static $DBUser = "root";
    private static $DBPass = "";
    private static $DBname = 'schedlr';

    public static function DBConnection(){
        $con = mysqli_connect(self::$DBHost, self::$DBUser, self::$DBPass, self::$DBname);
        return (!$con)? die("Connection Failed: " . mysqli_connect_error() ) : $con;
    }

    public static function DBClose(){
        return mysqli_close(self::DBConnection());
    }

}

?>