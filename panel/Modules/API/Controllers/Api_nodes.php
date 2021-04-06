<?php
namespace Modules\API\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;

// use \Modules\Common\Libraries\Oauth;
use \Modules\Common\Libraries\Json_format_datatable;
// use \OAuth2\Request;

class Api_nodes extends ResourceController
{
    protected $modelName = 'Modules\Common\Models\Tbl_nodes';
    protected $format    = 'json';

    function __construct()
	{	
        $this->session      = \Config\Services::session();
        $this->json_format     = new Json_format_datatable;
    }

    use ResponseTrait;

    public function index(){
        
        $nodes           = $this->model
                                        ->from('vw_members vm')
                                        ->where('vm.node_id = tbl_referral_bonus.downline_id')
                                        ->where('tbl_referral_bonus.node_id',$this->session->get('node_id'))
                                        ->where('referral_status = 0')
                                        ->find();
        // $json_format->setButton('"<a class=\"edit btn btn-success\" href=\"\"><span class=\"fa fa-edit\"></span> Edit</a> <a class=\"delete btn btn-danger\" href=\"\"><span class=\"fa fa-trash-o\"></span> Delete</a>"');
        $json = $json_format->json_format_node($nodes,['downline_id','fullname','amount','referral_status']);   
        return $this->respond(json_decode($json));
    }
    
    public function show($id=null){
        $db      = \Config\Database::connect();
        $query = $db->query('CALL process_map_nodes('.$id.')');
        $results = $query->getResult();
        // var_dump($results);
       return $json = $this->json_format->json_format_node($results,['node_id','sponsor_id','member_id','fullname','level']);  
        
        // return $this->respond(json_decode($json));
        // foreach ($results as $row)
        // {
        //     echo $row->title;
        //     echo $row->name;
        //     echo $row->email;
        // }
        // if(!$is_all):
        //     $package = $this->model->find($id);
        // else:
        //     $package = $this->model->findAll();
        // endif;
        // return $this->respond($package);
    }

}