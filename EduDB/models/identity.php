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
    // Student = 1; Teacher = 3; Contact = 2;
    private $type;

    public function __construct($id, $first_name, $middle_name, $last_name,
                                $gender, $email, $imageURI, $type)
    {
        $this->id = $id;
        $this->first_name = $first_name;
        $this->middle_name = $middle_name;
        $this->last_name = $last_name;
        if ($gender) {
            $this->gender = 'Male';
        } else {
            $this->gender = 'Female';
        }
        $this->email = $email;
        if (empty($imageURI)) {
            $this->imageURI = "views/assets/images/default_avatar.jpg";
        } else {
            $this->imageURI = $imageURI;
        }
        $this->type = $type;
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
                $identity['email'], $identity['id_Image_uri'],
                $identity['type']);
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
            $identity['id_Image_uri'], $identity['type']);
    }

    public static function findByType($type) {
        if (is_string($type)) {
            switch ($type) {
                case 'student':
                    $type = 1;
                    break;
                case 'contact':
                    $type = 2;
                    break;
                case 'teacher':
                    $type = 3;
                    break;
                default:
                    return false;
                    break;
            }
        }
        $db = DB::getInstance();
        $request = $db->prepare('SELECT * FROM identity WHERE type = :type');
        $request->bindParam(":type", $type, PDO::PARAM_INT);
        if (!$request->execute()) {
            return false;
        }
        $list = [];
        foreach ($request->fetchAll() as $i) {
            $item = new Identity($i['id'], $i['first_name'],
                $i['middle_name'], $i['last_name'], $i['gender'],
                $i['email'], $i['id_Image_uri'], $i['type']);
            $list[] = $item->getValues();
        }
        return $list;
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
            'image' => $this->imageURI,
            'type' => $this->type);
    }

    public function getID() {
        return $this->id;
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
                'imageURI' => $uri,
                'type' => $i['type']
            )
        );
    }

    public static function updateIdentity($values)
    {
        // This is as bad as it looks since it means tight coupling.
        if (isset($values['id'])) {
            $query = 'UPDATE identity SET ';
            $queryBuilder = [];
            if (isset($values['fName'])) {
                $queryBuilder[] ='first_name = :fName';
            }
            if (isset($values['mName'])) {
                $queryBuilder[] ='middle_name = :mName';
            }
            if (isset($values['lName'])) {
                $queryBuilder[] ='last_name = :lName';
            }
            if (isset($values['gender'])) {
                $queryBuilder[] ='gender = :gender';
            }
            if (isset($values['email'])) {
                $queryBuilder[] ='email = :email';
            }
            if (isset($values['imageURI']) && $values['imageURI'] != "views/assets/images/default_avatar.jpg") {
                $queryBuilder[] ='id_Image_uri = :imageURI';
            }
            if (isset($values['type'])) {
                $queryBuilder[] ='type = :type';
            }
            foreach ($queryBuilder as $key => $value) {
                $query = $query . $value;
                if (isset($queryBuilder[$key+1])) {
                    $query = $query .', ';
                } else {
                    $query = $query .' ';
                }
            }

            $query = $query . 'WHERE id = :id';

            $db = Db::getInstance();
            $request = $db->prepare($query);

            $request->bindParam(":id", $values['id'], PDO::PARAM_INT);
            if (isset($values['fName'])) {
                $request->bindParam(":fName", $values['fName'], PDO::PARAM_STR);
            }
            if (isset($values['mName'])) {
                $request->bindParam(":mName", $values['mName'], PDO::PARAM_STR);
            }
            if (isset($values['lName'])) {
                $request->bindParam(":lName", $values['lName'], PDO::PARAM_STR);
            }
            if (isset($values['gender'])) {
                $request->bindParam(":gender", $values['gender'], PDO::PARAM_BOOL);
            }
            if (isset($values['email'])) {
                $request->bindParam(":email", $values['email'], PDO::PARAM_STR);
            }
            if (isset($values['imageURI']) && $values['imageURI'] != "views/assets/images/default_avatar.jpg") {
                $request->bindParam(":imageURI", $values['imageURI'], PDO::PARAM_STR);
            }
            if (isset($values['type'])) {
                $request->bindParam(":type", $values['type'], PDO::PARAM_INT);
            }
            if(!$request->execute()) {
                return false;
            } else {
                return true;
            }
        } else {
            return false;
        }
    }

    public static function newIdentity($values) {
        // This is as bad as it looks since it means tight coupling.
        $query = 'INSERT INTO identity (';
        $columns = [];
        $rValues = [];
        if (isset($values['fName'])) {
            $columns[] = 'first_name';
            $rValues[] =':fName';
        }
        if (isset($values['mName'])) {
            $columns[] = 'middle_name';
            $rValues[] =':mName';
        }
        if (isset($values['lName'])) {
            $columns[] = 'last_name';
            $rValues[] =':lName';
        }
        if (isset($values['gender'])) {
            $columns[] = 'gender';
            $rValues[] =':gender';
        }
        if (isset($values['email'])) {
            $columns[] = 'email';
            $rValues[] =':email';
        }
        if (isset($values['imageURI']) && $values['imageURI'] != "views/assets/images/default_avatar.jpg") {
            $columns[] = 'id_Image_uri';
            $rValues[] =':imageURI';
        }
        if (isset($values['type'])) {
            $columns[] = 'type';
            $rValues[] =':type';
        }
        foreach ($columns as $key => $value) {
            $query = $query . $value;
            if (isset($columns[$key+1])) {
                $query = $query .', ';
            } else {
                $query = $query .') VALUES (';
            }
        }
        foreach ($rValues as $key => $value) {
            $query = $query . $value;
            if (isset($rValues[$key+1])) {
                $query = $query .', ';
            } else {
                $query = $query .')';
            }
        }

        $db = Db::getInstance();
        $request = $db->prepare($query);

        if (isset($values['fName'])) {
            $request->bindParam(":fName", $values['fName'], PDO::PARAM_STR);
        }
        if (isset($values['mName'])) {
            $request->bindParam(":mName", $values['mName'], PDO::PARAM_STR);
        }
        if (isset($values['lName'])) {
            $request->bindParam(":lName", $values['lName'], PDO::PARAM_STR);
        }
        if (isset($values['gender'])) {
            $request->bindParam(":gender", $values['gender'], PDO::PARAM_BOOL);
        }
        if (isset($values['email'])) {
            $request->bindParam(":email", $values['email'], PDO::PARAM_STR);
        }
        if (isset($values['imageURI']) && $values['imageURI'] != "views/assets/images/default_avatar.jpg") {
            $request->bindParam(":imageURI", $values['imageURI'], PDO::PARAM_STR);
        }
        if (isset($values['type'])) {
            $request->bindParam(":type", $values['type'], PDO::PARAM_INT);
        }

        if(!$request->execute()) {
            return false;
        } else {
            return $db->lastInsertId();
        }
    }

}

?>
