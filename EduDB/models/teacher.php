<?php
class Teacher {
   private $id;
   private $schoolId;
   private $identityId;
   private $details;
   private $identity;

   private function getIdentity($identiyId) {
      $this->identity = Identity::findById($identityId);
   }

   public function __construct($id, $schoolId, $identityId, $details) {
      $this->id = $id;
      $this->schoolId = $schoolId;
      $this->identityId = $identiyId;
      $this->details = $details;
      getIdentity();
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

   public function getValues() {
      return array('id' => $id, 'schoolId' => $schoolId,
                   'identityID' => $identityId, 'details' => $details);
   }
}
 ?>
