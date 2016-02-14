<?php
include_once ('models/teacher.php');
include_once ('models/grade.php');
class Sclass
{
    private $id;
    private $teacher_id;
    private $school_id;
    private $grade_id;
    private $name;

    public function __construct($id, $teacher_id, $school_id, $grade_id, $name)
    {
        $this->id = $id;
        $this->teacher_id = $teacher_id;
        $this->school_id = $school_id;
        $this->grade_id = $grade_id;
        $this->name = $name;
    }

    public static function all($start, $number) {
        $list = [];
        $db = Db::getInstance();
        $request = $db->prepare('SELECT * FROM class LIMIT :start, :number');
        $request->bindParam(":start", $start, PDO::PARAM_INT);
        $request->bindParam(":number", $number, PDO::PARAM_INT);
        $request->execute();
        foreach ($request->fetchAll as $class) {
            $list[] = new Sclass($class['idClass'], $class['Teacher_id'],
                $class['schoolId'], $class['GradeLevel_id'], $class['Name']);
        }
        return $list;
    }

    public static function getAllClassesAtSchool($schoolId, $start, $number) {
        $list = [];
        $db = Db::getInstance();
        $request = $db->prepare('SELECT * FROM class WHERE schoolId = :id '.
                   'LIMIT :start, :number');
        $request->bindParam(":id", $schoolId, PDO::PARAM_INT);
        $request->bindParam(":start", $start, PDO::PARAM_INT);
        $request->bindParam(":number", $number, PDO::PARAM_INT);
        $request->execute();
        foreach ($request->fetchAll() as $class) {
            $list[] = new Sclass($class['idClass'], $class['Teacher_id'],
                $class['schoolId'], $class['GradeLevel_id'], $class['Name']);
        }
        return $list;
    }

    public static function findById($id) {
        $db = Db::getInstance();
        $request = $db->prepare('SELECT * FROM class WHERE idClass = :id');
        $request->execute(array('id' => $id));
        $class = $request->fetch();

        return new Sclass($class['idClass'], $class['Teacher_id'],
            $class['schoolId'], $class['GradeLevel_id'], $class['Name']);
    }

    public static function findByTeacherId($id)
    {
        $list = [];
        $db = Db::getInstance();
        $request = $db->prepare('SELECT * FROM class WHERE Teacher_id = :id');
        $request->execute(array('id' => $id));
        foreach ($request->fetchAll as $class) {
            $list[] = new Sclass($class['idClass'], $class['Teacher_id'],
                $class['schoolId'], $class['GradeLevel_id'], $class['Name']);
        }
        return $list;
    }

    public function getValues()
    {
        return array('id' => $this->id,
            'teacher' => Teacher::findById($this->teacher_id)->getValues(),
            'schoolId' => $this->school_id,
            'grade' => Grade::findById($this->grade_id)->getValues(),
            'name' => $this->name);
    }

    public static function rowCount()
    {
        $db = Db::getInstance();
        return (int) $db->query('SELECT count(*) FROM class')->fetchColumn();
    }
}

?>
