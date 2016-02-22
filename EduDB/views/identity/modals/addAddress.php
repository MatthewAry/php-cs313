<div class="modal-dialog">
    <div class="modal-content">
      <form class="form-horizontal" action="?controller=address&action=addAddress" method="post">
         <div class="modal-header">
           <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
           <h4 class="modal-title">Add Address To <?php echo $_POST['firstName']; ?> <?php echo $_POST['lastName']; ?></h4>
         </div>
         <div class="modal-body">
            <div class="row">
               <?php require_once('views/identity/partials/emptyAddressField.php'); ?>
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
        $('#ajaxModal #state').selectize();
        $('#ajaxModal #type').selectize();
    </script>
</div>
