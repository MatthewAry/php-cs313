<div class="container">
    <div class="page-header">
        <h1>Define Student Relationship with Contact</h1>
    </div>
    <form class="form-horizontal" action="?controller=contact&action=linkContact" method="post">
        <div class="row">
            <?php foreach ($joiningIdentities as $i):
                $identity = $i['identity'];
                $type = $i['type']; ?>
                <div class="col-md-6">
                    <div class="panel<?php echo ($type['label'] == 'Student')? ' panel-default':' panel-info' ?>">
                        <div class="panel-heading">
                            <?php if ($type['label'] == 'Student'): ?>
                                <h2 class="panel-title">Student Being Linked To Contact</h2>
                            <?php else: ?>
                                <h2 class="panel-title">Contact Being Linked To Student</h2>
                            <?php endif; ?>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <?php require('views/identity/partials/readOnlyBasicInfo.php'); ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h2 class="panel-title">Set Relationship</h2>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label for="relationship" class="control-label col-md-2">Relationship</label>
                            <div class="col-md-10">
                                <select id="relationship" class="form-control" name="relationship" placeholder="Set Relationship">
                                    <option value="">Set Relationship</option>
                                    <?php foreach (StudentContact::getTypes() as $i): ?>
                                        <option value="<?php echo $i['id']; ?>"><?php echo $i['name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer" style="text-align: right;">
                        <button type="submit" name="button" class="btn btn-raised btn-info" id="save_relationship">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<script type="text/javascript">
    $('#relationship').selectize();
</script>
