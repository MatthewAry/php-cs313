<p>
   List of scriptures.
</p>

<?php foreach ($scriptures as $i): ?>
   <p>
      ID: <?php echo $i->id; ?><br>
      Scripture: <?php echo $i->book . ' ' . $i->chapter . ':' . $i->verse; ?><br>
      Content: <?php echo $i->content; ?>
   </p>
<?php endforeach; ?>

<form class="" action="?controller=scripture&action=post" method="post">
   <p>
      Book: <input type="text" name="book" value="">
   </p>
   <p>
      Chapter: <input type="text" name="chapter" value="">
   </p>
   <p>
      Verse: <input type="text" name="verse" value="">
   </p>
   <p>
      Content: <textarea name="content" rows="8" cols="40"></textarea>
   </p>
   <?php foreach ($topics as $i): ?>
      <p>
         <input type="checkbox" name="topics[<?php echo $i->name; ?>]" value="tId[<?php echo $i->id; ?>]"> <?php echo $i->name;?>
      </p>
   <?php endforeach; ?>
   <input type="submit" name="name" value="Submit">
</form>
