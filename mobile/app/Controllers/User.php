<?php
	
	namespace App\Controllers;
	use App\Models\UserModel;
	use App\Controllers\BaseController;
	use \Hermawan\DataTables\DataTable;
	
	class User extends BaseController
	{
		public function index()
		{	
			helper('url');
			$userModel = new UserModel();
			$data['users'] = $userModel->orderBy('id', 'DESC')->findAll();
			return view('user/index',$data);
		}
		
		public function create()
		{	
			
			return view('user/create.php');
		}
		
		public function store()
		{	
			helper(['form', 'url']);
			
			$valid = $this->validate([
            'name' => 'required|min_length[3]|is_unique[users.name]',
            'email' => 'required|valid_email',
            'password' => 'required|min_length[5]|alpha_numeric',
            'conform_password' => 'required|min_length[3]|is_unique[users.name]',
            'phone' => 'required|min_length[10]|is_unique[users.phone]',
			'image_upload' =>'uploaded[image_upload]|mime_in[image_upload,image/jpg,image/jpeg,image/gif,image/png]'
			]);
			
			$userModel = new UserModel();
			
			$img = $this->request->getFile('image_upload');
			
			if ($img->isValid() && ! $img->hasMoved()) 
			{	
				$newName = $img->getRandomName();
				$img->move('uploads/', $newName);
			}
			
			$data = [ 
			'name' => $this->request->getVar('name'),
			'email' => $this->request->getVar('email'),
			'password' => $this->request->getVar('password'),
			'phone' => $this->request->getVar('phone'),
			'image_upload' => $newName,
			];
			
			
			if (!$valid) {
				return view('user/create.php', [
                'validation' => $this->validator
				]);
			}
			else{
				
				$userModel->save($data);
				return redirect()->to (base_url('user'))->with('status','user added');
			}
		}	
		
		public function edit($id)
		{	
			$userModel = new UserModel();
			
			$data['users'] = $userModel->find($id);
			
			return view('user/edit.php',$data);
		}
		
		public function update($id)
		{	
			helper(['form', 'url']);
			
			$valid = $this->validate([
            'name' => "required|min_length[3]|is_unique[users.name,id,{$id}]",
            'email' => 'required|valid_email',
            'phone' => 'required|min_length[10]|is_unique[users.name]',
			'image_upload' =>'mime_in[image_upload,image/jpg,image/jpeg,image/gif,image/png]'
			]);
			
			$userModel = new UserModel();
			
			$users = $userModel->find($id);
			
			$oldimg = $users['image_upload'];
			$img = $this->request->getFile('image_upload');
			
			
			if ($img->isValid() && !$img->hasMoved()) 
			{	echo("lo");
				
				if(file_exists('uploads/'. $oldimg)) {
					unlink("uploads/". $oldimg);
				} 
				$newName = $img->getRandomName();
				$img->move('uploads/', $newName);	 
			}
			else
			{
				$newName = $oldimg;			
			}
			
			
			$insert_data = [ 
			'name' => $this->request->getVar('name'),
			'email' => $this->request->getVar('email'),
			'phone' => $this->request->getVar('phone'),
			'image_upload' => $newName,
			];
			if (!$valid)
			{ 
				echo("hi");
				return view('user/edit.php', [
				'users' => $users,
				'validation' => $this->validator
				]);
			}
			else
			{
				$userModel->update($id,$insert_data);
				return redirect()->to (base_url('user'))->with('status','user updated');
			}
		}
		
		public function delete($id)
		{
			$userModel = new UserModel();
			
			$userModel->delete($id);
			
			return redirect()->to (base_url('user'))->with('status','user deleted');
			
		}
		public function ajaxDataTables()
		{
			$db = db_connect();
			$builder = $db->table('users')->select('name, email,  phone, image_upload,');
			
			return DataTable::of($builder)
			->addNumbering() //it will return data output with numbering on first column
			/* ->addColumn('action', function($user){ return '<a href="'.<?php echo base_url('user-edit/'.$user['id']); ?>.'" class="btn btn-primary btn-sm">Edit</a>} */		
			->toJson();
		}
		
		//fetch all students records 
		/* public function ReadStudent()
			{	echo("hi");die;
			$userModel = new UserModel();
			
			$data['allstudents'] = $userModel->findAll();
			
			return $this->response->setJSON($data);
		} */
		public function getUsers(){
			echo("hi");
			$request = service('request');
			$postData = $request->getPost();
			$dtpostData = $postData['data'];
			$response = array();
			
			## Read value
			$draw = $dtpostData['draw'];
			$start = $dtpostData['start'];
			$rowperpage = $dtpostData['length']; // Rows display per page
			$columnIndex = $dtpostData['order'][0]['column']; // Column index
			$columnName = $dtpostData['columns'][$columnIndex]['data']; // Column name
			$columnSortOrder = $dtpostData['order'][0]['dir']; // asc or desc
			$searchValue = $dtpostData['search']['value']; // Search value
			
			## Total number of records without filtering
			$userModel = new UserModel();
			$totalRecords = $userModel->select('id')
			->countAllResults();
			
			## Total number of records with filtering
			$totalRecordwithFilter = $userModel->select('id')
            ->orLike('name', $searchValue)
            ->orLike('email', $searchValue)
            ->orLike('phone', $searchValue)
            ->countAllResults();
			
			## Fetch records
			$records = $userModel->select('*')
            ->orLike('name', $searchValue)
            ->orLike('email', $searchValue)
            ->orLike('phone', $searchValue)
            ->orderBy($columnName,$columnSortOrder)
            ->findAll($rowperpage, $start);
			
			$data = array();
			
			foreach($records as $record ){
				
				$data[] = array( 
				"id"=>$record['id'],
				"name"=>$record['name'],
				"email"=>$record['email'],
				"phone"=>$record['phone'],
				); 
			}
			
			## Response
			$response = array(
			"draw" => intval($draw),
			"iTotalRecords" => $totalRecords,
			"iTotalDisplayRecords" => $totalRecordwithFilter,
			"aaData" => $data,
			"token" => csrf_hash() // New token hash
			);
			
			return $this->response->setJSON($response);
		}
		
	}								