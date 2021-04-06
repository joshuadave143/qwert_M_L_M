<?php
namespace Modules\Member\Controllers;
use \CodeIgniter\Controller;
use CodeIgniter\API\ResponseTrait;

use \App\Libraries\Oauth;
use \OAuth2\Request;

class Referrals extends \Modules\Common\Controllers\MemberBaseController
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
			array('css_link' => base_url().'/assets/plugins/bootstrap-toastr/toastr.min.css'),
			array('css_link' => base_url().'/assets/plugins/select2/select2.css'),
			array('css_link' => base_url().'/assets/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css')
		);
		array_push($this->data['js_entries'],
			array('js_link' => base_url().'/assets/plugins/bootstrap-toastr/toastr.min.js'),
			array('js_link' => base_url().'/assets/plugins/select2/select2.min.js'),
			array('js_link' => base_url().'/assets/plugins/datatables/media/js/jquery.dataTables.min.js'),
			array('js_link' => base_url().'/assets/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js'),
			array('js_link' => base_url().'/assets/scripts/referral.js')
        );
        
        $this->data['js_init']      = "referralTable.init('direct')
        localStorage.setItem('access_token','".$this->session->get('access_token')."');";
		$this->data['title']        = 'Direct Referrals';
		$this->data['page']         = 'Modules\Member\Views\referral_view';
        $this->data['css_custom']   = "";
        $this->data['js_custom']    = "";
        $this->data['message']      = "";
        $this->data['referral_type']      = "Direct Referrals";
        
        $side['side_bar'] = $this->load_sidebar(array('item_index' => 7, 'sub_index' => 1, 'page_title' => 'Dashboard', 'show_page_title' => 1, 'show_breadcrumbs' => 1, 'user_type' => $this->joshua_auth->get_session_data('user_type')));

        $this->data['side_bar_template'] = view('Modules\Template\Views\template\page-sidebar',$side['side_bar'] );
        $this->data['template'] = view('Modules\Template\Views\default-page',$this->data);
        echo $this->parser->setData($this->data)
                            ->renderString($this->data['template']);
    }

    public function indirect(){
        array_push($this->data['css_entries'],
			array('css_link' => base_url().'/assets/plugins/bootstrap-toastr/toastr.min.css'),
			array('css_link' => base_url().'/assets/plugins/select2/select2.css'),
			array('css_link' => base_url().'/assets/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css')
		);
		array_push($this->data['js_entries'],
			array('js_link' => base_url().'/assets/plugins/bootstrap-toastr/toastr.min.js'),
			array('js_link' => base_url().'/assets/plugins/select2/select2.min.js'),
			array('js_link' => base_url().'/assets/plugins/datatables/media/js/jquery.dataTables.min.js'),
			array('js_link' => base_url().'/assets/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js'),
			array('js_link' => base_url().'/assets/scripts/referral.js')
        );
        
        $this->data['js_init']      = "referralTable.init('indirect')
        localStorage.setItem('access_token','".$this->session->get('access_token')."');";
		$this->data['title']        = 'Indirect Referrals';
		$this->data['page']         = 'Modules\Member\Views\referral_view';
        $this->data['css_custom']   = "";
        $this->data['js_custom']    = "";
        $this->data['message']      = "";
        $this->data['referral_type']      = "Indirect Referrals";
        
        $side['side_bar'] = $this->load_sidebar(array('item_index' => 7, 'sub_index' => 2, 'page_title' => 'Dashboard', 'show_page_title' => 1, 'show_breadcrumbs' => 1, 'user_type' => $this->joshua_auth->get_session_data('user_type')));

        $this->data['side_bar_template'] = view('Modules\Template\Views\template\page-sidebar',$side['side_bar'] );
        $this->data['template'] = view('Modules\Template\Views\default-page',$this->data);
        echo $this->parser->setData($this->data)
                            ->renderString($this->data['template']);
    }
}