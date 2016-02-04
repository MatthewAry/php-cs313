<?php
   class IdentityController {
      public function home() {
         $identities = Identity::all();
         require_once('views/identity/home.php');
      }

      public function show() {
         if (!isset($_GET['id'])) {

         }
      }
   }

?>
