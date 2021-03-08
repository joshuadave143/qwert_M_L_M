<?php

namespace App\Controllers;
use \CodeIgniter\Controller;
use CodeIgniter\API\ResponseTrait;
class Home extends BaseController
{
	use ResponseTrait;
	public function index()
	{
		return view('welcome_message');
	}
    public function show($id)
    {
        // $model = new UserModel();
        // $user  = $model->save($this->request->getPost());

        // Respond with 201 status code
        return $this->respond($id);
    }
}
