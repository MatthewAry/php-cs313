<div class="modal fade" tabindex="-1" role="dialog" id="imageUpload">
  <div class="modal-dialog">
    <div class="modal-content">
      <form class="form-horizontal" enctype="multipart/form-data" action="/EduDB/?controller=identity&action=updateImage" method="post">
         <div class="modal-header">
           <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
           <h4 class="modal-title">Update Image</h4>
         </div>
         <div class="modal-body">
            <div class="row">
               <input type="file" name="image_field" value="">
               <input type="hidden" name="id" value="<?php echo $student['identity']['id']; ?>">
               <input type="hidden" name="path" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
            </div>
         </div>
         <div class="modal-footer">
           <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
           <button type="submit" name="Submit" value="upload" class="btn btn-primary">Upload File</button>
         </div>
      </form>
    </div>
  </div>
</div>
<div class="container">
   <form class="form-horizontal" action="?controller=student&action=updateStudent" method="post">
      <div class="panel panel-info">
         <div class="panel-heading">
            <h2 class="panel-title">Basic Information</h2>
         </div>
         <div class="panel-body">
            <div class="row">
               <div class="col-md-2" style="text-align: center;" >
                  <img src="<?php echo $student['identity']['image'] ?>" alt="<?php echo $student['identity']['firstName']; ?>
                  <?php echo $student['identity']['lastName']; ?>">
                  <button data-toggle="modal" data-target="#imageUpload" type="button" class="btn btn-default">Change Image</button>
               </div>
               <div class="col-md-10">
                  <h4>Student ID: <?php echo $student['id']; ?></h4>
                  <div class="form-group">
                     <label for="firstName" class="col-md-2 control-label">First Name</label>
                     <div class="col-md-10">
                        <input type="text" value="<?php echo $student['identity']['firstName']; ?>" name="firstName" class="form-control">
                     </div>
                  </div>
                  <div class="form-group">
                     <label for="middleName" class="col-md-2 control-label">Middle Name</label>
                     <div class="col-md-10">
                        <input class="form-control" type="text" value="<?php echo $student['identity']['middleName']; ?>" name="middleName">
                     </div>
                  </div>
                  <div class="form-group">
                     <label for="lastName" class="col-md-2 control-label">Last Name</label>
                     <div class="col-md-10">
                        <input class="form-control" type="text" value="<?php echo $student['identity']['lastName']; ?>" name="lastName">
                     </div>
                  </div>
                  <div class="form-group">
                     <label for="gender" class="col-md-2 control-label">Gender</label>
                     <div class="col-md-10">
                        <select id="gender" name="gender" class="form-control">
                           <option value="1"<?php echo ($student['identity']['gender'] == 'Male') ? ' selected' : ''; ?>>Male</option>
                           <option value="0"<?php echo ($student['identity']['gender'] == 'Female') ? ' selected' : ''; ?>>Female</option>
                        </select>
                     </div>
                  </div>
               </div>

            </div>
         </div>
      </div>
      <div class="panel panel-info">
         <div class="panel-heading">
            <h2 class="panel-title">Addresses</h2>
         </div>
         <div class="panel-body">
               <ul class="list-group">
                  <?php foreach ($addresses as $i): ?>
                     <li class="list-group-item">
                        <h4 class="list-group-item-heading">Address ID: <?php echo $i['id'] ?></h3>
                        <div class="form-group">
                           <label for="address[<?php echo $i['id']?>][street]" class="col-md-2 control-label">Street</label>
                           <div class="col-md-10">
                              <input type="text" value="<?php echo $i['street']; ?>" name="address[<?php echo $i['id']?>][street]" class="form-control">
                           </div>
                        </div>
                        <div class="form-group">
                           <label for="address[<?php echo $i['id']?>][extended]" class="col-md-2 control-label">Extended</label>
                           <div class="col-md-10">
                              <input type="text" value="<?php echo $i['extended']; ?>" name="address[<?php echo $i['id']?>][extended]" class="form-control">
                           </div>
                        </div>
                        <div class="form-group">
                           <label for="address[<?php echo $i['id']?>][city]" class="col-md-2 control-label">City</label>
                           <div class="col-md-10">
                              <input type="text" value="<?php echo $i['city']; ?>" name="address[<?php echo $i['id']?>][city]" class="form-control">
                           </div>
                        </div>
                        <div class="form-group">
                           <label for="address[<?php echo $i['id']?>][zip]" class="col-md-2 control-label">Zip Code</label>
                           <div class="col-md-10">
                              <input type="text" value="<?php echo $i['zip']; ?>" name="address[<?php echo $i['id']?>][zip]" class="form-control">
                           </div>
                        </div>
                        <div class="form-group">
                           <label for="address[<?php echo $i['id']?>][zip4]" class="col-md-2 control-label">Zip4</label>
                           <div class="col-md-10">
                              <input type="text" value="<?php echo $i['zip4']; ?>" name="address[<?php echo $i['id']?>][zip4]" class="form-control">
                           </div>
                        </div>
                        <div class="form-group">
                           <label for="address[<?php echo $i['id']?>][stateAbbrv]" class="col-md-2 control-label">State</label>
                           <div class="col-md-10">
                              <input type="text" value="<?php echo $i['stateAbbrv']; ?>" name="address[<?php echo $i['id']?>][stateAbbrv]" class="form-control">
                           </div>
                        </div>
                        <div class="form-group">
                           <label for="address[<?php echo $i['id']?>][addressType]" class="col-md-2 control-label">Type</label>
                           <div class="col-md-10">
                              <input type="text" value="<?php echo $i['addressType']; ?>" name="address[<?php echo $i['id']?>][addressType]" class="form-control">
                           </div>
                        </div>
                     </li>
                  <?php endforeach; ?>
               </ul>
         </div>
      </div>
      <div class="panel panel-info">
         <div class="panel-heading">
            <h2 class="panel-title">Enrollment</h2>
         </div>
         <div class="panel-body">
            <ul class="list-group">
               <li class="list-group-item">
                  <label for="grade" class="col-md-2 control-label">Grade:</label>
                  <div class="col-md-10">
                     <select id="grade" name="grade" class="form-control">
                        <?php foreach ($grades as $i): ?>
                        <option value="<?php echo $i['id']; ?>"<?php echo ($student['grade']['id'] == $i['id'])?' selected':''; ?>><?php echo $i['name']; ?></option>
                        <?php endforeach; ?>
                     </select>
                  </div>
              </li>
            </ul>
         </div>
      </div>
      <p>
          School: <select id="school" name="school" class="form-control">
              <?php foreach ($schools as $i): ?>
              <option value="<?php echo $i['id']; ?>"<?php echo ($student['school']['id'] == $i['id'])?' selected':''; ?>><?php echo $i['name']; ?></option>
              <?php endforeach; ?>
           </select>
      </p>
       <input type="hidden" name="identityID" value="<?php echo $student['identity']['id']; ?>">
       <input type="hidden" name="studentID" value="<?php echo $student['id']; ?>">
       <input type="hidden" name="path" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
       <input type="submit" value="SubmitIdentity">
   </form>
</div>

</div>
Student Classes:
<?php if (isset($student['classList'])): ?>
    <table>
      <thead>
         <tr>
             <th>Class Name</th>
             <th>Grade Level</th>
             <th>Teacher</th>
             <th></th>
         </tr>
      </thead>
      <tbody>
         <?php foreach ($student['classList'] as $i): ?>
         <tr>
              <td><?php echo $i['name']; ?></td>
              <td><?php echo $i['grade']['name']; ?></td>
              <td><?php echo $i['teacher']['identity']['firstName'] . ' ' . $i['teacher']['identity']['lastName']; ?></td>
              <td>Controls will go here</td>
         </tr>
         <?php endforeach; ?>
      </tbody>
    </table>
<?php else: ?>
    <p>This student does not belong to any classes.</p>
<?php endif; ?>
</p>
<p>
    Student Contact Information:
    <?php if (isset($student['contactList'])): ?>
        <table>
           <thead>
             <tr>
                 <th>Relationship</th>
                 <th>Name</th>
                 <th></th>
             </tr>
           </thead>
           <tbody>
             <?php foreach ($student['contactList'] as $i): ?>
              <tr>
                  <td><?php echo $i['relationship']['Type']; ?></td>
                  <td><?php echo $i['identity']['firstName']. ' ' .$i['identity']['lastName']; ?></td>
                  <td>Controls will go here.</td>
              </tr>
             <?php endforeach; ?>
           </tbody>
    </table>
    <?php else: ?>
    <p>This student has no contacts.</p>
    <?php endif ?>
</p>
<script type="text/javascript">
//$('#gender, #grade, #school').selectize({create: true});
</script>
