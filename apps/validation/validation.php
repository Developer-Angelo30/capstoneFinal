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

}


?>