<div class="form-group">
   <label for="street" class="col-md-3 control-label">Street</label>
   <div class="col-md-9">
      <input type="text" value="" name="street" class="form-control">
   </div>
</div>
<div class="form-group">
   <label for="extended" class="col-md-3 control-label">Extended</label>
   <div class="col-md-9">
      <input type="text" value="" name="extended" class="form-control">
   </div>
</div>
<div class="form-group">
   <label for="city" class="col-md-3 control-label">City</label>
   <div class="col-md-9">
      <input type="text" value="" name="city" class="form-control">
   </div>
</div>
<div class="form-group">
   <label for="zip" class="col-md-3 control-label">Zip</label>
   <div class="col-md-9">
      <input type="text" value="" name="zip" class="form-control">
   </div>
</div>
<div class="form-group">
   <label for="zip4" class="col-md-3 control-label">Zip4</label>
   <div class="col-md-9">
      <input type="text" value="" name="zip4" class="form-control">
   </div>
</div>
<div class="form-group">
   <label for="state" class="col-md-3 control-label">State</label>
   <div class="col-md-9">
      <select id="state" name="state" class="form-control">
         <option>Select A State</option>
         <?php foreach (Address::getStates() as $i): ?>
         <option value="<?php echo $i['id']; ?>"><?php echo $i['name']; ?></option>
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
         <option value="<?php echo $i['id']; ?>"><?php echo $i['name']; ?></option>
         <?php endforeach; ?>
      </select>
   </div>
</div>
