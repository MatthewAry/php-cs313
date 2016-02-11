<?php
   class ScriptureController {
      public function home() {
         $scriptures = Scripture::all();
         $topics = Topic::all();
         require_once('views/scripture/home.php');
      }

      public function post() {
         $id = Scripture::addScripture($_POST['book'], $_POST['chapter'],
                                 $_POST['verse'], $_POST['content']);
         $topics = [];
         foreach ($_POST['tId'] as $key => $value) {
            $topics[] = $value;
         }

         Scripture::setTopics($id, $topics);
      }

   }
