<?php
namespace Modules\API\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;

// use \Modules\Common\Libraries\Oauth;
use \Modules\Common\Libraries\Json_format_datatable;
// use \OAuth2\Request;

class Api_direct_referral extends ResourceController
{
    protected $modelName = 'Modules\Common\Models\Tbl_referral_bonus';
    protected $format    = 'json';

    function __construct()
	{	
        $this->session      = \Config\Services::session();
    }

    use ResponseTrait;

    public function index(){
        $json_format     = new Json_format_datatable;
        $product         = $this->model
                                        ->from('vw_members vm')
                                        ->where('vm.node_id = tbl_referral_bonus.downline_id')
                                        ->where('tbl_referral_bonus.node_id',$this->session->get('node_id'))
                                        ->where('referral_status = 0')
                                        ->find();
        // $json_format->setButton('"<a class=\"edit btn btn-success\" href=\"\"><span class=\"fa fa-edit\"></span> Edit</a> <a class=\"delete btn btn-danger\" href=\"\"><span class=\"fa fa-trash-o\"></span> Delete</a>"');
        $json = $json_format->json_format($product,['downline_id','fullname','amount','referral_status']);   
        return $this->respond(json_decode($json));
    }

    /**
     * todo
     */

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

}