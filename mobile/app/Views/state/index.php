<!DOCTYPE html>
<html>
	<head>
		<title>Codeigniter 4 Add User With Validation Demo</title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
		
	</head>
	<body>
		<a href="<?php echo base_url('state-add') ?>" class="btn btn-success mb-2">Add State</a>
		<?php 
			if(session()->getFlashdata('status'))
			{
				echo"<h3>".(session()->getFlashdata('status'))."</h3>";
				
			}
		?>
		<div class="mt-3">
			<table class="table table-bordered" id="users-list">
				<thead>
					<tr>
						<th>State Id</th>
						<th>Country Id</th>
						<th>State Name</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php if($states): ?>
					<?php foreach($states as $state): ?>
					<tr>
						<td><?php echo $state['id']; ?></td>
						<td><?php echo $state['country_id']; ?></td>
						<td><?php echo $state['state_name']; ?></td>
						<td>
							<a href="<?php echo base_url('state-edit/'.$state['id']); ?>" class="btn btn-primary btn-sm">Edit</a>
							<a href="<?= base_url('state-delete/'.$state['id']); ?>" class="btn btn-danger btn-sm">Delete</a>
						</td>
					</tr>
					<?php endforeach; ?>
					<?php endif; ?>	
				</tbody>
			</table>
		</div>
	</form>
</body>
</html>