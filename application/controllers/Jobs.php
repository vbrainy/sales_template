<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jobs extends CI_Controller {

	function __construct(){
		parent:: __construct();
		$this->load->model('job_model');

		check_auth(); //check is logged in.
	}

	public function index()
	{
		//restricted this area, only for admin
		permittedArea();
                
		theme('task_index');
	}
        
        /**
	 * Add agent script
	 */

	public function add_job($taskId){
		//restricted this area, only for admin
		permittedArea();

		$data['countries'] = $this->db->get('countries');

		if($this->input->post())
		{
			if($this->input->post('submit') != 'add_task') die('Error! sorry');

			$this->form_validation->set_rules('title', 'Title', 'required|trim');
//			$this->form_validation->set_rules('contactno', 'Contact No.', 'required|trim');
//			$this->form_validation->set_rules('email', 'Email', 'required|trim|is_unique[users.email]');
//			$this->form_validation->set_rules('password', 'Password', 'required|matches[passconf]');
//			$this->form_validation->set_rules('passconf', 'Password Confirmation', 'required');
//			$this->form_validation->set_rules('gender', 'Gender', 'required');
//			$this->form_validation->set_rules('date_of_birth', 'Date of birth', 'required|trim');
//			$this->form_validation->set_rules('profession', 'Profession', 'required|trim');
//			$this->form_validation->set_rules('street_address', 'Street Address', 'required|trim');
//			$this->form_validation->set_rules('country', 'Country', 'required');

			if($this->form_validation->run() == true)
			{
				$insert = $this->task_model->add_task();
				if($insert)
				{
					$this->session->set_flashdata('successMsg', 'Task Created Success');
					redirect(base_url('tasks'));
				}

			}
		}

		theme('add_job', $data);
	}
}