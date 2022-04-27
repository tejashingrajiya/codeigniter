<?php
	
	namespace App\Controllers;
	use App\Models\Country;
	use App\Controllers\BaseController;
	
	class CountryController extends BaseController
	{
		public function index()
		{
			$countrymodel = new Country();
			$data['countries'] = $countrymodel->orderBy('id', 'DESC')->findAll();
			return view('country/index',$data);
		}
		
		public function create()
		{	
			
			return view('country/create.php');
		}
		
		public function store()
		{	
			helper(['form', 'url']);
			
			$valid = $this->validate([
            'country_name' => 'required|min_length[3]|is_unique[countries.country_name]',
			]);
			$countrymodel = new Country();
			$data = [ 
			'country_name' => $this->request->getVar('country_name'),
			];
			if (!$valid) {
				return view('country/create.php', [
                'validation' => $this->validator
				]);
			}
			else{
				$countrymodel->save($data);
				return redirect()->to (base_url('country'))->with('status','country added successfully');
			}
		}
		
		public function edit($id)
		{	
			$countrymodel = new Country();
			
			$data['countries'] = $countrymodel->find($id);
			
			return view('country/edit.php',$data);
		}
		
		public function update($id)
		{	
			helper(['form', 'url']);
			
			$valid = $this->validate([
            'country_name' => "required|min_length[3]|is_unique[countries.country_name,id,{$id}]",
			]);
			$countrymodel = new Country();
			
			$countries = $countrymodel->find($id);
			
			$insert_data = [ 
			'country_name' => $this->request->getVar('country_name'),
			];
			if (!$valid)
			{ 
				return view('country/edit.php', [
				'countries' => $countries,
				'validation' => $this->validator
				]);
			}
			else
			{
				//echo("hi");
				$countrymodel->update($id,$insert_data);
				return redirect()->to (base_url('country'))->with('status','country updated successfully');
			}
		}
		
		public function delete($id)
		{
			$countrymodel = new Country();
			
			$countrymodel->delete($id);
			
			return redirect()->to (base_url('country'))->with('status','country deleted');
			
		}
	}
