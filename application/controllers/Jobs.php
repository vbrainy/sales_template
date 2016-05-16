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
                $this->uri->segments[1] = "tasks";
                $data['task_id'] = $task_id;
                $data['task'] = singleDbTableRow($task_id,'tasks');		//restricted this area, only for admin
		permittedArea();
                
		theme('jobs_index', $data);
	}
        
        /**
	 * Add agent script
	 */
	public function pastjob($task_id)
	{
                $this->uri->segments[1] = "tasks";
                $data['task_id'] = $task_id;
                $data['task'] = singleDbTableRow($task_id,'tasks');		//restricted this area, only for admin
		permittedArea();
                
		theme('jobs_index', $data);
	}


	public function add_job($taskId) {
               
                $this->uri->segments[1] = "tasks";
		//restricted this area, only for admin
		permittedArea();

		$data['countries'] = $this->db->get('countries');
                $data['tasks'] = singleDbTableRow($taskId,'tasks');
                $data['agent'] = singleDbTableRow($data['tasks']->assign_to,'users');
                $data['jobUniqueName'] = $this->job_model->jobUniqueName($taskId);
                
     
                
		if($this->input->post())
		{
                    
			if($this->input->post('submit') != 'add_job') die('Error! sorry');
                        
                        //p($_POST)
                        
          		//$this->form_validation->set_rules('title', 'Title', 'required|trim');
                        $this->form_validation->set_rules('latitude', 'Latitude', 'required|trim');
                        $this->form_validation->set_rules('longitude', 'Longitude', 'required|trim');
                        $this->form_validation->set_rules('job_at_shop', 'Job at shop', 'required|trim');
                        $this->form_validation->set_rules('job_add1', 'Job Address 1', 'required|trim');
                         $this->form_validation->set_rules('job_add2', 'Job Address 2', 'required|trim');
                        $this->form_validation->set_rules('description', 'Description', 'required|trim');
                        $this->form_validation->set_rules('total_price', 'Total Price', 'required|numeric');
                        $this->form_validation->set_rules('city', 'City', 'required|trim');
                        $this->form_validation->set_rules('postcode', 'Postcode', 'required|trim');
                        $this->form_validation->set_rules('mobile', 'Mobile', 'required|trim');
//                        $this->form_validation->set_rules('desc1', 'Description 1', 'required|trim');
//                        $this->form_validation->set_rules('price1', 'Price 1', 'required|numeric|trim');
//                        $this->form_validation->set_rules('desc2', 'Description 2', 'required|trim');
//                        $this->form_validation->set_rules('price2', 'Price 2', 'required|numeric|trim');
//                        $this->form_validation->set_rules('desc3', 'Description 3', 'required|trim');
//                        $this->form_validation->set_rules('price3', 'Price 3', 'required|numeric|trim');
//                        $this->form_validation->set_rules('desc4', 'Description 4', 'required|trim');
//                        $this->form_validation->set_rules('price4', 'Price 4', 'required|numeric|trim');
//                        $this->form_validation->set_rules('desc5', 'Description 5', 'required|trim');
//                        $this->form_validation->set_rules('price5', 'Price 5', 'required|numeric|trim');
//                        $this->form_validation->set_rules('desc6', 'Description 6', 'required|trim');
//                        $this->form_validation->set_rules('price6', 'Price 6', 'required|numeric|trim');
//                        $this->form_validation->set_rules('desc7', 'Description 7', 'required|trim');
//                        $this->form_validation->set_rules('price7', 'Price 7', 'required|numeric|trim');
//                        $this->form_validation->set_rules('desc8', 'Description 8', 'required|trim');
//                        $this->form_validation->set_rules('price8', 'Price 8', 'required|numeric|trim');
//                        $this->form_validation->set_rules('desc9', 'Description 9', 'required|trim');
//                        $this->form_validation->set_rules('price9', 'Price 9', 'required|numeric|trim');
//                        $this->form_validation->set_rules('desc10', 'Description 10', 'required|trim');
//                        $this->form_validation->set_rules('price10', 'Price 10', 'required|numeric|trim');
                        
                        
                        
                        
			if($this->form_validation->run() == true)
			{
       
                            
                           
                    
                            
                            
                            $config['upload_path'] = './uploads/'; 
                            $config['file_name'] = $_FILES['shop_nameplate']['name'];
                            $config['overwrite'] = TRUE;
                            $config["allowed_types"] = 'jpg|jpeg|png|gif';
                            $config["max_size"] = 93234565;
                            $config["max_width"] = 200000;
                            $config["max_height"] = 10000;
                            $this->load->library('upload', $config);
      
                          
                            if(!$this->upload->do_upload('shop_nameplate')) {               
                                $this->data['error'] = $this->upload->display_errors();
                                
                            } else {
                $upload_data = $this->upload->data(); //all uploaded data store in variable
                $photoName = $upload_data['raw_name'] . '_thumb' . $upload_data['file_ext'];
                $fullPhoto =  $config['upload_path'] . $upload_data['file_name'];
                            //exit;
                            }
                            
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
        
        public function job_edit($taskId="",$jobId=""){
            
            
           $data['countries'] = $this->db->get('countries');
                $data['tasks'] = singleDbTableRow($taskId,'tasks');
                 $stdClass = singleDbTableRow($jobId,'jobs');
                $data['agent'] = singleDbTableRow($data['tasks']->assign_to,'users');
                $data['jobUniqueName'] = $stdClass->unique_name;
                
                
                $data['job_details'] = json_decode(json_encode($stdClass),true);
           //p($data['job_details']);
                if($this->input->post())
		{
                    
			if($this->input->post('submit') != 'update_job') die('Error! sorry');
                        
                        //p($_POST)
                        
          		//$this->form_validation->set_rules('title', 'Title', 'required|trim');
                        
                         $this->form_validation->set_rules('latitude', 'Latitude', 'required|trim');
                        $this->form_validation->set_rules('longitude', 'Longitude', 'required|trim');
                       
                        $this->form_validation->set_rules('job_at_shop', 'Job at shop', 'required|trim');
                        $this->form_validation->set_rules('job_add1', 'Job Address 1', 'required|trim');
                         $this->form_validation->set_rules('job_add2', 'Job Address 2', 'required|trim');
                        $this->form_validation->set_rules('description', 'Description', 'required|trim');
                        $this->form_validation->set_rules('total_price', 'Total Price', 'required|numeric');
                        $this->form_validation->set_rules('city', 'City', 'required|trim');
                        $this->form_validation->set_rules('postcode', 'Postcode', 'required|trim');
                        $this->form_validation->set_rules('mobile', 'Mobile', 'required|trim');
                        /*$this->form_validation->set_rules('desc1', 'Description 1', 'required|trim');
                        $this->form_validation->set_rules('price1', 'Price 1', 'required|numeric|trim');
                        $this->form_validation->set_rules('desc2', 'Description 2', 'required|trim');
                        $this->form_validation->set_rules('price2', 'Price 2', 'required|numeric|trim');
                        $this->form_validation->set_rules('desc3', 'Description 3', 'required|trim');
                        $this->form_validation->set_rules('price3', 'Price 3', 'required|numeric|trim');
                        $this->form_validation->set_rules('desc4', 'Description 4', 'required|trim');
                        $this->form_validation->set_rules('price4', 'Price 4', 'required|numeric|trim');
                        $this->form_validation->set_rules('desc5', 'Description 5', 'required|trim');
                        $this->form_validation->set_rules('price5', 'Price 5', 'required|numeric|trim');
                        $this->form_validation->set_rules('desc6', 'Description 6', 'required|trim');
                        $this->form_validation->set_rules('price6', 'Price 6', 'required|numeric|trim');
                        $this->form_validation->set_rules('desc7', 'Description 7', 'required|trim');
                        $this->form_validation->set_rules('price7', 'Price 7', 'required|numeric|trim');
                        $this->form_validation->set_rules('desc8', 'Description 8', 'required|trim');
                        $this->form_validation->set_rules('price8', 'Price 8', 'required|numeric|trim');
                        $this->form_validation->set_rules('desc9', 'Description 9', 'required|trim');
                        $this->form_validation->set_rules('price9', 'Price 9', 'required|numeric|trim');
                        $this->form_validation->set_rules('desc10', 'Description 10', 'required|trim');
                        $this->form_validation->set_rules('price10', 'Price 10', 'required|numeric|trim');
                        */
                        
			if($this->form_validation->run() == true)
			{
                            
                            $config['upload_path'] = './uploads/'; 
                            $config['file_name'] = $_FILES['shop_nameplate']['name'];
                            $config['overwrite'] = TRUE;
                            $config["allowed_types"] = 'jpg|jpeg|png|gif';
                            $config["max_size"] = 93234565;
                            $config["max_width"] = 200000;
                            $config["max_height"] = 10000;
                            $this->load->library('upload', $config);
      
                          
                            if(!$this->upload->do_upload('shop_nameplate')) {               
                                $this->data['error'] = $this->upload->display_errors();
                                
                            } else {
                $upload_data = $this->upload->data(); //all uploaded data store in variable
                $photoName = $upload_data['raw_name'] . '_thumb' . $upload_data['file_ext'];
                $fullPhoto =  $config['upload_path'] . $upload_data['file_name'];
                //$this->photoResize($fullPhoto); // resize now
            }
                            //print_r($this->data);
				$update = $this->job_model->update_job($jobId);
				if($update)
				{
					$this->session->set_flashdata('successMsg', 'Job Updated Success');
						//redirect($_SERVER['HTTP_REFERER']);
                                        redirect(base_url('jobs/index/'.$taskId));
				}

			}
		}
                
                
                theme('edit_job', $data);
        }

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
			$button .= '&nbsp; <a class="btn btn-primary editBtn" href="'.base_url('jobs/job_view/'.$task_id.'/'. $r->id).'" data-toggle="tooltip" title="View">
						<i class="fa fa-eye"></i> </a>';
			$button .= '&nbsp; <a class="btn btn-info editBtn"  href="'.base_url('jobs/job_edit/'.$task_id.'/'. $r->id).'" data-toggle="tooltip" title="Edit">
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

	public function job_view($taskId, $jobId){
		//restricted this area, only for admin
		permittedArea();
                
		$data['job'] = singleDbTableRow($jobId, 'jobs');
                //print_R($data['job']);exit
		theme('job_view', $data);
	}
        
        //
        


}