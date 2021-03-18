<?php
namespace Modules\Member\Controllers;
use \CodeIgniter\Controller;
use CodeIgniter\API\ResponseTrait;

use \App\Libraries\Oauth;
use \OAuth2\Request;

use \Modules\Common\Models\Lib_countries;
use \Modules\Common\Models\Members;
class Entry_member extends \Modules\Common\Controllers\MemberBaseController
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
        array('css_link' => base_url().'/assets/plugins/bootstrap-toastr/toastr.min.css')
    );
    array_push($this->data['js_entries'],
        array('js_link' => base_url().'/assets/plugins/bootstrap-toastr/toastr.min.js'),
        array('js_link' => base_url().'/assets/scripts/member_entry.js')
    );
    // list of country from database
    $Lib_countries = new Lib_countries;
    $this->data['country_list']   = $Lib_countries->findAll();
    // set selected
    @$valueSeleted = set_value('country'); //get the selected value
    @$this->data['country_list'][$valueSeleted-1]['selected'] = 'selected'; // set selected item
    // var_dump( );
    $this->data['js_init']      = "member_entry.init()";
    $this->data['title']        = 'Members';
    $this->data['page']         = 'Modules\Member\Views\add_entry';
    $this->data['css_custom']   = "";
    $this->data['js_custom']    = "";
    $this->data['message']      = "";
    $this->data['has_error']      = "";
    
    $side['side_bar'] = $this->load_sidebar(array('item_index' => 5, 'sub_index' => 1, 'page_title' => 'Dashboard', 'show_page_title' => 1, 'show_breadcrumbs' => 1, 'user_type' => $this->joshua_auth->get_session_data('user_type')));
    if($this->save()){
        return redirect()->to(base_url( '/member/'.$this->joshua_auth->get_session_data('fullname').'/Members_add'));
    }
    
    if ($this->joshua_auth->get_session_data('success')){
        $this->joshua_auth->set_session_data('success',false);
        $this->data['success'] = true;
        $this->data['message'] = 'Entry details submitted successfully';
    }
    
    $this->data['side_bar_template'] = view('Modules\Template\Views\template\page-sidebar',$side['side_bar'] );
    $this->data1['template'] = view('Modules\Template\Views\default-page',$this->data);
    echo $this->parser->setData($this->data)
                        ->renderString($this->data1['template']);
}

function save(){
    if( $this->request->getMethod() == 'post' ){
        $rules = [
            'firtname'      => [
                'label'  => 'First Name',
                'rules'  => 'required',
                'errors' => [
                    'required' => 'The {field} field is required.'
                ]
            ],
            'middlename'    => [
                'label'  => 'Middle Name',
                'rules'  => 'required',
                'errors' => [
                    'required' => 'The {field} field is required.'
                ]
            ],
            'lastname'      => [
                'label'  => 'Last Name',
                'rules'  => 'required',
                'errors' => [
                    'required' => 'The {field} field is required.'
                ]
            ],
            'age'           => 'required',
            'gender'        => 'required',
            'email'         => 'required',
            'birthdate'     => [
                'label'  => 'Date of Birth',
                'rules'  => 'required',
                'errors' => [
                    'required' => 'The {field} field is required.'
                ]
            ],
            'mobile_no'     => [
                'label'  => 'Mobile No.',
                'rules'  => 'required',
                'errors' => [
                    'required' => 'The {field} field is required.'
                ]
            ],
            'tin'           => 'required',
            'address'       => 'required',
            'city'          => 'required',
            'province'      => 'required',
            'postal_code'   => [
                'label'  => 'Postal Code',
                'rules'  => 'required',
                'errors' => [
                    'required' => 'The {field} field is required.'
                ]
            ],
            'country'       => 'required',
            'civil_status'  => [
                'label'  => 'Civil Status',
                'rules'  => 'required',
                'errors' => [
                    'required' => 'The {field} field is required.'
                ]
            ],
            // 'mop_cash'      => 'required',
            // 'mop_bank_deposit' => 'required',
            // 'mop_bank_details' => 'required',
        ];

    
        if( $this->validate($rules) ){
            $Members = new Members;
            $input = $this->request->getPost();
            $data = [
                'sponsor_id'    => $this->joshua_auth->get_session_data('member_id'),
                'firstname'     => $input['firtname'],
                'middlename'    => $input['middlename'],
                'lastname'      => $input['lastname'],
                'age'           => $input['age'],
                'gender'        => $input['gender'],
                'email'         => $input['email'],
                'birthdate'     => $input['birthdate'],
                'mobile_no'     => $input['mobile_no'],
                'tin'           => $input['tin'],
                'address'       => $input['address'],
                'city'          => $input['city'],
                'province'      => $input['province'],
                'postal_code'   => $input['postal_code'],
                'country'       => $input['country'],
                'civil_status'  => $input['civil_status'],
            ];
            $post_id = $Members->insert($data);
            // $data['post_id'] = $post_id;
            // return $this->respondCreated($data);
            $this->joshua_auth->set_session_data('success',true);
            return true;
        //   return $this->respond($response);
        }
        else{
            $this->data['validation'] = $this->validator->listErrors();
        }
    }
}

public function members_list(){
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
        array('js_link' => base_url().'/assets/scripts/members_list.js')
    );
    
    $this->data['js_init']      = "members_listTable.init()";
    $this->data['title']        = 'Package Library';
    $this->data['page']         = 'Modules\Member\Views\member_list';
    $this->data['css_custom']   = "";
    $this->data['js_custom']    = "";
    $this->data['message']      = "";
    
    $side['side_bar'] = $this->load_sidebar(array('item_index' => 5, 'sub_index' => 2, 'page_title' => 'Dashboard', 'show_page_title' => 1, 'show_breadcrumbs' => 1, 'user_type' => $this->joshua_auth->get_session_data('user_type')));

    $this->data['side_bar_template'] = view('Modules\Template\Views\template\page-sidebar',$side['side_bar'] );
    $this->data['template'] = view('Modules\Template\Views\default-page',$this->data);
    echo $this->parser->setData($this->data)
                        ->renderString($this->data['template']);
}
}