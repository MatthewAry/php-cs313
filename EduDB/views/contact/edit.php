<div class="container">
    <div class="page-header">
        <h1>View and Modify Student Contact</h1>
    </div>
    <form class="form-horizontal" action="" method="post">
        <div class="panel panel-info">
            <div class="panel-heading">
                <h2 class="panel-title">Basic Information</h2>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-2" style="text-align: center;">
                        <img src="<?php echo $identity['image']; ?>" alt="<?php echo $identity['firstName'] . ' ' . $identity['lastName']; ?>" />
                        <a data-toggle="ajaxModal" href="?controller=identity&action=updateImageModal&ajax=true" class="btn btn-default">Change Image</a>
                    </div>
                    <div class="col-md-10">
                        <h4>Identity ID: <?php echo $identity['id']; ?></h4>
                        <div class="form-group">
                            <label for="firstName" class="col-md-2 control-label">First Name</label>
                            <div class="col-md-10">
                                <input type="text" name="firstName" value="<?php echo $identity['firstName']; ?>" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="middleName" class="col-md-2 control-label">Middle Name</label>
                            <div class="col-md-10">
                                <input type="text" name="middleName" value="<?php echo $identity['middleName']; ?>" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="lastName" class="col-md-2 control-label">Last name</label>
                            <div class="col-md-10">
                                <input type="text" name="lastName" value="<?php echo $identity['lastName']; ?>" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                           <label for="gender" class="col-md-2 control-label">Gender</label>
                           <div class="col-md-10">
                              <select id="gender" name="gender" class="form-control">
                                 <option value="1"<?php echo ($identity['gender'] == 'Male') ? ' selected' : ''; ?>>Male</option>
                                 <option value="0"<?php echo ($identity['gender'] == 'Female') ? ' selected' : ''; ?>>Female</option>
                              </select>
                           </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel panel-info">
            <div class="panel-heading">
                <h2 class="panel-title">Addresses</h2>
            </div>
            <div class="panel-body">
                I haven't built this yet.
            </div>
        </div>
        <div class="panel panel-info">
            <div class="panel-heading">
                <h2 class="panel-title">Phone Numbers</h2>
            </div>
            <div class="panel-body">
                I haven't built this yet.
            </div>
        </div>
        <div class="panel panel-info">
            <div class="panel-heading">
                <h2 class="panel-title">Contact For</h2>
            </div>
            <div class="panel-body">
                <?php if (!empty($list)): ?>
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Relationship</th>
                                <th>Student Name</th>
                                <th>School</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($list as $i): ?>
                            <tr>
                                <td><?php echo $i['relationship']; ?></td>
                                <td><?php echo $i['student']['identity']['firstName']; ?> <?php echo $i['student']['identity']['lastName']; ?></td>
                                <td><?php echo $i['student']['school']['name']; ?></td>
                                <td><a class="btn" href="?controller=student&action=viewStudent&id=<?php echo $i['student']['id']; ?>">View</a></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <div class="alert alert-info">
                        <?php echo $identity['firstName']. ' ' . $identity['lastName']; ?> is not a contact for any student.
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <input type="hidden" name="identityId" value="<?php echo $identity['id']; ?>">
        <input type="hidden" name="path" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
        <button type="submit" value="SubmitIdentity" class="btn btn-raised btn-info">Update Contact</button>
    </form>
</div>
<script type="text/javascript">
    $('[data-toggle="ajaxModal"]').on('click',
      function(e) {
        $('#ajaxModal').remove();
        e.preventDefault();
        var $this = $(this)
          , $remote = $this.data('remote') || $this.attr('href')
          , $modal = $('<div class="modal fade" id="ajaxModal"><div class="modal-body"></div></div>');
        $('body').append($modal);
        $modal.modal({backdrop: 'static', keyboard: false});
        $fName = "<?php echo $identity['firstName']; ?>";
        $lName = "<?php echo $identity['lastName']; ?>";
        $identityId = "<?php echo $identity['id']; ?>";
        $path = "<?php echo $_SERVER['REQUEST_URI']; ?>";
        $modal.load($remote, {
            "firstName": $fName,
            "lastName": $lName,
            "identityId": $identityId,
            "path": $path
        });
      });
    $('#gender').selectize();
</script>
