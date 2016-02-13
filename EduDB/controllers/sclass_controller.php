<?php
/**
 * Created by PhpStorm.
 * User: MatthewAry
 * Date: 2/13/2016
 * Time: 3:48 PM
 */

class sclass_controller
{
    public function listClasses($schoolID) {
        $start = 0;
        if (isset($_POST['rStart']))
            $start = $_POST['rStart'];
        $number = 0;
        if (isset($_POST['rNumber']))
            $number = $_POST['rNumber'];
        else
            $number = Sclass::rowCount();

        $schoolList = School::all($start, $number);

        if (isset($_POST['schoolID'])) {
            $studentsAtSchool = Student::allStudentsAtSchool($_POST['schoolID'], $start, $number);
            $schoolName = School::findById($_POST['schoolID']);
            $schoolName = $schoolName->getValues();
            $schoolName = $schoolName['name'];
        }

        require_once ('views/class/listClasses.php');
    }
}