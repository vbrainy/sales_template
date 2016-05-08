<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jobs extends CI_Controller {

	function __construct(){
		parent:: __construct();
		$this->load->model('job_model');

		check_auth(); //check is logged in.
	}

	public function index($task_id)
	{
                $data['task_id'] = $task_id;
                $data['task'] = singleDbTableRow($task_id,'tasks');		//restricted this area, only for admin
		permittedArea();
                
		theme('jobs_index', $data);
	}
        
        /**
	 * Add agent script
	 */

	public function add_job($taskId){

		//restricted this area, only for admin
		permittedArea();

		$data['countries'] = $this->db->get('countries');
                $data['tasks'] = singleDbTableRow($taskId,'tasks');
                $data['agent'] = singleDbTableRow($data['tasks']->assign_to,'users');
                $data['jobUniqueName'] = $this->job_model->jobUniqueName($taskId);
                
		if($this->input->post())
		{
                    
			if($this->input->post('submit') != 'add_job') die('Error! sorry');
                        
//			$this->form_validation->set_rules('title', 'Title', 'required|trim');
                        $this->form_validation->set_rules('description', 'Description', 'required|trim');
                        $this->form_validation->set_rules('total_price', 'Total Price', 'required|numeric');
                        $this->form_validation->set_rules('city', 'City', 'required|trim');
                        $this->form_validation->set_rules('postcode', 'Postcode', 'required|trim');
                        $this->form_validation->set_rules('mobile', 'Mobile', 'required|trim');
                        
			if($this->form_validation->run() == true)
			{
        
                            $config['upload_path'] = APPPATH . 'uploads/'; 
                            $config['file_name'] = $_FILES['shop_nameplate']['name'];
                            $config['overwrite'] = TRUE;
                            $config["allowed_types"] = 'jpg|jpeg|png|gif';
                            $config["max_size"] = 1024;
                            $config["max_width"] = 400;
                            $config["max_height"] = 400;
                            $this->load->library('upload', $config);
        
                            if(!$this->upload->do_upload('shop_nameplate')) {               
                                $this->data['error'] = $this->upload->display_errors();
                                //print_r($this->data);
                            }
                            //exit;
                            
                            
				$insert = $this->job_model->add_job();
				if($insert)
				{
					$this->session->set_flashdata('successMsg', 'Job Created Success');
					redirect(base_url('tasks'));
				}

			}
		}

		theme('add_job', $data);
	}
        
        
        /**
	 * Agent list from db
	 * @return Json format
	 * usable only via API
	 */

	public function jobsListJson(){
		$limit = $this->input->get('length');
		$start = $this->input->get('start');
                $task_id  = $this->input->get('task_id');
		$queryCount = $this->job_model->jobsListCount($task_id);
		$query = $this->job_model->jobsList($limit, $start, $task_id);
                    
		$draw = $this->input->get('draw');

		$data = [];
		$data['draw'] = $draw;
		$data['recordsTotal'] = $queryCount;
		$data['recordsFiltered'] = $queryCount;
                
		foreach($query->result() as $r){
                //    print_R($r);exit;
			//$activeStatus = $r->status;
//			//Status Button
//                        switch($activeStatus){
//				case 0:
//					$statusBtn = '<small class="label label-default"> In Active </small>';
//					$blockUnblockBtn = '<button class="btn btn-success blockUnblock" id="'.$r->id.'" data-toggle="tooltip" title="Unblock" value="1">
//						<i class="fa fa-unlock-alt"></i> </button>';
//					break;
//				case 1 :
//					$statusBtn = '<small class="label label-success"> Active </small>';
//					$blockUnblockBtn = '<button class="btn btn-warning blockUnblock" id="'.$r->id.'" data-toggle="tooltip" title="Block" value="0">
//						<i class="fa fa-lock"></i> </button>';
//					break;
//			}
			//Action Button
			$button = '';
                        $addjobbutton = '';
                        /*$button .= '<a class="btn btn-primary editBtn" href="'.base_url('jobs/add_job/'. $r->id).'" data-toggle="tooltip" title="Add Job">
						<i class="fa fa-plus"></i> </a>';*/
			$button .= '&nbsp; <a class="btn btn-primary editBtn" href="'.base_url('jobs/job_view/'. $r->id).'" data-toggle="tooltip" title="View">
						<i class="fa fa-eye"></i> </a>';
			$button .= '&nbsp; <a class="btn btn-info editBtn"  href="'.base_url('jobs/job_edit/'. $r->id).'" data-toggle="tooltip" title="Edit">
						<i class="fa fa-edit"></i> </a>';
			//$button .= $blockUnblockBtn;
			$button .= '&nbsp; <a class="btn btn-danger deleteBtn" id="'.$r->id.'" data-toggle="tooltip" title="Delete">
						<i class="fa fa-trash"></i> </a>';
                        
                        $addjobbutton = '&nbsp; <a class="btn btn-primary editBtn" href="'.base_url('jobs/add_job/'. $r->id).'" data-toggle="tooltip" title="Add Job">
						<i class="fa fa-plus"></i>&nbsp;Add Job </a>';
			$data['data'][] = array(
				//$r->title,
				$r->unique_name,
				//$r->first_name.' '.$r->last_name,
				$r->city,
                            //$addjobbutton,

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
	 * This isApi for deleting an agent
	 */

	public function deleteAjax(){
		$id = $this->input->post('id');

		//get deleted user info
		$userInfo = singleDbTableRow($id,'jobs');
		$title = $userInfo->unique_name;
		// add a activity
		create_activity("Deleted {$title} Job");
		//Now delete permanently
		$this->db->where('id', $id)->delete('jobs');
		return true;
	}
        
        	/**
	 * @param $id
	 * View Job Details
	 */

	public function job_view($id){
		//restricted this area, only for admin
		permittedArea();


		$data['job'] = singleDbTableRow($id, 'jobs');
                
		theme('job_view', $data);
	}
        
        //
        


}