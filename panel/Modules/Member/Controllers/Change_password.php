<?php
namespace Modules\Member\Controllers;
use \CodeIgniter\Controller;
use CodeIgniter\API\ResponseTrait;

use \App\Libraries\Oauth;
use \OAuth2\Request;

use \Modules\Common\Models\Lib_countries;
use \Modules\Common\Models\Members;
class Change_password extends \Modules\Common\Controllers\MemberBaseController
{
    use ResponseTrait;
    public $parser;
    public $success;
    public function __construct(){
        $this->parser = \Config\Services::parser();

        $this->data['css_entries'] = array();
        $this->data['js_entries'] = array();
        $this->data['js_plug'] = array();
        
        $this->data['css_custom'] = "";
        $this->data['js_init'] = "";
        
        $this->data['js_custom'] = "";
        $this->data['success']  = false;
    }

    public function index(){
        helper(['form', 'url']);
        array_push($this->data['css_entries'],
            array('css_link' => base_url().'/assets/plugins/bootstrap-toastr/toastr.min.css'),
            array('css_link' => base_url().'/assets/plugins/select2/select2.css'),
            array('css_link' => base_url().'/assets/plugins/bootstrap-editable/bootstrap-editable/css/bootstrap-editable.css')
        );
        array_push($this->data['js_entries'],
            array('js_link' => base_url().'/assets/plugins/bootstrap-toastr/toastr.min.js'),
            array('js_link' => base_url().'/assets/plugins/select2/select2.min.js'),
            array('js_link' => base_url().'/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js'),
            array('js_link' => base_url().'/assets/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js'),
            array('js_link' => base_url().'/assets/plugins/moment.min.js'),
            array('js_link' => base_url().'/assets/plugins/jquery.mockjax.js'),
            array('js_link' => base_url().'/assets/plugins/bootstrap-editable/bootstrap-editable/js/bootstrap-editable.min.js'),
            array('js_link' => base_url().'/assets/plugins/bootstrap-editable/inputs-ext/address/change_pass.js'),
            array('js_link' => base_url().'/assets/scripts/change_password.js')
        );
        // list of country from database
        
        $Members = new Members;
        $membere_details = $Members->find($this->joshua_auth->get_session_data('member_id'));
        $this->data['member_details'] = $membere_details;
        
        $this->data['Username']      = $this->joshua_auth->get_session_data('username');
      
        $this->data['js_init']      = "FormEditable.init()";
        $this->data['title']        = 'Change password';
        $this->data['page']         = 'Modules\Member\Views\Change_password';
        $this->data['css_custom']   = "";
        $this->data['js_custom']    = "";
        $this->data['message']      = "";
        $this->data['has_error']      = "";
        
        $side['side_bar'] = $this->load_sidebar(array('item_index' => 13, 'sub_index' => 0, 'page_title' => 'Dashboard', 'show_page_title' => 1, 'show_breadcrumbs' => 1, 'user_type' => $this->joshua_auth->get_session_data('user_type')));


        
        $this->data['side_bar_template'] = view('Modules\Template\Views\template\page-sidebar',$side['side_bar'] );
        $this->data1['template'] = view('Modules\Template\Views\default-page',$this->data);
        echo $this->parser->setData($this->data)
                            ->renderString($this->data1['template']);
    }

}