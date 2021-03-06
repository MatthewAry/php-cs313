  <div class="modal-dialog">
    <div class="modal-content">
      <form class="form-horizontal" action="?controller=address&action=updateAddress" method="post">
         <div class="modal-header">
           <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
           <h4 class="modal-title">Edit Address For <?php echo $_POST['firstName']; ?> <?php echo $_POST['lastName']; ?></h4>
         </div>
         <div class="modal-body">
            <div class="row">
                <div class="form-group">
                   <label for="street" class="col-md-3 control-label">Street</label>
                   <div class="col-md-9">
                      <input type="text" value="<?php echo $address['street']; ?>" name="street" class="form-control">
                   </div>
                </div>
                <div class="form-group">
                   <label for="extended" class="col-md-3 control-label">Extended</label>
                   <div class="col-md-9">
                      <input type="text" value="<?php echo $address['extended']; ?>" name="extended" class="form-control">
                   </div>
                </div>
                <div class="form-group">
                   <label for="city" class="col-md-3 control-label">City</label>
                   <div class="col-md-9">
                      <input type="text" value="<?php echo $address['city']; ?>" name="city" class="form-control">
                   </div>
                </div>
                <div class="form-group">
                   <label for="zip" class="col-md-3 control-label">Zip</label>
                   <div class="col-md-9">
                      <input type="text" value="<?php echo $address['zip']; ?>" name="zip" class="form-control">
                   </div>
                </div>
                <div class="form-group">
                   <label for="zip4" class="col-md-3 control-label">Zip4</label>
                   <div class="col-md-9">
                      <input type="text" value="<?php echo $address['zip4']; ?>" name="zip4" class="form-control">
                   </div>
                </div>
                <div class="form-group">
                   <label for="state" class="col-md-3 control-label">State</label>
                   <div class="col-md-9">
                      <select id="state" name="state" class="form-control">
                         <option>Select A State</option>
                         <?php foreach (Address::getStates() as $i): ?>
                         <option value="<?php echo $i['id']; ?>"<?php if ($address['stateAbbrv'] == $i['abbrv']): ?> selected<?php endif; ?>><?php echo $i['name']; ?></option>
                         <?php endforeach; ?>
                      </select>
                   </div>
                </div>
                <div class="form-group">
                   <label for="type" class="col-md-3 control-label">Address Type</label>
                   <div class="col-md-9">
                      <select id="type" name="type" class="form-control">
                         <option>Select A Type</option>
                         <?php foreach (Address::getTypes() as $i): ?>
                         <option value="<?php echo $i['id']; ?>"<?php if ($i['name'] == $address['addressType']): ?> selected<?php endif; ?>><?php echo $i['name']; ?></option>
                         <?php endforeach; ?>
                      </select>
                   </div>
                </div>
                <input type="hidden" name="identityId" value="<?php echo $address['identityId']; ?>">
                <input type="hidden" name="id" value="<?php echo $address['id']; ?>">
               <input type="hidden" name="path" value="<?php echo $_POST['path']; ?>">
            </div>
         </div>
         <div class="modal-footer">
           <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
           <button type="submit" name="Submit" class="btn btn-info btn-raised">Submit</button>
         </div>
      </form>
      <script type="text/javascript">
          $('#ajaxModal #state').selectize();
          $('#ajaxModal #type').selectize();
      </script>
    </div>
  </div>
