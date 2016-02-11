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

    public function listStudentContactsPost() {

    }

}