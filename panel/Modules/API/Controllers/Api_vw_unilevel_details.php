<?php
namespace Modules\API\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;


use \Modules\Common\Libraries\Json_format_datatable;


class Api_vw_unilevel_details extends ResourceController
{
    function __construct()
	{	
        $this->session      = \Config\Services::session();
    }

    protected $modelName = 'Modules\Common\Models\vw_unilevel_details';
    protected $format    = 'json';

    use ResponseTrait;

    public function index(){
        $json_format     = new Json_format_datatable;
        $unilevel = $this->model->where('node_id',$this->session->get('node_id'))
                            ->find();
        // var_dump($unilevel);
        $json = $json_format->json_format($unilevel,['unilevel_id',
            'downline_id','downline','amount','date_created']);   
        return $this->respond(json_decode($json));
    }

    public function show($id=null){
        $json_format     = new Json_format_datatable;
        $unilevel = $this->model->findAll($id);
        // var_dump($unilevel);
        $json = $json_format->json_format($unilevel,['unilevel_id',
            'downline_id','downline','amount','date_created']);   
      
        return $this->respond(json_decode($json));
    }
}