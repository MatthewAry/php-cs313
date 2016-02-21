<div class="modal-dialog">
    <div class="modal-content">
      <form class="form-horizontal" action="?controller=phone&action=addPhone" method="post">
         <div class="modal-header">
           <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
           <h4 class="modal-title">Add Phone Number to <?php echo $_POST['firstName']; ?> <?php echo $_POST['lastName']; ?></h4>
         </div>
         <div class="modal-body">
            <div class="row">
                <div class="form-group">
                   <label for="phoneNumber" class="col-md-3 control-label">Phone Number</label>
                   <div class="col-md-9">
                      <input type="text" value="" name="phoneNumber" class="form-control">
                   </div>
                </div>
                <div class="form-group">
                   <label for="phoneType" class="col-md-3 control-label">Phone Type</label>
                   <div class="col-md-9">
                      <select id="phoneType" name="phoneType" class="form-control">
                         <option>Select Phone Type</option>
                         <?php foreach (Phone::getPhoneTypes() as $i): ?>
                         <option value="<?php echo $i['id']; ?>"><?php echo $i['name']; ?></option>
                         <?php endforeach; ?>
                      </select>
                   </div>
                </div>
               <input type="hidden" name="identityId" value="<?php echo $_POST['identityId']; ?>">
               <input type="hidden" name="path" value="<?php echo $_POST['path']; ?>">
            </div>
         </div>
         <div class="modal-footer">
           <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
           <button type="submit" name="Submit" value="add" class="btn btn-info btn-raised">Add</button>
         </div>
      </form>
    </div>
    <script type="text/javascript">
        $('#ajaxModal #phone').selectize();
    </script>
</div>
