<?php
require_once('models/identity.php');
class StudentContact
{
    // A student contact should contain a list of other identities it has a
    // relationship to.
    const STUDENT_CONTACTS = 2;
    const CONTACT_STUDENTS = 1;
    // contact has many students(1) OR student has many contacts(1)
    private $type;

    // [n][id, Student_id/Identity_id, Relationship_id, Relationship]
    // ID is the id contained in student_to_identity
    private $relationships;

    // Depending on the type, the id can belong to a student or to an identity
    private $id;

    public function __construct($type, $relationships, $id)
    {
        if (!($type == 1 || $type == 2)) {
            throw new Exception("Type must be 1 or 2.");
            $this->$id = $id; // This can be a student ID or an Identity id depending on the type.
        }
        $this->type = $type;
        $this->relationships = $relationships;
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
        // $id is studentID
        return new StudentContact(self::STUDENT_CONTACTS, $list, $id);
    }

    public static function findById($id)
    {
        $db = Db::getInstance();
        $request = $db->prepare(
            'SELECT * FROM student_to_identity '.
            'WHERE id = :id');
        $request->bindParam(":id", $id, PDO::PARAM_INT);
        if (!$request->execute()) {
            return false;
        }
        $response = $request->fetch();
        $list = array(
            'id' => $response['id'], // the primary key for the table row of student_to_identity
            'identityId' => $response['Identity_id'],
            'studentId' => $response['Student_id'],
            'relationshipID' => $response['Relationship_id']
        );
        return new StudentContact(self::STUDENT_CONTACTS, $list, $id);
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
                'id' => $i['id'], // the primary key for the table row of student_to_identity
                'studentID' => $i['Student_id'],
                'relationshipID' => $i['Relationship_id'],
                'type' => $i['type']
            );
        }
        // $id is identityID
        return new StudentContact(self::CONTACT_STUDENTS, $relationships, $id);
    }

    public static function findTypeById($id) {
        $db = Db::getInstance();
        $request = $db->prepare('SELECT * FROM relationship WHERE idRelationship = :id');
        $request->bindParam(":id", $id, PDO::PARAM_INT);
        if (!$request->execute()) {
            return false;
        }
        $response = $request->fetch();
        return array(
            'id' => $response['idRelationship'],
            'type' => $response['Type']
        );
    }

    public function getValues()
    {
        if (isset($this->id)) {
            return array(
                'type' => $this->type,
                'relationships' => $this->relationships,
                // Depending on the type, the id can belong to a student or to an identity
                'id' => $this->id
            );
        } else {
            return array(
                'type' => $this->type,
                'relationships' => $this->relationships,
            );
        }
    }

    public static function rowCount()
    {
        $db = Db::getInstance();
        return (int) $db->query('SELECT count(*) FROM student_to_identity')->fetchColumn();
    }

    public static function getTypes() {
        $db = Db::getInstance();
        $request = $db->query('SELECT * FROM relationship');
        if (!$request->execute()) {
            return false;
        }
        $list = [];
        foreach ($request->fetchAll() as $i) {
            $list[] = array('id' => $i['idRelationship'], 'name' => $i['Type']);
        }
        return $list;
    }

    public static function linkContact($identityId, $contactId, $relationshipId) {
        $db = Db::getInstance();
        $query = "INSERT INTO student_to_identity ".
                 "(Identity_id, Student_id, Relationship_id) VALUES ".
                 "(:identity, :contact, :relationship)";
        $request = $db->prepare($query);
        $request->bindParam(":identity", $identityId, PDO::PARAM_INT);
        $request->bindParam(":contact", $contactId,PDO::PARAM_INT);
        $request->bindParam(":relationship", $relationshipId,PDO::PARAM_INT);
        $id = $request->execute();
        if (!$id) {
            return false;
        }
        return $id;
    }

    public static function updateContact($values) {
        if (isset($values['id'])) {
            # code...
        } else {
            // ERROR!!!
        }
    }

    public static function unlinkContact($id) {
        $db = Db::getInstance();
        $request = $db->prepare(
            'DELETE FROM student_to_identity '.
            'WHERE id = :id'
        );
        $request->bindParam(":id", $id, PDO::PARAM_INT);
        if (!$request->execute()) {
            return false;
        }
    }
}

?>
