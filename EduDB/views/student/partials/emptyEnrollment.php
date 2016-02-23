<div class="form-group">
   <label for="grade" class="col-md-2 control-label">Grade</label>
   <div class="col-md-10">
      <select id="grade" name="grade" class="form-control" placeholder="Select One">
         <option value="">Select One</option>
         <?php foreach ($grades as $i): ?>
         <option value="<?php echo $i['id']; ?>"><?php echo $i['name']; ?></option>
         <?php endforeach; ?>
      </select>
   </div>
</div>
<div class="form-group">
  <label for="school" class="col-md-2 control-label">School</label>
  <div class="col-md-10">
     <select id="school" name="school" class="form-control" placeholder="Select One">
        <option value="">Select One</option>
        <?php foreach ($schools as $i): ?>
           <option value="<?php echo $i['id']; ?>"><?php echo $i['name']; ?></option>
        <?php endforeach; ?>
     </select>
  </div>
</div>
<script type="text/javascript">
    $('#school, #grade').selectize();
</script>
