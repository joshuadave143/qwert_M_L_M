<?php
namespace Modules\Admin\Controllers;
use \CodeIgniter\Controller;
use CodeIgniter\API\ResponseTrait;
use Modules\Common\Models\Tbl_developers_fee;

use \App\Libraries\Oauth;
use \OAuth2\Request;

class Dev_fee extends \Modules\Common\Controllers\AdminBaseController
{
	use ResponseTrait;
    public $parser;
    public function __construct(){
        $this->parser = \Config\Services::parser();

        $this->data['css_entries'] = array();
		$this->data['js_entries'] = array();
		$this->data['js_plug'] = array();
		
		$this->data['css_custom'] = "";
		$this->data['js_init'] = "";
		
		$this->data['js_custom'] = "";
        $this->data['msgbox'] = "";
		$this->data['message'] = "";
    }

    public function index(){
        array_push($this->data['css_entries'],
            array('css_link' => base_url().'/assets/css/AdminLTE.min.css'),
			array('css_link' => base_url().'/assets/plugins/bootstrap-toastr/toastr.min.css'),
			array('css_link' => base_url().'/assets/plugins/select2/select2.css'),
			array('css_link' => base_url().'/assets/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css')
		);
		array_push($this->data['js_entries'],
			array('js_link' => base_url().'/assets/plugins/bootstrap-toastr/toastr.min.js'),
			array('js_link' => base_url().'/assets/plugins/select2/select2.min.js'),
			array('js_link' => base_url().'/assets/plugins/datatables/media/js/jquery.dataTables.min.js'),
			array('js_link' => base_url().'/assets/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js'),
			array('js_link' => base_url().'/assets/scripts/developers_fee.js')
        );
        
        $this->data['js_init']      = "developers_feeTable.init()
        localStorage.setItem('access_token','".$this->session->get('access_token')."');";
		$this->data['title']        = 'Product Library';
		$this->data['page']         = 'Modules\Admin\Views\dev_fee_view';
        $this->data['css_custom']   = "";
        $this->data['js_custom']    = "";
        $this->data['message']      = "";
        $this->data['Total']      = $this->income_format($this->ewallet()[0]['total']);

        
        $side['side_bar'] = $this->load_sidebar(array('item_index' => 14, 'sub_index' => 0, 'page_title' => 'Dashboard', 'show_page_title' => 1, 'show_breadcrumbs' => 1, 'user_type' => $this->joshua_auth->get_session_data('user_type')));

        $this->data['side_bar_template'] = view('Modules\Template\Views\template\page-sidebar',$side['side_bar'] );
        $this->data['template'] = view('Modules\Template\Views\default-page',$this->data);
        echo $this->parser->setData($this->data)
                            ->renderString($this->data['template']);
    }

    function income_format($data){
        return $data != ''?number_format($data, 2, '.', ','):number_format(0, 2, '.', '');
    }

    function ewallet(){
        $Tbl_developers_fee = new tbl_developers_fee;
        return $Tbl_developers_fee->select('sum(amount) as total')
                                    ->where('status', 'Not Collected')
                                    ->find();
    }
}