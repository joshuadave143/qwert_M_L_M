<?php
namespace Modules\API\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;

// use \Modules\Common\Libraries\Oauth;
use \Modules\Common\Libraries\Json_format_datatable;
// use \OAuth2\Request;

class Api_product_codes extends ResourceController
{
    protected $modelName = 'Modules\Common\Models\Vw_product_codes';
    protected $format    = 'json';

    use ResponseTrait;

    public function index(){
        $json_format     = new Json_format_datatable;
        $product         = $this->model->where('node_id = 0')
                                        ->findAll();
        $json_format->setTextStyle(['code'=>'label label-success']);
        $json = $json_format->json_format($product,['procode_id','product_name','code']);   
        return $this->respond(json_decode($json));
    }

    public function create(){
        $db      = \Config\Database::connect();
        helper(['form']);

        $rules =[
            'products'=>'required',
            'total'=>'required|numeric'
        ];

        if( !$this->validate($rules) ){
            return $this->fail($this->validator->getErrors());
        }
        
        $products = $this->request->getPost('products');
        $total = $this->request->getPost('total');
        for( $i = 0; $i < count($products) ; $i++ ){
           
            $query = $db->query('CALL product_code_generator('.$products[$i].','.$total.')');
            
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