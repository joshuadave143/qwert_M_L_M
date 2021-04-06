<?php
namespace Modules\API\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;

// use \Modules\Common\Libraries\Oauth;
use \Modules\Common\Libraries\Json_format_datatable;
// use \OAuth2\Request;

class Api_unilevel extends ResourceController
{
    protected $modelName = 'Modules\Common\Models\Lib_unilevel';
    protected $format    = 'json';

    use ResponseTrait;

    public function index(){
        $json_format     = new Json_format_datatable;
        $product         = $this->model->findAll();
        
        $json_format->setButton('"<a class=\"edit btn btn-success\" href=\"\"><span class=\"fa fa-edit\"></span> Edit</a>"');
        $json = $json_format->json_format($product,['libuni_id','level','amount']);   
        return $this->respond(json_decode($json));
    }

    public function update($id = null){
        
        helper(['form']);

        $rules =[
            'Amount'=>'required|numeric'            
        ];

        if( !$this->validate($rules) ){
            return $this->fail($this->validator->getErrors());
        }
        $input = $this->request->getRawInput();
        
        $data = [
            'libuni_id'         => $id,
            'amount'            => $input['Amount'],
        ];
     
        $test = $this->model->save($data);
        

        $response = [
          'status'   => 200,
          'error'    => null,
          'messages' => [
              'success' => 'Unilevel updated successfully'
          ]
      ];
      return $this->respond($response);
    }
}