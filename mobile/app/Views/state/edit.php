<!DOCTYPE html>
<html>
	<head>
		<title>Codeigniter 4 Add country With Validation Demo</title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
		
	</head>
	<body>
		<?php $validation = \Config\Services::validation(); ?>
		<form method="post" id="add_create" name="add_create" action="<?= base_url('state-update/'.$states['id']) ?>">
			<div class="form-row">
				
				<div class="form-group col-md-4">
					
					<label>Country Name</label>
					
					<select class="form-control" name="country_id"  value="<?php echo set_value('country_id'); ?>">
						<option value="">- Select Country -</option>
						<?php if($get_country): ?>
						<?php foreach($get_country as $country): ?>
						<option  <?php if($states['country_id'] == 
					$country['id'] ) echo "selected";?>  
					value="<?php echo $country['id']?>">
					<?php echo $country['country_name']?> </option>
						<?php endforeach; ?>
						<?php endif; ?>
						<!-- Error -->
						<?php if($validation->getError('country_id')) {?>
							<div class='alert alert-danger mt-2'>
								<?= $error = $validation->getError('country_id'); ?>
							</div>
						<?php }?>
						</select>
					</div>
				</div>
				<div class="form-row">
					<div class="form-group col-md-4">
						<label>State Name</label>
						<input type="text" name="state_name" class="form-control" value="<?php echo $states['state_name']; ?>">
						<!-- Error -->
						<?php if($validation->getError('state_name')) {?>
							<div class='alert alert-danger mt-2'>
								<?= $error = $validation->getError('state_name'); ?>
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
