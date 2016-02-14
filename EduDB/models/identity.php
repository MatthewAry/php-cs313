<?php

class Identity
{
    private $id;
    private $first_name;
    private $middle_name;
    private $last_name;
    private $gender;
    private $email;
    private $imageURI;

    public function __construct($id, $first_name, $middle_name, $last_name,
                                $gender, $email, $imageURI)
    {
        $this->id = $id;
        $this->first_name = $first_name;
        $this->middle_name = $middle_name;
        $this->last_name = $last_name;
        if ($gender == true) {
            $this->gender = 'Male';
        } else {
            $this->gender = 'Female';
        }
        $this->email = $email;
        $this->imageURI = $imageURI;
    }

    public static function all($start, $number)
    {
        $list = [];
        $db = Db::getInstance();
        $request = $db->prepare('SELECT * FROM identity LIMIT :start, :number');
        $request->bindParam(":start", $start, PDO::PARAM_INT);
        $request->bindParam(":number", $number, PDO::PARAM_INT);
        $request->execute();

        foreach ($request->fetchAll() as $identity) {
            $list[] = new Identity($identity['id'], $identity['first_name'],
                $identity['middle_name'],
                $identity['last_name'], $identity['gender'],
                $identity['email'], $identity['id_Image_uri']);
        }
        return $list;
    }

    public static function rowCount()
    {
        $db = Db::getInstance();
        return (int)$db->query('SELECT count(*) FROM identity')->fetchColumn();
    }

    public static function findById($id)
    {
        $db = Db::getInstance();
        $request = $db->prepare('SELECT * FROM identity WHERE id = :id');
        $request->bindParam(":id", $id, PDO::PARAM_INT);
        $request->execute();
        $identity = $request->fetch();

        return new Identity($identity['id'], $identity['first_name'],
            $identity['middle_name'], $identity['last_name'],
            $identity['gender'], $identity['email'],
            $identity['id_Image_uri']);
    }


    // Getter
    public function getValues()
    {
        return array('id' => $this->id,
            'firstName' => $this->first_name,
            'middleName' => $this->middle_name,
            'lastName' => $this->last_name,
            'gender' => $this->gender,
            'email' => $this->email,
            'image' => $this->imageURI);
    }

    public static function updateImage($id, $uri) {
        $i = self::findById($id);
        $i = $i->getValues();

        self::updateIdentity(
            array(
                'id' => $i['id'],
                'fName' => $i['firstName'],
                'mName' => $i['middleName'],
                'lName' => $i['lastName'],
                'gender' => $i['gender'],
                'email' => $i['email'],
                'imageURI' => $uri
            )
        );
    }

    public static function updateIdentity($values)
    {
        $db = Db::getInstance();
        $request = $db->prepare(
            'UPDATE identity ' .
            'SET first_name = :fName, ' .
            'middle_name = :mName, ' .
            'last_name = :lName, ' .
            'gender = :gender, ' .
            'email = :email, ' .
            'id_Image_uri = :imageURI ' .
            'WHERE id = :id'
        );

        $request->bindParam(":id", $values['id'], PDO::PARAM_INT);
        $request->bindParam(":fName", $values['fName'], PDO::PARAM_STR);
        $request->bindParam(":mName", $values['mName'], PDO::PARAM_STR);
        $request->bindParam(":lName", $values['lName'], PDO::PARAM_STR);
        $request->bindParam(":gender", $values['gender'], PDO::PARAM_BOOL);
        $request->bindParam(":email", $values['email'], PDO::PARAM_STR);
        $request->bindParam(":imageURI", $values['imageURI'], PDO::PARAM_STR);

        if(!$request->execute()) {
            return false;
        } else {
            return true;
        }
    }
}

?>
