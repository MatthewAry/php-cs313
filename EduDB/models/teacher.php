<?php
class Teacher {
   private $id;
   private $schoolId;
   private $identityId;
   private $details;
   private $identity;

   private function getIdentity($identityId) {
      $this->identity = Identity::findById($identityId);
   }

   public function __construct($id, $schoolId, $identityId, $details) {
      $this->id = $id;
      $this->schoolId = $schoolId;
      $this->identityId = $identityId;
      $this->details = $details;
      $this->getIdentity($identityId);
   }

   public function findById($id) {
      $db = Db::getInstance();
      $id = intval($id); // Validate that it is actually a number
      $request = $db->prepare('SELECT * FROM Teacher WHERE idTeacher = :id');
      $request->execute(array('id' => $id));
      $teacher = $request->fetch();

      return new Teacher($teacher['idTeacher'], $teacher['School_id'],
                         $teacher['Identity_id'], $teacher['details']);
   }

   public static function findBySchoolId($id) {
      $list = [];
      $db = Db::getInstance();
      $id = intval($id); // Validate that it is actually a number
      $request = $db->prepare('SELECT * FROM Teacher WHERE School_id = :id');
      $request->execute(array('id' => $id));
      foreach ($request->fetchAll() as $teacher) {
         $list[] = new Teacher($teacher['idTeacher'], $teacher['School_id'],
                            $teacher['Identity_id'], $teacher['Details']);
      }
      return $list;
   }

   public function getValues() {
      return array('id' => $this->id, 'schoolId' => $this->schoolId,
                   'identityID' => $this->identityId,
                   'details' => $this->details,
                   'identity' => $this->identity->getValues());
   }
}
 ?>
