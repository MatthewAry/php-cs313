<div class="container">
   <div class="page-header">
      <h1>View and Modify Student</h1>
      <a type="button" href="?controller=student&action=listStudents" class="btn"><i class="material-icons">keyboard_return</i> Return to Student List</a>
   </div>
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
                  <a data-toggle="ajaxModal" href="?controller=identity&action=updateImageModal&ajax=true" class="btn btn-default">Change Image</a>
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
            <?php if (empty($addresses)): ?>
               <div class="alert alert-dismissible alert-danger">
                  <button type="button" class="close" data-dismiss="alert">×</button>
                 No addresses were found for this student.
               </div>
            <?php else: ?>
                <?php foreach ($addresses as $i): ?>
                    <div class="list-group">
                        <div class="list-group-item">
                            <div class="row-content">
                                <h4><?php echo $i['addressType']; ?></h4>
                                <div class="col-md-9">
                                    <?php echo $i['street']; ?><br>
                                    <?php if ($i['extended'] != ''): ?>
                                        <?php echo $i['extended']; ?><br>
                                    <?php endif; ?>
                                    <?php echo $i['city']; ?> <?php echo $i['stateAbbrv']; ?>,
                                    <?php echo $i['zip']; ?><?php if ($i['zip4'] != ''): ?>-<?php echo $i['zip4']; ?>
                                    <?php endif; ?>
                                </div>
                                <div class="col-md-3">
                                    <a data-toggle="ajaxModal" class='btn btn-sm btn-default' href="?controller=address&action=getAddress&id=<?php echo $i['id']; ?>&ref=student&ajax=true"><i class="material-icons">mode_edit</i> Edit</a>
                                    <a data-toggle="ajaxModal" class='btn btn-sm' href="?controller=address&action=confirmDelete&id=<?php echo $i['id']; ?>&ref=student&ajax=true" data-toggle="popover" data-placement="top" data-content="Delete Address"><i class="material-icons">delete</i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
            <button data-toggle="ajaxModal" type="button" class="btn btn-default" href="?controller=address&action=newAddressModal&ajax=true">Add An Address</button>
         </div>
      </div>
      <div class="panel panel-info">
         <div class="panel-heading">
            <h2 class="panel-title">Enrollment</h2>
         </div>
         <div class="panel-body">
            <div class="form-group">
               <label for="grade" class="col-md-2 control-label">Grade</label>
               <div class="col-md-10">
                  <select id="grade" name="grade" class="form-control">
                     <?php foreach ($grades as $i): ?>
                     <option value="<?php echo $i['id']; ?>"<?php echo ($student['grade']['id'] == $i['id'])?' selected':''; ?>><?php echo $i['name']; ?></option>
                     <?php endforeach; ?>
                  </select>
               </div>
            </div>
           <div class="form-group">
              <label for="school" class="col-md-2 control-label">School</label>
              <div class="col-md-10">
                 <select id="school" name="school" class="form-control">
                    <?php foreach ($schools as $i): ?>
                       <option value="<?php echo $i['id']; ?>"<?php echo ($student['school']['id'] == $i['id'])?' selected':''; ?>><?php echo $i['name']; ?></option>
                    <?php endforeach; ?>
                 </select>
              </div>
           </div>
         </div>
      </div>
       <input type="hidden" name="identityID" value="<?php echo $student['identity']['id']; ?>">
       <input type="hidden" name="studentID" value="<?php echo $student['id']; ?>">
       <input type="hidden" name="path" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
       <button class="btn btn-raised btn-info" type="submit" value="SubmitIdentity">Update Student</button>
   </form>
   <div class="panel panel-info">
      <div class="panel-heading">
         <h2 class="panel-title">Assigned Classes</h2>
      </div>
      <div class="panel-body">
         <?php if (isset($student['classList'])): ?>
             <table class="table table-striped table-hover">
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
             <p>This student does not belong to any classes at this school.</p>
         <?php endif; ?>
      </div>
   </div>
   <div class="panel panel-info">
      <div class="panel-heading">
         <h2 class="panel-title">Student Contacts</h2>
      </div>
      <div class="panel-body">
      <?php if (isset($student['contactList'])): ?>
      <table class="table table-striped table-hover">
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
               <td><?php echo $i['relationship']; ?></td>
               <td><?php echo $i['identity']['firstName'] . ' ' . $i['identity']['lastName']; ?></td>
               <td><a class="btn" href="?controller=contact&action=viewContact&id=<?php echo $i['identity']['id']; ?>">View</a></td>
            </tr>
         <?php endforeach; ?>
         </tbody>
      </table>
      <?php else: ?>
      <p>This student has no contacts.</p>
      <?php endif ?>
      </div>
   </div>

</div>
<script type="text/javascript">
    $('[data-toggle="ajaxModal"]').on('click',
      function(e) {
        $('#ajaxModal').remove();
        e.preventDefault();
        var $this = $(this)
          , $remote = $this.data('remote') || $this.attr('href')
          , $modal = $('<div class="modal fade" id="ajaxModal"><div class="modal-body"></div></div>');
        $('body').append($modal);
        $modal.modal({backdrop: 'static', keyboard: false});
        $fName = "<?php echo $student['identity']['firstName']; ?>";
        $lName = "<?php echo $student['identity']['lastName']; ?>";
        $identityId = "<?php echo $student['identity']['id']; ?>";
        $path = "<?php echo $_SERVER['REQUEST_URI']; ?>";
        $modal.load($remote, {
            "firstName": $fName,
            "lastName": $lName,
            "identityId": $identityId,
            "path": $path
        });
      }
    );
    $('[data-dismiss="modal"]').on('click', function(event) {
        event.preventDefault();
        $this.parent('.modal').delay(300).remove();
    });
    $('#gender').selectize();
    $('#grade').selectize();
    $('#school').selectize();
</script>
