<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Agent extends CI_Controller {

	function __construct(){
		parent:: __construct();
		$this->load->model('agent_model');

		check_auth(); //check is logged in.
	}

	public function index()
	{
            
		//restricted this area, only for admin
		permittedArea();

		theme('agent_index');
	}

	/**
	 * Add agent script
	 */

	public function add_agent(){
		//restricted this area, only for admin
		permittedArea();

		$data['countries'] = $this->db->get('countries');

		if($this->input->post())
		{
			if($this->input->post('submit') != 'add_agent') die('Error! sorry');

			$this->form_validation->set_rules('first_name', 'First Name', 'required|trim');
			$this->form_validation->set_rules('mobile_no_1', 'Mobile No.', 'required|trim');
			$this->form_validation->set_rules('mobile_no_2', 'Mobile No.', 'required|trim');
			
                        $this->form_validation->set_rules('email', 'Email', 'required|trim|is_unique[users.email]');
			$this->form_validation->set_rules('password', 'Password', 'required|matches[passconf]');
			$this->form_validation->set_rules('passconf', 'Password Confirmation', 'required');
			$this->form_validation->set_rules('gender', 'Gender', 'required');
			$this->form_validation->set_rules('date_of_birth', 'Date of birth', 'required|trim');
			$this->form_validation->set_rules('profession', 'Profession', 'required|trim');
			$this->form_validation->set_rules('agent_address1', 'Address 1', 'required|trim');
			$this->form_validation->set_rules('country', 'Country', 'required');
                        $this->form_validation->set_rules('national_insurance_no', 'National Insurance No.', 'required|trim');
 		        $this->form_validation->set_rules('postal_code', 'Postal Code', 'required');
           $this->form_validation->set_rules('city', 'City', 'required');
           
			if($this->form_validation->run() == true)
			{
				$insert = $this->agent_model->add_agent();
				if($insert)
				{
					$this->session->set_flashdata('successMsg', 'Agent Created Success');
					redirect(base_url('agent'));
				}

			}
		}

		theme('add_agent', $data);
	}

        /**
	 * Agent list from db
	 * @return Json format
	 * usable only via API
	 */
        	public function edit_agent($id = ""){
                  
                    if(empty($id)){
                       redirect(base_url('agent'));
                    }

		$data['agent'] = singleDbTableRow($id,'agents');
		if($this->input->post())
		{
			if($this->input->post('submit') != 'add_agent') die('Error! sorry');

			$this->form_validation->set_rules('first_name', 'First Name', 'required|trim');
			$this->form_validation->set_rules('mobile_no_1', 'Mobile No.', 'required|trim');
			$this->form_validation->set_rules('mobile_no_2', 'Mobile No.', 'required|trim');
			
                        //$this->form_validation->set_rules('email', 'Email', 'required|trim|is_unique[agents.email]');
			$this->form_validation->set_rules('password', 'Password', 'matches[passconf]');
			$this->form_validation->set_rules('passconf', 'Password Confirmation');
			$this->form_validation->set_rules('gender', 'Gender', 'required');
			$this->form_validation->set_rules('date_of_birth', 'Date of birth', 'required|trim');
			$this->form_validation->set_rules('profession', 'Profession', 'required|trim');
			$this->form_validation->set_rules('agent_address1', 'Address 1', 'required|trim');
			$this->form_validation->set_rules('country', 'Country', 'required');
                        $this->form_validation->set_rules('national_insurance_no', 'National Insurance No.', 'required|trim');
 		        $this->form_validation->set_rules('postal_code', 'Postal Code', 'required');
           $this->form_validation->set_rules('city', 'City', 'required');
           
		if($this->form_validation->run() == true)
		{
			$update = $this->agent_model->update_agent($id);
			if($update)
			{
				$this->session->set_flashdata('successMsg', 'Profile Update Success');
				redirect($_SERVER['HTTP_REFERER']);
			}
		}
		}
		


theme('edit_agent', $data);

	}
        
	/**
	 * Agent list from db
	 * @return Json format
	 * usable only via API
	 */

	public function agentListJson(){
		$limit = $this->input->get('length');
		$start = $this->input->get('start');

		$queryCount = $this->agent_model->agentListCount();
		$query = $this->agent_model->agentList($limit, $start);

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
					$blockUnblockBtn = '<button class="btn btn-success blockUnblock" id="'.$r->id.'" data-toggle="tooltip" title="Unblock" value="1">
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
//			$button .= '<a class="btn btn-primary editBtn" href="'.base_url('agent/profile_view/'. $r->id).'" data-toggle="tooltip" title="View">
//						<i class="fa fa-eye"></i> </a>';
			$button .= '<a class="btn btn-info editBtn"  href="'.base_url('agent/edit_agent/'. $r->id).'" data-toggle="tooltip" title="Edit">
						<i class="fa fa-edit"></i> </a>';
			$button .= $blockUnblockBtn;
			$button .= '<a class="btn btn-danger deleteBtn" id="'.$r->id.'" data-toggle="tooltip" title="Delete">
						<i class="fa fa-trash"></i> </a>';

			$data['data'][] = array(
                        ucfirst($r->first_name).' '. ucfirst($r->last_name),
				$r->email,
				ucfirst($r->gender),
				$r->mobile_no_1,
			$r->profession,
					
                            $statusBtn,
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
		$this->db->where('id', $id)->delete('agents');
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

		$this->db->where('id', $id)->update('agents', ['active' => $buttonValue]);
		return true;
	}


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

}
