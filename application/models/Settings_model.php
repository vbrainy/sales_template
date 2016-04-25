<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings_model extends CI_Model {

    /**
     * @return default admin data...
     */

    public function adminSettings(){
        $query = $this->db->order_by('id','desc')->get('admin_settings', 1);
        return $query;
    }

    /**
     * Insert Settings Every Time
     */

    public function updateSettings(){
        $userInfo = loggedInUserData();
        $user_id = $userInfo['user_id'];

/*        $data = [
            'company_name' =>  $this->input->post('company_name'),
            'default_email' =>  $this->input->post('default_email'),
            'contact_address' =>  $this->input->post('contact_address'),
            'agent_commision' =>  $this->input->post('agent_commision'),
            'user_commision' =>  $this->input->post('user_commision'),
            'referral_commision' =>  $this->input->post('referral_commision'),
            'admin_commision' =>  $this->input->post('admin_commision'),
            'updated_by' =>  $user_id,
            'updated_at' =>  time(),
        ];

        if($this->db->insert('admin_settings', $data))
        {
            create_activity('Updated admin settings');
            $this->session->set_flashdata('successMsg', 'Settings updated');
            redirect($_SERVER['HTTP_REFERER']);
        }*/

       $data = array_diff_key($this->input->post(), ['_wysihtml5_mode', 'update']);

        foreach($data as $key => $value)
        {
            $this->db->where('option', $key)->update('options', ['value' => $value]);
        }

        create_activity('Updated admin settings');
        $this->session->set_flashdata('successMsg', 'Settings updated');
        redirect($_SERVER['HTTP_REFERER']);

    }

    public function addAdmin(){
        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];

        $this->load->helper('string'); //load string helper

        $row_password   = $this->input->post('password');
        $password       = sha1($row_password);
        $referral_code  = strtoupper(random_string());



        //check unique $referral_code

        $getReferral = $this->db->get_where('users', ['referral_code'=> $referral_code]);
        if($getReferral -> num_rows() > 0)
        {
            for($i= 0; $getReferral -> num_rows() > 0; $i++){
                $referral_code  = strtoupper(random_string());
                $getReferral = $this->db->get_where('users', ['referral_code'=> $referral_code]);
            }
        }

        $email = $this->input->post('email');
        $country_id = $this->input->post('country');
        // get country name
        $country_query = $this->db->get_where('countries', ['id' => $country_id]);
        foreach($country_query->result() as $country);

        //set all data for inserting into database
        $data = [
            'first_name'        => $this->input->post('first_name'),
            'last_name'         => $this->input->post('last_name'),
            'password'          => $password,
            'email'             => $email,
            'gender'            => $this->input->post('gender'),
            'country'           => $country->country_name,
            'country_id'        => $country_id,
            'role'              => 'admin',
            'active'            => 1,
            'referral_code'     => $referral_code,
            'created_by'        => $user_id,
            'created_at'        => time(),
            'modified_at'       => time()
        ];

        $query = $this->db->insert('users', $data);

        if($query)
        {
            create_activity('Added '.$data['first_name'].' '. $data['last_name'].' as admin'); //create an activity

            $email_data = [
                'email'  => $email,
                'password'  => $row_password,
            ];

            //send email to new user
            //$settings = get_admin_settings();
            $adminEmail = get_option('default_email');
            $subject = 'Congratulation '.$data['first_name'].' '. $data['last_name'];
            $this->load->library('email');
            $this->email->set_mailtype("html");
            $this->email->from($adminEmail, get_option('company_name'));
            $this->email->to($email);
            $this->email->cc($adminEmail);
            $this->email->subject($subject);
            $message = $this->load->view('email_template_password',$email_data,TRUE);
            $this->email->message($message);
            $this->email->send();

            return true;
        }
        return false;
    }

    public function adminSettingsLog(){
       // $query = $this->db->order_by('id', 'DESC')->join('users', 'comments.id = blogs.id')->get('admin_settings');
        $query = $this->db->query("select admin_settings.*, users.first_name, users.last_name
                from admin_settings
                LEFT JOIN users
                on admin_settings.updated_by = users.id
                ORDER BY admin_settings.id DESC ");

        return $query;
    }



}