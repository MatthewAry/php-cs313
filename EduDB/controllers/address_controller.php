<?php
class AddressController {
    public function addAddress() {
        // TODO: VALIDATE INPUT!
        $address = array(
            'street' => $_POST['street'],
            'extended' => $_POST['extended'],
            'city' => $_POST['city'],
            'zip' => $_POST['zip'],
            'zip4' => $_POST['zip4'],
            'stateId' => $_POST['state'],
            'addressTypeId' => $_POST['type'],
            'identityId' => $_POST['identityId']
        );
        Address::newAddress($address);
        header("Location: " . $_POST['path']);
    }

    public function getAddress() {
        $address = Address::findById($_GET['id']);
        $address = $address->getValues();
        if (isset($_GET['ref'])) {
            if ($_GET['ref'] == 'student') {
                include_once('views/student/modals/editAddress.php');
            }
            // Potential for teachers and for contacts
        }
    }

    public function updateAddress() {

        header("Location: " . $_POST['path']);
    }
}
