<?php
namespace Modules\Auth\Controllers;
use \CodeIgniter\Controller;
use CodeIgniter\API\ResponseTrait;
// use Modules\Admin\Models\Members as MembersModel;
use Modules\Common\Libraries\Joshua_auth;

use Modules\Common\Models\Members;
use Modules\Common\Models\Tbl_nodes;
use Modules\Common\Models\Tbl_security;
use Modules\Common\Models\Vw_activation_codes;
use \Modules\Common\Libraries\Oauth;
use \OAuth2\Request;
class Auth extends Controller {

	public $joshua_auth;
	public $data = [];
	public $data1 = [];
	public $Tbl_security;
	public $wv_activation_codes;

	function __construct()
	{	
		$this->Tbl_nodes 			=  new Tbl_nodes;
		$this->Members 				=  new Members;
		$this->Tbl_security 		=  new Tbl_security;
		$this->wv_activation_codes 	=  new Vw_activation_codes;
		$this->joshua_auth 			=  new Joshua_auth();
        $this->parser 				=  \Config\Services::parser();	
	}
	
	public function index(){
		helper(['form', 'url']);
		$Title = "Login";
		$this->data['page_title'] = $Title;
		$this->data1['has_error'] = false;
		if( $this->joshua_auth->is_logged_in() ){
			$lastname = $this->joshua_auth->get_session_data('LASTNAME');
			if( $this->joshua_auth->get_session_data('user_type') == 0 )
				return redirect()->to(base_url( '/admin/'.$this->joshua_auth->get_session_data('fullname').'/dashboard'));
			// else
				// redirect($lastname.'/Request_Logs');
		}
		else{
			
			if( $this->request->getMethod() == 'post' ){
				$rules = [
					'username' => 'required',
					'password' => 'required'
				];

				if( $this->validate($rules) ){
					$data = $this->request->getPost();
					
					if( !is_null( $usr = $this->joshua_auth->admin_login(
						$data['username'],
						$data['password']
					) ) ){
						
						if( $this->joshua_auth->get_session_data('user_type') == 0):
							$this->joshua_auth->set_session_data('access_token',$this->api_login());
							return redirect()->to(base_url( '/admin/'.$usr['fullname'].'/dashboard'));
						else:
							return redirect()->to(base_url( '/'.$usr['fullname'].'/dashboard'));
						endif;
					}
					else{
						$this->data['page_title'] = 'Login Failed';
						$this->data1['error_msg'] = sizeof($this->joshua_auth->get_error_message()) > 0 ? $this->joshua_auth->get_error_message() : NULL;
						$this->data1['has_error'] = $this->joshua_auth->has_error;
						// redirect($usr->iduser_acc.'/home/'.$this->joshua_auth->has_error);
					}
				}
				else{
				
					$this->data1['validation'] = $this->validator;
				}
			}
		}
		$template = view('Modules\Template\Views\access-page',$this->data1);
		return $this->parser->setData($this->data)->renderString($template);
	}
	
	public function api_login(){
		$_POST['username'] = "qwerty123";
        $_POST['password'] = 'Qw3rty!@#';
        $_POST['grant_type'] = 'password';
        $_SERVER['PHP_AUTH_USER'] = 'mlm_api';
        $_SERVER['PHP_AUTH_PW'] = 'wIw_@p!';
        $oauth = new Oauth();
        $request = new Request();
        $respond = $oauth->server->handleTokenRequest($request->createFromGlobals());
        $code = $respond->getStatusCode();
		$body = $respond->getResponseBody();
		return json_decode($body)->access_token;
	}
	
	public function logout(){
		$this->joshua_auth->logout();
		return redirect()->to(base_url('Auth'));
	}
	// access-page_member
	
	// registration-page_member
	public function register(){
		helper(['form', 'url']);
		$Title = "Register";
		$this->data['page_title'] = $Title;
		$this->data1['has_error'] = false;
		if( $this->joshua_auth->is_logged_in() ){
			
			return redirect()->to(base_url( '/'.$this->joshua_auth->get_session_data('fullname').'/dashboard'));
		}
		else{
			
			if( $this->request->getMethod() == 'post' ){
				$rules = [
					'activation_code' 	=> 'required',
					'member_id' 		=> [
						'label'  => 'Member ID',
						'rules'  => 'required|numeric',
						'errors' => [
							'required' => 'There is no {field} provided.'
						]
					],
					'username' 			=> 'required',
					'password' 			=> 'required',
        			'confirm_password' 	=> 'required|matches[password]',
				];

				if( $this->validate($rules) ){
					$data = $this->request->getPost();
					
					// var_dump($username_check);
					if( $this->is_not_activation_exist($data) ){
						// $this->data['page_title'] = 'Login Failed';Incorrect username and/or password.
						$this->data1['error_msg'] = array("err_msg"=>"Incorrect activation code.");
						$this->data1['has_error'] = true;
					}
					elseif( $this->is_activation_taken($data) ){
						// $this->data['page_title'] = 'Login Failed';Incorrect username and/or password.
						$this->data1['error_msg'] = array("err_msg"=>"Activation code already used.");
						$this->data1['has_error'] = true;
					}
					elseif( $this->is_username_taken($data) ){
						$this->data1['error_msg'] = array("err_msg"=>"Username is already exists.");
						$this->data1['has_error'] = true;
					}
					elseif( $this->is_member_id_already_registered($data) ){
						$this->data1['error_msg'] = array("err_msg"=>"Member ID already registered.");
						$this->data1['has_error'] = true;
					}
					elseif( $this->is_member_id_not_exists($data) ){
						$this->data1['error_msg'] = array("err_msg"=>"Member ID is not exists.");
						$this->data1['has_error'] = true;
					}else{
						if(  $this->joshua_auth->register(
								$data['username'],
								$data['password'],
								$data['member_id'],
								$this->get_activation_code_id($data),
								$this->get_node_id($data)
							) ){
								$this->joshua_auth->set_session_data('register_success',true);
								return redirect()->to(base_url( '/success'));
						}
					}

					
					// if( !is_null( $usr = $this->joshua_auth->admin_login(
					// 	$data['username'],
					// 	$data['password']
					// ) ) ){
						
					// 	if( $this->joshua_auth->get_session_data('user_type') == 0):
					// 		$this->joshua_auth->set_session_data('access_token',$this->api_login());
					// 		return redirect()->to(base_url( '/admin/'.$usr['fullname'].'/dashboard'));
					// 	else:
					// 		return redirect()->to(base_url( '/'.$usr['fullname'].'/dashboard'));
					// 	endif;
					// }
					// else{
					// 	$this->data['page_title'] = 'Login Failed';
					// 	$this->data1['error_msg'] = sizeof($this->joshua_auth->get_error_message()) > 0 ? $this->joshua_auth->get_error_message() : NULL;
					// 	$this->data1['has_error'] = $this->joshua_auth->has_error;
					// 	// redirect($usr->iduser_acc.'/home/'.$this->joshua_auth->has_error);
					// }
				}
				else{
				
					$this->data1['validation'] = $this->validator;
				}
			}
		}
		$template = view('Modules\Template\Views\registration-page_member',$this->data1);
		return $this->parser->setData($this->data)->renderString($template);
	}

	public function success(){
		if(!$this->joshua_auth->get_session_data('register_success')) return redirect()->to('/');
		$this->joshua_auth->set_session_data('register_success',false);
		$this->data['page_title'] = 'success';
		$template = view('Modules\Template\Views\success-page',$this->data1);
		return $this->parser->setData($this->data)->renderString($template);
		
	}
	
	public function member_index(){
		helper(['form', 'url']);
		$Title = "Login";
		$this->data['page_title'] = $Title;
		$this->data1['has_error'] = false;
		if( $this->joshua_auth->is_logged_in() ){
			
			return redirect()->to(base_url( '/member/'.$this->joshua_auth->get_session_data('fullname').'/dashboard'));
			
		}
		else{
			
			if( $this->request->getMethod() == 'post' ){
				$rules = [
					'username' => 'required',
					'password' => 'required'
				];

				if( $this->validate($rules) ){
					$data = $this->request->getPost();
					
					if( !is_null( $usr = $this->joshua_auth->member_login(
						$data['username'],
						$data['password']
					) ) ){
						
						
						$this->joshua_auth->set_session_data('access_token',$this->api_login());
						return redirect()->to(base_url( '/member/'.$usr['fullname'].'/dashboard'));
					

					}
					else{
						$this->data['page_title'] = 'Login Failed';
						$this->data1['error_msg'] = sizeof($this->joshua_auth->get_error_message()) > 0 ? $this->joshua_auth->get_error_message() : NULL;
						$this->data1['has_error'] = $this->joshua_auth->has_error;
						// redirect($usr->iduser_acc.'/home/'.$this->joshua_auth->has_error);
					}
				}
				else{
				
					$this->data1['validation'] = $this->validator;
				}
			}
		}
		$template = view('Modules\Template\Views\access-page_member',$this->data1);
		return $this->parser->setData($this->data)->renderString($template);
	}

	private function get_activation_code_id($data){
		$result =$this->wv_activation_codes->where('activation_code',$data['activation_code'])
												->find();
		return $result[0]['activation_code_id'];
	}

	private function get_node_id($data){
		return $this->Tbl_nodes->where('member_id',$data['member_id'])->find()[0]['node_id'];
	}

	private function is_not_activation_exist($data){
		return empty($this->wv_activation_codes->where('activation_code',$data['activation_code'])
												->find());
	}

	private function is_activation_taken($data){
		return !empty($this->wv_activation_codes->where('activation_code',$data['activation_code'])
												->where('node_id is not null')
												->find());
	}

	private function is_username_taken($data){
		return !empty($this->Tbl_security->where('username',$data['username'])->find());
	}

	private function is_member_id_already_registered($data){
		return !empty($this->Tbl_security->where('member_id',$data['member_id'])->find());
	}

	private function is_member_id_not_exists($data){
		return empty($this->Members->where('member_id',$data['member_id'])->find());
	}
	
}