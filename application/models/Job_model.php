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
            'unique_name'    => $this->input->post('unique_name'),
            'geo_location'   => $this->input->post('geo_location'),
            'total_price'    => $this->input->post('total_price'),
            'desc1'          => $this->input->post('desc1'),
            'price1'         =>$this->input->post('price1'),
            'desc2' => $this->input->post('desc2'),
            'price2' => $this->input->post('price2'),
            'desc3' => $this->input->post('desc3'),
            'price3' =>$this->input->post('price3'),
            'desc4' => $this->input->post('desc4'),
            'price4' => $this->input->post('price4'),
            'desc5' => $this->input->post('desc5'),
            'price5' =>$this->input->post('price5'),
            'desc6' => $this->input->post('desc6'),
            'price6' => $this->input->post('price6'),
            'desc7' => $this->input->post('desc7'),
            'price7' =>$this->input->post('price7'),
            'desc8' => $this->input->post('desc8'),
            'price8' => $this->input->post('price8'),
            'desc9' => $this->input->post('desc9'),
            'price9' => $this->input->post('price9'),
            'desc10' => $this->input->post('desc10'),
            'price10' =>$this->input->post('price10'),
            'job_at_shop' =>$this->input->post('job_at_shop'),
            'job_add1' => $this->input->post('job_add1'),
            'job_add2' => $this->input->post('job_add2'),
            'city' => $this->input->post('city'),
            'postcode' => $this->input->post('postcode'),
            'phone' => $this->input->post('mobile'),
            'description' => $this->input->post('description'),
            'total_price' => $this->input->post('total_price'),
            'created_at' => time(),
            'modified_at' => time()
            
            
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
        return "job-".($this->jobsListCount($task_id)+1).date('M Y');
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
            'task_id' => $insertedTaskid,
            'unique_name' => "job-" . ($this->jobsListCount($insertedTaskid) + 1).date('M Y'),
            'shop_nameplate' => $postData->shop_nameplate,
            'geo_location' => $postData->geo_location,
            'total_price' => $postData->total_price,
            'desc1' => $postData->desc1,
            'price1' => $postData->price1,
            'desc2' => $postData->desc2,
            'price2' => $postData->price2,
            'desc3' => $postData->desc3,
            'price3' => $postData->price3,
            'desc4' => $postData->desc4,
            'price4' => $postData->price4,
            'desc5' => $postData->desc5,
            'price5' => $postData->price5,
            'desc6' => $postData->desc6,
            'price6' => $postData->price6,
            'desc7' => $postData->desc7,
            'price7' => $postData->price7,
            'desc8' => $postData->desc8,
            'price8' => $postData->price8,
            'desc9' => $postData->desc9,
            'price9' => $postData->price9,
            'desc10' => $postData->desc10,
            'price10' => $postData->price10,
            'job_at_shop' => $postData->job_at_shop,
            'job_add1' => $postData->job_add1,
            'job_add2' => $postData->job_add2,
            'city' => $postData->city,
            'postcode' => $postData->postcode,
            'phone' => $postData->mobile,
            'description' => $postData->description,
            'total_price' => $postData->total_price,
            'created_at' => time(),
            'modified_at' => time()
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