<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <title><?php print $title ?></title>
   </head>
   <body>
      <header>
         <?php if (isset($_SESSION['ERROR'])) {
            echo 'ERROR: ' . $_SESSION['ERROR'];
            unset($_SESSION['ERROR']);
         } ?>
      </header>
      <?php require_once('routes.php'); ?>
      <footer></footer>
   </body>
</html>