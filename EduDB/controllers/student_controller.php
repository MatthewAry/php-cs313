<?php
/**
 * Created by PhpStorm.
 * User: MatthewAry
 * Date: 2/10/2016
 * Time: 12:03 PM
 */

class StudentController
{
    public function listStudentContacts($id=1) {
        $start = 0;
        $number = 50;
        $records = Student::rowCount();
        $studentList = Student::all($start, $records);

        if (isset($_POST['studentID'])) {
            $id = $_POST['studentID'];
        }
        $studentContacts = StudentContact::findByStudentId($id);
        require_once('views/student/listContacts.php');
    }

    public function listStudents() {
        $start = 0;
        $number = 50;
        if(isset($_POST['rStart']))
            $start = $_POST['rStart'];
        if(isset($_POST['rNumber']))
            $number = $_POST['rNumber'];
        else
            $number = School::rowCount();
        $schoolList = School::all($start, $number);
        $studentsAtSchool = '';
        $schoolName = '';

        if(isset($_POST['schoolID'])) {
            $studentsAtSchool = Student::allStudentsAtSchool($_POST['schoolID'], $start, $number);
            $schoolName = School::findById($_POST['schoolID']);
            $schoolName = $schoolName->getValues();
            $schoolName = $schoolName['name'];
        }

        require_once('views/student/listStudents.php');
    }

}