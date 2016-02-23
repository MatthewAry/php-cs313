<div class="form-group">
   <label for="grade" class="col-md-2 control-label">Grade</label>
   <div class="col-md-10">
      <select id="grade" name="grade" class="form-control">
         <?php foreach ($grades as $i): ?>
         <option value="<?php echo $i['id']; ?>"<?php echo ($student['grade']['id'] == $i['id'])?' selected':''; ?>><?php echo $i['name']; ?></option>
         <?php endforeach; ?>
      </select>
   </div>
</div>
<div class="form-group">
  <label for="school" class="col-md-2 control-label">School</label>
  <div class="col-md-10">
     <select id="school" name="school" class="form-control">
        <?php foreach ($schools as $i): ?>
           <option value="<?php echo $i['id']; ?>"<?php echo ($student['school']['id'] == $i['id'])?' selected':''; ?>><?php echo $i['name']; ?></option>
        <?php endforeach; ?>
     </select>
  </div>
</div>
