<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tasks extends CI_Controller {

	function __construct(){
		parent:: __construct();
		$this->load->model('task_model');
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

	public function add_task(){
		//restricted this area, only for admin
		permittedArea();

		$data['countries'] = $this->db->get('countries');

                $data['agents'] = $this->db->where('role', 'agent')->get('users');
//                print_r($data['agents']);


		if($this->input->post())
		{
			if($this->input->post('submit') != 'add_task') die('Error! sorry');

			$this->form_validation->set_rules('title', 'Title', 'required|trim');
                        $this->form_validation->set_rules('assign_to', 'Agent Name', 'required|trim|is_unique[tasks.assign_to]');
                        $this->form_validation->set_rules('city', 'City', 'required');
                        
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

        
        	public function edit($id){
		//restricted this area, only for admin
		permittedArea();
                
		$data['tasks'] = singleDbTableRow($id,'tasks');
                
                $data['agents'] = $this->db->where('role', 'agent')->get('users');
                //print_r($data['agents']);exit;
		if($this->input->post())
		{
			if($this->input->post('submit') != 'edit_task') die('Error! sorry');

			$this->form_validation->set_rules('title', 'Title', 'required|trim');
                        $this->form_validation->set_rules('assign_to', 'agent', 'required');
                                
                        $this->form_validation->set_rules('city', 'City', 'required');
                        

			if($this->form_validation->run() == true)
			{
				$insert = $this->task_model->edit_task($id);
				if($insert)
				{
					$this->session->set_flashdata('successMsg', 'Task Updated Success');
					redirect(base_url('tasks'));
				}
			}
		}

		theme('edit_task', $data);
	}

        	/**
	 * This isApi for deleting an agent
	 */

	public function deleteAjax(){
		$id = $this->input->post('id');

		//get deleted user info
		$userInfo = singleDbTableRow($id,'tasks');
		$title = $userInfo->title;
		// add a activity
		create_activity("Deleted {$title} Task");
                //Delete jobs first of that task
                $this->db->where('task_id', $id)->delete('jobs');
                
		//Now delete permanently
		$this->db->where('id', $id)->delete('tasks');
		return true;
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
                //    print_R($r);exit;
			$activeStatus = $r->status;
			//Status Button
			switch($activeStatus){
				case 0:
					$statusBtn = '<small class="label label-default"> In Active </small>';
					$blockUnblockBtn = '<button class="btn btn-success blockUnblock" id="'.$r->id.'" data-toggle="tooltip" title="Unblock" value="1">
						<i class="fa fa-unlock-alt"></i> </button>';
					break;
				case 1 :
					$statusBtn = '<small class="label label-success"> Active </small>';
					$blockUnblockBtn = '<button class="btn btn-warning blockUnblock" id="'.$r->id.'" data-toggle="tooltip" title="Block" value="0">
						<i class="fa fa-lock"></i> </button>';
					break;
			}

			//Action Button
			$button = '';
                        $addjobbutton = '';
                        /*$button .= '<a class="btn btn-primary editBtn" href="'.base_url('jobs/add_job/'. $r->id).'" data-toggle="tooltip" title="Add Job">
						<i class="fa fa-plus"></i> </a>';*/
			$button .= '<a class="btn btn-primary editBtn" href="'.base_url('jobs/index/'. $r->id).'" data-toggle="tooltip" title="View">
						<i class="fa fa-eye"></i> </a>';
			$button .= '<a class="btn btn-info editBtn"  href="'.base_url('tasks/edit/'. $r->id).'" data-toggle="tooltip" title="Edit">
						<i class="fa fa-edit"></i> </a>';
			$button .= $blockUnblockBtn;
			$button .= '<a class="btn btn-danger deleteBtn" id="'.$r->id.'" data-toggle="tooltip" title="Delete">
						<i class="fa fa-trash"></i> </a>';
                         $button .= '<a class="btn btn-info editBtn"  href="'.base_url('tasks/copytask/'. $r->id).'" data-toggle="tooltip" title="copy task">
						<i class="fa fa-copy"></i></a>';
                          $button .= '<a class="btn btn-danger editBtn"  href="#" data-toggle="tooltip" title="Archive task">
						<i class="fa fa-archive"></i></a>';
		        
                        $addjobbutton = '<a class="btn btn-primary editBtn" href="'.base_url('jobs/add_job/'. $r->id).'" data-toggle="tooltip" title="Add Job">
						<i class="fa fa-plus"></i>&nbsp;Add Job </a>';
			$data['data'][] = array(
				$r->title,
				$r->unique_name,
				$r->first_name.' '.$r->last_name,
				$r->agent_area,
                            $addjobbutton,

				//$r->created_at,
				//$r->modified_at,

//				$statusBtn,
//				$r->referral_code,
				$button
			);
		}

		echo json_encode($data);

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
		create_activity($status." {$fullName} from Task");
		//Now delete permanently

		$this->db->where('id', $id)->update('tasks', ['status' => $buttonValue]);
		return true;
	}
        
        // Copy task list
        
        public function copytask($id){
            	permittedArea();
                
		$data['tasks'] = singleDbTableRow($id,'tasks');
                if(empty($data['tasks'])){
                     $this->session->set_flashdata('errorMsg', 'Task not found');
				    redirect(base_url('tasks'));
                }
               $data['agents'] = $this->db->where('role', 'agent')->get('users');
                 //print_r($data['agents']);exit;
		if($this->input->post())
		{ 
			if($this->input->post('submit') != 'copy_task') die('Error! sorry');

			$this->form_validation->set_rules('title', 'Title', 'required|trim');
                        $this->form_validation->set_rules('assign_to', 'agent', 'required|trim|is_unique[tasks.assign_to]');
                                
                        $this->form_validation->set_rules('city', 'City', 'required');

                        
                        if($this->form_validation->run() == true)
			{
				$insert = $this->task_model->add_task();
				if(!empty($insert))
				{ 
                                    $jobReacord = $this->job_model->singleJobTableRow($id,'jobs');
                                   if(empty($jobReacord)){
                                    
				    $this->session->set_flashdata('successMsg', 'Task Created Success');
				    redirect(base_url('tasks'));   
                                   }else{
                                    $this->job_model->copy_job($jobReacord,$insert);
				    $this->session->set_flashdata('successMsg', 'Task Created Success');
				    redirect(base_url('tasks'));   
                                   }
                                    
				}

                        }
		}

		theme('copy_task', $data);
        }
        
        // City Name
        public function getAgentcity(){
            if(empty($_POST['id'])){
                return "";
            }
           $dataCity = singleDbTableRow($_POST['id'],'users');
          // p($dataCity->city);
           echo $dataCity->city;
        }
}