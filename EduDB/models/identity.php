<?php
class Identity
{
   private $id;
   private $first_name;
   private $middle_name;
   private $last_name;
   private $gender;
   private $email;
   private $imageURI;

   public function __construct($id, $first_name, $middle_name, $last_name,
                               $gender, $email, $imageURI) {
      $this->id = $id;
      $this->first_name = $first_name;
      $this->middle_name = $middle_name;
      $this->last_name = $last_name;
      if ($gender == true) {
         $this->gender = 'Male';
      } else {
         $this->gender = 'Female';
      }
      $this->email = $email;
      $this->imageURI = $imageURI;
   }

   public static function all() {
      $list = [];
      $db = Db::getInstance();
      $request = $db->query('SELECT * FROM identity');

      foreach ($request->fetchAll() as $identity) {
         $list[] = new Identity($identity['id'], $identity['first_name'],
                                $identity['middle_name'],
                                $identity['last_name'], $identity['gender'],
                                $identity['email'], $identity['id_Image_uri']);
      }
      return $list;
   }

   public static function findById($id) {
      $db = Db::getInstance();
      $id = intval($id);
      $request = $db->prepare('SELECT * FROM identity WHERE id = :id');
      $request->execute(array('id' => $id));
      $identity = $request->fetch();

      return new Identity($identity['id'], $identity['first_name'],
                              $identity['middle_name'], $identity['last_name'],
                              $identity['gender'], $identity['email'],
                              $identity['id_Image_uri']);
   }

   public static function findByFirstName($firstName) {
      $list = [];
      $db = Db::getInstance();

      $request = $db->prepare('SELECT * FROM identity WHERE first_name = :id');
   }

   public static function findByLastName($lastName) {

   }

   public static function findByName($partOne, $partTwo) {

   }

   // Getter
   public function getValues() {
      return array('id' => $id, 'firstName' => $first_name,
                   'middleName' => $middle_name, 'lastName' => $last_name,
                   'gender' => $gender, 'email' => $imageURI);
   }

}
?>
