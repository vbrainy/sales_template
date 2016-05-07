<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Myjobs extends CI_Controller {

	function __construct(){
		parent:: __construct();
		$this->load->model('job_model');
                $this->load->model('task_model');

		check_auth(); //check is logged in.
	}

	public function index()
	{
            
             $Mytask =   $this->task_model->getmytaskByid();
            
                $data['task_id'] = $Mytask->id;
                $data['task'] = $Mytask;		//restricted this area, only for admin
		//permittedArea();
                
		theme('myjobs', $data);
	}
        
        /**
	 * Add agent script
	 */

	public function update_job_status($taskId){
		//restricted this area, only for admin
	
		$data['countries'] = $this->db->get('countries');
                
                $data['tasks'] = singleDbTableRow($taskId,'tasks');
                
                $data['jobUniqueName'] = $this->job_model->jobUniqueName($taskId);
                
		

		theme('update_job', $data);
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
			$button .= '<a class="btn btn-primary editBtn" href="'.base_url('myjobs/view_job/'. $r->id).'" data-toggle="tooltip" title="View">
						<i class="fa fa-eye"></i> </a>';
			$button .= '<a class="btn btn-info editBtn"  href="'.base_url('myjobs/update_job_status/'. $r->id).'" data-toggle="tooltip" title="Edit">
						<i class="fa fa-edit"></i> </a>';
			//$button .= $blockUnblockBtn;
			$button .= '<a class="btn btn-danger deleteBtn" id="'.$r->id.'" data-toggle="tooltip" title="Delete">
						<i class="fa fa-trash"></i> </a>';
                        
                        $addjobbutton = '<a class="btn btn-primary editBtn" href="'.base_url('jobs/add_job/'. $r->id).'" data-toggle="tooltip" title="Add Job">
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
}