<div class="modal-dialog">
  <div class="modal-content">
    <form class="form-horizontal" action="?controller=contact&action=unlinkContact" method="post">
       <div class="modal-header" style="background: red; color: white;">
         <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
         <i class="material-icons" style="font-size: 3.3em; float:left; margin-right: 15px; margin-top:-10px">warning</i>
         <h4 style="margin-top:-10px;" class="modal-title">DELETE RELATIONSHIP WITH <?php echo strtoupper($_POST['firstName'].' '.$_POST['lastName']); ?></h4>
         <p>This cannot be undone.</p>
       </div>
       <div class="modal-body">
         <h4 style="line-height: 1.5em;">Are you sure you want to remove <?php echo $_POST['firstName'] .' '.$_POST['lastName']; ?>'s relationship with <?php echo $contact['firstName'].' '.$contact['lastName']?> as a <?php echo StudentContact::findTypeById($info['relationships']['relationshipID'])['type']; ?>?</h4>
       </div>
       <div class="modal-footer">
         <input type="hidden" name="path" value="<?php echo $_POST['path']; ?>">
         <input type="hidden" name="id" value="<?php echo $info['relationships']['id'] ?>">
         <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
         <button type="submit" name="Submit" class="btn btn-danger btn-raised">DELETE RELATIONSHIP</button>
       </div>
    </form>
  </div>
</div>
