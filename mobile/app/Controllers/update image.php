public function update($id)
		{	
			helper(['form', 'url']);
			
			$valid = $this->validate([
            'name' => "required|min_length[3]|is_unique[users.name,id,{$id}]",
            'email' => 'required|valid_email',
            'phone' => 'required|min_length[10]|is_unique[users.name]',
			'image_upload' =>'uploaded[image_upload]|mime_in[image_upload,image/jpg,image/jpeg,image/gif,image/png]'
			]);
			
			$userModel = new UserModel();
			
			$users = $userModel->find($id);
			
			$oldimg = $users['image_upload'];
			$img = $this->request->getFile('image_upload');
		
			if ($img->isValid() && ! $img->hasMoved()) 
			{	echo("lo");
			
				 if(file_exists('uploads/', $oldimg)){
					 unlink('uploads/', $oldimg);
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