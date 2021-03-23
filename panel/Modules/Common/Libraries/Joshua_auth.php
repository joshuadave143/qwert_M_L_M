<?php 
namespace Modules\Common\Libraries;

use Modules\Common\Models\Vw_members;
use Modules\Common\Models\Tbl_security as securityModel;
use Modules\Common\Models\Tbl_users as usersModel;
use Modules\Common\Models\Tbl_nodes;
use Modules\Common\Models\Tbl_login_history;
use Modules\Common\Libraries\PasswordHash;

use \Modules\Common\Libraries\Oauth;
use \OAuth2\Request;
/**
* 
* 
* @package 	Joshua_auth
* @author	Joshua Dave Tonido
* @version	2.0.0
*/

class Joshua_auth {

    public $error;
    public $has_error;
    public $url_segments;
    public $session;

	function __construct() {        
        
        $this->session      = \Config\Services::session();
        $this->Vw_members    = new Vw_members;
        $this->Tbl_login_history    = new Tbl_login_history;
        $this->usersModel    = new usersModel;
        $this->Tbl_nodes    = new Tbl_nodes;
        $this->securityModel    = new securityModel;
        $this->url_segments = explode('.', $_SERVER['HTTP_HOST']);
    }

	function get_error_message()
	{
		return $this->error;
	}

    function is_logged_in()
	{
		return $this->get_session_data('logged_in');
    }

    function is_register()
	{
		return $this->get_session_data('register');
    }
    
    function admin_login( $username, $password, $remember = ""){
        $idno = str_replace("'", "", $username);
        
      
        // $member = $members->find($id);
        if( !is_null( $user = $this->usersModel->where('username', htmlentities( $username ))->first() ) ){
            $hasher = new PasswordHash(8, FALSE);
            // echo $password = $hasher->HashPassword($password);
            // return;
             // check the status if it is active or not
            if( $user['user_type'] == '0' ){
              
                if( $hasher->CheckPassword( $password, $user['password'] ) ){
                    $user['logged_in'] = true;
                    $user['isadmin'] = true;
                    $this->session->set($user); 
                   
                    return $user;
                }
                else{
                    $this->error = array('err_msg' => 'Incorrect password.');
                    $this->has_error = TRUE;
                }
            }
            else{
                $this->error = array('err_msg' => 'You are not allowed to login. <br>Because Your Account Status is Inactive');
			    $this->has_error = TRUE;
            }
            
            // if( $hasher->CheckPassword( $password, $admin->password ) ){
            
        }
        else{
            $this->error = array('err_msg' => 'Incorrect username and/or password. ');
			$this->has_error = TRUE;
        }

        return null;
        
    }
    
    function member_login( $username, $password, $remember = ""){
        $idno = str_replace("'", "", $username);
        
        $user = $this->Vw_members->where('username', htmlentities( $username ))->first();
        // var_dump($user);
        // return;
        if( !is_null( $user ) ){
            $hasher = new PasswordHash(8, FALSE);
            // echo $password = $hasher->HashPassword($password);
            // return;
            
            if( $hasher->CheckPassword( $password, $user['login_pass'] ) ){
                $user['logged_in'] = true;
                $user['isadmin'] = false;
                $user['user_type']  = 1;
                $this->session->set($user); 
                $data = [
                    'member_id' => $user['member_id']
                ];
                $this->Tbl_login_history->insert($data);
                return $user;
            }
            else{
                $this->error = array('err_msg' => 'Incorrect password.');
                $this->has_error = TRUE;
            }
        }
        else{
            $this->error = array('err_msg' => 'Incorrect username and/or password. ');
			$this->has_error = TRUE;
        }

        return null;
        
    }

	function get_session_id()
	{
		return session_id();
	}

    function get_session_data($key)
	{
		$sess_val = $this->session->get($key);

		if ($key == 'last_login') {
			$last_login = date_create($sess_val);
			$sess_val = date_format($last_login, 'Y-m-d H:i:s');
		}

		return $sess_val;
    }

    function set_session_data($name,$val){
        $this->session->set($name,$val);
    }
    
    function logout()
	{
		$this->session->set(array());
        $this->session->destroy();
    }

    function get_users_fullname($empno){
        return $this->ci->authModel->_get_emp_detials($empno);
    }

    function register($username, $password, $member_id, $activation_code_id, $node_id){
        $username           = str_replace("'", "", $username);
        $password           = str_replace("'", "", $password);
        $member_id          = str_replace("'", "", $member_id);
        $activation_code_id = str_replace("'", "", $activation_code_id);
        $hasher             = new PasswordHash(8, FALSE);

        $password           = $hasher->HashPassword($password);
        $data = [
            'member_id'             => $member_id,
            'username'              => $username,
            'login_pass'            => $password
        ];
        $post_id = $this->securityModel->insert($data);

        $data = [
            'node_id'               => $node_id,
            'activation_code_id'    => $activation_code_id,
            'status'                => 1
        ];
     
        $this->Tbl_nodes->save($data);
        return  ($this->securityModel->affectedRows() != 1) ? false : true;
       
    }

    public function api_login(){
		$_POST['username'] = "qwerty123";
        $_POST['password'] = 'Qw3rty!@#';
        $_POST['grant_type'] = 'password';
        $_SERVER['PHP_AUTH_USER'] = 'mlm_api';
        $_SERVER['PHP_AUTH_PW'] = 'wIw_@p!';
        $_SERVER['REQUEST_METHOD'] = 'POST';
        $oauth = new Oauth();
        $request = new Request();
        $respond = $oauth->server->handleTokenRequest($request->createFromGlobals());
        $code = $respond->getStatusCode();
		$body = $respond->getResponseBody();

		$time = strtotime(date('H:i')) + 60*59;
		$time = date('H:i', $time);
		$this->set_session_data('api_time_expired',$time);
        // print_r(json_decode($body));
		$this->set_session_data('access_token', json_decode($body)->access_token);
	}
}