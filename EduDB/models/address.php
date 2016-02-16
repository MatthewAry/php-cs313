<?php

class Address
{
    private $id;
    private $street;
    private $extended;
    private $city;
    private $zip;
    private $zip4;
    // Consider refactoring the way we grab states by using a
    // Join
    private $stateName;
    private $stateAbbrv;
    // Consider refactoring the way we grab the address type by
    // using a Join.
    private $addressType; // Table: AddressType Column: Name
    private $identityId;

    public function __construct($id, $street, $extended, $city, $zip, $zip4,
                                $stateName, $stateAbbv,
                                $addressType, $identityId)
    {
        $this->id = $id;
        $this->street = $street;
        $this->extended = $extended;
        $this->city = $city;
        $this->zip = $zip;
        $this->zip4 = $zip4;
        $this->stateName = $stateName;
        $this->stateAbbv = $stateAbbv;
        $this->addressType = $addressType;
        $this->identityId = $identityId;
    }

    public static function findByIdentityId($id)
    {
        $list = [];
        $db = Db::getInstance();
        $id = intval($id); // Security
        // Joins matching info from three tables. Can return multiple results.
        // YAY!!! This is my first LEFT JOIN I have ever understood on my own!
        $request = $db->prepare('SELECT a.idAddress, a.street, a.extended, ' .
            'a.city, a.zip, a.zip4, s.stateName, s.abbrv, ' .
            't.addressName, a.Identity_id ' .
            'FROM address AS a ' .
            'LEFT JOIN addresstype AS t ' .
            'ON a.Addresstype_id = t.idAddresstype ' .
            'LEFT JOIN state AS s ' .
            'ON a.state_id = s.idstate ' .
            'WHERE a.Identity_id = :id');
        $request->bindParam(":id", $id, PDO::PARAM_INT);
        $request->execute();
        foreach ($request->fetchAll() as $address) {
            $list[] = new Address($address['idAddress'], $address['street'],
                $address['extended'], $address['city'],
                $address['zip'], $address['zip4'],
                $address['stateName'], $address['abbrv'],
                $address['addressName'], $address['Identity_id']);
        }
        return $list;
    }

    public static function findById($id)
    {
        $list = [];
        $db = Db::getInstance();
        $id = intval($id); // Security
        // Joins matching info from three tables. Can return multiple results.
        // YAY!!! This is my first LEFT JOIN I have ever understood on my own!
        $request = $db->prepare('SELECT a.idAddress, a.street, a.extended, ' .
            'a.city, a.zip, a.zip4, s.stateName, s.abbrv, ' .
            't.addressName, a.Identity_id ' .
            'FROM address AS a ' .
            'LEFT JOIN addresstype AS t ' .
            'ON a.Addresstype_id = t.idAddresstype ' .
            'LEFT JOIN state AS s ' .
            'ON a.state_id = s.idstate ' .
            'WHERE a.idAddress = :id');
        $request->bindParam(":id", $id, PDO::PARAM_INT);
        $request->execute();
        foreach ($request->fetchAll() as $address) {
            $list[] = new Address($address['idAddress'], $address['street'],
                $address['extended'], $address['city'],
                $address['zip'], $address['zip4'],
                $address['stateName'], $address['abbrv'],
                $address['addressName'], $address['Identity_id']);
        }
        return $list;
    }


    public function getValues()
    {
        return array(
            'id' => $this->id,
            'street' => $this->street,
            'extended' => $this->extended,
            'city' => $this->city,
            'zip' => $this->zip,
            'zip4' => $this->zip4,
            'stateName' => $this->stateName,
            'stateAbbrv' => $this->stateAbbv,
            'addressType' => $this->addressType,
            'identityId' => $this->identityId
        );
    }

    public static function getTypes() {
        $list = [];
        $db = Db::getInstance();
        $request = $db->query('SELECT * FROM addresstype');
        $request->execute();
        foreach ($request->fetchAll() as $i) {
            $list[] = array('id' => $i['idAddressType'],
                            'name' => $i['addressName']);
        }
        return $list;
    }

    public static function getStates() {
        $list = [];
        $db = Db::getInstance();
        $request = $db->query('SELECT * FROM state');
        $request->execute();
        foreach ($request->fetchAll() as $i) {
            $list[] = array('id' => $i['idstate'],
                            'abbrv' => $i['abbrv'],
                            'name' => $i['stateName']);
        }
        return $list;
    }

    public static function newAddress($values) {
        $db = Db::getInstance();
        $request = $db->prepare(
            'INSERT INTO address '.
            '(street, extended, city, zip, zip4, state_id, AddressType_id,'.
            ' Identity_id) '.
            'VALUES (:street, :extended, :city, :zip, :zip4, :stateId, '.
            ':addressTypeId, :identityId)'
        );
        $request->bindParam(":street", $values['street'], PDO::PARAM_STR);
        $request->bindParam(":extended", $values['extended'], PDO::PARAM_STR);
        $request->bindParam(":city", $values['city'], PDO::PARAM_STR);
        $request->bindParam(":zip", $values['zip'], PDO::PARAM_INT);
        $request->bindParam(":zip4", $values['zip4'], PDO::PARAM_INT);
        $request->bindParam(":stateId", $values['stateId'], PDO::PARAM_INT);
        $request->bindParam(":addressTypeId", $values['addressTypeId'], PDO::PARAM_INT);
        $request->bindParam(":identityId", $values['identityId'], PDO::PARAM_INT);
        $request->execute();
        return $db->lastInsertId();
    }

    public static function editAddress($values) {
        if (isset($values['id'])) {
            $db = Db::getInstance();
            $request = $db->prepare(
                'UPDATE address '.
                'SET street=:street, extended=:extended, city=:city, zip=:zip, '.
                'zip4=:zip4, state_id=:stateId, AddressType_id=:addressTypeId'.
                'WHERE addressId = :id'
            );
            $request->bindParam(":street", $values['street'], PDO::PARAM_STR);
            $request->bindParam(":extended", $values['extended'], PDO::PARAM_STR);
            $request->bindParam(":city", $values['city'], PDO::PARAM_STR);
            $request->bindParam(":zip", $values['zip'], PDO::PARAM_INT);
            $request->bindParam(":zip4", $values['zip4'], PDO::PARAM_INT);
            $request->bindParam(":stateId", $values['stateId'], PDO::PARAM_INT);
            $request->bindParam(":addressTypeId", $values['addressTypeId'], PDO::PARAM_INT);
            $request->bindParam(":id", $values['id'], PDO::PARAM_INT);
            $request->execute();
            if(!$request->execute()) {
                return false;
            } else {
                return true;
            }
        } else {
            return false;
        }
    }

    public static function rowCount()
    {
        $db = Db::getInstance();
        return (int) $db->query('SELECT count(*) FROM address')->fetchColumn();
    }
}

?>
