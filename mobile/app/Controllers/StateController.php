<?php
	
	namespace App\Controllers;
	use App\Models\Country;
	use App\Models\State;
	use App\Controllers\BaseController;
	//$db = \Config\Database::connect();
	class StateController extends BaseController
	{
		public function __construct()
    {
        $this->db = db_connect(); // Loading database
        // OR $this->db = \Config\Database::connect();
    }
		public function index()
		{
			$statemodel = new State();
			
			//$builder = $db->table('countries');
			//$query = $builder->get();
			$data['states'] = $statemodel->orderBy('id', 'DESC')->findAll();
			return view('state/index',$data);
		}
		
		public function create()
		{	
			$countrymodel = new Country();
			$get_country = $countrymodel->findAll();
			
			$data=['get_country' => $get_country];
			
			return view('state/create.php',$data);
		}
		
		public function store() 
		{
			helper(['form', 'url']);
			$countrymodel = new Country();
			$get_country = $countrymodel->findAll();
			
			$data=['get_country' => $get_country,];
			$valid = $this->validate([
            'country_id' => 'required',
            'state_name' => 'required|min_length[3]|is_unique[states.state_name]',
			]);
			$statemodel = new State();
			$data = [
            'country_id' => $this->request->getVar('country_id'),
            'state_name'  => $this->request->getVar('state_name'),
			];
			if (!$valid) {
				echo("hi");
				return view('state/create.php', [
                'validation' => $this->validator,
				'get_country' => $get_country,
				]);
			}
			else{
				$statemodel->save($data);
				return redirect()->to (base_url('state'))->with('status','state added successfully');
			}
		}
		
		public function edit($id)
		{	
			helper(['form', 'url']);
			$countrymodel = new Country();
			$get_country = $countrymodel->findAll();
			$statemodel = new State();
			
			$data['states'] = $statemodel->find($id);
			$data['get_country']= $get_country;
			return view('state/edit.php',$data);
		}
		
		public function update($id)
		{
			helper(['form', 'url']);
			$countrymodel = new Country();
			$get_country = $countrymodel->findAll();
			
			$data=['get_country' => $get_country];
			$valid = $this->validate([
            'country_id' => 'required',
            'state_name' => "required|min_length[3]|is_unique[states.state_name,id,{$id}]",
			]);
			$statemodel = new State();
			$states = $statemodel->find($id);
			$insert_data = [
            'country_id' => $this->request->getVar('country_id'),
            'state_name'  => $this->request->getVar('state_name'),
			];
			if (!$valid) {
				echo("hi");
				return view('state/edit.php', [
				'states' => $states,
                'validation' => $this->validator,
				'get_country' => $get_country,
				]);
			}
			else{
				$statemodel->update($id,$insert_data);
				return redirect()->to (base_url('state'))->with('status','state added successfully');
			}
		}
		
		public function delete($id)
		{
			$statemodel = new State();
			
			$statemodel->delete($id);
			
			return redirect()->to (base_url('state'))->with('status','state deleted');
			
		}
		
		
	}
