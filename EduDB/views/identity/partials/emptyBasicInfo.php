<div class="col-md-2" style="text-align: center;" >
   <img src="views/assets/images/default_avatar.jpg" alt="Placeholder" id="img" style="width: 100px; height: 100px;">
   <div class="fileUpload btn">
       <span>Add Image</span>
       <input type="file" id="imgInp" name="image_field" class="upload" />
   </div>
</div>
<div class="col-md-10">
   <div class="form-group">
      <label for="firstName" class="col-md-2 control-label">First Name</label>
      <div class="col-md-10">
         <input type="text" value="" name="firstName" class="form-control">
      </div>
   </div>
   <div class="form-group">
      <label for="middleName" class="col-md-2 control-label">Middle Name</label>
      <div class="col-md-10">
         <input class="form-control" type="text" value="" name="middleName">
      </div>
   </div>
   <div class="form-group">
      <label for="lastName" class="col-md-2 control-label">Last Name</label>
      <div class="col-md-10">
         <input class="form-control" type="text" value="" name="lastName">
      </div>
   </div>
   <div class="form-group">
      <label for="gender" class="col-md-2 control-label">Gender</label>
      <div class="col-md-10">
         <select id="gender" name="gender" class="form-control">
            <option value="1">
                Male
            </option>
            <option value="0">
                Female
            </option>
         </select>
      </div>
   </div>
   <div class="form-group">
      <label for="email" class="col-md-2 control-label">Email</label>
      <div class="col-md-10">
         <input class="form-control" type="text" value="" name="email">
      </div>
   </div>
</div>
<script type="text/javascript">

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#img').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#imgInp").change(function() {
        readURL(this);
    });
    $('#gender').selectize();
</script>
