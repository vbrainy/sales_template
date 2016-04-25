<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_settings extends CI_Controller {

	function __construct(){
		parent:: __construct();
		$this->load->model('settings_model');

		check_auth(); //check is logged in.
	}

	/**
	 * home page of settings
	 */

	public function index()
	{
		//restricted this area, only for admin
		permittedArea();

		$data['settings'] = $this->settings_model->adminSettings();

		if($this->input->post())
		{
			$input = $this->input->post();
			$this->form_validation->set_rules('default_email', 'Default Email', 'required|valid_email');

			if($this->form_validation->run())
			{
				$this->settings_model->updateSettings();
			}
		}

		theme('admin_settings', $data);
	}


	public function settingsLog(){
		//restricted this area, only for admin
		permittedArea();

		$data['settingsLog'] = $this->settings_model->adminSettingsLog();

		theme('settingsLog', $data);
	}

	/**
	 * Add Admin with permission
	 */

	public function addAdmin(){
		//restricted this area, only for admin
		permittedArea();

		$data['countries'] = $this->db->get('countries');

		if($this->input->post())
		{
			if($this->input->post('submit') != 'addAdmin') die('Error! sorry');

			$this->form_validation->set_rules('first_name', 'First Name', 'required|trim');
			$this->form_validation->set_rules('email', 'Email', 'required|trim|is_unique[users.email]');
			$this->form_validation->set_rules('password', 'Password', 'required|matches[passconf]');
			$this->form_validation->set_rules('passconf', 'Password Confirmation', 'required');
			$this->form_validation->set_rules('gender', 'Gender', 'required');
			$this->form_validation->set_rules('country', 'Country', 'required');

			if($this->form_validation->run() == true)
			{
				$insert = $this->settings_model->addAdmin();
				if($insert)
				{
					$this->session->set_flashdata('successMsg', 'Admin Created Success');
					redirect(base_url('admin_settings/addAdmin'));
				}

			}
		}

		theme('addAdmin', $data);
	}



	/**
	 * @allAdmin List
	 */

	public function all_admin(){
		//restricted this area, only for admin
		permittedArea();

		$data['adminList'] = $this->db->order_by('id', 'DESC')->get_where('users', ['role' => 'admin']);

		theme('all_admin', $data);
	}


}
