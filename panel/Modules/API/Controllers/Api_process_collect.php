<?php
namespace Modules\API\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;


use \Modules\Common\Libraries\Json_format_datatable;


class Api_process_collect extends ResourceController
{
    function __construct()
	{	
        $this->session      = \Config\Services::session();
    }

    use ResponseTrait;

    public function index(){
        
    }

    public function show($type=null){

        $db      = \Config\Database::connect();
        $query = $db->query("CALL process_collect_bonus('".$type."',".$this->session->get('node_id').")");
        // $query = $db->query("CALL process_collect_bonus('".$type."',
            // 1001)");
        $response = [
            'status'   => 200,
            'error'    => null,
            'messages' => [
                'success' => 'Collected Successfully.'
            ]
        ];
        return $this->respond($response);

    }
}