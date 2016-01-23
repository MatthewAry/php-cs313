<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <title>Matthew Ary's Homepage</title>
   </head>
   <body>
      <?php for ($i=0; $i < 10; $i++): ?>
         <div>This is content #<?php print $i +1; ?></div>
      <?php endfor ?>
   </body>
</html>
