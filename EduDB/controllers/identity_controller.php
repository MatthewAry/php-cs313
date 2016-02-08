<?php
   class IdentityController {
      public function home() {
         $identities = Identity::all();
         $address = Address::findByIdentityId(1);
         $schools = School::all(0,50);
         require_once('views/identity/home.php');
      }

      public function show() {
         if (!isset($_GET['id'])) {

         }
      }
   }

?>
