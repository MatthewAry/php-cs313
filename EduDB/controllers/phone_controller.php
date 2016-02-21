<?php
/**
 * Controller for Phone model objects. Primarily used to load in and process the
 * modals used to perform CRUD operations on Phone db entries.
 */
class PhoneController
{
    public function newPhoneModal() {
        include_once ('views/identity/modals/addPhone.php');
    }

    public function addPhone() {
        $phone = array(
            'id' => $_POST['identityId'],
            'number' => $_POST['phoneNumber'],
            'typeId' => $_POST['phoneType']
        );
        Phone::newPhone($phone);

        // Redirects are a stupid solution for this problem
        header('Location: ' . $_POST['path']);
    }

    public function getPhone() {
        $phone = Phone::findById($_GET['id']);
        $phone = $phone->getValues();
        include_once('views/identity/modals/editPhone.php');
    }

    public function updatePhone() {

    }

    public function confirmDelete() {
        $phone = Phone::findById($_GET['id']);
        $phone = $phone->getValues();
        include_once('views/identity/modals/confirmPhoneDelete.php');
    }

    public function delete() {
        if (!Phone::delete($_POST['id'])) {
            $_SESSION['ERROR'] = "Unable to delete phone number.";
        }
        // THIS IS STUPID
        header("LOCATION: ". $_POST['path']);
    }
}

 ?>
