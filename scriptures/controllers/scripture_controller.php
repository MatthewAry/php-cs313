<?php
   class ScriptureController {
      public function home() {
         $scriptures = Scripture::all();
         require_once('views/scripture/home.php');
      }

   }
