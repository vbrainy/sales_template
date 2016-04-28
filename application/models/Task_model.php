<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Task_model extends CI_Model {


public function add_task(){

        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];

        $this->load->helper('string'); //load string helper

        $title = $this->input->post('title');
        
        
        //set all data for inserting into database
        $data = [
            'title'        => $this->input->post('title'),
            'assign_to' => $this->input->post('assign_to'),
            'unique_name' =>    $this->taskUniqueName(),
            'created_at'        => time(),
            'modified_at'       => time()
        ];

       $query = $this->db->insert('tasks', $data);

        if($query)
        {
            create_activity('Added '.$data['title'] .' as task'); //create an activity

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
    public function taskUniqueName(){
        return "Task-".($this->tasksListCount()+1);
    }
    /**
     * @return Agent List
     * Agent List Query
     */

    public function tasksListCount(){
        $query = $this->db->count_all_results('tasks');
        return $query;
    }

    public function tasksList($limit = 0, $start = 0){
       // $query1 =  $this->db->;
        $query   = $this->db->order_by('email', 'desc')->limit($limit, $start)->join('agents', 'tasks.assign_to = agents.id', 'left')->get_where('tasks');
    
        return $query;
    }
    
    
}