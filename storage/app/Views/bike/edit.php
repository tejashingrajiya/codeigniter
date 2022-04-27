<!DOCTYPE html>
<html>
	<head>
		<title>Codeigniter 4 Add User With Validation Demo</title>
		  <h1>Codeigniter 4 Edit parts Demo</h1>

		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
		
	</head>
	<body>
		<?php $validation = \Config\Services::validation(); ?>
		<form method="post" id="add_create" name="add_create" action="<?= base_url('bikeparts-update/'.$bikes['id']) ?>">
			<div class="form-row">
			<div class="form-group col-md-4">
				<label>part Name</label>
				<input type="text" name="part_name" value="<?php echo $bikes['part_name']; ?>" class="form-control">
				<!-- Error -->
        <?php if($validation->getError('country_name')) {?>
            <div class='alert alert-danger mt-2'>
              <?= $error = $validation->getError('country_name'); ?>
            </div>
        <?php }?>
			</div>
			</div>
			
			<div class="form-row">
			<div class="form-group col-md-4">
				<label>price</label>
				<input type="text" name="price" value="<?php echo $bikes['price']; ?>" class="form-control">
				<!-- Error -->
        <?php if($validation->getError('price')) {?>
            <div class='alert alert-danger mt-2'>
              <?= $error = $validation->getError('price'); ?>
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