<?php
class ContactController {
    public function viewContact() {
        if (!isset($_GET['id'])) {
            $_SESSION['Error'] = "You can't view student contacts without having an ID.";
        } else {
            require_once ('models/student.php');
            require_once ('models/studentContact.php');
            require_once ('models/identity.php');
            require_once ('models/address.php');
            require_once ('models/phone.php');

            // Get identity of contact
            $identity = Identity::findById($_GET['id']);
            $identity = $identity->getValues();

            // Get addresses belonging to identity
            $addresses = [];
            foreach (Address::findByIdentityId($_GET['id']) as $i) {
                $addresses[] = $i->getValues();
            }

            $phoneNumbers = [];
            foreach (Phone::findByIdentityId($_GET['id']) as $i) {
                $phoneNumbers[] = $i->getValues();
            }

            // Load Contact
            $students = [];
            foreach (StudentContact::findByIdentityId($_GET['id'])->getValues()['relationships'] as $i) {
                $students[] = array(
                    'relationship' => $i['type'],
                    'student' => Student::findById($i['studentID'])->getValues()
                );
            }
            // This individual is a contact for: student identity, relationship type, edit controls
            require_once ('views/contact/edit.php');
        }
    }

    public function linkContact() {
        StudentContact::linkContact($_POST['identityId'], $_POST['search']);
        header("Location: " . $_POST['path']);
    }

    public function newContact() {
        
    }
}

 ?>
