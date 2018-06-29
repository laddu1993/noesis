<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 *
 * @package    Login
 * @author     Vinil Lakkavatri (vinil.lakkavatri@icloud.com)
 * @copyright  2018 Vinil Lakkavatri
 * @ci_version 3.1.9 echo CI_VERSION;
 * @deprecated File deprecated in Release 2.0.0
 *
 **/
class Login extends CI_Controller {

	
	function __construct(){
		parent::__construct();
        error_reporting(0);
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->model('Common_model', 'common');
        //echo "<pre>";print_r($_SESSION);die;
	}

	public function index()
	{
		if (isset($_POST) && !empty($_POST)) {
			$email = $this->input->post('email');
			$pass = $this->input->post('pass');
			if (!empty($email) && !empty($pass)) {
				$whr = '(user = "'.$email.'" AND password = "'.$pass.'")';
				$check_with_db = current($this->common->fetch_all_table_data_multiple_condition('users',$whr));
				if (!empty($check_with_db)) {
					session_start();
					$this->session->set_userdata(array(
					    'user_id'  => $check_with_db['id'],
					    'email' => $check_with_db['user'],
					    'u_role_id' => $check_with_db['u_role_id'],
					));
					redirect('Dashboard/index');
				}else{
					$this->session->set_flashdata('message','Logged In Failed!');
					redirect('Login/index');
				}
			}
			//echo "<pre>";print_r($_POST);die;
		}
		if (!empty($this->session->userdata('email'))) {
			redirect('Dashboard/index');
		}
		$this->load->view('index');
	}

	function logout(){
		unset($_SESSION['user_id']);
		unset($_SESSION['email']);
		unset($_SESSION['u_role_id']);
		session_destroy();
		redirect('/');
	}

}
