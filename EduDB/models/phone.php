<?php

class Phone
{
    private $id;
    private $number;
    private $type;

    public function __construct($id, $number, $type)
    {
        $this->id = $id;
        $this->number = $number;
        $this->type = $type;
    }

    public static function findById($id) {
        $db = Db::getInstance();
        $request = $db->prepare('SELECT * FROM phone AS p '.
                                'LEFT JOIN phonetype as t '.
                                'ON p.phoneType_id = t.idphoneType '.
                                'WHERE idphone = :id');
        $request->bindParam(":id", $id, PDO::PARAM_INT);
        $request->execute();
        $request = $request->fetch();
        return new Phone($request['idphone'], $request['number'],
            $request['name']);
    }

    public static function newPhone($values) {
        $db = Db::getInstance();
        $request = $db->prepare(
            'INSERT INTO phone '.
            '(Identity_id, phoneType_id, number) '.
            'VALUES (:id, :typeId, :number)'
        );
        $request->bindParam(":id", $values['id'], PDO::PARAM_INT);
        $request->bindParam(":number", $values['number'], PDO::PARAM_STR);
        $request->bindParam(":typeId", $values['typeId'], PDO::PARAM_INT);
        $request->execute();
        return $db->lastInsertId();
    }

    public static function updatePhone($values) {
        $db = Db::getInstance();
        $request = $db->prepare('UPDATE ');
    }

    public static function findByIdentityId($id)
    {
        $list = [];
        $db = Db::getInstance();
        $request = $db->prepare('SELECT * FROM phone AS p ' .
            'LEFT JOIN phonetype as t ' .
            'ON p.phoneType_id = t.idphoneType ' .
            'WHERE p.Identity_id = :id');
        $request->bindParam(":id", $id, PDO::PARAM_INT);
        $request->execute();
        foreach ($request->fetchAll() as $phone) {
            $list[] = new Phone($phone['idphone'], $phone['number'],
                $phone['name']);
        }
        return $list;
    }

    public static function getPhoneTypes() {
        $db = Db::getInstance();
        $request = $db->query('SELECT * FROM phonetype');
        if (!$request->execute()) {
            throw new Exception('Unable to query all rows from table phonetype.');
        }
        $list = [];
        foreach ($request->fetchAll() as $i) {
            $list[] = array(
                'id' => $i['idphoneType'],
                'name' => $i['name']
            );
        }
        return $list;
    }

    public function delete($id) {
        $db = Db::getInstance();
        $request = $db->prepare('DELETE FROM phone WHERE idphone = :id');
        $request->bindParam(":id", $id, PDO::PARAM_INT);
        if ($request->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getValues()
    {
        return array('id' => $this->id, 'number' => $this->number,
            'type' => $this->type);
    }

    public static function rowCount()
    {
        $db = Db::getInstance();
        return (int) $db->query('SELECT count(*) FROM phone')->fetchColumn();
    }
}

?>
