<?php

class Grade
{
    private $gradeId;
    private $name;

    public function __construct($grade, $name)
    {
        $this->gradeId = $grade;
        $this->name = $name;
    }

    public static function all($start = 0, $number = false)
    {
        $list = [];
        $db = Db::getInstance();
        $request = $db->prepare('SELECT * FROM gradelevel LIMIT :start, :number');
        if (!$number) {
            $number = self::rowCount();
        }
        $request->bindParam(":start", $start, PDO::PARAM_INT);
        $request->bindParam(":number", $number, PDO::PARAM_INT);
        $request->execute();
        foreach ($request->fetchAll() as $grade) {
            $list[] = new Grade($grade['idGrade'], $grade['Name']);
        }
        return $list;
    }

    public static function findById($id)
    {
        $db = Db::getInstance();
        $request = $db->prepare('SELECT * FROM gradelevel WHERE idGrade = :id');
        $request->bindParam(":id", $id, PDO::PARAM_INT);
        $request->execute();
        $result = $request->fetch();
        return new Grade($result['idGrade'], $result['Name']);
    }

    public function getValues()
    {
        return array('id' => $this->gradeId, 'name' => $this->name);
    }

    public static function rowCount()
    {
        $db = Db::getInstance();
        return (int) $db->query('SELECT count(*) FROM gradelevel')->fetchColumn();
    }
}

?>
