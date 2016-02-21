<?php
/**
 * Controller for Address model objects. Primarily used to load in and process
 * the modals used to perform CRUD operations on Address db entries.
 */
class AddressController {
    public function newAddressModal() {
        include_once('views/identity/modals/addAddress.php');
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
        include_once('views/identity/modals/editAddress.php');
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
        // Redirects are still stupid!
        header("Location: " . $_POST['path']);
    }

    public function confirmDelete() {
        $address = Address::findById($_GET['id']);
        $address = $address->getValues();
        include_once('views/identity/modals/confirmAddressDelete.php');
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
