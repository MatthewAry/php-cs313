<?php
require_once('connection.php');
function accountVerify($username, $password) {
   $db = Db::getInstance();
   $request = $db->prepare('SELECT password FROM users WHERE '.
                           'username = :username'
                        );
   $request->bindParam(":username", $username);
   $request->execute();
   if ($request->rowCount() > 0) {
      if ($password = password_verify($password, $request->fetchColumn())) {
         return true;
      } else {
         return false;
      }

   } else {
      return false;
   }
}
   if (!accountVerify($_POST['username'], $_POST['password'])): ?>
      NOT A VALID USER

   <?php else: ?>
<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <title></title>
   </head>
   <body>
      YEAY!!!
   </body>
</html>
<?php endif ?>
