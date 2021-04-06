<?php
namespace Modules\API\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;

// use \Modules\Common\Libraries\Oauth;
use \Modules\Common\Libraries\Json_format_datatable;
use \Modules\Common\Models\Tbl_product_codes;
// use \OAuth2\Request;

class Api_product_codes extends ResourceController
{
    protected $modelName = 'Modules\Common\Models\Vw_product_codes';
    protected $format    = 'json';

    use ResponseTrait;


	function __construct() {        
        
        $this->session              = \Config\Services::session();
    }

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

    public function show($id=null){
        $product   = $this->model->where('code',$id)
                    ->where('node_id',0)
                    ->first();
        
        if( is_null($product) ){

            $product = [
                'status'   => 400,
                'error'    => null,
                'messages' => [
                    'error' => 'Product code does not exist or already claimed.'
                ]
            ];
            return $this->respond($product,400);
        }
        return $this->respond($product);
    }

    public function update($id = null){
        $Tbl_product_codes = new Tbl_product_codes;
        
        $data = [
            'procode_id'        => $id,
            'node_id'           => $this->session->get('node_id')
        ];
     
        $test = $Tbl_product_codes->save($data);
        

        $response = [
          'status'   => 200,
          'error'    => null,
          'messages' => [
              'success' => 'You have successfully claimed Unilevel bunos.'
          ]
      ];
      return $this->respond($response);
    }
}