<?php
class Student {
   private $studentId;
   private $identity; // An Identity Model Object
   private $grade; // Grade Model Object
   private $school; // School Model Object
   private $classList; // A list of Class Objects
   private $contactList; // A list of Student contacts


   public function __construct($schoolId, $identityId, $gradeId, $identity) {
      $this->schoolId = $schoolId;
      $this->identityId = $identityId;
      $this->gradeId = $gradeId;
      $this->identity = $identity;
   }

   // We are only doing getters!
   public static function all() {
      $list = [];
      $db = Db::getInstance();
      $request = $db->query('SELECT * FROM Student');
      foreach ($request->fetchAll as $student) {
         // Get the identity
         // Get the grade
         // Get the school

      }
      return $list;
   }

   public function getValues() {
      return array('id' => $studentId, 'identity' => $identity.getValues(),
                   'grade' => $grade.getValues(), 'school' => $school.getValues());
   }

}
 ?>
