<!DOCTYPE html>
<html>
<head>
  <title>Codeigniter 4 Add User With Validation Demo</title>
  <h1>Codeigniter 4 Add new parts Demo</h1>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <style>
    .container {
      max-width: 500px;
    }
    .error {
      display: block;
      padding-top: 5px;
      font-size: 14px;
      color: red;
    }
  </style>
</head>
<body>
  <div class="container mt-5">
    <form method="post" id="add_create" name="add_create" 
    action="<?= base_url('bikeparts-store') ?>">
      <div class="form-group">
	<input type="hidden" class="txt_csrfname" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
		</div>
	<div class="form-group">
        <label>part Name</label>
        <input type="text" name="part_name" class="form-control">
      </div>
      <div class="form-group">
        <label>price</label>
        <input type="text" name="price" class="form-control">
      </div>
      <div class="form-group">
        <button type="submit" class="btn btn-primary btn-block">submit part</button>
      </div>
    </form>
  </div>  
</body>
</html>