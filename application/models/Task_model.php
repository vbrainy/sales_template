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
     * @return Agent List
     * Agent List Query
     */

    public function tasksListCount(){
        $query = $this->db->count_all_results('tasks');
        return $query;
    }

    public function tasksList($limit = 0, $start = 0){
        $query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get_where('tasks');
        return $query;
    }
    
    
}