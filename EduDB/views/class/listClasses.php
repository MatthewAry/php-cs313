<form action="?controller=sclass&action=listClasses" method="post">
    <p>Select School:</p>
    <select name="schoolID">
        <?php foreach ($schoolList['list'] as $i): $i = $i->getValues(); ?>
            <option value="<?php echo $i['id']; ?>"><?php echo $i['name']; ?></option>
        <?php endforeach; ?>
    </select>
    <input type="submit" value="submit">
</form>

<?php if(!empty($classesAtSchool) && !empty($schoolName)): ?>
    <h2>Classes at <?php echo $schoolName; ?></h2>
    <table>
        <tr>
            <th>Class Name</th>
            <th>Teacher</th>
            <th>Grade</th>
        </tr>
    <?php foreach($classesAtSchool as $i): $i = $i->getValues(); ?>
        <tr>
            <td><?php echo $i['name']; ?></td>
            <td><?php echo $i['teacher']['identity']['firstName']; ?>
                <?php echo $i['teacher']['identity']['middleName']; ?>
                <?php echo $i['teacher']['identity']['lastName']; ?>
            </td>
            <td><?php echo $i['grade']['name']; ?></td>
        </tr>
    <?php endforeach; ?>

<?php elseif(empty($classesAtSchool)): ?>
    <h2>No classes were found at that school.</h2>
<?php else: ?>
    <h2>Select a School</h2>
<?php endif; ?>
