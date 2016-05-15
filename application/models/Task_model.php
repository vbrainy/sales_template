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
            'added_by'=> $user_id,
            'assign_to' => $this->input->post('assign_to'),
            'agent_area' => $this->input->post('city'),
            'unique_name' =>    $this->taskUniqueName(),
            'created_at'        => time(),
            'status'       =>0
        ];

       $query = $this->db->insert('tasks', $data);
       
       $insert_id = $this->db->insert_id();

        if($query)
        { 
            create_activity('Added '.$data['title'] .' as task'); //create an activity

            return $insert_id;
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
            'assign_to' => $this->input->post('assign_to'),
            'agent_area' => $this->input->post('city'),
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
//    public function getTaskClearName($name){
//        $tempName = explode('-', $name);
//        return $tempName[0].'-'.$tempName[1].$tempName[2];
//    }


    //Generate task unique name
    public function taskUniqueName(){
        $query = $this->db->order_by('id', 'desc')->select('tasks.*')->get_where('tasks');
        $lastTask = $query->result_array();
        $taskIdArr=[];
        if(isset($lastTask[0]['unique_name']))
        {
            $taskIdArr = explode('-', $lastTask[0]['unique_name']);
        }
        $lastMonth = date('M', strtotime(" -1 month"));
        $currMonth = date('M');
        if(isset($taskIdArr[1]) && $taskIdArr[1] == $currMonth)
        {
            return ($this->tasksListCount()+1)."-".date('M')."-".date('y');
        }
        else
        {
            return '1'."-".date('M')."-".date('y');
        }
    }
    /**
     * @return Agent List
     * Agent List Query
     */

    public function tasksListCount(){
        $query = $this->db->count_all_results('tasks');
        return $query;
    }
    
    public function tasksArchivedListCount(){
        $query = $this->db->where('status!=2')->count_all_results('tasks');
        return $query;
    }
    
    

    public function tasksArchivedList($limit = 0, $start = 0, $dateFilter, $status){
        $where = "status=2";
        $query   = $this->db->where($where)->order_by('tasks.id', 'desc')->limit($limit, $start)->select('tasks.*, users.first_name, users.last_name, users.city')->join('users', 'tasks.assign_to = users.id', 'left')->get_where('tasks');
        return $query;
    }
    

    public function tasksList($limit = 0, $start = 0, $dateFilter, $status){
        $where = "status!=2";

        if(is_array($dateFilter) && isset($dateFilter[0]) && isset($dateFilter[2]))
        {
            if(!empty($where))
            {
                $where .= " AND ";
            }
            $where .= "FROM_UNIXTIME(tasks.created_at, '%Y-%m-%d') BETWEEN "."'".$dateFilter[0] ."'"." AND ". "'".$dateFilter[2]."'";
        }
        if($status == 0)
        {
            if(!empty($where))
            {
                $where .= " AND ";
            }
            $where .= "status=".$status;
        }

        if(empty($where))
        {
            $query   = $this->db->order_by('tasks.id', 'desc')->limit($limit, $start)->select('tasks.*, users.first_name, users.last_name, users.city')->join('users', 'tasks.assign_to = users.id', 'left')->get_where('tasks');
        }
        else
        {
            $query   = $this->db->where($where)->order_by('tasks.id', 'desc')->limit($limit, $start)->select('tasks.*, users.first_name, users.last_name, users.city')->join('users', 'tasks.assign_to = users.id', 'left')->get_where('tasks');
        }
        
        
        //echo $query;exit;
        return $query;
    }
    
    public function agentTasksListCount($agentId){
        $query = $this->db->where('assign_to', $agentId)->count_all_results('tasks');
        return $query;
    }

    public function agentTasksList($limit = 0, $start = 0, $agentId){

        $query   = $this->db->where('assign_to', $agentId)->limit($limit, $start)->select('tasks.*')->get_where('tasks');
        // $query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get_where('tasks');

        return $query;
    }
    
    
    
    
    public function getmytaskByid(){
        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
       
          $query = $this->db->where('assign_to',$user_id)->get_where('tasks');
         
        return $query->result();
        


        
    }
    
    
    
}