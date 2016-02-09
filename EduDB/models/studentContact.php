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
      $request->execute(array('id' => $relationshipID));
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
   // We want to refactor our DB to include an ID for the relationship table.
   // Why? So we can look things up when and if we need to.
   public function getValues() {
      return array('id' => $id, 'studentID' => $studentID,
                   'identityID' => $identityID,
                   'relationshipID' => $relationshipID, 'identity' => $identity);
   }
}

?>
