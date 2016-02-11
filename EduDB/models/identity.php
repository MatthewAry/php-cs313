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

   public static function all($start, $number) {
      $list = [];
      $db = Db::getInstance();
      $request = $db->prepare('SELECT * FROM identity LIMIT :start, :number');
      $request->bindParam(":start", $start, PDO::PARAM_INT);
      $request->bindParam(":number", $number, PDO::PARAM_INT);
      $request->execute();

      foreach ($request->fetchAll() as $identity) {
         $list[] = new Identity($identity['id'], $identity['first_name'],
                                $identity['middle_name'],
                                $identity['last_name'], $identity['gender'],
                                $identity['email'], $identity['id_Image_uri']);
      }
      return $list;
   }

   public static function rowCount() {
      $db = Db::getInstance();
      return (int) $db->query('SELECT count(*) FROM identity')->fetchColumn();
   }

   public static function findById($id) {
      $db = Db::getInstance();
      $request = $db->prepare('SELECT * FROM identity WHERE id = :id');
      $request->bindParam(":id", $id, PDO::PARAM_INT);
      $request->execute();
      $identity = $request->fetch();

      return new Identity($identity['id'], $identity['first_name'],
                              $identity['middle_name'], $identity['last_name'],
                              $identity['gender'], $identity['email'],
                              $identity['id_Image_uri']);
   }

   public static function findByFirstName($firstName) {
      $list = [];
      $db = Db::getInstance();

      $request = $db->prepare('SELECT * FROM identity WHERE first_name = '.
                              ':firstName');
   }

   public static function findByLastName($lastName) {

   }

   public static function findByName($partOne, $partTwo) {

   }

   // Getter
   public function getValues() {
      return array('id' => $this->id,
                   'firstName' => $this->first_name,
                   'middleName' => $this->middle_name,
                   'lastName' => $this->last_name,
                   'gender' => $this->gender,
                   'email' => $this->email,
                   'image' => $this->imageURI);
   }

}
?>
