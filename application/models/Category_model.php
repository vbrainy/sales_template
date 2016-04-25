<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category_model extends CI_Model {

    /**
     * @return bool
     */

    public function add_category(){

        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];

        //set all data for inserting into database
        $data = [
            'name'         => $this->input->post('category_name'),
            'commission_percent'    => $this->input->post('commission_percent'),
            'added_by'              => $user_id,
            'created_at'            => time(),
            'modified_at'           => time()
        ];

       $query = $this->db->insert('categories', $data);

        if($query)
        {
            create_activity('Added '.$data['name'].' Category'); //create an activity
            return true;
        }
        return false;

    }


   /**
     * @param $id
     * @return bool
     * Update Category
     */


    public function edit_category($id){

        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];

        //set all data for inserting into database
        $data = [
            'name'         => $this->input->post('category_name'),
            'commission_percent'    => $this->input->post('commission_percent'),
            'added_by'              => $user_id,
            'created_at'            => time(),
            'modified_at'           => time()
        ];

        $query = $this->db->where('id', $id)->update('categories', $data);

        if($query)
        {
            create_activity('Updated '.$data['name'].' Category'); //create an activity
            return true;
        }
        return false;

    }





  /**
     * @return Agent List
     * Agent List Query
     */

    public function categoryListCount(){
        $query = $this->db->count_all_results('categories');
        return $query;
    }

    public function categoryList($limit = 0, $start = 0){
        $query = $this->db->order_by('id', 'desc')->limit($limit, $start)->join('users', 'users.id = categories.added_by')->get('categories');
        return $query;
    }



}