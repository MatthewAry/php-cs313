<div class="container">
    <div class="page-header">
        <h1>Add A New Contact To <?php echo $firstName. ' '. $lastName; ?></h1>
        <a class="btn" href="<?php echo $path; ?>">
            <i class="material-icons">keyboard_return</i> Go Back
        </a>
    </div>
    <form class="form-horizontal" enctype="multipart/form-data" action="?controller=contact&action=newContact" method="post">
        <div class="panel panel-info">
            <div class="panel-heading">
                <h2 class="panel-title">Basic Information</h2>
            </div>
            <div class="panel-body">
                <div class="row">
                    <?php include_once('views/identity/partials/emptyBasicInfo.php'); ?>
                </div>
            </div>
        </div>
        <input type="hidden" name="identityId" value="<?php echo $identityId; ?>">
        <input type="hidden" name="studentId" value="<?php echo $studentId; ?>">
        <button class="btn btn-raised btn-info" type="submit" name="submit">Create Contact and Add Details</button>
    </form>
</div>
