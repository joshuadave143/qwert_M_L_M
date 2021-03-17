<?php
namespace Modules\Auth\Controllers;
use \CodeIgniter\Controller;
use CodeIgniter\API\ResponseTrait;
// use Modules\Admin\Models\Members as MembersModel;
use Modules\Common\Libraries\Joshua_auth;

use \Modules\Common\Libraries\Oauth;
use \OAuth2\Request;
class Auth extends Controller {

	public $joshua_auth;
	public $data = [];
	public $data1 = [];
	function __construct()
	{	
		$this->joshua_auth = new Joshua_auth();
		// $this->load->library('Joshua_auth');
        $this->parser = \Config\Services::parser();
	
		// $this->load->helper('security');
		
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

	function register(){
		if( $this->joshua_auth->is_logged_in() && $this->joshua_auth->is_register() ){
			$this->load->library('form_validation');
			$Title = "TransCo Transmittal - Register";

			$this->data['has_error'] = false;
			
			$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
			$this->form_validation->set_rules('re_password', 'Confirmation-Password', 'trim|required|xss_clean');

			
			
			if( $this->form_validation->run() == false){
				$this->data['page_title'] = $Title;
				if ( validation_errors() != "" ) :
					$this->data['has_error'] = true;
					$this->data['error_msg'] = validation_errors();
				endif;
			}
			else{
				if( !is_null( $usr = $this->joshua_auth->register_pass(
					$this->form_validation->set_value('password'),
					$this->form_validation->set_value('re_password')
				) ) ){
					$Title = 'Dashboard';
					$this->data['page_title'] = $Title;
					redirect($usr.'/Request_Logs');
				}
				else{
					$this->data['page_title'] = 'Register Failed';
					$this->data['error_msg'] = sizeof($this->joshua_auth->get_error_message()) > 0 ? $this->joshua_auth->get_error_message() : NULL;
					$this->data['has_error'] = $this->joshua_auth->has_error;
					// redirect($usr->iduser_acc.'/home/'.$this->joshua_auth->has_error);
				}
				
			}
			
		}else{
			redirect('login');
		}
		$this->data['action'] = 'register';
		$this->parser->parse('template/access-page', $this->data);
		
	}
	
}