<?php 
namespace Modules\Common\Libraries;

use Modules\Common\Models\Tbl_security;
use Modules\Common\Models\Tbl_users as usersModel;
use Modules\Common\Libraries\PasswordHash;
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
        $this->usersModel    = new usersModel;
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
    
    function member_login( $idno, $password, $remember = "" ){
        $idno = str_replace("'", "", $idno);
       
        if( !is_null( $member = $this->ci->authModel->get_user_acc_details( htmlentities( $idno ) ) ) ){
            // $hasher = new PasswordHash(8, FALSE);
            // prevent the admin to Login in from the members login
            // TODO: 
            /*if( $this->url_segments[0] == "member" && $member->user_type == 1 ){
                $this->error = array('err_msg' => 'You are not allowed to login here.');
                $this->has_error = TRUE;
                return null;
            }*/
            // check the status if it is active or not
            if( $member->ACTIVESTATUS == 'A' ){
                
                // check the password if it is equal to the database
                // if( $hasher->CheckPassword( $password, $member->password ) ){
                if( $password == $member->PASSWORD ){
                    $this->ci->session->set_userdata(array(
                        'EMPNO'         =>  $member->EMPNO,
                        'FIRSTNAME'     =>  $member->FIRSTNAME,
                        'LASTNAME'      =>  $member->LASTNAME,
                        'MIDDLENAME'    =>  $member->MIDDLENAME,
                        'NAMEEXT'       =>  $member->NAMEEXT,
                        'JOBCODE'       =>  $member->JOBCODE,
                        'POSITION'      =>  $member->POSITION,
                        'EMAIL'         =>  empty($member->TRANSCO_EMAILADD)?'':$member->TRANSCO_EMAILADD,
                        'CHARGING_CCDESC'   =>  $member->CHARGING_CCDESC,
                        'CHARGING_MC'   =>  $member->CHARGING_MC,
                        'app_name'      =>  "user",
                        'logged_in'     =>  true,
                        'user_type'     =>  1
                    ));
                    
                    if(empty($member->TRANSCO_EMAILADD)) {
                        $this->ci->session->set_userdata(array('register' => true));
                    }

                    return $member;
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
        }
        else{
            $this->error = array('err_msg' => 'Incorrect ID no. and/or password. ');
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

    function register($email, $reemail){
        $email = str_replace("'", "", $email);
        $repassword = str_replace("'", "", $reemail);
        if( $email != $reemail ){
            $this->error = array('err_msg' => 'ERROR: Your Email and Confirmation Email do not match.');
            $this->has_error = TRUE;
            return null;
        }

        $data['EMPNO']              = $this->get_session_data('EMPNO');
        $data['TRANSCO_EMAILADD']   = $email;
        
        if ( $this->ci->authModel->_update_email($data)) :
            $this->ci->session->set_userdata(array('register' => 0));
            return $this->get_session_data('LASTNAME');
        else:
            $this->error = array('err_msg' => 'ERROR: When Updating Email add.');
            $this->has_error = TRUE;
            return null;
        endif;
        
    }

    function register_pass($password, $repassword){
        $password = str_replace("'", "", $password);
        $repassword = str_replace("'", "", $repassword);
        $hasher = new PasswordHash(8, FALSE);
        if( $password != $repassword ){
            $this->error = array('err_msg' => 'ERROR: Your password and confirmation password do not match.');
            $this->has_error = TRUE;
            return null;
        }

        $password = $hasher->HashPassword($password);
        if ( $this->ci->authModel->update_admin_password($this->get_session_data('EMPNO'), $password)) :
            $this->ci->session->set_userdata(array('register' => 0));
            return $this->get_session_data('LASTNAME');
        endif;
        
    }
}