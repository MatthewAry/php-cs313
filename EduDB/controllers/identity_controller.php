<?php
   class IdentityController {
      public function home() {
         $identities = Identity::all(0,50);
         $address = Address::findByIdentityId(1);
         $schools = School::all(0,50);
         $teachers = Teacher::findBySchoolId(1);
         $studentContacts = StudentContact::findByStudentId(1);
         $classes = Sclass::findByTeacherId(1);
         $student = Student::findById(1);
         require_once('views/identity/home.php');
      }

      public function show() {
         if (!isset($_GET['id'])) {

         }
      }
   }

?>
