<?php
namespace Modules\API\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;

// use \Modules\Common\Libraries\Oauth;
use \Modules\Common\Libraries\Json_format_datatable;
// use \OAuth2\Request;

class Api_vw_ewallet_total extends ResourceController
{
    protected $modelName = 'Modules\Common\Models\vw_ewallet_total';
    protected $format    = 'json';

    use ResponseTrait;

    function __construct()
	{	
        $this->session      = \Config\Services::session();
    }

    public function index(){
        $product = $this->model->find($this->session->get('node_id'));
        $total = $product['Direct_Referral'] + $product['Indirect_Referral'] + 
                $product['Unilevel'] + $product['points']; 
        return $this->respond($total);
    }
    
    public function show($id=null){
        $product = $this->model->find($id);
        return $this->respond($product);
    }

}