<p>
   Here is a list of all identities:
</p>

<?php foreach ($identities as $i):
      $a = $i->getValues(); ?>
   <p>
      ID: <?php echo $a['id']; ?><br>
      Full Name: <?php echo $a['firstName'] . ' ' . $a['middleName'] . ' ' .
                            $a['lastName']; ?><br>
      Gender: <?php echo $a['gender']; ?><br>
      Email: <?php echo $a['email']; ?>
      ImageURI: <?php echo $a['image']; ?>
   </p>
<?php endforeach;
print_r($schools); ?>
