<?php


class validation{

    public static function Email($email){
        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
            return filter_var($email , FILTER_SANITIZE_EMAIL );
        }
        else{
            return false;
        }
    }
    
    public static function Numeric($value){
        $pattern = "/^[0-9]+$/";
        return (preg_match($pattern, $value))?true:false;
    }

    public static function AlphaSpace($value){
        $pattern = "/^[A-Za-z\s]+$/";
        return (preg_match($pattern, $value))?true:false;
    }

}

?>