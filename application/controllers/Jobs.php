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
                        $this->form_validation->set_rules('description', 'Description', 'required|trim');
                        $this->form_validation->set_rules('part_price1', 'Price 1', 'required|trim');
                        $this->form_validation->set_rules('job_address1', 'Job Address 1', 'required|trim');
                        $this->form_validation->set_rules('job_address2', 'Job Address 1', 'required|trim');
                        $this->form_validation->set_rules('city', 'City', 'required|trim');
                        $this->form_validation->set_rules('location', 'Location', 'required|trim');
                        $this->form_validation->set_rules('postcode', 'Postcode', 'required|trim');
                        $this->form_validation->set_rules('country', 'Country', 'required|trim');
                        $this->form_validation->set_rules('mobile', 'Mobile', 'required|trim');
                        
			if($this->form_validation->run() == true)
			{
				$insert = $this->job_model->add_job();
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