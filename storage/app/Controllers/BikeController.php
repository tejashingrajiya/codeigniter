<?php
	
	namespace App\Controllers;
	use App\Models\Bike;
	use App\Controllers\BaseController;
	
	class BikeController extends BaseController
	{
	    // show bikes list
		
		public function index()
		{	
			$bike = new Bike();
			$data['bikes'] = $bike->orderBy('id', 'DESC')->findAll();
			return view('bike/index', $data);
		}
		
		// show create product form
		public function create() {
			
			//echo("hi");die;
			return view('bike/create');
		}
		
		// save product data
		public function store() {
			$bike = new Bike();
			$data = [
            'part_name' => $this->request->getVar('part_name'),
            'price'  => $this->request->getVar('price'),
			];
			
			$bike->save($data);
			return $this->response->redirect(site_url('bike'));
			
		}
		
		// delete user
		public function delete($id = null){
			$bike = new Bike();
			$data['bikes'] = $bike->where('id', $id)->delete($id);
			return $this->response->redirect(site_url('bike'));
		} 
		
		// show single user
		public function edit($id){
			
			$bike = new Bike();
			$bike = $bike->find($id);

			$data['bikes'] = $bike;
			//$data['bikes'] = $bike->where('id', $id)->first();
			return view('bike/edit', $data);
		}
		
		// update user data
    public function update($id){
        $bike = new Bike();
        $bikes = $bike->find($id);
        $update_data = [
            'part_name' => $this->request->getVar('part_name'),
            'price'  => $this->request->getVar('price'),
        ];
        $ok=$bike->update($id, $update_data);
		echo "<pre>";
	print_r($ok);
	echo "</pre>";die();
        return $this->response->redirect(site_url('bike'));
    }
	
	}
