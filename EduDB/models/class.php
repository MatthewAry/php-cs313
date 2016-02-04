<?php
class Iclass
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

   public static function all() {
      $list = [];
      $db = Db::getInstance();
      $request = $db->query('SELECT * FROM class');
      foreach ($request->fetchAll as $class) {
         $list[] = new Iclass($class['idClass'], $class['Teacher_id'],
                              $class['GradeLevel_id'], $class['Name']);
      }
      return $list;
   }

   public static function find($id) {
      $db = Db::getInstance();
      $id = intval($id);
      $request = $db->prepare('SELECT * FROM class WHERE id = :id');
      $request->execute(array('id' => $id));
      $class = $request->fetch();

      return new Iclass($class['idClass'], $class['Teacher_id'],
                        $class['GradeLevel_id'], $class['Name']);
   }
   
}

?>
