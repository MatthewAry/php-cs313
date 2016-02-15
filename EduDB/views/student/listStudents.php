<?php
/**
 * Created by PhpStorm.
 * User: MatthewAry
 * Date: 2/13/2016
 * Time: 2:20 PM
 */
?>

<form action="?controller=student&action=listStudents" method="post">
    <p>Select School:
    <select name="schoolID">
        <option selected>Select One</option>
        <?php foreach ($schoolList as $i):?>
            <option value="<?php echo $i['id']; ?>"><?php echo $i['name']; ?></option>
        <?php endforeach; ?>
    </select>
    <input type="submit" value="submit">
    </p>
</form>
<?php if(!empty($studentsAtSchool) && !empty($schoolName)): ?>

    <h2>Students at <?php echo $schoolName; ?></h2>
    <table>
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
            <td><a href="?controller=student&action=viewStudent&id=<?php echo $i['id'] ?>">view</a></td>
        </tr>
    <?php endforeach; ?>
    </table>
<?php elseif(empty($studentsAtSchool) && !empty($schoolName)): ?>
    <h2>No students were found at <?php echo $schoolName; ?>.</h2>
<?php elseif(empty($schoolName)): ?>
    <h2>Select a School.</h2>
<?php endif; ?>