<?php
class Student {
   private $studentId;
   private $identity; // An Identity Model Object
   private $grade; // Grade Model Object
   private $school; // School Model Object
   private $classList; // A list of Class Objects
   private $contactList; // A list of Student contacts


   public function __construct($studentId, $identityId, $gradeId, $schoolId) {
      $this->studentId = $studentId;
      $this->identity = Identity::find($identityId);
      $this->school = School::find($schoolId);
      $this->grade = Grade::find($gradeId);
   }

   // We are only doing getters!
   public static function allStudentsAtSchool($schoolId,$start,$number) {
      $list = [];
      $db = Db::getInstance();
      $request = $db->prepare('SELECT * FROM Student WHERE School_id = :id '.
                            'LIMIT :start, :number');
      $request->bindParam(":id", $id, PDO::PARAM_INT);
      $request->bindParam(":start", $start, PDO::PARAM_INT);
      $request->bindParam(":number", $number, PDO::PARAM_INT);
      $request->execute();
      foreach ($request->fetchAll as $student) {
         $list[] = new Student($student['idStudent'], $student['Identity_id'],
                               $student['Grade_id'], $student['School_id']);
      }
      return $list;
   }

   public function getValues() {
      $values = array('id' => $studentId, 'identity' => $identity.getValues(),
                      'grade' => $grade.getValues(),
                      'school' => $school.getValues());
      if (isset($classList)) {
         $values['classList'] = $classList;
      }
      if (isset($contactList)) {
         $values['contactList'] = $contactList;
      }
   }

   public function loadClassList() {
      $list = [];
      $db = Db::getInstance();
      $request = $db->prepare('SELECT * FROM student_to_class WHERE Student_id = :id '.
                            'LIMIT :start, :number');
      $request->bindParam(":id", $studentId, PDO::PARAM_INT);
      $request->execute();
      foreach ($request->fetchAll as $class) {
         $list[] = Sclass::findById($class['Class_id']);
      }
      $classList = $list;
   }

   public function loadContactList() {
      $contactList = StudentContact::findByStudentId($studentId);
   }

}
 ?>
