<?php
namespace Modules\Member\Controllers;
use \CodeIgniter\Controller;
use CodeIgniter\API\ResponseTrait;
use Modules\Common\Models\Vw_income_summary_not_collected as VISNCModel;

use \Modules\Common\Libraries\Oauth;
use \OAuth2\Request;

class Genealogy extends \Modules\Common\Controllers\MemberBaseController
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
			array('css_link' => base_url().'/assets/css/genealogy.css'),
			array('css_link' => base_url().'/assets/plugins/bootstrap-toastr/toastr.min.css')
		);
		array_push($this->data['js_entries'],
			array('js_link' => base_url().'/assets/plugins/bootstrap-toastr/toastr.min.js'),
			array('js_link' => base_url().'/assets/scripts/genealogy.js')
        );
        
        $this->data['js_init']      = "genealogy.init()
                                        localStorage.setItem('access_token','".$this->session->get('access_token')."');
                                        "; 
		$this->data['title']        = 'Genealogy';
		$this->data['page']         = 'Modules\Member\Views\genealogy_views';
        $this->data['css_custom']   = "";
        $this->data['js_custom']    = "";
        $this->data['node_id']      = $this->session->get('node_id');
        

        $side['side_bar'] = $this->load_sidebar(array('item_index' => 8, 'sub_index' => 0, 'page_title' => 'Dashboard', 'show_page_title' => 1, 'show_breadcrumbs' => 1, 'user_type' => $this->joshua_auth->get_session_data('user_type')));
        
        $this->data['side_bar_template'] = view('Modules\Template\Views\template\page-sidebar',$side['side_bar'] );
        $this->data['template'] = view('Modules\Template\Views\default-page',$this->data);
        echo $this->parser->setData($this->data)
                            ->renderString($this->data['template']);
    }
}