<?php
class ContactController {
    public function viewContact() {
        if (!isset($_GET['id'])) {
            $_SESSION['Error'] = "You can't view student contacts without having an ID.";
        } else {
            require_once ('models/student.php');
            require_once ('models/studentContact.php');
            require_once ('models/identity.php');
            // Get identity of contact
            $identity = Identity::findById($_GET['id']);
            $identity = $identity->getValues();

            // Load Contact
            $list = [];
            foreach (StudentContact::findByIdentityId($_GET['id'])->getValues()['relationships'] as $i) {
                $list[] = array(
                    'relationship' => $i['type'],
                    'student' => Student::findById($i['studentID'])->getValues()
                );
            }
            // This individual is a contact for: student identity, relationship type, edit controls

            require_once ('views/contact/edit.php');
        }
    }
}

 ?>
