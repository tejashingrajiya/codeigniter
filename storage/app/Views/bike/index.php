<!DOCTYPE html>
<html>
	<head>
		<title>Codeigniter 4 Add User With Validation Demo</title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
		
	</head>
	<body>
		<a href="<?php echo base_url('bikeparts-form') ?>" class="btn btn-success mb-2">Add parts</a>
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
					 <?php if($bikes): ?>
          <?php foreach($bikes as $bike): ?>
          <tr>
             <td><?php echo $bike['id']; ?></td>
             <td><?php echo $bike['part_name']; ?></td>
             <td><?php echo $bike['price']; ?></td>
             <td>
               <a href="<?php echo base_url('delete/'.$bike['id']);?>" class="btn btn-danger btn-sm">Delete</a>
               <a href="<?php echo base_url('bikeparts-edit/'.$bike['id']);?>" class="btn btn-danger btn-sm">edit</a>
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