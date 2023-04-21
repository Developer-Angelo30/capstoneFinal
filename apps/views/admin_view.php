<?php
include_once("../models/admin_model.php");

class AdminView extends Admin{

    public function logins($email, $password){
        $this->setEmail($email);
        $this->setPassword($password);
        return $this->login();
    }

}

$action = $_POST['action'];

if(!empty($action)){
    $view = new AdminView();
    if($action === "logins"){
        echo $view->logins($_POST['login-email'], $_POST['login-password'] );
    }
}
else{
    die(array("status"=>false , "message"=>"There is a problem; please contact the developer."));
}

?>