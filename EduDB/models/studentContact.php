<?php
require_once('models/identity.php');
class StudentContact
{
    // A student contact should contain a list of other identities it has a
    // relationship to.
    const STUDENT_CONTACTS = 1;
    const CONTACT_STUDENTS = 0;
    // contact has many students(0) OR student has many contacts(1)
    private $type;

    // [n][id, Student_id/Identity_id, Relationship_id, Relationship]
    // ID is the id contained in student_to_identity
    private $relationships;

    // Depending on the type, the id can belong to a student or to an identity
    private $id;

    public function __construct($type, $relationships, $id)
    {
        if (!($type == 0 || $type == 1)) {
            throw new Exception("Type must be 0 or 1.");
        }
        $this->type = $type;
        $this->relationships = $relationships;
        $this->$id = $id; // This can be a student ID or an Identity id depending on the type.
    }

    // For student view only!
    public static function findByStudentId($id)
    {
        $db = Db::getInstance();
        $request = $db->prepare('SELECT si.id, si.Identity_id, '.
                                'si.Relationship_id, r.type '.
                                'FROM student_to_identity AS si '.
                                'LEFT JOIN relationship AS r '.
                                'ON si.Relationship_id = r.idRelationship '.
                                'WHERE Student_id = :id');
        $request->bindParam(":id", $id, PDO::PARAM_INT);
        if(!$request->execute()) {
            $string = "Unable to execute studentContact::findByStudentId() ".
                      "USING $id";
            die($string);
        }

        $list = [];
        // We are getting a list of Identities
        foreach ($request->fetchAll() as $i) {
            $list[] = array(
                'id' => $i['id'], // the primary key for the table row of student_to_identity
                'identityID' => $i['Identity_id'],
                'relationshipID' => $i['Relationship_id'],
                'type' => $i['type']
            );
        }

        return new StudentContact(self::STUDENT_CONTACTS, $list, $id);
    }

    public static function findById($id)
    {

    }

    public static function findByIdentityId($id) {
        $db = Db::getInstance();
        $request = $db->prepare('SELECT si.id, si.Student_id, '.
                                'si.Relationship_id, r.type '.
                                'FROM student_to_identity AS si '.
                                'LEFT JOIN relationship AS r '.
                                'ON si.Relationship_id = r.idRelationship '.
                                'WHERE Identity_id = :id');
        $request->bindParam(":id", $id, PDO::PARAM_INT);
        if(!$request->execute()) {
            $string = "Unable to execute studentContact::findByIdentityId() ".
                      "USING $id";
            die($string);
        }

        $relationships = [];
        // We are getting a list of Identities
        foreach ($request->fetchAll() as $i) {
            $relationships[] = array(
                'id' => $i['id'],
                'studentID' => $i['Student_id'],
                'relationshipID' => $i['Relationship_id'],
                'type' => $i['type']
            );
        }

        return new StudentContact(self::CONTACT_STUDENTS, $relationships, $id);
    }

    public function getValues()
    {
        return array(
            'type' => $this->type,
            'relationships' => $this->relationships,
            'id' => $this->id
        );
    }

    public static function rowCount()
    {
        $db = Db::getInstance();
        return (int) $db->query('SELECT count(*) FROM student_to_identity')->fetchColumn();
    }
}

?>
