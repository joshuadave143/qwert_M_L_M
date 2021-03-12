<?php
namespace Modules\API\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;

// use \Modules\Common\Libraries\Oauth;
use \Modules\Common\Libraries\Json_format_datatable;
// use \OAuth2\Request;

class Api_vw_activation_codes extends ResourceController
{
    protected $modelName = 'Modules\Common\Models\Vw_activation_codes';
    protected $format    = 'json';

    use ResponseTrait;

    public function index(){
        $json_format     = new Json_format_datatable;
        $product         = $this->model->where('node_id is null')
                                        ->where('activation_code is not null')
                                        ->findAll();
        $json_format->setTextStyle(['activation_code'=>'label label-success']);
        $json = $json_format->json_format($product,['activation_code_id','package_name','package_amt','activation_code']);   
        return $this->respond(json_decode($json));
    }
    
    public function show($id=null){
        $json_format     = new Json_format_datatable;
        $product         = $this->model->where('node_id is not null')->findAll();

        $json_format->setTextStyle(['activation_code'=>'label label-success',
                                    'activation_date'=>'label label-warning']);
       
        $json = $json_format->json_format($product,['activation_code_id','package_name','package_amt','activation_code','activation_date']);   
        return $this->respond(json_decode($json));
    }

    public function create(){
        $db      = \Config\Database::connect();
        helper(['form']);

        $rules =[
            'packages'=>'required',
            'total'=>'required|numeric'
        ];

        if( !$this->validate($rules) ){
            return $this->fail($this->validator->getErrors());
        }
        
        $packages = $this->request->getPost('packages');
        $total = $this->request->getPost('total');
        for( $i = 0; $i < count($packages) ; $i++ ){
           
            $query = $db->query('CALL activation_code_generator('.$packages[$i].','.$total.')');
            
        }
        $response = [
            'status'   => 200,
            'error'    => null,
            'messages' => [
                'success' => 'Codes generated successfully'
            ]
        ];
        return $this->respond($response);
    }
}