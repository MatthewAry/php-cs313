<?php
class School {
   private $id;
   private $name;


   public function __construct($id, $name) {
      $this->id = $id;
      $this->name = $name;
   }


   // Gets a list of schools in the Database
   // $start sets the records to skip
   // $number sets the records to grab at a time.
   public static function all($start,$number) {
      $start = intval($start);
      $end = intval($number);

      $list = [];
      $db = Db::getInstance();

      $records = $db->query('SELECT COUNT(*) FROM school');
      $records = $records->fetchColumn();
      $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, FALSE);
      $request = $db->prepare('SELECT * FROM school LIMIT '.
                              ':start,:number');
      $request->execute(array('start' => $start, 'number' => $number));
      foreach ($request->fetchAll() as $school) {
         $list[] = new School($school['idSchool'], $school['Name']);
      }

      return array('records' => $records, 'list' => $list);

      // returns an array with the number of records found and
      // a list of schools restricted to the
   }

   // Gets a list of classes, grades, and teachers belonging to a school.

   // Gets a list of students belonging to a school.
}
 ?>
