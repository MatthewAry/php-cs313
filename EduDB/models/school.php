<?php

class School
{
    private $id;
    private $name;

    public function __construct($id, $name)
    {
        $this->id = $id;
        $this->name = $name;
    }


    // Gets a list of schools in the Database
    // $start sets the records to skip
    // $number sets the records to grab at a time.
    public static function all($start, $number)
    {
        $list = [];
        $db = Db::getInstance();

        $records = $db->query('SELECT COUNT(*) FROM school');
        $records = $records->fetchColumn();
        $request = $db->prepare('SELECT * FROM school LIMIT ' .
            ':start,:number');
        $request->bindParam(":start", $start, PDO::PARAM_INT);
        $request->bindParam(":number", $number, PDO::PARAM_INT);
        $request->execute();
        foreach ($request->fetchAll() as $school) {
            $list[] = new School($school['idSchool'], $school['Name']);
        }
        return array('records' => $records, 'list' => $list);

        // returns an array with the number of records found and
        // a list of schools restricted to the
    }

    // Finds a school
    public static function findById($id)
    {
        $db = Db::getInstance();
        $request = $db->prepare('SELECT * FROM school WHERE idSchool = :id');
        $request->bindParam(":id", $id, PDO::PARAM_INT);
        $request->execute();
        $result = $request->fetch();
        return new School($result['idSchool'], $result['Name']);
    }

    // Gets a list of classes, grades, and teachers belonging to a school.

    // Gets a list of students belonging to a school.
    public static function rowCount()
    {
        $db = Db::getInstance();
        return (int) $db->query('SELECT count(*) FROM school')->fetchColumn();
    }

    // Get Values
    public function getValues()
    {
        return array('id' => $this->id, 'name' => $this->name);
    }
}

?>
