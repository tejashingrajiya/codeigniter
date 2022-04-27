<!DOCTYPE html>
<html>
	<head>
		<title>Codeigniter 4 Add country With Validation Demo</title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
		
	</head>
	<body>
		<?php $validation = \Config\Services::validation(); ?>
		<form method="post" id="add_create" name="add_create" action="<?= base_url('city-update/'.$cities['id']) ?>">
			<div class="form-row">
				<div class="form-group col-md-4">
					<label>Country Name</label>
					<select class="form-control" name="country_id"  id="country_id" value="<?php echo set_value('country_id'); ?>">
					<option value="">- Select Country -</option>
					<?php if($get_country): ?>
					<?php foreach($get_country as $country): ?>
					<option  <?php if($cities['country_id'] == 
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
				<select class="form-control" name="state_id" id="state_id" value="<?php echo set_value('country_id'); ?>">
				<option value="">- Select State -</option>
				<?php if($get_state): ?>
				<?php foreach($get_state as $state): ?>
				<option  <?php if($cities['state_id'] == 
					$state['id']) echo "selected";?>  
					value="<?php echo $state['id']?>">
					<?php echo $state['state_name']?> </option>
				<?php endforeach; ?>
				<?php endif; ?>
				<!-- Error -->
				<?php if($validation->getError('state_id')) {?>
					<div class='alert alert-danger mt-2'>
						<?= $error = $validation->getError('state_id'); ?>
					</div>
				<?php }?>
			</select>
		</div>
	</div>
	<div class="form-row">
		<div class="form-group col-md-4">
			<label>city Name</label>
			<input type="text" name="city_name" class="form-control" value="<?php echo $cities['city_name']; ?>">
			<!-- Error -->
			<?php if($validation->getError('city_name')) {?>
				<div class='alert alert-danger mt-2'>
					<?= $error = $validation->getError('city_name'); ?>
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
	 $(document).ready(function() {
	$('#country_id').on('change', function() {
	//alert('hi');
	var country_id = this.value;
	//alert(country_id);
		$("#state_id").html('');
		$.ajax({
			url:"<?= base_url('get-state')?>",
			type: "POST",
			data: {
				country_id: country_id,
			},
			dataType : 'json',
			success: function(result){
				$('#state_id').html('<option value="">Select State</option>'); 
				$.each(result,function(key,value){
				$("#state_id").append('<option value="'+value.id+'">'+value.state_name+'</option>');
				}); 
			}
		});
	});    
}); 
</script>
