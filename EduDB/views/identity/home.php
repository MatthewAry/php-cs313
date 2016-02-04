<p>
   Here is a list of all identities:
</p>

<?php foreach ($identities as $i): ?>
   <p>
      ID: <?php echo $i->id; ?><br>
      Full Name: <?php echo $i->first_name . ' ' . $i->middle_name . ' ' .
                            $i->last_name; ?><br>
      Gender: <?php echo $i->gender; ?>
      ImageURI: <?php echo $i->imageURI; ?>
   </p>
<?php endforeach; ?>
