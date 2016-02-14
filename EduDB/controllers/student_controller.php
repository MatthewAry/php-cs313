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

    public function viewStudent() {
        if (!isset($_GET['id'])) {
            $error = "You can't edit students with out having an ID.";
            require_once ('views/student/error.php');
        } else {
            // Load Student
            $student = Student::findById($_GET['id']);
            //print_r($student);
            $student->loadClassList();
            $student->loadContactList();
            $student = $student->getValues();
            require_once ('views/student/edit.php');
        }
    }

    public function viewContact() {
        if (!isset($_GET['id'])) {
            $error = "You can't view student contacts with out having an ID.";
            require_once ('views/student/edit.php');
        } else {
            require_once ('models/studentContact.php');
            $contact = StudentContact::findById($_GET['id']);
            $contact = $contact->getValues();
            // Load Contact
            require_once ('views/student/editContact.php');
        }
    }


    public static function updateStudent() {
        // So now we need to get POST data.

        // The student might needs its grade changed!
        $values = array(
            'id' => $_POST['id'],
            'fName' => $_POST['firstName'],
            'mName' => $_POST['middleName'],
            'lName' => $_POST['lastName'],
            'gender' => $_POST['gender'],
            'email' => '',
            'imageURI' => $_POST['']
        );

    }

}