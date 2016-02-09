<?php
class StudentContact {
   private $id;
   private $studentID;
   private $identityID;
   private $relationshipID;
   private $relationship;
   private $identity;

   private function getIdentity($identityID) {
      $this->identity = Identity::findById($identityID);
   }

   private function getRelationship() {
      $db = Db::getInstance();
      $request = $db->prepare('SELECT Type FROM Relationship '.
                              'WHERE idRelationship = :id');
      $request->bindParam(":id", $id, PDO::PARAM_INT);
      $request->execute();
      $relationship = $request->fetch();
   }

   public function __construct($id, $studentID, $identityID, $relationshipID) {
      $this->id = $id;
      $this->studentID = $studentID;
      $this->identityID = $identityID;
      $this->relationshipID = $relationshipID;
      getRelationship();
      getIdentity();
   }

   // Returns a list of Student Contacts
   public static function findByStudentId($id) {
      $list = [];
      $db = Db::getInstance();
      $request = $db->prepare('SELECT * FROM student_to_identity '.
                              'WHERE Student_id = :id');
      $request->bindParam(":id", $id, PDO::PARAM_INT);
      $request->execute();
      foreach ($request->fetchAll() as $result) {
         $list[] = new StudentContact($result['id'], $result['Student_id'],
                                   $result['Identity_id'],
                                   $result['Relationship_id']);
      }
      return $list;
   }

   public function getValues() {
      return array('id' => $id, 'studentID' => $studentID,
                   'identityID' => $identityID,
                   'relationshipID' => $relationshipID, 'identity' => $identity);
   }
}

?>
