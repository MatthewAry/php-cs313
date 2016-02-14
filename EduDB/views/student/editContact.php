<pre><?php print_r($contact); ?></pre>
<form action="">
    <p>
        <select name="relationship" id="">
            <?php foreach(StudentContact::getRelationships() as $i): ?>
                <option value="<?php echo $i['id']; ?>"><?php echo $i['type']; ?></option>
            <?php endforeach; ?>
        </select>
    </p>

</form>
<p>

</p>