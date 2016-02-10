<?php
class Grade {
   private $gradeId;
   private $name;

   public function __construct($grade, $name) {
      $this->gradeId = $grade;
      $this->name = $name;
   }

   public static function all($start, $number) {
      $list = [];
      $db = Db::getInstance();
      $request = $db->prepare('SELECT * FROM GradeLevel LIMIT :start, :number');
      $request->bindParam(":start", $start, PDO::PARAM_INT);
      $request->bindParam(":number", $number, PDO::PARAM_INT);
      $request->execute();
      foreach ($request->fetchAll as $grade) {
         $list[] = new Grade($grade['idGrade'], $grade['Name']);
      }
      return $list;
   }

   public static function findById($id) {
      $db = Db::getInstance();
      $request = $db->prepare('SELECT * FROM GradeLevel WHERE idGrade = :id');
      $request->bindParam(":id", $id, PDO::PARAM_INT);
      $request->execute();
      $result = $request->fetch();
      return new Grade($result['idGrade'], $result['Name']);
   }

   public function getValues() {
      return array('id' => $this->gradeId, 'name' => $this->name);
   }
}
?>
