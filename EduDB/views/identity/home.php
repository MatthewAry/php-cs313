<img src="views/assets/images/db.png" alt="" style="width: 100%; height: auto" />

<h2>
   List of Identities (1-50):
</h2>

<?php foreach ($identities as $i):
      $a = $i->getValues(); ?>
   <p>
      <hr>
      ID: <?php echo $a['id']; ?><br>
      Full Name: <?php echo $a['firstName'] . ' ' . $a['middleName'] . ' ' .
                            $a['lastName']; ?><br>
      Gender: <?php echo $a['gender']; ?><br>
      Email: <?php echo $a['email']; ?>
      ImageURI: <?php echo $a['image']; ?>
   </p>
<?php endforeach; ?>

<h2>List of Schools (1-50):</h2>
<?php foreach ($schools['list'] as $i):  $i = $i->getValues();?>
   <hr>
   <p>
      ID: <?php echo $i['id']; ?><br>
      Name: <?php echo $i['name']; ?>
   </p>
<?php endforeach; ?>

<h2>Student's Contacts for Student ID 1</h2>

<?php foreach ($studentContacts as $i): $i = $i->getValues(); ?>
   <hr>
   ID: <?php echo $i['id']; ?><br>
   Student ID: <?php echo $i['studentID']; ?><br>
   Identity ID: <?php echo $i['identityID']; ?><br>
   Relationship ID: <?php echo $i['relationshipID']; ?><br>
   Relationship: <?php echo $i['relationship']['Type']; ?><br>
   ---Identity Information---<br>
   &nbsp;&nbsp;&nbsp;&nbsp;ID: <?php echo $i['identity']['id']; ?><br>
   &nbsp;&nbsp;&nbsp;&nbsp;First Name: <?php echo $i['identity']['firstName']; ?><br>
   &nbsp;&nbsp;&nbsp;&nbsp;Middle Name: <?php echo $i['identity']['middleName']; ?><br>
   &nbsp;&nbsp;&nbsp;&nbsp;Last Name: <?php echo $i['identity']['lastName']; ?><br>
   &nbsp;&nbsp;&nbsp;&nbsp;Gender: <?php echo $i['identity']['gender']; ?><br>
   &nbsp;&nbsp;&nbsp;&nbsp;Email: <?php echo $i['identity']['email']; ?><br>
   &nbsp;&nbsp;&nbsp;&nbsp;Image URI: <?php echo $i['identity']['image']; ?>

<?php endforeach; ?>
<h2>Addresses belonging to Identity ID 1</h2>
<?php foreach ($address as $i): $i = $i->getValues();?>
   <p>
      <hr>
      ID: <?php echo $i['id']; ?><br>
      Street: <?php echo $i['street']; ?><br>
      Extended: <?php echo $i['extended']; ?><br>
      City: <?php echo $i['city']; ?><br>
      Zip: <?php echo $i['zip']; ?><br>
      Zip4: <?php echo $i['zip4']; ?><br>
      State Name: <?php echo $i['stateName']; ?><br>
      State Abbreviation: <?php echo $i['stateAbbrv']; ?><br>
      Address Type: <?php echo $i['addressType']; ?><br>
      Identity ID: <?php echo $i['identityId']; ?>
   </p>
<?php endforeach; ?>
<h2>Teachers belonging to School ID 1</h2>
<?php foreach ($teachers as $i): $i = $i->getValues();?>
   <p>
      <hr>
      ID: <?php echo $i['id']; ?><br>
      School ID: <?php echo $i['schoolId']; ?><br>
      Identity ID: <?php echo $i['identityID']; ?><br>
      Details: <?php echo $i['details']; ?><br>
      ---Identity Information---<br>
      &nbsp;&nbsp;&nbsp;&nbsp;ID: <?php echo $i['identity']['id']; ?><br>
      &nbsp;&nbsp;&nbsp;&nbsp;First Name: <?php echo $i['identity']['firstName']; ?><br>
      &nbsp;&nbsp;&nbsp;&nbsp;Middle Name: <?php echo $i['identity']['middleName']; ?><br>
      &nbsp;&nbsp;&nbsp;&nbsp;Last Name: <?php echo $i['identity']['lastName']; ?><br>
      &nbsp;&nbsp;&nbsp;&nbsp;Gender: <?php echo $i['identity']['gender']; ?><br>
      &nbsp;&nbsp;&nbsp;&nbsp;Email: <?php echo $i['identity']['email']; ?><br>
      &nbsp;&nbsp;&nbsp;&nbsp;Image URI: <?php echo $i['identity']['image']; ?><br>
   </p>
<?php endforeach; ?>
<h2>Classes taught by Teacher ID 1</h2>
<?php foreach ($classes as $i): $i = $i->getValues(); ?>
   <hr>
   ID: <?php echo $i['id']; ?><br>
   Teacher ID: <?php echo $i['teacherId'];  ?><br>
   Grade ID: <?php echo $i['gradeId']; ?><br>
   Name: <?php echo $i['name']; ?>
<?php endforeach; ?>

<h2>Full Student Information for Student ID 1</h2>
<?php $student = $student->getValues(); ?>
ID: <?php echo $student['id']; ?><br>
---Identity Information---<br>
&nbsp;&nbsp;&nbsp;&nbsp;ID: <?php echo $student['identity']['id']; ?><br>
&nbsp;&nbsp;&nbsp;&nbsp;First Name: <?php echo $student['identity']['firstName']; ?><br>
&nbsp;&nbsp;&nbsp;&nbsp;Middle Name: <?php echo $student['identity']['middleName']; ?><br>
&nbsp;&nbsp;&nbsp;&nbsp;Last Name: <?php echo $student['identity']['lastName']; ?><br>
&nbsp;&nbsp;&nbsp;&nbsp;Gender: <?php echo $student['identity']['gender']; ?><br>
&nbsp;&nbsp;&nbsp;&nbsp;Email: <?php echo $student['identity']['email']; ?><br>
&nbsp;&nbsp;&nbsp;&nbsp;Image URI: <?php echo $student['identity']['image']; ?><br>
---Grade Information---<br>
&nbsp;&nbsp;&nbsp;&nbsp;ID: <?php echo $student['grade']['id']; ?><br>
&nbsp;&nbsp;&nbsp;&nbsp;Name: <?php echo $student['grade']['name']; ?><br>
---School Information---<br>
&nbsp;&nbsp;&nbsp;&nbsp;ID: <?php echo $student['school']['id']; ?><br>
&nbsp;&nbsp;&nbsp;&nbsp;Name: <?php echo $student['school']['name']; ?><br>
