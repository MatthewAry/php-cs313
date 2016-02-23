<div class="col-md-2" style="text-align: center;" >
   <img src="<?php echo $identity['image'] ?>" alt="<?php echo $identity['firstName']; ?>
   <?php echo $identity['lastName']; ?>">
   <button type="button" data-toggle="ajaxModal" href="?controller=identity&action=updateImageModal&ajax=true" class="btn btn-default btn-sm">Change Image</button>
</div>
<div class="col-md-10">
   <h4><?php echo $type['label']. ' ID: '.$type['id']; ?></h4>
   <div class="form-group">
      <label for="firstName" class="col-md-2 control-label">First Name</label>
      <div class="col-md-10">
         <input type="text" value="<?php echo $identity['firstName']; ?>" name="firstName" class="form-control">
      </div>
   </div>
   <div class="form-group">
      <label for="middleName" class="col-md-2 control-label">Middle Name</label>
      <div class="col-md-10">
         <input class="form-control" type="text" value="<?php echo $identity['middleName']; ?>" name="middleName">
      </div>
   </div>
   <div class="form-group">
      <label for="lastName" class="col-md-2 control-label">Last Name</label>
      <div class="col-md-10">
         <input class="form-control" type="text" value="<?php echo $identity['lastName']; ?>" name="lastName">
      </div>
   </div>
   <div class="form-group">
      <label for="gender" class="col-md-2 control-label">Gender</label>
      <div class="col-md-10">
         <select id="gender" name="gender" class="form-control">
            <option value="1"<?php echo ($identity['gender'] == 'Male') ? ' selected' : ''; ?>>
                Male
            </option>
            <option value="0"<?php echo ($identity['gender'] == 'Female') ? ' selected' : ''; ?>>
                Female
            </option>
         </select>
      </div>
   </div>
   <?php if (!isset($student)): ?>
       <div class="form-group">
          <label for="email" class="col-md-2 control-label">Email</label>
          <div class="col-md-10">
             <input class="form-control" type="text" value="<?php echo $identity['email']; ?>" name="email">
          </div>
       </div>
   <?php endif; ?>
</div>
<script type="text/javascript">
$('#gender').selectize();
</script>
