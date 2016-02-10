<?php
   class Phone {
      private $id;
      private $number;
      private $type;

      public function __construct($id, $number, $type) {
         $this->id = $id;
         $this->number = $number;
         $this->type = $type;
      }

      public static function findByIdentityId($id) {
         $list = [];
         $db = Db::getInstance();
         $id = intval($id);
         $request = $db->prepare('SELECT * FROM phone AS p '.
                                 'LEFT JOIN phonetype as t '.
                                    'ON p.phoneType_id = t.idphoneType '.
                                 'WHERE p.Identity_id = :id');
         $request->execute(array('id'=>$id));
         foreach ($request->fetchAll() as $phone) {
            $list[] = new Phone($phone['idphone'], $phone['number'],
                                $phone['name']);
         }
         return $list;
      }

      public function getValues() {
         return array('id' => $this->id, 'number' => $this->number,
                      'type' => $this->type);
      }
   }
 ?>
