<?php
require_once('connection.php');
   // get POST data
   $passwordHash = password_hash($_POST['password'], PASSWORD_DEFAULT);
   $db = Db::getInstance();
   $request = $db->prepare('INSERT INTO users (username, password) VALUES '.
                           '(:username, :passwordhash)');
   $request->bindParam(":username", $_POST['Username'], PDO::PARAM_STR);
   $request->bindParam(":passwordhash", $passwordHash, PDO::PARAM_STR);
   $request->execute();
   header("Location: signin.php");
 ?>
