<?php
namespace Modules\API\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;

// use \Modules\Common\Libraries\Oauth;
use \Modules\Common\Libraries\Json_format_datatable;
// use \OAuth2\Request;

class Api_country extends ResourceController
{
    protected $modelName = 'Modules\Common\Models\Lib_countries';
    protected $format    = 'json';

    use ResponseTrait;

    public function index(){
        $json_format     = new Json_format_datatable;
        $country         = $this->model->findAll();
        // $json_format->setTextStyle(['is_unilevel'=>'label label-success'],
        //                             ['is_unilevel'=>'Not Unilevel'],
        //                             ['is_unilevel_Not Unilevel'=>"label label-danger"]);
        // $json_format->setButton('"<a class=\"edit btn btn-success\" href=\"\"><span class=\"fa fa-edit\"></span> Edit</a> <a class=\"delete btn btn-danger\" href=\"\"><span class=\"fa fa-trash-o\"></span> Delete</a>"');
        // $json = $json_format->json_format($product,['product_id','product_name','amount','pts','developer_fee','is_unilevel']);   
        return $this->respond($country);
    }
  
}