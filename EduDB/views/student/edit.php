<p>
    <img src="<?php echo $student['identity']['image'] ?>" alt="<?php echo $student['identity']['firstName']; ?>
    <?php echo $student['identity']['lastName']; ?>"><br>
    <form enctype="multipart/form-data" action="/EduDB/?controller=identity&action=updateImage" method="post">
        <input type="file" size="32" name="image_field" value="">
        <input type="hidden" name="id" value="<?php echo $student['identity']['id']; ?>">
        <input type="hidden" name="path" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
        <input type="submit" name="Submit" value="upload">
    </form>
</p>

<form action="/EduDB/?controller=student&action=updateStudent" method="post">
<p>ID: <?php echo $student['id']; ?></p>
<p>
    First Name: <input type="text" value="<?php echo $student['identity']['firstName']; ?>" name="firstName">
</p>
<p>
    Middle Name: <input type="text" value="<?php echo $student['identity']['middleName']; ?>" name="middleName">
</p>
<p>
    Last Name: <input type="text" value="<?php echo $student['identity']['lastName']; ?>" name="lastName">
</p>
<p>Gender:
    <select name="gender" id="">
        <option value="1"<?php echo ($student['identity']['gender'] == 'Male') ? ' selected' : ''; ?>>Male</option>
        <option value="0"<?php echo ($student['identity']['gender'] == 'Female') ? ' selected' : ''; ?>>Female</option>
    </select>
<p/>

<p>
 Grade:
     <select name="grade">
        <?php foreach ($grades as $i): ?>
        <option value="<?php echo $i['id']; ?>"<?php echo ($student['grade']['id'] == $i['id'])?' selected':''; ?>><?php echo $i['name']; ?></option>
        <?php endforeach; ?>
    </select>
</p>
<p>
    School: <select name="school">
        <?php foreach ($schools as $i): ?>
        <option value="<?php echo $i['id']; ?>"<?php echo ($student['school']['id'] == $i['id'])?' selected':''; ?>><?php echo $i['name']; ?></option>
        <?php endforeach; ?>
    </select>
</p>
    <input type="hidden" name="identityID" value="<?php echo $student['identity']['id']; ?>">
    <input type="hidden" name="studentID" value="<?php echo $student['id']; ?>">
    <input type="hidden" name="path" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
    <button type="submit" value="SubmitIdentity">Submit Changes</button>
</form>
<p>
Student Classes:
<?php if (isset($student['classList'])): ?>
    <table>
        <tr>
            <th>
                Class Name
            </th>
            <th>
                Grade Level
            </th>
            <th>
                Teacher
            </th>
            <th></th>
        </tr>
    <?php foreach ($student['classList'] as $i): ?>
        <tr>
            <td><?php echo $i['name']; ?></td>
            <td><?php echo $i['grade']['name']; ?></td>
            <td><?php echo $i['teacher']['identity']['firstName'] . ' ' . $i['teacher']['identity']['lastName']; ?></td>
            <td>Controls will go here</td>
        </tr>
    <?php endforeach; ?>
    </table>
<?php else: ?>
    <p>This student does not belong to any classes.</p>
<?php endif; ?>
</p>
<p>
    Student Contact Information:
    <?php if (isset($student['contactList'])): ?>
        <table>
        <tr>
            <th>Relationship</th>
            <th>Name</th>
            <th></th>
        </tr>
    <?php foreach ($student['contactList'] as $i): ?>
        <tr>
            <td><?php echo $i['relationship']['Type']; ?></td>
            <td><?php echo $i['identity']['firstName']. ' ' .$i['identity']['lastName']; ?></td>
            <td>Controls will go here.</td>
        </tr>
    <?php endforeach; ?>
    </table>
    <?php else: ?>
    <p>This student has no contacts.</p>
    <?php endif ?>
</p>