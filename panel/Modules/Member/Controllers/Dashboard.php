<?php
namespace Modules\Member\Controllers;
use \CodeIgniter\Controller;
use CodeIgniter\API\ResponseTrait;
use Modules\Common\Models\Vw_income_summary_not_collected as VISNCModel;
use Modules\Common\Models\Vw_active_account;
use Modules\Common\Models\Vw_ewallet_total;

use \Modules\Common\Libraries\Oauth;
use \OAuth2\Request;

class Dashboard extends \Modules\Common\Controllers\MemberBaseController
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
			array('css_link' => base_url().'/assets/plugins/bootstrap-toastr/toastr.min.css')
		);
		array_push($this->data['js_entries'],
			array('js_link' => base_url().'/assets/plugins/bootstrap-toastr/toastr.min.js'),
			array('js_link' => base_url().'/assets/scripts/Dash.js')
        );
        
        $this->data['js_init']      = "localStorage.setItem('access_token','".$this->session->get('access_token')."');
                                    dash.init()
                                        "; 
		$this->data['title']        = 'Dashboard';
		$this->data['page']         = 'Modules\Member\Views\dashboard_views';
        $this->data['css_custom']   = "";
        $this->data['js_custom']    = "";
        $this->data['message']      = "";
        
        $income_not_collected = $this->income_summary_not_collected($this->session->get('member_id'));
        $this->data['DIREC_REF']     = $this->income_format($income_not_collected['reftotal']);
        $this->data['INDI_REF']      = $this->income_format($income_not_collected['indreftotal']);
        $this->data['UNILEVEL']      = $this->income_format($income_not_collected['unileveltotal']);
        $this->data['RPT']           = date('H:i:s a', time());
        $this->data['account_status']  = $this->check_status();
        $this->data['account_status_css_tags'] = $this->data['account_status'] == 'Active'?'success':'danger';
        
        /**
         * income summary
         */

        $this->data['UNI_COL']      = $this->income_format($income_not_collected['unilevel_collectable']);
        $this->data['UNI_PENDING']  = $this->income_format($income_not_collected['unilevel_pending']);
        $this->data['UNI_POINTS']   = $this->income_format($income_not_collected['unilevel_points']);
        $this->data['UNI_POINTS_P'] = $this->income_format($income_not_collected['unilevel_points_pending']);
        $this->data['COL_TOTAL']    = $this->income_format($this->collectable_total($income_not_collected));
        $this->data['PENDING_TOTAL']    = $this->income_format($this->pending_total($income_not_collected));
        
        $ewallet = $this->ewallet();
 
        $this->data['E_DIREC_REF']      = $this->income_format($ewallet['Direct_Referral']);
        $this->data['E_INDI_REF']       = $this->income_format($ewallet['Indirect_Referral']);
        $this->data['E_UNI_COL']        = $this->income_format($ewallet['Unilevel']);
        $this->data['E_UNI_POINTS']     = $this->income_format($ewallet['points']);
        $this->data['E_TOTAL']          = $this->income_format($this->ewallet_total($ewallet));

        $side['side_bar'] = $this->load_sidebar(array('item_index' => 1, 'sub_index' => 0, 'page_title' => 'Dashboard', 'show_page_title' => 1, 'show_breadcrumbs' => 1, 'user_type' => $this->joshua_auth->get_session_data('user_type')));
        
        $this->data['side_bar_template'] = view('Modules\Template\Views\template\page-sidebar',$side['side_bar'] );
        $this->data['template'] = view('Modules\Template\Views\default-page',$this->data);
        echo $this->parser->setData($this->data)
                            ->renderString($this->data['template']);
    }

    public function income_summary_not_collected($id){
        $VISNCModel = new VISNCModel;
        return $VISNCModel->find($id);
    }

    function income_format($data){
        return $data != ''?number_format($data, 2, '.', ','):number_format(0, 2, '.', '');
    }

    /**
     * check if the account is active or Inactive
     */
    function check_status(){
        $db      = \Config\Database::connect();
        $db->query('call process_due_unilevel()');
        
        $Vw_active_account = new Vw_active_account;       
        return empty($Vw_active_account->find($this->session->get('node_id')))?'Inactive':'Active';
    }

    function collectable_total($data){
        return  $data['reftotal'] + $data['indreftotal'] +
        $data['unilevel_collectable'] + $data['unilevel_points'];
    }

    function ewallet_total($data){
        return  $data['Direct_Referral'] + $data['Indirect_Referral'] +
        $data['Unilevel'] + $data['points'];
    }

    function pending_total($data){
        return  $data['unilevel_pending'] + $data['unilevel_points_pending'];
    }

    function ewallet(){
        $Vw_ewallet_total = new Vw_ewallet_total;
        return $Vw_ewallet_total->find($this->session->get('node_id'));
    }
}