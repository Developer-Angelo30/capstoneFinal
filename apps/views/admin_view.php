<?php
include_once("../models/admin_model.php");

class AdminView extends Admin{

    public function logins($_email, $_password){
        return $this->login($_email, $_password);
    }

}

$action = $_POST['action'];

if(!empty($action)){
    $view = new AdminView();
    if($action === "logins"){
        echo $view->logins($_POST['login-email'], $_POST['login-password'] );
    }
}


?>