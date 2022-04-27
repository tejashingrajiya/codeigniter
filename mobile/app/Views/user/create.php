<!DOCTYPE html>
<html>
	<head>
		<title>Codeigniter 4 Add User With Validation Demo</title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
		
	</head>
	<body>
		<div>
			<h4>Codeigniter 4 Add User With Validation Demo</h4>
			<?php 
				if(session()->getFlashdata('status'))
				{
					echo"<h3>".(session()->getFlashdata('status'))."</h3>";
					
				}
			?>
		</div>
		<?php $validation = \Config\Services::validation(); ?>
		<form method="post" id="add_create" name="add_create" action="<?= base_url('/user-store') ?>"  enctype="multipart/form-data">
			<div class="form-row">
				<div class="form-group col-md-4">
					<label>Name</label>
					<input type="text" name="name" class="form-control">
					<!-- Error -->
					<?php if($validation->getError('name')) {?>
						<div class='alert alert-danger mt-2'>
							<?= $error = $validation->getError('name'); ?>
						</div>
					<?php }?>
				</div>
			</div>
			<div class="form-row">
				<div class="form-group col-md-4">
					<label>Email</label>
					<input type="text" name="email" class="form-control">
					<!-- Error -->
					<?php if($validation->getError('email')) {?>
						<div class='alert alert-danger mt-2'>
							<?= $error = $validation->getError('email'); ?>
						</div>
					<?php }?>
				</div>
			</div>
			<div class="form-row">
				<div class="form-group col-md-4">
					<label>Password</label>
					<input type="password" name="password" class="form-control">
					<!-- Error -->
					<?php if($validation->getError('password')) {?>
						<div class='alert alert-danger mt-2'>
							<?= $error = $validation->getError('password'); ?>
						</div>
					<?php }?>
				</div>
			</div>
			<div class="form-row">
				<div class="form-group col-md-4">
					<label>ConformPassword</label>
					<input type="password" name="conform_password" class="form-control">
					<!-- Error -->
					<?php if($validation->getError('conformpassword')) {?>
						<div class='alert alert-danger mt-2'>
							<?= $error = $validation->getError('conformpassword'); ?>
						</div>
					<?php }?>
				</div>
			</div>
			<div class="form-row">
				<div class="form-group col-md-4">
					<label>Phone</label>
					<input type="text" name="phone" class="form-control">
					<!-- Error -->
					<?php if($validation->getError('phone')) {?>
						<div class='alert alert-danger mt-2'>
							<?= $error = $validation->getError('phone'); ?>
						</div>
					<?php }?>
				</div>
			</div>
			<div class="form-row">
				<div class="form-group col-md-4">
					<label>image</label>
					<input type="file" name="image_upload" class="form-control">
					<!-- Error -->
					<?php if($validation->getError('image_upload')) {?>
						<div class='alert alert-danger mt-2'>
							<?= $error = $validation->getError('image_upload'); ?>
						</div>
					<?php }?>
				</div>
			</div>
			<div class="form-group">
				<button type="submit" class="btn btn-primary ">Add Data</button>
			</div>
		</form>
	</body>
</html>