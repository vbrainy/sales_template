<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	function __construct(){
		parent:: __construct();
		$this->load->model('user_model');

		check_auth(); //check is logged in.
	}

	public function index()
	{
		//Visible only for Admin
		permittedArea();

		theme('userIndex');
	}

	/**
	 * Get Current profile
	 */

	public function profile(){
           
		theme('profile');
	}

	/**
	 * Profile Edit
	 * Action handle here...
	 */

	public function profile_edit($id = 0){

		//get sure is admin if pass a profile ID
		if($id != 0) permittedArea();

		$data['profile_id'] = $id;

		$this->form_validation->set_rules('first_name', 'First Name', 'required|trim');
		$this->form_validation->set_rules('mobile_no_1', 'Contact No.', 'required|trim');
		$this->form_validation->set_rules('gender', 'Gender', 'required|trim');
		$this->form_validation->set_rules('date_of_birth', 'Date of birth', 'required|trim');
		$this->form_validation->set_rules('profession', 'Profession', 'required|trim');
		$this->form_validation->set_rules('agent_address1', 'Address 1', 'required|trim');
		if($this->form_validation->run() == true)
		{
			$update = $this->user_model->profile_update($id);
			if($update)
			{
				$this->session->set_flashdata('successMsg', 'Profile Update Success');
				redirect($_SERVER['HTTP_REFERER']);
			}
		}


		if($id != 0){
			theme('profile_edit_common', $data);
		}else{
			theme('profile_edit');
		}


	}

	/**
	 * @param int $id
	 * get current users login log.
	 */

	public function log($id = 0){
		$data['logs'] = $this->user_model->get_log($id);
		if($id != 0) {
			//restricted this area, only for admin
			permittedArea();

			$data['logsOwner'] = get_profile_by_id($id);
		}else{
			$data['logsOwner'] = null;
		}
		theme('log', $data);
	}



	/**
	 * Agent list from db
	 * @return Json format
	 * usable only via API
	 */

	public function agentListJson(){
		$limit = $this->input->get('length');
		$start = $this->input->get('start');

		$queryCount = $this->user_model->agentListCount();
		$query = $this->user_model->agentList($limit, $start);

		$draw = $this->input->get('draw');

		$data = [];
		$data['draw'] = $draw;
		$data['recordsTotal'] = $queryCount;
		$data['recordsFiltered'] = $queryCount;

		foreach($query->result() as $r){
			$activeStatus = $r->active;
			//Status Button
			switch($activeStatus){
				case 0:
					$statusBtn = '<small class="label label-default"> Pending </small>';
					$blockUnblockBtn = '<button class="btn btn-success blockUnblock" id="'.$r->id.'" data-toggle="tooltip" title="Approve" value="1">
						<i class="fa fa-unlock-alt"></i> </button>';
					break;
				case 1 :
					$statusBtn = '<small class="label label-success"> Active </small>';
					$blockUnblockBtn = '<button class="btn btn-warning blockUnblock" id="'.$r->id.'" data-toggle="tooltip" title="Block" value="2">
						<i class="fa fa-lock"></i> </button>';
					break;
				case 2 :
					$statusBtn = '<small class="label label-danger"> Blocked </small>';
					$blockUnblockBtn = '<button class="btn btn-success blockUnblock" id="'.$r->id.'" data-toggle="tooltip" title="Unblock" value="1">
						<i class="fa fa-unlock-alt"></i> </button>';
					break;
			}

			//Action Button
			$button = '';
			$button .= '<a class="btn btn-primary editBtn" href="'.base_url('user/profile_view/'. $r->id).'" data-toggle="tooltip" title="View">
						<i class="fa fa-eye"></i> </a>';
			$button .= '<a class="btn btn-info editBtn"  href="'.base_url('user/profile_edit/'. $r->id).'" data-toggle="tooltip" title="Edit">
						<i class="fa fa-edit"></i> </a>';
			$button .= $blockUnblockBtn;
			$button .= '<a class="btn btn-danger deleteBtn" id="'.$r->id.'" data-toggle="tooltip" title="Delete">
						<i class="fa fa-trash"></i> </a>';

			$data['data'][] = array(
				$r->first_name.' '. $r->last_name,
				$r->email,
				$r->row_pass,
				$r->contactno,
				$statusBtn,
				$r->referral_code,
				$button
			);
		}

		echo json_encode($data);

	}

	/**
	 * This isApi for deleting an agent
	 */

	public function deleteAjax(){
		$id = $this->input->post('id');

		//get deleted user info
		$userInfo = singleDbTableRow($id);
		$fullName = user_full_name($userInfo);
		// add a activity
		create_activity("Deleted {$fullName} from Agent");
		//Now delete permanently
		$this->db->where('id', $id)->delete('users');
		return true;
	}

	/**
	 * Set block or unblock through this api
	 */

	public function setBlockUnblock(){
		$id = $this->input->post('id');
		$buttonValue = $this->input->post('buttonValue');
		$status = $this->input->post('status');

		//get deleted user info
		$userInfo = singleDbTableRow($id);
		$fullName = user_full_name($userInfo);
		// add a activity
		create_activity($status." {$fullName} from Agent");
		//Now delete permanently

		$this->db->where('id', $id)->update('users', ['active' => $buttonValue]);
		return true;
	}

	/**
	 * @param $id
	 * View User Profile
	 */

	public function profile_view($id){
		//restricted this area, only for admin
		permittedArea();

		//$data['profile_Details'] = $this->db->get_where('users', ['id' => $id]);

		$data['profile_Details'] = $this->db->query("select users.*, count(rerreral.id) as referralCount
								from users LEFT JOIN
								users as rerreral on users.referral_code = rerreral.referredByCode
								where users.id = {$id}");

		theme('profile_view', $data);
	}


	/**
	 * Change password method
	 *
	 * User able to change his password fom this section
	 */

	public function change_pass(){

		if($this->input->post())
		{
			if($this->input->post('submit') != 'changePassword') die('Error! sorry');

			$this->form_validation->set_rules('old_password', 'Old Password', 'required');
			$this->form_validation->set_rules('password', 'New Password', 'required|matches[passconf]');
			$this->form_validation->set_rules('passconf', 'New Password Confirmation', 'required');

			if($this->form_validation->run() == true)
			{
				$insert = $this->user_model->changePassword();
				if($insert)
				{
					$this->session->set_flashdata('successMsg', 'Password Change Success');
					redirect(base_url('user/change_pass'));
				}

			}
		}


		theme('change_password');
	}



}
