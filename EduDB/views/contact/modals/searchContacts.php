<div class="modal-dialog">
    <div class="modal-content">
      <form class="form-horizontal" action="?controller=contact&action=linkContact&ajax=true" method="post">
         <div class="modal-header">
           <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
           <h4 class="modal-title">Find and Add Contact To <?php echo $_POST['firstName']; ?> <?php echo $_POST['lastName']; ?></h4>
         </div>
         <div class="modal-body">
             <div class="row">
                 <label for="search" class="col-md-3 control-label">Search</label>
                 <div class="col-md-9">
                    <select id="search" name="search" class="form-control" placeholder="Type to search">
                       <option value="">Type to Search</option>
                       <?php foreach ($names as $i): ?>
                       <option value="<?php echo $i['id']; ?>"><?php echo $i['firstName'] . ' ' . $i['middleName'] . ' ' . $i['lastName'] . ': ' . $i['email']; ?></option>
                       <?php endforeach; ?>
                    </select>
                 </div>
             </div>
             <div class="row">
                 <label for="type" class="col-md-3 control-label">Search</label>
                 <div class="col-md-9">
                    <select id="type" name="type" class="form-control" placeholder="Define Relationship">
                        <option value="">Define Relationship</option>
                       <?php foreach ($types as $i): ?>
                       <option value="<?php echo $i['id']; ?>"><?php echo $i['name']; ?></option>
                       <?php endforeach; ?>
                    </select>
                 </div>
             </div>
         </div>
         <div class="modal-footer">
           <input type="hidden" name="identityId" value="<?php echo $_POST['identityId']; ?>">
           <input type="hidden" name="path" value="<?php echo $_POST['path']; ?>">
           <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
           <button type="submit" name="Submit" value="add" class="btn btn-info btn-raised">Add</button>
         </div>
      </form>
    </div>
<script type="text/javascript">
$('#search').selectize({
    create: true,
    sortField: 'text'
});
$('#type').selectize({
    create: true,
    sortField: 'text'
});
</script>
</div>
