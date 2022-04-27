<!DOCTYPE html>
<html>
	<head>
		<title>Codeigniter 4 Add User With Validation Demo</title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
		
	</head>
	<body>
		<a href="<?php echo base_url('country-add') ?>" class="btn btn-success mb-2">Add Country</a>
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
						<th>User Id</th>
						<th>Name</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php if($countries): ?>
					<?php foreach($countries as $country): ?>
					<tr>
						<td><?php echo $country['id']; ?></td>
						<td><?php echo $country['country_name']; ?></td>
						<td>
							<a href="<?php echo base_url('country-edit/'.$country['id']); ?>" class="btn btn-primary btn-sm">Edit</a>
							<a href="<?= base_url('country-delete/'.$country['id']); ?>" class="btn btn-danger btn-sm">Delete</a>
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