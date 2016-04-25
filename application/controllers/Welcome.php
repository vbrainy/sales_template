<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	function __construct(){
		parent:: __construct();
		$this->load->model('login');
	}

	public function index()
	{
		//Redirect dashboard if logged-in
		if(is_logged_in()) redirect(base_url('dashboard'));

		$data = [
			'title'	=> 'Log In'
		];

		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|trim');
		$this->form_validation->set_rules('password', 'Password', 'required');

		if($this->form_validation->run() == true) {

			if ($this->input->post()) {
				//prevent CSRF
				if ($this->input->post('submitBtn') != 'submitBtn') die('You are not authorized to do this action');

				$check_auth = $this->login->authonication();

				if ($check_auth) {
					//redirect previously fail admin url
					if(redirect_auth_uri()) redirect(redirect_auth_uri());
					//redirect Dashboard
					redirect(base_url('dashboard'));
				} else {
					redirect(base_url());
				}
			}
		}


		$this->load->view('login', $data);
	}



	public function registerUser(){
		$data['title'] = 'Register';
		$data['countries'] = $this->db->get('countries');


		//User Registration Form Processing...

		if($this->input->post())
		{
			if($this->input->post('submit') != 'userRegistration') die('Error! sorry');

			$this->form_validation->set_rules('referredByCode', 'Referral Code', 'required|trim|callback_referralCodeCheck');
			$this->form_validation->set_rules('first_name', 'First Name', 'required|trim');
			$this->form_validation->set_rules('contactno', 'Contact No.', 'required|trim');
			$this->form_validation->set_rules('email', 'Email', 'required|trim|is_unique[users.email]');
			$this->form_validation->set_rules('password', 'Password', 'required|matches[passconf]');
			$this->form_validation->set_rules('passconf', 'Password Confirmation', 'required');
			$this->form_validation->set_rules('gender', 'Gender', 'required');
			$this->form_validation->set_rules('date_of_birth', 'Date of birth', 'required|trim');
			$this->form_validation->set_rules('profession', 'Profession', 'required|trim');
			$this->form_validation->set_rules('street_address', 'Street Address', 'required|trim');
			$this->form_validation->set_rules('country', 'Country', 'required');

			if($this->form_validation->run() == true)
			{
				$insert = $this->login->registerUser();
				if($insert)
				{

					$email = $this->input->post('email');

					$newUserInfo = singleDbTableRow($email, 'users', 'email');
					$html = '<br />';
					$html .= 'Email : '.$email.'<br />';
					$html .= 'Password : '.$newUserInfo->row_pass.'<br />';
					$html .= 'Referral ID : '.$newUserInfo->referral_code.'<br /> <hr />';
					$html .= 'Please find email on your <strong>Inbox</strong> or  <strong>Spam</strong> folder';

					$this->session->set_flashdata('successMsg', 'Registration Success, below are user details'. $html);
					redirect(base_url());
				}

			}
		}


		$this->load->view('registerUser', $data);
	}


	public function referralCodeCheck($referredByCode){
		$query = $this->db->get_where('users', ['referral_code' => $referredByCode]);
		if ($query->num_rows() > 0)
		{
			return true;
		}
		else
		{
			$this->form_validation->set_message('referralCodeCheck', 'The {field} field is not valid');
			return FALSE;
		}
	}

	/**
	 * Forgot password
	 */

	public function forgotPassword()
	{
		//Redirect dashboard if logged-in
		if(is_logged_in()) redirect(base_url('dashboard'));

		$data = [
			'title'	=> 'Password Retrieval'
		];

		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|trim');

		if($this->form_validation->run() == true) {

			if ($this->input->post()) {
				//prevent CSRF
				if ($this->input->post('submitBtn') != 'submitBtn') die('You are not authorized to do this action');

				$get_password = $this->login->forgotPassword();

				if ($get_password) {
					redirect(base_url());
				} else {
					redirect(base_url());
				}
			}
		}

		$this->load->view('forgot_password', $data);
    }


	public function validateReferralCodeApi(){
		$referredByCode = $this->input->post('referredByCode');
		$query = $this->db->get_where('users', ['referral_code' => $referredByCode]);
		if($query->num_rows() > 0){
			$return = 'true';
		}else{
			$return = 'false';
		}
		echo $return;
	}






	public function email_template(){
		$data['firstname'] = 'Buppy';
		$data['lastname'] = 'Hossain';
		$data['email'] = 'Buppy@globemg.com';
		$data['userid'] = 8;

		$this->load->view('product_sell_email_tpl', $data);
	}


}
