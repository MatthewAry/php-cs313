<div class="container">
    <div class="page-header">
        <h1>View and Modify Student Contact</h1>
    </div>
    <form class="form-horizontal" action="?controller=contact&action=updateContact" method="post">
        <div class="panel panel-info">
            <div class="panel-heading">
                <h2 class="panel-title">Basic Information</h2>
            </div>
            <div class="panel-body">
                <div class="row">
                    <?php include_once('views/identity/partials/editBasicInfo.php'); ?>
                </div>
            </div>
        </div>
        <input type="hidden" name="identityId" value="<?php echo $identity['id']; ?>">
        <input type="hidden" name="path" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
        <button type="submit" value="SubmitIdentity" class="btn btn-raised btn-info">Update Basic Information</button>
        <div class="panel panel-info">
            <div class="panel-heading">
                <h2 class="panel-title">Addresses</h2>
            </div>
            <div class="panel-body">
                <?php if (empty($addresses)): ?>
                   <div class="alert alert-dismissible alert-danger">
                      <button type="button" class="close" data-dismiss="alert">×</button>
                     No addresses were found for this contact.
                   </div>
                <?php else: ?>
                    <?php foreach ($addresses as $i): ?>
                        <div class="list-group">
                            <div class="list-group-item">
                                <div class="row-content">
                                    <h4><?php echo $i['addressType']; ?></h4>
                                    <div class="col-md-9">
                                        <?php echo $i['street']; ?><br>
                                        <?php if ($i['extended'] != ''): ?>
                                            <?php echo $i['extended']; ?><br>
                                        <?php endif; ?>
                                        <?php echo $i['city']; ?> <?php echo $i['stateAbbrv']; ?>,
                                        <?php echo $i['zip']; ?><?php if ($i['zip4'] != ''): ?>-<?php echo $i['zip4']; ?>
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-md-3">
                                        <a data-toggle="ajaxModal" class='btn btn-sm btn-default' href="?controller=address&action=getAddress&id=<?php echo $i['id']; ?>&ajax=true"><i class="material-icons">mode_edit</i> Edit</a>
                                        <a data-toggle="ajaxModal" class='btn btn-sm' href="?controller=address&action=confirmDelete&id=<?php echo $i['id']; ?>&ajax=true" data-toggle="popover" data-placement="top" data-content="Delete Address"><i class="material-icons">delete</i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
                <button data-toggle="ajaxModal" type="button" class="btn btn-default" href="?controller=address&action=newAddressModal&ajax=true">Add An Address</button>
            </div>
        </div>
        <div class="panel panel-info">
            <div class="panel-heading">
                <h2 class="panel-title">Phone Numbers</h2>
            </div>
            <div class="panel-body">
                <?php if (empty($phoneNumbers)): ?>
                   <div class="alert alert-dismissible alert-danger">
                      <button type="button" class="close" data-dismiss="alert">×</button>
                      No phone numbers were found for this contact.
                   </div>
                <?php else: ?>
                    <div class="list-group">
                        <?php foreach ($phoneNumbers as $i): ?>
                            <div class="list-group-item">
                                <div class="col-md-9">
                                    <h4><?php echo $i['type']; ?></h4>
                                    <?php echo $i['number']; ?>
                                </div>
                                <div class="col-md-3">
                                    <button data-toggle="ajaxModal"
                                    class='btn btn-sm btn-default'
                                    href="?controller=phone&action=getPhone&id=<?php echo $i['id']; ?>&ajax=true">
                                        <i class="material-icons">mode_edit</i>
                                        &nbsp;EDIT</button>
                                    <button data-toggle="ajaxModal"
                                    class='btn btn-sm'
                                    href="?controller=phone&action=confirmDelete&id=<?php echo $i['id']; ?>&ajax=true">
                                        <i class="material-icons">delete</i>
                                    </button>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
                <button data-toggle="ajaxModal" type="button" class="btn" href="?controller=phone&action=newPhoneModal&ajax=true">Add Phone Number</button>
            </div>
        </div>
        <div class="panel panel-info">
            <div class="panel-heading">
                <h2 class="panel-title">Contact For</h2>
            </div>
            <div class="panel-body">
                <?php if (!empty($students)): ?>
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
                            <?php foreach ($students as $i): ?>
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
