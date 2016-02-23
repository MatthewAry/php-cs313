<div class="container">
    <form class="form-horizontal" enctype="multipart/form-data" action="?controller=student&action=addStudent" method="post">
        <div class="page-header">
            <h1>Add A New Student</h1>
            <a href="?controller=student&action=listStudents" class="btn">
                <i class="material-icons">keyboard_return</i> Return to Student List
            </a>
        </div>
        <div class="panel panel-info">
            <div class="panel-heading">
                <h2 class="panel-title">Basic Information</h2>
            </div>
            <div class="panel-body">
                <?php include_once('views/identity/partials/emptyBasicInfo.php') ?>
            </div>
        </div>
        <div class="panel panel-info">
            <div class="panel-heading">
                <h2 class="panel-title">Enrollments</h2>
            </div>
            <div class="panel-body">
                <?php include_once('views/student/partials/emptyEnrollment.php'); ?>
            </div>
        </div>
        <button type="submit" name="button" class="btn btn-raised btn-info">Add Student</button>
    </form>
</div>
