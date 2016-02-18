<?php
class AddressController {
    public function newAddressModal() {
        if (isset($_GET['ref'])) {
            if ($_GET['ref'] == 'student') {
                include_once('views/student/modals/addAddress.php');
            }
            // Potential for teachers and for contacts
        }
    }
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
        // YES I know redirects are stupid when used like this.
        header("Location: " . $_POST['path']);
    }

    public function getAddress() {
        $address = Address::findById($_GET['id']);
        $address = $address->getValues();
        // Bad Coupling
        if (isset($_GET['ref'])) {
            if ($_GET['ref'] == 'student') {
                include_once('views/student/modals/editAddress.php');
            }
            // Potential for teachers and for contacts
        }
    }

    public function updateAddress() {
        $address = array(
            'id' => $_POST['id'],
            'street' => $_POST['street'],
            'extended' => $_POST['extended'],
            'city' => $_POST['city'],
            'zip' => $_POST['zip'],
            'zip4' => $_POST['zip4'],
            'stateId' => $_POST['state'],
            'addressTypeId' => $_POST['type'],
            'identityId' => $_POST['identityId']
        );
        Address::editAddress($address);
        // Redirects are still stupic!
        header("Location: " . $_POST['path']);
    }

    public function confirmDelete() {
        $address = Address::findById($_GET['id']);
        $address = $address->getValues();
        if (isset($_GET['ref'])) {
            if ($_GET['ref'] == 'student') {
                include_once('views/student/modals/confirmAddressDelete.php');
            }
            // Potential for teachers and for contacts
        }
    }

    // HMM There can be more security for this...
    public function delete() {
        if (!Address::deleteAddress($_POST['id'])) {
            $_SESSION['ERROR'] = "Unable to delete address.";
        }
        // YES I KNOW: REDIRECTS ARE STUPID
        header("LOCATION: ". $_POST['path']);
    }
}
