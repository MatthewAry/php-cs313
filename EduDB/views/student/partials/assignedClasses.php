<div class="panel panel-info">
   <div class="panel-heading">
      <h2 class="panel-title">Assigned Classes</h2>
   </div>
   <div class="panel-body">
      <?php if (isset($student['classList'])): ?>
          <table class="table table-striped table-hover">
            <thead>
               <tr>
                   <th>Class Name</th>
                   <th>Grade Level</th>
                   <th>Teacher</th>
                   <th></th>
               </tr>
            </thead>
            <tbody>
               <?php foreach ($student['classList'] as $i): ?>
               <tr>
                    <td><?php echo $i['name']; ?></td>
                    <td><?php echo $i['grade']['name']; ?></td>
                    <td><?php echo $i['teacher']['identity']['firstName'] . ' ' . $i['teacher']['identity']['lastName']; ?></td>
                    <td>Controls will go here</td>
               </tr>
               <?php endforeach; ?>
            </tbody>
          </table>
      <?php else: ?>
          <p>This student does not belong to any classes at this school.</p>
      <?php endif; ?>
   </div>
</div>
