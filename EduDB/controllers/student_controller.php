<?php
/**
 * Created by PhpStorm.
 * User: MatthewAry
 * Date: 2/10/2016
 * Time: 12:03 PM
 */
require_once('models/address.php');
require_once('models/studentContact.php');
require_once('models/identity.php');
class StudentController
{
    public function listStudentContacts($id=1) {
        $studentList = Student::all($start, $records);

        if (isset($_POST['studentID'])) {
            $id = $_POST['studentID'];
        }
        $studentContacts = StudentContact::findByStudentId($id)->getValues();
        $temp = [];
        foreach ($studentContacts['relationships'] as $i) {
            $temp[] = array(
                'id' => $i['id'],
                'identityID' => $i['identityID'],
                'relationshipID' => $i['relationshipID'],
                'type' => $i['type'],
                'identity' => Identity::findById($i['identityID'])->getValues()
            );
        }
        $studentContacts = array();
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
            $identity = $student['identity'];
            $type = ['label' => 'Student', 'id' => $student['id']];
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

    public function updateStudent() {
        // So now we need to get POST data.

        // The student might need its grade changed!
        $identity = array(
            'id' => $_POST['identityID'],
            'fName' => $_POST['firstName'],
            'mName' => $_POST['middleName'],
            'lName' => $_POST['lastName'],
            'gender' => $_POST['gender']
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

    public function addStudent() {
        $identity = array(
            'fName' => $_POST['firstName'],
            'mName' => $_POST['middleName'],
            'lName' => $_POST['lastName'],
            'gender' => $_POST['gender'],
            'email' => $_POST['email'],
            'type' => 1
        );

        $studentIdentityId = Identity::newIdentity($identity);
        if (!$studentIdentityId) {
            $_SESSION['Error'] = "Unable to create Student Identity!";
            header("Location: " . $_POST['path']); // TODO: This should go to an error page.
            return false;
        }

        require_once('helpers/upload.php');
        $code = '';
        if ($studentIdentityId) {
            $id = intval($studentIdentityId);
            $handle = new upload($_FILES['image_field']);
            if ($handle->uploaded) {
                $handle->file_new_name_body   = $id;
                $handle->image_resize         = true;
                $handle->image_x              = 100;
                $handle->image_ratio_y        = true;
                $handle->file_overwrite       = true;
                $handle->process($_SERVER['DOCUMENT_ROOT'] . '/EduDB/imageUploads/' );
                if ($handle->processed) {
                    $handle->clean();
                } else {
                    $_SESSION['ERROR'] = $handle->error; // Failure
                }
            }
            Identity::updateImage($id, '/EduDB/imageUploads/'.$handle->file_dst_name);
        }

        $student = array(
            'gradeId' => $_POST['grade'],
            'identityId' => $studentIdentityId,
            'schoolId' => $_POST['school']
        );

        $sId = Student::newStudent($student);
        if (!$sId) {
            $_SESSION['Error'] = "Unable to update Student!";
        }

        header("Location: ?controller=student&action=viewStudent&id=$sId");
    }

    public function create() {
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
        include_once('views/student/create.php');
    }
}
