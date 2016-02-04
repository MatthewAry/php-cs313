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
