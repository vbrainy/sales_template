<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Job_model extends CI_Model {


public function add_job(){

        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];

        $this->load->helper('string'); //load string helper

        $title = $this->input->post('title');
        
        
        //set all data for inserting into database
        $data = [
            'task_id'        => $this->input->post('task_id'),
            'unique_name'        => $this->input->post('unique_name'),
            'job_at_shop'        => $this->input->post('job_at_shop'),
            'job_add1'        => $this->input->post('job_add1'),
            'job_add2'        => $this->input->post('job_add2'),
            'city'        => $this->input->post('city'),
            'postcode'        => $this->input->post('postcode'),
            'phone'        => $this->input->post('mobile'),
            'description'        => $this->input->post('description'),
            'total_price'        => $this->input->post('total_price'),
            'created_at'        => time(),
            'modified_at'       => time()
        ];
        //print_r($data);exit;
       $query = $this->db->insert('jobs', $data);

        if($query)
        {
            create_activity('Added '.$data['unique_name'] .' as job'); //create an activity

            return true;
        }
        return false;

    }
    
       /**
     * @param $id
     * @return bool
     * Update Category
     */


    public function edit_task($id){

        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];

        //set all data for inserting into database
        $data = [
            'title'         => $this->input->post('title'),
            'modified_at'           => time()
        ];

        $query = $this->db->where('id', $id)->update('tasks', $data);

        if($query)
        {
            create_activity('Updated '.$data['title'].' Task'); //create an activity
            return true;
        }
        return false;

    }



    //Generate task unique name
    public function jobUniqueName($task_id){
        return "job-".($this->jobsListCount($task_id)+1);
    }
    /**
     * @return Agent List
     * Agent List Query
     */

    public function jobsListCount($task_id){
        $query = $this->db->where('task_id', $task_id)->count_all_results('jobs');
        return $query;
    }

    public function jobsList($limit = 0, $start = 0, $task_id){
        $query = $this->db->where('task_id', $task_id)->order_by('id', 'desc')->limit($limit, $start)->get_where('jobs');
        return $query;
    }
    
    
   public function singleJobTableRow($id = 1, $table = 'jobs', $column = 'task_id'){
        $CI =& get_instance();
        $query = $CI->db->get_where($table, [$column => $id ]);
        if($query->num_rows() > 0)
        {
            foreach($query->result() as $row);
            return $row;
        }
        return false;
    }
    
    public function copy_job($postData,$insertedTaskid){

        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];

        $this->load->helper('string'); //load string helper

        $title = $this->input->post('title');
        
       
        //set all data for inserting into database
        $data = [
            'task_id'        => $insertedTaskid,
            'unique_name'        =>$postData->unique_name,
            'job_at_shop'        => $postData->job_at_shop,
            'job_add1'        => $postData->job_add1,
            'job_add2'        => $postData->job_add2,
            'city'        => $postData->city,
            'postcode'        => $postData->postcode,
            'phone'        => $postData->mobile,
            'description'        => $postData->description,
            'total_price'        => $postData->total_price,
            'created_at'        => time(),
            'modified_at'       => time()
        ];
        //print_r($data);exit;
       $query = $this->db->insert('jobs', $data);

        if($query)
        {
            create_activity('Added '.$data['unique_name'] .' as job'); //create an activity

            return true;
        }
        return false;

    }


    
    
}