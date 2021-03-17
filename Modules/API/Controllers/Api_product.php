<?php
namespace Modules\API\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;

// use \Modules\Common\Libraries\Oauth;
use \Modules\Common\Libraries\Json_format_datatable;
// use \OAuth2\Request;

class Api_product extends ResourceController
{
    protected $modelName = 'Modules\Common\Models\Tbl_products';
    protected $format    = 'json';

    use ResponseTrait;

    public function index(){
        $json_format     = new Json_format_datatable;
        $product         = $this->model->findAll();
        $json_format->setButton('"<a class=\"edit btn btn-success\" href=\"\"><span class=\"fa fa-edit\"></span> Edit</a> <a class=\"delete btn btn-danger\" href=\"\"><span class=\"fa fa-trash-o\"></span> Delete</a>"');
        $json = $json_format->json_format($product,['product_id','product_name','amount','pts','developer_fee']);   
        return $this->respond(json_decode($json));
    }
    
    public function show($id=null,$is_all = false){
        if(!$is_all):
            $package = $this->model->find($id);
        else:
            $package = $this->model->findAll();
        endif;
        return $this->respond($package);
    }

    public function create(){
        helper(['form']);

        $rules =[
            'Name'=>'required',
            'Amount'=>'required|numeric',
            'Points'=>'required|numeric',
            'Developer'=>'required|numeric',
        ];

        if( !$this->validate($rules) ){
            return $this->fail($this->validator->getErrors());
        }
        $input = $this->request->getRawInput();
        
        $data = [
            'product_name'      => $input['Name'],
            'amount'            => $input['Amount'],
            'pts'               => $input['Points'],
            'developer_fee'     => $input['Developer']
        ];
        
        $post_id = $this->model->insert($data);
        // $data['post_id'] = $post_id;
        // return $this->respondCreated($data);

        $response = [
          'status'   => 200,
          'error'    => null,
          'messages' => [
              'success' => 'Product inserted successfully'
          ]
        ];
      return $this->respond($response);
    }

    public function update($id = null){
        
        helper(['form']);

        $rules =[
            'Name'=>'required',
            'Amount'=>'required|numeric',
            'Points'=>'required|numeric',
            'Developer'=>'required|numeric',
        ];

        if( !$this->validate($rules) ){
            return $this->fail($this->validator->getErrors());
        }
        $input = $this->request->getRawInput();
        
        $data = [
            'product_id'            => $id,
            'product_name'      => $input['Name'],
            'amount'            => $input['Amount'],
            'pts'               => $input['Points'],
            'developer_fee'     => $input['Developer']
        ];
     
        $test = $this->model->save($data);
        

        $response = [
          'status'   => 200,
          'error'    => null,
          'messages' => [
              'success' => 'Package updated successfully'
          ]
      ];
      return $this->respond($response);
    }

    public function delete($id = null){
		$data = $this->model->find($id);
		if($data){
			$this->model->delete($id);
            $response = [
                'status'   => 200,
                'error'    => null,
                'messages' => [
                    'success' => 'Package deleted successfully'
                ]
            ];
            return $this->respond($response);
		}else{
			return $this->failNotFound('Item not found');
		}
	}
}