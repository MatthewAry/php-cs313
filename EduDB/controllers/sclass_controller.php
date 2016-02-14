<?php
/**
 * Created by PhpStorm.
 * User: MatthewAry
 * Date: 2/13/2016
 * Time: 3:48 PM
 */
require_once ('models/school.php');
class SclassController
{
    public function listClasses() {
        $start = 0;
        if (isset($_POST['rStart']))
            $start = $_POST['rStart'];
        $number = 0;
        if (isset($_POST['rNumber']))
            $number = $_POST['rNumber'];
        else
            $number = Sclass::rowCount();

        $schoolList = School::all($start, $number);
        $classesAtSchool = '';
        $schoolName = '';
        if (isset($_POST['schoolID'])) {
            $classesAtSchool = Sclass::getAllClassesAtSchool($_POST['schoolID'], $start, $number);
            $schoolName = School::findById($_POST['schoolID']);
            $schoolName = $schoolName->getValues();
            $schoolName = $schoolName['name'];
        }

        require_once ('views/class/listClasses.php');
    }
}