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


    public function __construct($studentId, $identityId, $gradeId, $schoolId)
    {
        $this->studentId = $studentId;
        $this->identity = Identity::findById($identityId);
        $this->school = School::findById($schoolId);
        $this->grade = Grade::findById($gradeId);
    }

    // We are only doing getters!
    public static function allStudentsAtSchool($schoolId, $start, $number)
    {
        $list = [];
        $db = Db::getInstance();
        $request = $db->prepare('SELECT * FROM Student WHERE School_id = :id ' .
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


    public static function rowCount()
    {
        $db = Db::getInstance();
        return (int) $db->query('SELECT count(*) FROM student')->fetchColumn();
    }
}

?>
