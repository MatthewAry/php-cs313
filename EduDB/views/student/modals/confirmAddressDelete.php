<div class="modal-dialog">
  <div class="modal-content">
    <form class="form-horizontal" action="?controller=address&action=delete" method="post">
       <div class="modal-header" style="background: red; color: white;">
         <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
         <i class="material-icons" style="font-size: 3.3em; float:left; margin-right: 15px; margin-top:-10px">warning</i><h4 style="margin-top:-10px;" class="modal-title">Delete Address For <?php echo $_POST['firstName']; ?> <?php echo $_POST['lastName']; ?></h4>
         <p>This cannot be undone.</p>
       </div>
       <div class="modal-body">
           <h4><?php echo $address['addressType']; ?></h4>
           <div>
               <?php echo $address['street']; ?><br>
               <?php if ($address['extended'] != ''): ?>
                   <?php echo $address['extended']; ?><br>
               <?php endif; ?>
               <?php echo $address['city']; ?> <?php echo $address['stateAbbrv']; ?>,
               <?php echo $address['zip']; ?><?php if ($address['zip4'] != ''): ?>-<?php echo $address['zip4']; ?>
               <?php endif; ?>
           </div>
         <input type="hidden" name="id" value="<?php echo $address['id']; ?>">
         <input type="hidden" name="path" value="<?php echo $_POST['path']; ?>">
       </div>
       <div class="modal-footer">
         <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
         <button type="submit" name="Submit" class="btn btn-danger btn-raised">DELETE ADDRESS</button>
       </div>
    </form>
  </div>
</div>
