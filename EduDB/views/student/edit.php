<div class="container">
   <div class="page-header">
      <h1>View and Modify Student</h1>
      <a href="?controller=student&action=listStudents" class="btn"><i class="material-icons">keyboard_return</i> Return to Student List</a>
   </div>
   <form class="form-horizontal" action="?controller=student&action=updateStudent" method="post">
      <div class="panel panel-info">
         <div class="panel-heading">
            <h2 class="panel-title">Basic Information</h2>
         </div>
         <div class="panel-body">
            <div class="row">
                <?php include_once('views/identity/partials/editBasicInfo.php'); ?>
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
                <div class="list-group">
                <?php foreach ($addresses as $i): ?>
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
                                <button data-toggle="ajaxModal" class='btn btn-sm btn-default' href="?controller=address&action=getAddress&id=<?php echo $i['id']; ?>&ajax=true">
                                    <i class="material-icons">mode_edit</i> Edit
                                </button>
                                <button data-toggle="ajaxModal" class='btn btn-sm' href="?controller=address&action=confirmDelete&id=<?php echo $i['id']; ?>&ajax=true">
                                    <i class="material-icons">delete</i>
                                </button>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
                </div>
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
               <td>
                   <a class="btn" href="?controller=contact&action=viewContact&id=<?php echo $i['identity']['id']; ?>">View</a>
                   <button class='btn btn-sm' href=""><i class="material-icons">delete</i></button>
               </td>
            </tr>
         <?php endforeach; ?>
         </tbody>
      </table>
      <?php else: ?>
      <p>This student has no contacts.</p>
      <?php endif ?>
      <button class="btn btn-default" data-toggle="ajaxModal" type="button" name="button" href="?controller=identity&action=searchModal&ajax=true">Add Existing Contact</button>
      <form style="display:inline;" action="?controller=contact&action=newContactPage" method="post">
          <input type="hidden" name="firstName" value="<?php echo $student['identity']['firstName']; ?>">
          <input type="hidden" name="lastName" value="<?php echo $student['identity']['lastName']; ?>">
          <input type="hidden" name="studentId" value="<?php echo $student['id']; ?>">
          <input type="hidden" name="identityId" value="<?php echo $student['identity']['id']; ?>">
          <input type="hidden" name="path" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
          <button id="newContact" class="btn btn-default" type="submit" name="button">Add New Contact</button>
      </form>
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
        $studentId = "<?php echo $type['id']; ?>"
        $path = "<?php echo $_SERVER['REQUEST_URI']; ?>";
        $modal.load($remote, {
            "firstName": $fName,
            "lastName": $lName,
            "identityId": $identityId,
            "studentId": $studentId,
            "path": $path
        });
      }
    );
    $('[data-dismiss="modal"]').on('click', function(event) {
        event.preventDefault();
        $this.parent('.modal').delay(300).remove();
    });
    $('#grade').selectize();
    $('#school').selectize();
</script>
