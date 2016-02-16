<div class="container">
   <div class="page-header">
      <h1>Student List</h1>
      <fieldset disabled><a type="button" href="" class="btn"><i class="material-icons">keyboard_return</i> Return to...</a></fieldset>
   </div>
   <div class="panel panel-primary">
      <div class="panel-heading">
         <h3 class="panel-title">School Selection</h3>
      </div>
      <div class="panel-body">
         <form action="?controller=student&action=listStudents" method="post" class="form-horizontal">
            <div class="col-md-10">
               <div class="form-group">
                  <label for="schoolID" class="col-md-2 control-label">School</label>
                  <div class="col-md-10">
                   <select name="schoolID" class="form-control" id="school">
                       <option>Select One</option>
                       <?php foreach ($schoolList as $i):?>
                           <option value="<?php echo $i['id']; ?>"<?php if (isset($schoolName) && $schoolName == $i['name']): ?>selected<?php endif; ?>><?php echo $i['name']; ?></option>
                       <?php endforeach; ?>
                   </select>
                  </div>
               </div>
            </div>
            <div class="col-md-2">
                <input class="btn btn-default" type="submit" value="submit">
            </div>
         </form>
      </div>
   </div>
   <div class="panel panel-info">
      <div class="panel-heading">
         <h2 class="panel-title">Students at <?php echo $schoolName; ?></h2>
      </div>
      <div class="panel-body">
         <?php if(!empty($studentsAtSchool) && !empty($schoolName)): ?>
             <table class="table table-striped table-hover">
                 <tr>
                     <th>Image</th>
                     <th>First Name</th>
                     <th>Middle Name</th>
                     <th>Last Name</th>
                     <th>Gender</th>
                     <th>Grade</th>
                     <th></th>
                 </tr>
             <?php foreach($studentsAtSchool as $i):?>
                 <tr>
                     <td><img src="<?php echo $i['identity']['image'] ?>"></td>
                     <td><?php echo $i['identity']['firstName']; ?></td>
                     <td><?php echo $i['identity']['middleName']; ?></td>
                     <td><?php echo $i['identity']['lastName']; ?></td>
                     <td><?php echo $i['identity']['gender']; ?></td>
                     <td><?php echo $i['grade']['name']; ?></td>
                     <td><a class="btn" href="?controller=student&action=viewStudent&id=<?php echo $i['id'] ?>">view</a></td>
                 </tr>
             <?php endforeach; ?>
             </table>
         <?php elseif(empty($studentsAtSchool) && !empty($schoolName)): ?>
            <div class="alert alert-info">
              No students were found at <?php echo $schoolName; ?>.
            </div>
         <?php elseif(empty($schoolName)): ?>
             <p>Select a School.</p>
         <?php endif; ?>
      </div>
   </div>

</div>
<script type="text/javascript">
$('#school').selectize();
</script>
