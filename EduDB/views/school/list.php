<h2>List of ALL Schools:</h2>
<?php
/**
 * Created by PhpStorm.
 * User: MatthewAry
 * Date: 2/10/2016
 * Time: 11:27 AM
 */
foreach ($schools['list'] as $i):  $i = $i->getValues();?>
    <hr>
    <p>
        ID: <?php echo $i['id']; ?><br>
        Name: <?php echo $i['name']; ?>
    </p>
<?php endforeach; ?>