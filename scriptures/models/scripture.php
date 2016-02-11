<?php
   class Scripture
   {
      public $id;
      public $book;
      public $chapter;
      public $verse;
      public $content;

      public function __construct($id, $book, $chapter, $verse, $content) {
         $this->id = $id;
         $this->book = $book;
         $this->chapter = $chapter;
         $this->verse = $verse;
         $this->content = $content;
      }

      public static function all() {
         $list = [];
         $db = Db::getInstance();
         $request = $db->query('SELECT * FROM scriptures');
         foreach ($request->fetchAll() as $scripture) {
            $list[] = new Scripture($scripture['id'], $scripture['book'],
                                    $scripture['chapter'], $scripture['verse'],
                                    $scripture['content']);
         }
         return $list;
      }

      public static function addScripture($book, $chapter, $verse, $content) {
         $db = Db::getInstance();
         $request = $db->prepare('INSERT INTO scriptures (book, chapter, '.
                                 'verse, content) VALUES (:book, :chapter, '.
                                 ':verse, :content)');
         $request->bindParam(':book', $book);
         $request->bindParam(':chapter', $chapter);
         $request->bindParam(':verse', $verse);
         $request->bindParam(':content', $content);
         $request->execute();
         return $db->lastInsertId();

         //return ID that the row was assigned
      }

      // $id scripture id
      // $topics array of topic id's associated with scripture
      public static function setTopics($id, $topics) {
         $db = Db::getInstance();
         foreach ($topics as $key => $value) {
            $request = $db->prepare('INSERT INTO scripture_topic ('.
                                    'scripture_id, topic_id) VALUES '.
                                    '(:scripture_id, :topid_id)');
            $request->bindParam(":scripture_id", $id);
            $request->bindParam(":topic_id", $value);
            $request->execute();
         }
      }
   }
?>
