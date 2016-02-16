<?php

require_once('models/grade.php');
require_once('models/studentContact.php');
require_once('models/identity.php');
require_once('models/school.php');
require_once('models/sclass.php');
class Student
{
    private $studentId;
    private $identity; // An Identity Model Object
    private $grade; // Grade Model Object
    private $school; // School Model Object
    private $classList; // A list of Class Objects
    private $contactList; // A list of Student contacts

    public function __construct($studentId, $identityId, $gradeId, $schoolId) {
        $this->studentId = $studentId;
        $this->identity = Identity::findById($identityId);
        $this->school = School::findById($schoolId);
        $this->grade = Grade::findById($gradeId);
    }

    public static function allStudentsAtSchool($schoolId, $start = 0, $number = false)
    {
        $list = [];
        $db = Db::getInstance();
        if (!$number) {
            $number = self::rowCountAtSchool($schoolId);
        }
        $request = $db->prepare('SELECT * FROM student WHERE School_id = :id ' .
            'LIMIT :start, :number');
        $request->bindParam(":id", $schoolId, PDO::PARAM_INT);
        $request->bindParam(":start", $start, PDO::PARAM_INT);

        $request->bindParam(":number", $number, PDO::PARAM_INT);
        $request->execute();
        foreach ($request->fetchAll() as $student) {
            $list[] = new Student($student['idStudent'], $student['Identity_id'],
                $student['Grade_id'], $student['School_id']);
        }
        return $list;
    }

    public function getValues()
    {
        $values = array('id' => $this->studentId,
            'identity' => $this->identity->getValues(),
            'grade' => $this->grade->getValues(),
            'school' => $this->school->getValues());
        // For performance reasons we might not need the stuff below.
        if (!empty($this->classList)) {
            $values['classList'] = $this->classList;
        }
        if (!empty($this->contactList)) {
            $values['contactList'] = $this->contactList;
        }
        return $values;
    }

    public static function all($start, $number) {
        $list = [];
        $db = Db::getInstance();
        $request = $db->prepare('SELECT * FROM student LIMIT :start, :number');
        $request->bindParam(":start", $start, PDO::PARAM_INT);
        $request->bindParam(":number", $number, PDO::PARAM_INT);
        $request->execute();
        foreach ($request->fetchAll() as $student) {
            $item = new Student($student['idStudent'], $student['Identity_id'],
                $student['Grade_id'], $student['School_id']);
            $list[] = $item->getValues();
        }
        return $list;
    }

    public static function findById($id)
    {
        $db = Db::getInstance();
        $request = $db->prepare('SELECT * FROM student WHERE idStudent = :id');
        $request->bindParam(":id", $id, PDO::PARAM_INT);
        $request->execute();
        $result = $request->fetch();
        return new Student($result['idStudent'], $result['Identity_id'],
            $result['Grade_id'], $result['School_id']);
    }

    public function loadClassList()
    {
        $list = [];
        $db = Db::getInstance();
        $request = $db->prepare('SELECT * FROM student_to_class WHERE Student_id = :id ');
        $request->bindParam(":id", $this->studentId, PDO::PARAM_INT);
        $request->execute();
        foreach ($request->fetchAll() as $class) {
            $item = Sclass::findById($class['Class_id']);
            $list[] = $item->getValues();
        }
        $this->classList = $list;
    }

    public function loadContactList()
    {
        $list = StudentContact::findByStudentId($this->studentId);
        foreach ($list as $i) {
            $this->contactList[] = $i->getValues();
        }
    }

    public static function updateStudent($values) {
        // This is as bad as it looks since it means tight coupling.
        if (isset($values['id'])) {
            $query = 'UPDATE student SET ';
            $queryBuilder = [];
            if (isset($values['gradeId'])) {
                $queryBuilder[] ='Grade_id = :gradeId';
            }
            if (isset($values['identityId'])) {
                $queryBuilder[] ='Identity_id = :identityId';
            }
            if (isset($values['schoolId'])) {
                $queryBuilder[] ='School_id = :schoolId';
            }
            foreach ($queryBuilder as $key => $value) {
                $query = $query . $value;
                if (isset($queryBuilder[$key+1])) {
                    $query = $query .', ';
                } else {
                    $query = $query .' ';
                }
            }

            $query = $query . 'WHERE idStudent = :id';

            $db = Db::getInstance();
            $request = $db->prepare($query);

            $request->bindParam(":id", $values['id'], PDO::PARAM_INT);
            if (isset($values['gradeId'])) {
                $request->bindParam(":gradeId", $values['gradeId'], PDO::PARAM_STR);
            }
            if (isset($values['identityId'])) {
                $request->bindParam(":identityId", $values['identityId'], PDO::PARAM_STR);
            }
            if (isset($values['schoolId'])) {
                $request->bindParam(":schoolId", $values['schoolId'], PDO::PARAM_STR);
            }
            if(!$request->execute()) {
                return false;
            } else {
                return true;
            }
        } else {
            return false;
        }
    }

    public static function rowCountAtSchool($schoolId) {
        $db = Db::getInstance();
        $request = $db->prepare('SELECT count(*) FROM student WHERE School_id = :id');
        $request->bindParam(":id", $schoolId, PDO::PARAM_INT);
        $request->execute();
        return (int) $request->fetchColumn();
    }

    public static function rowCount()
    {
        $db = Db::getInstance();
        return (int) $db->query('SELECT count(*) FROM student')->fetchColumn();
    }
}

?>
