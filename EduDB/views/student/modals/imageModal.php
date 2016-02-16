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
