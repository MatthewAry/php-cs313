<?php

class User
{
    private $id;
    private $identityId;
    private $userName;
    private $passwordHash;
    private $roles; // This is a list of the user's roles

    private function getRoles()
    {
        $list = [];
        $db = Db::getInstance();
        $request = $db->prepare('SELECT Role_idRole FROM role_to_user ' .
            'WHERE User_idUser = :id');
        $request->execute(array('id' => $id));
        foreach ($request->fetchAll() as $roleID) {
            $requestInner = $db->prepare('SELECT Type FROM role ' .
                'WHERE idRole = :roleID');
            $requestInner->execute(array('roleID' => $roleID['Role_idRole']));
            $type = $requestInner->fetch();
            $list[] = $type['Type'];
        }
        $roles = $list;
    }

    public function __construct($id, $identityId, $userName, $passwordHash)
    {
        $this->id = $id;
        $this->identityId = $identityId;
        $this->userName = $userName;
        $this->passwordHash = $passwordHash;
        $this->roles = $this->getRoles();
    }

    // Verify Credientials (Returns BOOL)
    public function verify($username, $password)
    {
        $db = Db::getInstance();
        //$request = $db->prepare('SELECT ')
   }

    // Get list of User

    public static function rowCount()
    {
        $db = Db::getInstance();
        return (int) $db->query('SELECT count(*) FROM user')->fetchColumn();
    }
}

?>
