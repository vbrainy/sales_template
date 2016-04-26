<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tasks extends CI_Controller {

	function __construct(){
		parent:: __construct();
		$this->load->model('task_model');

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

	public function add_task(){
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

		theme('add_task', $data);
	}

    
    /**
	 * Agent list from db
	 * @return Json format
	 * usable only via API
	 */

	public function tasksListJson(){
		$limit = $this->input->get('length');
		$start = $this->input->get('start');

		$queryCount = $this->task_model->tasksListCount();
		$query = $this->task_model->tasksList($limit, $start);
                
		$draw = $this->input->get('draw');

		$data = [];
		$data['draw'] = $draw;
		$data['recordsTotal'] = $queryCount;
		$data['recordsFiltered'] = $queryCount;

		foreach($query->result() as $r){
//			$activeStatus = $r->active;
//			//Status Button
//			switch($activeStatus){
//				case 0:
//					$statusBtn = '<small class="label label-default"> Pending </small>';
//					$blockUnblockBtn = '<button class="btn btn-success blockUnblock" id="'.$r->id.'" data-toggle="tooltip" title="Unblock" value="1">
//						<i class="fa fa-unlock-alt"></i> </button>';
//					break;
//				case 1 :
//					$statusBtn = '<small class="label label-success"> Active </small>';
//					$blockUnblockBtn = '<button class="btn btn-warning blockUnblock" id="'.$r->id.'" data-toggle="tooltip" title="Block" value="2">
//						<i class="fa fa-lock"></i> </button>';
//					break;
//				case 2 :
//					$statusBtn = '<small class="label label-danger"> Blocked </small>';
//					$blockUnblockBtn = '<button class="btn btn-success blockUnblock" id="'.$r->id.'" data-toggle="tooltip" title="Unblock" value="1">
//						<i class="fa fa-unlock-alt"></i> </button>';
//					break;
//			}

			//Action Button
			$button = '';
			$button .= '<a class="btn btn-primary editBtn" href="'.base_url('agent/profile_view/'. $r->id).'" data-toggle="tooltip" title="View">
						<i class="fa fa-eye"></i> </a>';
			$button .= '<a class="btn btn-info editBtn"  href="'.base_url('user/profile_edit/'. $r->id).'" data-toggle="tooltip" title="Edit">
						<i class="fa fa-edit"></i> </a>';
			//$button .= $blockUnblockBtn;
			$button .= '<a class="btn btn-danger deleteBtn" id="'.$r->id.'" data-toggle="tooltip" title="Delete">
						<i class="fa fa-trash"></i> </a>';

			$data['data'][] = array(
				$r->title,
				$r->unique_name,
				$r->created_at,
				$r->modified_at,
//				$statusBtn,
//				$r->referral_code,
				$button
			);
		}

		echo json_encode($data);

	}
}