<!DOCTYPE html>
<html>
	<head>
		<title>Codeigniter 4 Add User With Validation Demo</title>
		
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.24/datatables.min.css"/>		
	</head>
	<body>
		<a href="<?php echo base_url('user-add') ?>" class="btn btn-success mb-2">Add user</a>
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
						<th>name</th>
						<th>phone</th>
						<th>email</th>
						<th>image</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php if($users): ?>
					<?php foreach($users as $user): ?>
					<tr>
						<td><?php echo $user['id']; ?></td>
						<td><?php echo $user['name']; ?></td>
						<td><?php echo $user['phone']; ?></td>
						<td><?php echo $user['email']; ?></td>
						<td><?php echo $user['image_upload']; ?></td>
						<td><img src="<?php echo base_url('uploads/'.$user['image_upload']); ?>" width=100 height=100 ><?php echo $user['image_upload']; ?></td>
						<td>
							<a href="<?php echo base_url('user-edit/'.$user['id']); ?>" class="btn btn-primary btn-sm">Edit</a>
							<a href="<?= base_url('user-delete/'.$user['id']); ?>" class="btn btn-danger btn-sm">Delete</a>
						</td>
					</tr>
					<?php endforeach; ?>
					<?php endif; ?>	
				</tbody>
			</table>
		</div>
		
		
		
		
		<input type="hidden" class="txt_csrfname" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
		
		<table class="table table-bordered" id="list_table"  class="table table-striped table-bordered" cellspacing="0" width="100%" >
			<thead>
				<tr>
					<th>User Id</th>
					<th>Name</th>
					<th>Email</th>
					<th>Phone</th>
					<th>Image</th>
					
				</tr>
			</thead>
			<tbody>
			</tbody>
			<tfoot>
				<tr>
					<th>User Id</th>
					<th>Name</th>
					<th>Email</th>
					<th>Phone</th>
					<th>Image</th>
					
					
				</tr>
			</tfoot>
		</table>
		
		<table class="table table-bordered" id="ajax_table"  class="table table-striped table-bordered" cellspacing="0" width="100%" >
			<thead>
				<tr>
					<th>User Id</th>
					<th>Name</th>
					<th>Email</th>
					<th>Phone</th>
					<th>Image</th>
					
				</tr>
			</thead>
			<tbody>
			</tbody>
			<tfoot>
				<tr>
					<th>User Id</th>
					<th>Name</th>
					<th>Email</th>
					<th>Phone</th>
					<th>Image</th>
					
					
				</tr>
			</tfoot>
		</table>
	</body>
</html>


<script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>

<script src="https://cdn.datatables.net/v/dt/dt-1.10.24/datatables.min.js"></script>
<script type="text/javascript">
	
	$(document).ready(function() {
        $('#list_table').DataTable({ 
			processing: false,
			serverSide: true,
			order: [], //init datatable not ordering
			ajax: "<?php echo site_url('ajax-datatable')?>",
			column: [
			{ targets: 0, orderable: false}, //first column is not orderable.
			]
		});
	});  
</script>
<script type="text/javascript">
	/* $(document).ready(function()
		{	//alert("hi");
		$.ajax({
		url:'<?= site_url('fetch-student') ?>',
		method:'get',
		success:function(response){
		//alert("hello");
		$.each(response.allstudents,function(key, value){
		$('#list_table').append('<tr>\
		<td> '+value['id']+' </td>\
		<td> '+value['name']+' </td>\
		<td> '+value['email']+' </td>\
		<td> '+value['phone']+' </td>\
		<td><img src="<?php echo base_url("uploads"); ?>/'+value['image_upload']+'" width=100 height=100 > '+value['image_upload']+' </td>\
		<td>\
		<a href="<?php echo base_url("user-edit"); ?>/'+value['id']+'" class="btn btn-primary btn-sm">Edit</a>\
		</td>\
		<td>\
		<a href="<?php echo base_url("user-delete"); ?>/'+value['id']+'" class="btn btn-danger btn-sm">Delete</a>\
		</td>\
		</tr>');
		});
		}
		
		});
		
	}); */
</script>
<!-- Script -->
<script type="text/javascript">
	$(document).ready(function(){
		//alert("hi");
		$('#ajax_table').DataTable({
			'processing': true,
			'serverSide': true,
			'serverMethod': 'post',
			'ajax': {
				'url':"<?=site_url('/get-Users')?>",
				'data': function(data){
					// CSRF Hash
					var csrfName = $('.txt_csrfname').attr('name'); // CSRF Token name
					var csrfHash = $('.txt_csrfname').val(); // CSRF hash
					
					return {
						data: data,
						[csrfName]: csrfHash // CSRF Token
					};
				},
				dataSrc: function(data){
					
					// Update token hash
					$('.txt_csrfname').val(data.token);
					
					// Datatable data
					return data.aaData;
				}
			},
			'columns': [
			{ data: 'id' },
			{ data: 'name' },
			{ data: 'email' },
			{ data: 'phone' },
			]
		});
	}); 
</script>
