<?php
namespace Modules\API\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;

use \Modules\Common\Libraries\Json_format_datatable;

class Api_payout extends ResourceController
{
    protected $modelName = 'Modules\Common\Models\Tbl_payout';
    protected $format    = 'json';

    use ResponseTrait;

    function __construct()
	{	
        $this->session      = \Config\Services::session();
        $this->json_format     = new Json_format_datatable;
    }

    public function index(){
       
        $payout = $this->model
                ->from('vw_members m')
                ->where('tbl_payout.node_id = m.node_id')
                ->where("tbl_payout.status = 'Pending'")
                ->findAll();
        $this->json_format->setButton('"<a class=\"receive btn btn-success\" href=\"\"><span class=\"fa fa-share\"></span> Receive</a> "');
        $json = $this->json_format->json_format($payout,['payout_id','node_id','member_id','fullname','amount','date_created']);   
        return $this->respond(json_decode($json));
    }

    public function show($id=null){
        if($id == 'history'){
            $payout = $this->model
            ->from('vw_members m')
            ->where('tbl_payout.node_id = m.node_id')
            ->where("tbl_payout.status = 'Received'")
            ->findAll();
            $json = $this->json_format->json_format($payout,['payout_id','member_id','fullname','amount','date_modified']);   
            return $this->respond(json_decode($json));
        }
        elseif($id == 'history_member'){
            $payout = $this->model
            ->from('vw_members m')
            ->where('tbl_payout.node_id = m.node_id')
            ->where("tbl_payout.status = 'Received'")
            ->where('tbl_payout.node_id',$this->session->get('node_id'))
            ->findAll();
            $json = $this->json_format->json_format($payout,['payout_id','member_id','fullname','amount','date_modified']);   
            return $this->respond(json_decode($json));
        }
        else{
            $payout = $this->model
            ->where('node_id',$this->session->get('node_id'))
            ->where('status','Pending')
            ->find();
            return $this->respond($payout);
        }
    }
    
    public function create(){
        helper(['form']);

        $rules =[
            'amount'=>'required|numeric',
        ];

        if( !$this->validate($rules) ){
            return $this->fail($this->validator->getErrors());
        }
        $input = $this->request->getRawInput();
        
        $data = [
            'node_id'          => $this->session->get('node_id'),
            'amount'           => $input['amount']
        ];
        
        $post_id = $this->model->insert($data);
        // $data['post_id'] = $post_id;
        // return $this->respondCreated($data);

        $response = [
          'status'   => 200,
          'error'    => null,
          'messages' => [
              'success' => 'Request Payout successfully sent.'
          ]
      ];
      return $this->respond($response);
    }

    public function update($id = null){
        
        helper(['form']);

        $rules =[
            'node_id'=>'required'
        ];

        if( !$this->validate($rules) ){
            return $this->fail($this->validator->getErrors());
        }
        $input = $this->request->getRawInput();
        
        $data = [
            'payout_id' => $id,
            'status'    => 'Received'
        ];
     
        $test = $this->model->save($data);
        

        $response = [
          'status'   => 200,
          'error'    => null,
          'messages' => [
              'success' => 'Payout received successfully'
            ]
        ];
        $db      = \Config\Database::connect();
        $query = $db->query("UPDATE `mlm`.`tbl_ewallet` SET `status`='cash-out' 
        WHERE  `node_id`=".$input['node_id']." AND STATUS IS null;");
        
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