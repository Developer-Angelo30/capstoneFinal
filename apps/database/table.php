<?php


function createTable_admins(){
    $sql = "CREATE TABLE IF NOT EXISTS admins(
        adminID int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY ,
        adminFirstname varchar(15) NOT NULL ,
        adminLastname varchar(15) NOT NULL ,
        adminPassword varchar(60) NOT NULL ,
        departmentCode varchar(10) NOT NULL,
        roleID int(1) NOT NULL,
        FOREIGN KEY(departmentCode) REFERENCES departments(departmentCode),
        FOREIGN KEY(roleID) REFERENCES roles(roleID)
    )";
}

?>