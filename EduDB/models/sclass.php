<?php
class Sclass
{
   public $id;
   public $teacher_id;
   public $grade_id;
   public $name;

   public function __construct($id, $teacher_id, $grade_id, $name) {
      $this->id = $id;
      $this->teacher_id = $teacher_id;
      $this->grade_id = $grade_id;
      $this->name = $name;
   }

   public static function all($start,$number) {
      $list = [];
      $db = Db::getInstance();
      $request = $db->prepare('SELECT * FROM class LIMIT :start, :number');
      $request->bindParam(":start", $start, PDO::PARAM_INT);
      $request->bindParam(":number", $number, PDO::PARAM_INT);
      $request->execute();
      foreach ($request->fetchAll as $class) {
         $list[] = new Sclass($class['idClass'], $class['Teacher_id'],
                              $class['GradeLevel_id'], $class['Name']);
      }
      return $list;
   }

   public static function findById($id) {
      $db = Db::getInstance();
      $request = $db->prepare('SELECT * FROM class WHERE id = :id');
      $request->execute(array('id' => $id));
      $class = $request->fetch();

      return new Sclass($class['idClass'], $class['Teacher_id'],
                        $class['GradeLevel_id'], $class['Name']);
   }



}

?>
