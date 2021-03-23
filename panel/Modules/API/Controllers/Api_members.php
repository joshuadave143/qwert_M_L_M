<?php
namespace Modules\API\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;

// use \Modules\Common\Libraries\Oauth;
use \Modules\Common\Libraries\Json_format_datatable;
// use \OAuth2\Request;

class Api_members extends ResourceController
{
    protected $modelName = 'Modules\Common\Models\Members';
    protected $format    = 'json';

    use ResponseTrait;

    public function index(){
        $json_format     = new Json_format_datatable;
        $product         = $this->model->select('member_id,sponsor_id, 
                        concat(lastname,\', \',firstname,\' \',middlename) as name,
                        gender,
                        birthdate,
                        age,
                        concat(address,\' \',city,\' \',province,\' \',postal_code,\' \',lc.cname) as address,
                        email,
                        mobile_no,
                        mop_cash,
                        mop_bank_deposit,
                        mop_bank_details,
                        case 
                            when member_status = 1 then \'Active\'
                            when member_status = 0 then \'Inactive\'
                        end as member_status,
                        case 
                            when member_type = 1 then \'Not Activated\'
                            when member_type = 2 then \'Activated\'
                        end as member_type,',false)
                        ->from('lib_countries as lc')
                        ->where('lc.country_id = country')->findAll();
        // $json_format->setButton('"<a class=\"edit btn btn-success\" href=\"\"><span class=\"fa fa-edit\"></span> Edit</a> <a class=\"delete btn btn-danger\" href=\"\"><span class=\"fa fa-trash-o\"></span> Delete</a>"');
        $json_format->setTextStyle(['member_status'=>'label label-success','member_type'=>'label label-success'],
                                    ['member_status'=>'Inactive','member_type'=>'Not Activated'],
                                    ['member_status_Inactive'=>"label label-danger",
                                        'member_type_Not Activated'=>'label label-danger']);
        
        $json = $json_format->json_format($product,['member_id','sponsor_id','name',
                        'age', 'birthdate','gender','address','email','mobile_no',
                        'mop_cash','mop_bank_deposit','mop_bank_details', 'member_status','member_type']);   
        return $this->respond(json_decode($json));
    }
    
    public function show($id=null){
        $product = $this->model->find($id);
        return $this->respond($product);
    }

    // public function create(){
    //     helper(['form']);

    //     $rules =[
    //         'Name'=>'required',
    //         'Amount'=>'required|numeric',
    //         'Points'=>'required|numeric',
    //         'Developer'=>'required|numeric',
    //     ];

    //     if( !$this->validate($rules) ){
    //         return $this->fail($this->validator->getErrors());
    //     }
    //     $input = $this->request->getRawInput();
        
    //     $data = [
    //         'product_name'      => $input['Name'],
    //         'amount'            => $input['Amount'],
    //         'pts'               => $input['Points'],
    //         'developer_fee'     => $input['Developer']
    //     ];
        
    //     $post_id = $this->model->insert($data);
    //     // $data['post_id'] = $post_id;
    //     // return $this->respondCreated($data);

    //     $response = [
    //       'status'   => 200,
    //       'error'    => null,
    //       'messages' => [
    //           'success' => 'Product inserted successfully'
    //       ]
    //     ];
    //   return $this->respond($response);
    // }

    // public function update($id = null){
        
    //     helper(['form']);

    //     $rules =[
    //         'Name'=>'required',
    //         'Amount'=>'required|numeric',
    //         'Points'=>'required|numeric',
    //         'Developer'=>'required|numeric',
    //     ];

    //     if( !$this->validate($rules) ){
    //         return $this->fail($this->validator->getErrors());
    //     }
    //     $input = $this->request->getRawInput();
        
    //     $data = [
    //         'product_id'            => $id,
    //         'product_name'      => $input['Name'],
    //         'amount'            => $input['Amount'],
    //         'pts'               => $input['Points'],
    //         'developer_fee'     => $input['Developer']
    //     ];
     
    //     $test = $this->model->save($data);
        

    //     $response = [
    //       'status'   => 200,
    //       'error'    => null,
    //       'messages' => [
    //           'success' => 'Package updated successfully'
    //       ]
    //   ];
    //   return $this->respond($response);
    // }

    // public function delete($id = null){
	// 	$data = $this->model->find($id);
	// 	if($data){
	// 		$this->model->delete($id);
    //         $response = [
    //             'status'   => 200,
    //             'error'    => null,
    //             'messages' => [
    //                 'success' => 'Package deleted successfully'
    //             ]
    //         ];
    //         return $this->respond($response);
	// 	}else{
	// 		return $this->failNotFound('Item not found');
	// 	}
	// }
}