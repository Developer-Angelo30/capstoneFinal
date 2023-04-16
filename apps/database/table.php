<?php?

include_once("./database.php");

class Table extends DB {

    protected function Departments(){
        $sql = "CREATE TABLE IF NOT EXISTS Departments(
                    Department varchar(10) NOT NULL PRIMARY KEY ,
                    DepartmentName text NOT NULL
                )";
        $result = mysqli_query(DB::DBConnection(), $sql);
        DB::DBClose();
    }

    protected function Users(){
        $sql = "CREATE TABLE IF NOT EXISTS users(
                    UserID int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
                    UserEmail varchar(100) NOT NULL UNIQUE ,
                    UserFirstName varchar(15) NOT NULL,
                    UserLastName varchar(15) NOT NULL,
                    UserRole varchar(11) NOT NULL,
                    Department varchar(10) NOT NULL,
                    FOREIGN KEY(Department) REFERENCES departments(Department)
                )";
        
        $result= mysqli_query(DB::DBConnection(), $sql);
        DB::DBClose();
    }

    protected function login_attempts(){
        $sql = "CREATE TABLE IF NOT EXISTS login_attempts(
                    UserID int(11) UNSIGNED NOT NULL ,
                    UserAttempt int(1) UNSIGNED NOT NULL ,
                    UserLast_Attempt DATE
                )";
        $result= mysqli_query(DB::DBConnection(), $sql);
        DB::DBClose();
    }

    protected function sections(){
        $sql = "CREATE TABLE IF NOT EXISTS sections(
                    SectionID int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                    SectionName varchar(15) NOT NULL ,
                    SectionYearLevel int(1) NOT NULL
                )";
        $result= mysqli_query(DB::DBConnection(), $sql);
        DB::DBClose();
    }

    protected function classrooms(){
        $sql = "CREATE TABLE IF NOT EXISTS classrooms(
                    ClassroomNumber int(10) NOT NULL PRIMARY KEY,
                    ClassroomType varchar(10) NOT NULL
                )";
        $result= mysqli_query(DB::DBConnection(), $sql);
        DB::DBClose();
    }

    protected function ProfessorRanking(){
        $sql = "CREATE TABLE IF NOT EXISTS ProfessorRanking(
                    ProfessorRank varchar(20) NOT NULL PRIMARY KEY,
                    ProfessorLoad int(2) NOT NULL
                )";
        $result= mysqli_query(DB::DBConnection(), $sql);
        DB::DBClose();
    }

    protected function Professors(){
        $sql = "CREATE TABLE IF NOT EXISTS Professors(
                    ProfessorID int(11) NOT NULL PRIMARY KEY,
                    ProfessorFirstName int(15) NOT NULL,
                    ProfessorLastName int(15) NOT NULL,
                    Professor_has_designation boolean  NOT NULL,
                    ProfessorRank varchar(20) NOT NULL,
                    FOREIGN KEY(ProfessorRank) REFERENCES professorranking(ProfessorRank)
                )";
        $result= mysqli_query(DB::DBConnection(), $sql);
        DB::DBClose();
    }

    protected function Subjects(){
        $sql = "CREATE TABLE IF NOT EXISTS `Subjects`(
            SubjectCode varchar(10) NOT NULL PRIMARY KEY,
            SubjectName text NOT NULL,
            SubjectYearLevel int(1) UNSIGNED NOT NULL,
            SubjectSemester int(1) UNSIGNED NOT NULL,
            Subject_has_laboratory boolean NOT NULL
        )";
        $result= mysqli_query(DB::DBConnection(), $sql);
        DB::DBClose();

    }

    protected function Schedules(){
        $sql = "CREATE TABLE IF NOT EXISTS `Schedules`(
            ScheduleID int(11) NOT NULL PRIMARY KEY,
            ScheduleProfessor int(11) NOT NULL,
            ScheduleSubject varchar(10) NOT NULL,
            ScheduleClassroom int(11) NOT NULL,
            ScheduleSection int(11) NOT NULL,
            ScheduleStartClass int(2) NOT NULL,
            ScheduleEndClass int(2) NOT NULL,
            FOREIGN KEY(ScheduleProfessor) REFERENCES professors(professorID),
            FOREIGN KEY(ScheduleSubject) REFERENCES subjects(SubjectCode),
            FOREIGN KEY(ScheduleClassroom) REFERENCES classrooms(ClassroomNumber),
            FOREIGN KEY(ScheduleSection) REFERENCES sections(SectionID)
        )";
        $result= mysqli_query(DB::DBConnection(), $sql);
        DB::DBClose();
    }

}

?>