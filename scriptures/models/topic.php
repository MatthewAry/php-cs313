<?php
class Topic {
   public $id;
   public $name;

   public function __construct($id, $name) {
      $this->id = $id;
      $this->name = $name;
   }

   public static function insert($name) {
      $db = Db::getInstance();
      //$request = $db->prepare('INSERT INTO topics (name) ');

      //return ID that the row was assigned
   }

   public static function all( ) {
      $list = [];
      $db = Db::getInstance();
      $request = $db->query('SELECT * FROM topics');
      foreach ($request->fetchAll() as $i) {
         $list[] = new Topic($i['id'],$i['name']);
      }
      return $list;
   }
}

 ?>
