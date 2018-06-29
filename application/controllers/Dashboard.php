<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 *
 * @package    Dashboard
 * @author     Vinil Lakkavatri (vinil.lakkavatri@icloud.com)
 * @copyright  2018 Vinil Lakkavatri
 * @company    FiHavock Digital Pvt Ltd
 * @ci_version 3.1.9 echo CI_VERSION;
 * @deprecated File deprecated in Release 2.0.0
 *
 **/
class Dashboard extends CI_Controller {

	
	function __construct(){
		parent::__construct();
        error_reporting(0);
        $this->load->helper('url');
        $this->load->library('session');
        $this->user_role = $this->session->userdata('u_role_id');
        $this->load->model('Common_model','common');
	}

	function index()
	{
		if (!empty($this->session->userdata('u_role_id'))) {
			if ($this->user_role == 1) {
				$whr = '';
			}else{
				$whr = '(user_id = '.$this->user_role.')';
			}
		}
		$data['table_data'] = $this->common->fetch_all_table_data_multiple_condition('enquiries',$whr);
		if (!empty($data)) {
			$this->load->view('dashboard',$data);
		}else{
			$this->load->view('dashboard');
		}
	}

	function add_new_contact(){
		if (isset($_POST) && !empty($_POST)) {
			$data['first_name'] = $this->input->post('first_name');
			$data['middle_name'] = $this->input->post('middle_name');
			$data['last_name'] = $this->input->post('last_name');
			$data['email'] = $this->input->post('email');
			$data['mobile_no'] = $this->input->post('mobile_no');
			$data['landline_no'] = $this->input->post('landline_no');
			$data['notes'] = $this->input->post('notes');
			$data['user_id'] = $this->session->userdata('user_id');
			$insert_data = $this->common->insert_into_table('enquiries',$data);
			$this->session->set_flashdata('message','Successfully Added New Contact!');
			redirect('Dashboard/index');
			//echo "<pre>";print_r($_POST);die;
		}
		$this->load->view('add-new-contact');
	}

	function edit_contact(){
		if (isset($_POST) && !empty($_POST)) {
			$up_data['first_name'] = $this->input->post('first_name');
			$up_data['middle_name'] = $this->input->post('middle_name');
			$up_data['last_name'] = $this->input->post('last_name');
			$up_data['email'] = $this->input->post('email');
			$up_data['mobile_no'] = $this->input->post('mobile_no');
			$up_data['landline_no'] = $this->input->post('landline_no');
			$up_data['notes'] = $this->input->post('notes');
			$contact_id = $this->input->post('contact_id');
			$whr = '(id = '.$contact_id.')';
			$insert_data = $this->common->update_into_table_with_multiple_condition('enquiries',$whr,$up_data);
			$this->session->set_flashdata('message','Successfully Updated Contact!');
			redirect('Dashboard/edit_contact/'.$contact_id);
		}
		$contact_id = $this->uri->segment(3);
		if (!empty($contact_id)) {
			$whr = '(id = '.$contact_id.')';
			$data = current($this->common->fetch_all_table_data_multiple_condition('enquiries',$whr));
		}
		if (!empty($data)) {
			$this->load->view('edit_contact',$data);
		}else{
			$this->load->view('edit_contact');
		}
	}

	function del_contact(){
		if (isset($_POST['reqtype_del']) && !empty($_POST['reqtype_del'] == 'delete')) {
			$contact_id = $this->input->post('contact_id');
			$this->session->set_flashdata('message','Successfully Deleted Contact!');
			$whr = '(id = '.$contact_id.')';
			$insert_data = $this->common->delete_into_table_with_multiple_condition('enquiries',$whr);
		}
	}

	function session_checkout(){
		echo "session is not empty";
		echo "<pre>";print_r($_SESSION);
	}

}
