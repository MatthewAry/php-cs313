<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <title><?php print $title ?></title>
      <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Roboto:300,400,500,700">
      <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/icon?family=Material+Icons">
      <link rel="stylesheet" type="text/css" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
      <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-material-design/0.5.8/css/bootstrap-material-design.min.css">
      <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-material-design/0.5.8/css/ripples.min.css">
      <link rel="stylesheet" href="views/assets/stylesheets/screen.css">
      <script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
      <script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js"></script>
      <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-material-design/0.5.8/js/material.min.js"></script>
      <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-material-design/0.5.8/js/ripples.min.js"></script>
      <script src="//cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.1/js/standalone/selectize.js"></script>
      <script type="text/javascript">
      $(function () {
        $.material.init();
      });
      </script>
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
