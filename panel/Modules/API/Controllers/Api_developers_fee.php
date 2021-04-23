<?php
namespace Modules\API\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;

use \Modules\Common\Libraries\Json_format_datatable;

class Api_developers_fee extends ResourceController
{
    protected $modelName = 'Modules\Common\Models\Tbl_developers_fee';
    protected $format    = 'json';

    use ResponseTrait;


    public function index(){
        $json_format     = new Json_format_datatable;
        $dev_fee         = $this->model
                            ->select('m.member_id, p.product_name, pg.package_name, tbl_developers_fee.*')
                            ->join('tbl_products p','tbl_developers_fee.product_id = p.product_id','left')
                            ->join('tbl_packages pg','tbl_developers_fee.package_id = pg.package_id','left')
                            ->join('vw_members m','tbl_developers_fee.node_id = m.node_id','left')
                            ->findAll();
                            // ->getCompiledSelect();
        // var_dump($dev_fee);
        // return ;
        $json = $json_format->json_format($dev_fee,['dev_id','member_id','product_name','package_name','amount','status','date_created','date_modified']);   
        return $this->respond(json_decode($json));
    }
    
    public function show($id=null,$is_all = false){
       
    }

    public function update($id = null){

        $this->model->set('status', 'Collected');
        $this->model->where('status', 'Not Collected');
        $this->model->update();

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