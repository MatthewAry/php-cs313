<div class="col-md-3" style="text-align: center;"><img src="<?php echo $identity['image']; ?>" alt=
"<?php echo $identity['firstName']; ?> <?php echo $identity['lastName']; ?>"></div>
<div class="col-md-9">
	<h4><?php echo $type['label']. ' ID: '.$type['id']; ?></h4>
	<table class="table">
		<tbody>
			<tr>
				<td>First Name: </td>
				<td><?php echo $identity['firstName']; ?></td>
			</tr>
			<tr>
				<td>Middle Name: </td>
				<td><?php echo $identity['middleName']; ?></td>
			</tr>
			<tr>
				<td>Last Name: </td>
				<td><?php echo $identity['lastName']; ?></td>
			</tr>
			<tr>
				<td>Gender: </td>
				<td><?php echo $identity['gender']; ?></td>
			</tr>
			<tr>
				<td>Email: </td>
				<td><?php echo $identity['email']; ?></td>
			</tr>
		</tbody>
	</table>
</div>
