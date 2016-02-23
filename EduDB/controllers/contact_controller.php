<?php
class ContactController {
    public function viewContact($flag = true) {
        if(!session_id()) session_start();
        $id = false;
        if (isset($_SESSION['identityId'])) {
            $id = $_SESSION['identityId'];
        } else if (isset($_GET['id'])) {
            $id = $_GET['id'];
        } else {
            $_SESSION['Error'] = "You can't view student contacts without having an ID.";
        }

        if ($id) {
            require_once ('models/student.php');
            require_once ('models/studentContact.php');
            require_once ('models/identity.php');
            require_once ('models/address.php');
            require_once ('models/phone.php');

            // Get identity of contact
            $identity = Identity::findById($id);
            $identity = $identity->getValues();

            $type = ['label' => 'Contact', 'id' => $id];

            // Get addresses belonging to identity
            $addresses = [];
            foreach (Address::findByIdentityId($id) as $i) {
                $addresses[] = $i->getValues();
            }

            $phoneNumbers = [];
            foreach (Phone::findByIdentityId($id) as $i) {
                $phoneNumbers[] = $i->getValues();
            }

            // Load Contact
            $students = [];
            foreach (StudentContact::findByIdentityId($id)->getValues()['relationships'] as $i) {
                $students[] = array(
                    'relationship' => $i['type'],
                    'student' => Student::findById($i['studentID'])->getValues()
                );
            }

            if ($flag) {
                // This individual is a contact for: student identity, relationship type, edit controls
                require_once ('views/contact/edit.php');
            }
        }
    }

    public function newContactPage() {
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $identityId = $_POST['identityId'];
        $studentId = $_POST['studentId'];
        $path = $_POST['path'];
        require_once('views/contact/new.php');
    }

    public function newContact() {
        $identity = array(
            'fName' => $_POST['firstName'],
            'mName' => $_POST['middleName'],
            'lName' => $_POST['lastName'],
            'gender' => $_POST['gender'],
            'type' => 2
        );

        $contactIdentityId = Identity::newIdentity($identity);
        if (!$contactIdentityId) {
            $_SESSION['Error'] = "Unable to create a Contact Identity!";
            header("Location: " . $_POST['path']); // TODO: This should go to an error page.
            return false;
        }

        require_once('helpers/upload.php');
        $code = '';
        if ($contactIdentityId) {
            $id = intval($contactIdentityId);
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
        // If we get here then we have made an identity but have not linked it
        // to the target contact yet. We will need to set the relationship.

        if(!session_id()) session_start();
        $_SESSION['contact']['studentId'] = $_POST['studentId'];
        $_SESSION['contact']['studentIdentityId'] = $_POST['identityId'];
        $_SESSION['contact']['contactIdentityId'] = $contactIdentityId;
        header("Location: ?controller=contact&action=setRelationship");
    }

    public function setRelationship() {
        if(!session_id()) session_start();
        $joiningIdentities = [];
        $joiningIdentities[] = [
            'type' => ['label' => 'Contact', 'id' => $_SESSION['contact']['contactIdentityId']],
            'identity' => Identity::findById($_SESSION['contact']['contactIdentityId'])->getValues()
        ];
        $joiningIdentities[] = [
            'type' => ['label' => 'Student', 'id' => $_SESSION['contact']['studentId']],
            'identity' => Identity::findById($_SESSION['contact']['studentIdentityId'])->getValues()
        ];
        $firstName = $joiningIdentities[1]['identity']['firstName'];
        $lastName = $joiningIdentities[1]['identity']['lastName'];
        require_once('views/contact/setRelationship.php');
    }

    public function linkContact() {
        if(!session_id()) session_start();
        if(isset($_SESSION['contact'])) {
            $_SESSION['identityId'] = $_SESSION['contact']['contactIdentityId'];
            StudentContact::linkContact($_SESSION['contact']['contactIdentityId'],
                                        $_SESSION['contact']['studentId'],
                                        $_POST['relationship']);
            unset($_SESSION['contact']);
            header("Location: ?controller=contact&action=viewContact");
        } else {
            StudentContact::linkContact($_POST['identityId'],
                                        $_POST['studentId'],
                                        $_POST['relationship']);
        }
    }

    public function updateContact() {
        $identity = array(
            'id' => $_POST['identityId'],
            'fName' => $_POST['firstName'],
            'mName' => $_POST['middleName'],
            'lName' => $_POST['lastName'],
            'gender' => $_POST['gender'],
            'email' => $_POST['email']
        );

        // Returns if failed
        if (!Identity::updateIdentity($identity)) {
            print "error";
            $_SESSION['Error'] = "Unable to update Contact Identity!";
        }

        header("Location: " . $_POST['path']);
    }

    public function unlinkContactModal() {
        $info = StudentContact::findById($_GET['id'])->getValues();
        $contact = Identity::findById($info['relationships']['identityId'])->getValues();
        include_once('views/contact/modals/deleteRelationship.php');
    }

    public function unlinkContact() {
        StudentContact::unlinkContact($_POST['id']);
        header("Location: ".$_POST['path']);
    }
}
 ?>
