<?php
require_once('models/identity.php');
class StudentContact
{
    private $id;
    private $studentID;
    private $identityID;
    private $relationshipID;
    private $relationship;
    private $identity;

    private function getIdentity($identityID)
    {
        $this->identity = Identity::findById($identityID);
    }

    private function getRelationship($id)
    {
        $db = Db::getInstance();
        $request = $db->prepare('SELECT Type FROM relationship ' .
            'WHERE idRelationship = :id');
        $request->bindParam(":id", $id, PDO::PARAM_INT);
        $request->execute();
        $this->relationship = $request->fetch();
    }

    public static function getRelationships() {
        $db = Db::getInstance();
        $request = $db->prepare('SELECT * FROM relationship ');
        $request->execute();
        $list = [];
        foreach ($request->fetchAll() as $i) {
            $list[] = array("id" => $i['idRelationship'], "type" => $i['Type']);
        }
        return $list;
    }

    public function __construct($id, $studentID, $identityID, $relationshipID)
    {
        $this->id = $id;
        $this->studentID = $studentID;
        $this->identityID = $identityID;
        $this->relationshipID = $relationshipID;
        $this->getRelationship($relationshipID);
        $this->getIdentity($identityID);
    }

    // Returns a list of Student Contacts
    public static function findByStudentId($id)
    {
        $list = [];
        $db = Db::getInstance();
        $request = $db->prepare('SELECT * FROM student_to_identity ' .
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

    public static function findById($id)
    {
        $list = [];
        $db = Db::getInstance();
        $request = $db->prepare('SELECT * FROM student_to_identity ' .
                                'WHERE id = :id');
        $request->bindParam(":id", $id, PDO::PARAM_INT);
        $request->execute();
        $result = $request->fetch();
        return new StudentContact($result['id'], $result['Student_id'],
            $result['Identity_id'],
            $result['Relationship_id']);
    }

    public function getValues()
    {
        return array('id' => $this->id, 'studentID' => $this->studentID,
            'identityID' => $this->identityID,
            'relationshipID' => $this->relationshipID,
            'relationship' => $this->relationship,
            'identity' => $this->identity->getValues());
    }

    public static function rowCount()
    {
        $db = Db::getInstance();
        return (int) $db->query('SELECT count(*) FROM student_to_identity')->fetchColumn();
    }
}

?>
