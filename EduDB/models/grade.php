<?php
class Grade {
   private $gradeId;
   private $name;

   public function __construct($grade, $name) {
      $this->grade = $grade;
      $this->name = $name;
   }

   public static function all() {
      $list = [];
      $db = Db::getInstance();
      $request = $db->query('SELECT * FROM GradeLevel');

      foreach ($request->fetchAll as $grade) {
         $list[] = new Grade($grade['idGrade'], $grade['Name']);
      }
      return $list;
   }

   public function getValues() {
      return array('id' => $gradeId, 'name' => $name);
   }
}
?>
