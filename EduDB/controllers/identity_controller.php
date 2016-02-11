<?php
   class IdentityController {
      public function home() {
         $address = Address::findByIdentityId(1);
         $schools = School::all(0,50);
         $teachers = Teacher::findBySchoolId(1);
         $studentContacts = StudentContact::findByStudentId(1);
         $classes = Sclass::findByTeacherId(1);
         $student = Student::findById(1);
         require_once('views/identity/home.php');
      }

      public function listRecords() {
         $start = 0;
         $number = 50;
         $records = Identity::rowCount();
         if(isset($_POST['rStart']))
            $start = $_POST['rStart'];
         if(isset($_POST['rNumber']))
            $number = $_POST['rNumber'];
         $identities = Identity::all($start, $records);
         require_once('views/identity/list.php');
      }
   }

?>
