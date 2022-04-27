<?php
	
	namespace App\Controllers;
	
	use App\Controllers\BaseController;
	use App\Models\Country;
	use App\Models\State;
	use App\Models\City;
	class CityController extends BaseController
	{
		public function __construct() {
			//$this->load->database();
			$this->db = \Config\Database::connect();
		}
		
		public function index()
		{
			$citymodel = new City();
			$data['cities'] = $citymodel->orderBy('id', 'DESC')->findAll();
			return view('city/index',$data);
		}
		
		public function create()
		{	
			$countrymodel = new Country();
			$statemodel = new State();
			$get_country = $countrymodel->findAll();
			$get_state = $statemodel->findAll();
			
			$data=[	'get_country' => $get_country,
			'get_state' => $get_state
			];
			
			return view('city/create.php',$data);
		}
		
		public function store() 
		{
			helper(['form', 'url']);
			$countrymodel = new Country();
			$statemodel = new State();
			$get_country = $countrymodel->findAll();
			$get_state = $statemodel->findAll();
			
			$data=[	'get_country' => $get_country,
			'get_state' => $get_state
			];
			$valid = $this->validate([
            'country_id' => 'required',
            'state_id' => 'required',
            'city_name' => 'required|min_length[3]|is_unique[cities.city_name]',
			]);
			$citymodel = new City();
			$data = [
            'country_id' => $this->request->getVar('country_id'),
            'state_id' => $this->request->getVar('state_id'),
            'city_name'  => $this->request->getVar('city_name'),
			];
			if (!$valid) {
				//echo("hi");
				return view('city/create.php', [
                'validation' => $this->validator,
				'get_country' => $get_country,
				'get_state' => $get_state,
				]);
			}
			else{
				$citymodel->save($data);
				return redirect()->to (base_url('city'))->with('status','city added successfully');
			}
		}
		
		public function edit($id)
		{	
			helper(['form', 'url']);
			$countrymodel = new Country();
			$statemodel = new State();
			$get_country = $countrymodel->findAll();
			$get_state = $statemodel->findAll();
			
			$citymodel = new City();
			
			$data['cities'] = $citymodel->find($id);
			$data['get_country']= $get_country;
			$data['get_state']= $get_state;
			return view('city/edit.php',$data);
		}
		
		public function update($id)
		{
			helper(['form', 'url']);
			$countrymodel = new Country();
			$statemodel = new State();
			$get_country = $countrymodel->findAll();
			$get_state = $statemodel->findAll();
			
			$data=[	'get_country' => $get_country,
			'get_state' => $get_state
			];
			$valid = $this->validate([
            'country_id' => 'required',
            'state_id' => 'required',
            'city_name' => "required|min_length[3]|is_unique[cities.city_name,id,{$id}]",
			]);
			$citymodel = new City();
			$data = [
            'country_id' => $this->request->getVar('country_id'),
            'state_id' => $this->request->getVar('state_id'),
            'city_name'  => $this->request->getVar('city_name'),
			];
			if (!$valid) {
				//echo("hi");
				return view('city/create.php', [
                'validation' => $this->validator,
				'get_country' => $get_country,
				'get_state' => $get_state,
				]);
			}
			else{
				$citymodel->update($id,$data);
				return redirect()->to (base_url('city'))->with('status','city added successfully');
			}
		}
		
		public function delete($id)
		{
			$citymodel = new City();
			
			$citymodel->delete($id);
			
			return redirect()->to (base_url('city'))->with('status','city deleted');
			
		}
		
		/* public function ge_state()
			{	
			$statemodel = new State();
			$country_id = $this->request->getVar("country_id");
			$builder = $this->db->table('states');
			$builder->where('country_id',$country_id);
			$query   = $builder->get();
			$states = $query->getResultArray();
			print_r($query);
			return json_encode($query);
			
		} */
		
		/* public function ge_state()
			{	
			//problem in query
			//$statemodel = new State();
			$builder = $this->db->table('states');
			$query   = $builder->getResultArray();
			print_r($query);
			echo json_encode($query);
			
			} 
			
			public function ge_State()
			{		//ok query
			$country_id = $this->request->getVar("country_id");
			$states = $this->db->query("SELECT id, state_name from states where country_id = ".$country_id)->getResultArray();
			
			return json_encode($states);
		} */
		
		public function getCity(){
			
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
			$citymodel = new City();
			$totalRecords = $citymodel->select('id')
			->countAllResults();
			
			## Total number of records with filtering
			$totalRecordwithFilter = $citymodel->select('id')
            ->orLike('country_id', $searchValue)
            ->orLike('state_id', $searchValue)
            ->orLike('city_name', $searchValue)
            ->countAllResults();
			
			## Fetch records
			$records = $citymodel->select('*')
            ->orLike('country_id', $searchValue)
            ->orLike('state_id', $searchValue)
            ->orLike('city_name', $searchValue)
            ->orderBy($columnName,$columnSortOrder)
            ->findAll($rowperpage, $start);
			
			$data = array();
			
			foreach($records as $record ){
				
				$data[] = array( 
				"id"=>$record['id'],
				"country_id"=>$record['country_id'],
				"state_id"=>$record['state_id'],
				"city_name"=>$record['city_name'],
				); 
				}
			
			## Response
			$response = array(
			"draw" => intval($draw),
			"iTotalRecords" => $totalRecords,
			"iTotalDisplayRecords" => $totalRecordwithFilter,
			"aaData" => $data,
			);
			
			return $this->response->setJSON($response);
		}	
	}
