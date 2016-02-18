  <div class="modal-dialog">
    <div class="modal-content">
      <form class="form-horizontal" enctype="multipart/form-data" action="?controller=identity&action=updateImage" method="post">
         <div class="modal-header">
           <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
           <h4 class="modal-title">Update Image</h4>
         </div>
         <div class="modal-body">
            <div class="row">
               <input type="file" name="image_field" value="">
               <input type="hidden" name="id" value="<?php echo $identityID; ?>">
               <input type="hidden" name="path" value="<?php echo $path; ?>">
            </div>
         </div>
         <div class="modal-footer">
           <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
           <button type="submit" name="Submit" value="upload" class="btn btn-info btn-raised">Upload File</button>
         </div>
      </form>
    </div>
  </div>
