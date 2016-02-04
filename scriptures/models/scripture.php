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
   }
?>
