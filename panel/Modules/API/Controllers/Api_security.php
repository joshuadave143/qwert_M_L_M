<?php
namespace Modules\API\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;

// use \Modules\Common\Libraries\Oauth;
use \Modules\Common\Libraries\Json_format_datatable;
use Modules\Common\Libraries\PasswordHash;

class Api_security extends ResourceController
{
    protected $modelName = 'Modules\Common\Models\Tbl_security';
    protected $format    = 'json';

    use ResponseTrait;

    function __construct()
	{	
        $this->session      = \Config\Services::session();
    }

    public function index(){
       
    }
    

    public function update($id = null){
        
        $hasher             = new PasswordHash(8, FALSE);

        $input = $this->request->getRawInput();
        $password           = $hasher->HashPassword($input['value']['password']);
       
        $data = [
            'security_id'    => $this->session->get('security_id'),
            'login_pass'         => $password
        ];
     
        $test = $this->model->save($data);
        

        $response = [
          'status'   => 200,
          'error'    => null,
          'messages' => [
              'success' => 'Password updated successfully'
          ]
      ];
      return $this->respond($response);
    }

}