<!DOCTYPE html>
<html>
	<head>
		<title>Codeigniter 4 Add User With Validation Demo</title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
		
	</head>
	<body>
		<?php $validation = \Config\Services::validation(); ?>
		<form method="post" id="add_create" name="add_create" action="<?= base_url('user-update/'.$users['id']) ?>"  enctype="multipart/form-data">
			<!--for old image save-->
			<div>
				<input type="hidden" name="old" id="old" placeholder="Name" value="<?php echo"uploads/".$users['image_upload']; ?>">
			</div>
			<div class="form-row">
				<div class="form-group col-md-4">
					<label>Name</label>
					<input type="text" name="name" value="<?php echo $users['name']; ?>" class="form-control">
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
					<input type="text" name="email" value="<?php echo $users['email']; ?>" class="form-control">
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
					<label>Phone</label>
					<input type="text" name="phone" value="<?php echo $users['phone']; ?>" class="form-control">
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
					<!-- old image view-->&nbsp;&nbsp;&nbsp;
					<div>
					<?php
					if($users['image_upload'])
					{ ?>
					<img src="<?php echo base_url('uploads/'.$users['image_upload']); ?>" width=100 height=100 >
					<?php }
					?>
					</div>
					<!-- Error -->
					<?php if($validation->getError('image_upload')) {?>
						<div class='alert alert-danger mt-2'>
							<?= $error = $validation->getError('image_upload'); ?>
						</div>
					<?php }?>
				</div>
			</div>
			<div class="form-group">
				<button type="submit" class="btn btn-primary ">Update Data</button>
			</div>
		</form>
	</body>
</html>