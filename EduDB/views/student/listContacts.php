
<form action="?controller=student&action=listStudentContacts" method="POST">
<p>Select Student:
    <select name="studentID">
        <?php foreach($studentList as $i): $i = $i->getValues(); ?>
            <option value="<?php echo $i['id'] ?>" ><?php echo $i['identity']['firstName']. ' ' . $i['identity']['lastName']; ?></option>
        <?php endforeach; ?>
    </select>
    <input type="submit" value="submit">
</p>
</form>
<h2>Student's Contacts for Student ID <?php echo $id; ?></h2>
<?php
    if(empty($studentContacts)) {
        echo 'No Records Returned<br>';
    }
foreach ($studentContacts as $i): $i = $i->getValues(); ?>
    <hr>
    ID: <?php echo $i['id']; ?><br>
    Student ID: <?php echo $i['studentID']; ?><br>
    Identity ID: <?php echo $i['identityID']; ?><br>
    Relationship ID: <?php echo $i['relationshipID']; ?><br>
    Relationship: <?php echo $i['type']; ?><br>
    ---Identity Information---<br>
    &nbsp;&nbsp;&nbsp;&nbsp;ID: <?php echo $i['identity']['id']; ?><br>
    &nbsp;&nbsp;&nbsp;&nbsp;First Name: <?php echo $i['identity']['firstName']; ?><br>
    &nbsp;&nbsp;&nbsp;&nbsp;Middle Name: <?php echo $i['identity']['middleName']; ?><br>
    &nbsp;&nbsp;&nbsp;&nbsp;Last Name: <?php echo $i['identity']['lastName']; ?><br>
    &nbsp;&nbsp;&nbsp;&nbsp;Gender: <?php echo $i['identity']['gender']; ?><br>
    &nbsp;&nbsp;&nbsp;&nbsp;Email: <?php echo $i['identity']['email']; ?><br>
    &nbsp;&nbsp;&nbsp;&nbsp;Image URI: <?php echo $i['identity']['image']; ?>
<?php endforeach; ?>
