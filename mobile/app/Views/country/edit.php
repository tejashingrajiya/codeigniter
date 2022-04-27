<!DOCTYPE html>
<html>
	<head>
		<title>Codeigniter 4 Add User With Validation Demo</title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
		
	</head>
	<body>
		<?php $validation = \Config\Services::validation(); ?>
		<form method="post" id="add_create" name="add_create" action="<?= base_url('country-update/'.$countries['id']) ?>">
			<div class="form-row">
			<div class="form-group col-md-4">
				<label>Country Name</label>
				<input type="text" name="country_name" value="<?php echo $countries['country_name']; ?>" class="form-control">
				<!-- Error -->
        <?php if($validation->getError('country_name')) {?>
            <div class='alert alert-danger mt-2'>
              <?= $error = $validation->getError('country_name'); ?>
            </div>
        <?php }?>
			</div>
			</div>
			
			<div class="form-group">
				<button type="submit" class="btn btn-primary">Update Data</button>
			</div>
		</form>
	</body>
</html>