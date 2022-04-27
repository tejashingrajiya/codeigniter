<!DOCTYPE html>
<html>
	<head>
		<title>Codeigniter 4 Add User With Validation Demo</title>
			<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
		
	</head>
	<body>
		<a href="<?php echo base_url('city-add') ?>" class="btn btn-success mb-2">Add City</a>
		<?php 
			if(session()->getFlashdata('status'))
			{
				echo"<h3>".(session()->getFlashdata('status'))."</h3>";
				
			}
		?>
		<div class="mt-3">
			<table class="table table-bordered" id="users">
				<thead>
					<tr>
						<th>City Id</th>
						<th>Country Id</th>
						<th>State Id</th>
						<th>City Name</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php if($cities): ?>
					<?php foreach($cities as $city): ?>
					<tr>
						<td><?php echo $city['id']; ?></td>
						<td><?php echo $city['country_id']; ?></td>
						<td><?php echo $city['state_id']; ?></td>
						<td><?php echo $city['city_name']; ?></td>
						<td>
							<a href="<?php echo base_url('city-edit/'.$city['id']); ?>" class="btn btn-primary btn-sm">Edit</a>
							<a href="<?= base_url('city-delete/'.$city['id']); ?>" class="btn btn-danger btn-sm">Delete</a>
						</td>
					</tr>
					<?php endforeach; ?>
					<?php endif; ?>	
				</tbody>
			</table>
		</div>
		
		<table class="table table-bordered" id="userTable">
			<thead>
				<tr>
					<th> Id</th>
					<th>Country Id</th>
					<th>State Id</th>
					<th>City Name</th>
					<th>edit</th>
					<th>delete</th>
					
				</tr>
			</thead>
<tbody>
			</tbody>
			<tfoot>
				<tr>
					<th> Id</th>
					<th>Country Id</th>
					<th>State Id</th>
					<th>City Name</th>
					<th>edit</th>
					<th>delete</th>
					
				</tr>
			</tfoot>
			
			
			
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

			
			
			<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js" type="text/javascript"></script>
			
			<script>
				$(document).ready(function () {
					$('#userTable').DataTable({
					 'processing': true,
         'serverSide': true,
         'serverMethod': 'post',
         'ajax': {
            'url':"<?=base_url('users/getCity')?>",
            'data': function(data){
               return {
                  data: data,
               };
            },
            dataSrc: function(data){
              // Datatable data
              return data.aaData;
            }
         },
         'columns': [
            { data: 'id' },
            { data: 'country_id' },
            { data: 'state_id' },
            { data: 'city_name' },
			{
                        "render": function (data, type, full, meta)
                        { return '<a class="btn btn-info" href="city-edit/' + full.id + '">Edit</a>'; }
                    },
			 {
                        data: null, render: function (data, type, row)
                        { return '<a class="btn btn-danger" href="city-delete/' + row.id + '">Delete</a>'; }
                    },
            
                    
         ]
      });
   });
   </script>
		</body>
	</html>		