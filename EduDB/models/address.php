<?php
class Address {
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
                               $addressType, $identityId) {
      $this->id = $id;
      $this->street = $street;
      $this->extended = $extended;
      $this->city = $city;
      $this->zip = $zip;
      $this->zip4 = $zip4;
      $this->stateName = $stateName;
      $this->stateAbbv = $stateAbbv;
      $this->addressType = $addressType;
   }

   public static function findByIdentityId($id) {
      $list = [];
      $db = Db::getInstance();
      $id = intval($id); // Security
      // Joins matching info from three tables. Can return multiple results.
      // YAY!!! This is my first LEFT JOIN I have ever understood on my own!
      $request = $db->prepare('SELECT a.idAddress, a.street, a.extended, ' .
                              'a.city, a.zip, a.zip4, s.stateName, s.abbrv, '.
                              't.addressName, a.Identity_id ' .
                              'FROM address AS a ' .
                              'LEFT JOIN AddressType AS t '.
                                 'ON a.AddressType_id = t.idAddressType '.
                              'LEFT JOIN state AS s '.
                                 'ON a.state_id = s.idstate ' .
                              'WHERE a.Identity_id = :id');
      $request->execute(array('id' => $id));
      foreach ($request->fetchAll() as $address) {
         $list[] = new Address($address['idAddress'], $address['street'],
                               $address['extended'], $address['city'],
                               $address['zip'], $address['zip4'],
                               $address['stateName'], $address['abbrv'],
                               $address['addressName'], $address['Identity_id']);
      }
      return $list;
   }
}
?>