<?php
/**
 * Created by PhpStorm.
 * User: MatthewAry
 * Date: 2/10/2016
 * Time: 12:03 PM
 */
require_once('models/address.php');
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
        $schoolList = [];
        foreach (School::all() as $i) {
            $schoolList[] = $i->getValues();
        }
        $studentsAtSchool = [];
        $schoolName = '';

        if(isset($_POST['schoolID'])) {
            $studentObjects = Student::allStudentsAtSchool($_POST['schoolID']);
            $schoolName = School::findById($_POST['schoolID']);
            $schoolName = $schoolName->getValues();
            $schoolName = $schoolName['name'];
            foreach ($studentObjects as $i) {
                $studentsAtSchool[] = $i->getValues();
            }
        }
        require_once('views/student/listStudents.php');
    }

    public function viewStudent() {
        if (!isset($_GET['id'])) {
            $_SESSION['Error'] = "You can't edit students without having an ID.";
        } else {
            // Load Student
            $student = Student::findById($_GET['id']);
            $student->loadClassList();
            $student->loadContactList();
            $student = $student->getValues();
            // Get grades
            $grades = [];
            foreach (Grade::all() as $i) {
                $grades[] = $i->getValues();
            }
            // Get Schools
            $schools = [];
            foreach (School::all() as $i) {
                $schools[] = $i->getValues();
            }
            // Get Addresses
            $addresses = [];
            foreach (Address::findByIdentityId($student['identity']['id']) as $i) {
               $addresses[] = $i->getValues();
            }
            require_once ('views/student/edit.php');
        }
    }

    public function viewContact() {
        if (!isset($_GET['id'])) {
            $_SESSION['Error'] = "You can't view student contacts without having an ID.";
        } else {
            require_once ('models/studentContact.php');
            $contact = StudentContact::findById($_GET['id']);
            $contact = $contact->getValues();
            // Load Contact
            require_once ('views/student/editContact.php');
        }
    }

    public function updateStudent() {
        // So now we need to get POST data.

        // The student might need its grade changed!
        $identity = array(
            'id' => $_POST['identityID'],
            'fName' => $_POST['firstName'],
            'mName' => $_POST['middleName'],
            'lName' => $_POST['lastName'],
            'gender' => $_POST['gender'],
        );

        // Returns if failed
        if (!Identity::updateIdentity($identity)) {
            $_SESSION['Error'] = "Unable to update Student Identity!";
        }

        $student = array(
            'id' => $_POST['studentID'],
            'gradeId' => $_POST['grade'],
            'identityId' => $_POST['identityID'],
            'schoolId' => $_POST['school']
        );

        if (!Student::updateStudent($student)) {
            $_SESSION['Error'] = "Unable to update Student!";
        }

        // TODO: If student moves schools, the student looses their classes!

        header("Location: " . $_POST['path']);
    }
}
