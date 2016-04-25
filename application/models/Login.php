<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Model {


    /**
     *  Authonication check here
     * @return bool
     */

    public function authonication(){

        $this->load->library('user_agent');

        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $password = sha1($password);

        $credential = [
            'email' => $email,
            'password' => $password,
        ];

        $query = $this->db->get_where('users', $credential);

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $r);

            if($r->active == 0)
            {
                $this->session->set_flashdata('loggedIn_fail', 'Account is not active yet !');
                return false;
            }elseif($r->active == 2){
                $this->session->set_flashdata('loggedIn_fail', 'An error occur with your account !');
                return false;
            }

            /**
             * data for store in session
             */

            $user_data = [
                'email' => $email,
                'user_id' => $r->id,
                'role' => $r->role,
                'logged_in' => true,
            ];

            // set user status = online
            $login_update = [
                'online_status' => 1,
                'user_lastlogin' => time()
            ];
            $this->db->where('id', $r->id)->update('users', $login_update);

            //store login info in session
            $this->session->set_userdata('logged_user', $user_data);

            // insert user agent and ip into log
            $user_agent = $this->agent->agent_string();

            $user_device_info = [
                'user_id' => $r->id,
                'ip' => $_SERVER['REMOTE_ADDR'],
                'device_info' => $user_agent,
                'created_at' => time()
            ];

            $this->db->insert('log', $user_device_info);

            return true;
        } else {
            $this->session->set_flashdata('loggedIn_fail', 'Wrong email or password !');
            return false;
        }
    }


   /**
     * registerUser() method
     *
     * @return bool
     */

    public function registerUser(){

        $this->load->helper('string'); //load string helper

        $row_password   = $this->input->post('password');
        $password       = sha1($row_password);
        $referral_code  = random_string('numeric',6);

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

        $photoName = '';

        //check user is selected photo
        if(isset($_FILES['userfile']))
        {
            if($_FILES['userfile']['name'] != '')
            {
                $upload_dir = './uploads/'; //Upload directory
                if( ! file_exists($upload_dir)) mkdir($upload_dir); //create directory if not found.
                $config['upload_path']          = $upload_dir;
                $config['allowed_types']        = 'gif|jpg|png';
                $config['max_size']             = 2048;
                $config['max_width']            = 1024;
                $config['max_height']           = 768;

                $this->load->library('upload', $config);

                if ( ! $this->upload->do_upload())
                {
                    $error = array('error' => $this->upload->display_errors());
                    $errorData = implode('<br />', $error);
                    $this->session->set_flashdata('errorMsg', $errorData); //set uploading error into flash
                    redirect($_SERVER['HTTP_REFERER']); // redirect with error
                }else
                {
                    $upload_data = $this->upload->data(); //all uploaded data store in variable
                    $photoName = $upload_data['raw_name'].'_thumb'.$upload_data['file_ext'];
                    $fullPhoto = $upload_dir.$upload_data['file_name'];
                    $this->photoResize($fullPhoto); // resize now
                }
            }
        }

        //set all data for inserting into database
        $data = [
            'first_name'        => $this->input->post('first_name'),
            'last_name'         => $this->input->post('last_name'),
            'password'          => $password,
            'row_pass'          => $row_password,
            'email'             => $email,
            'contactno'         => $this->input->post('contactno'),
            'gender'            => $this->input->post('gender'),
            'date_of_birth'     => $this->input->post('date_of_birth'),
            'profession'        => $this->input->post('profession'),
            'street_address'    => $this->input->post('street_address'),
            'country'           => $country->country_name,
            'country_id'        => $country_id,
            'role'              => 'user',
            'active'            => 0,
            'referral_code'     => $referral_code,
            'referredByCode'    => $this->input->post('referredByCode'),
            'photo'             => $photoName,
            'created_by'        => 0,
            'created_at'        => time(),
            'modified_at'       => time()
        ];

        $query = $this->db->insert('users', $data);

        if($query)
        {

            $email_data = [
                'email'     => $email,
                'password'  => $row_password,
            ];

            //send email to new user
            //$settings = get_admin_settings();
            $adminEmail = get_option('default_email');

            $subject = 'Hi '.$data['first_name'].' '. $data['last_name'].', thanks for registration @'.date('d-m-Y h:i a');
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


    public function forgotPassword()
    {

        $email = $this->input->post('email');

        $credential = [
            'email' => $email
        ];

        $query = $this->db->get_where('users', $credential);

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $r);

            $email_data = [
                'email'     => $email,
                'password'  => $r->row_pass,
            ];

            //send email to new user
            //$settings = get_admin_settings();
            $adminEmail = get_option('default_email');

            $subject = 'Hi '.$r->first_name.' '. $r->last_name.', here your login details @'.date('d-m-Y h:i a');
            $this->load->library('email');
            $this->email->set_mailtype("html");
            $this->email->from($adminEmail, get_option('company_name'));
            $this->email->to($email);
            $this->email->cc($adminEmail);
            $this->email->subject($subject);
            $message = $this->load->view('email_template_password',$email_data,TRUE);
            $this->email->message($message);
            $this->email->send();

            $this->session->set_flashdata('successMsg', 'Password has been sent successfully, pleas check your email ');
            return true;
        } else {
            $this->session->set_flashdata('errorMsg', 'Sorry! we found no account associate with this email');
            return false;
        }
    }




    /**
     * @param string $photo
     * Photo Resize
     */

    public function photoResize($photo = ''){
        $config['image_library'] = 'gd2';
        $config['source_image'] = $photo;
        $config['create_thumb'] = TRUE;
        $config['maintain_ratio'] = TRUE;
        $config['width']         = 200;
        $config['height']       = 200;

        $this->load->library('image_lib', $config);
        $this->image_lib->resize();
        unlink($photo); // delete original photo
    }

   /**
     * @return bool
    * set user online status = 0
     */

    public function set_user_offline(){
        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
        $query = $this->db->where('id', $user_id)->update('users', ['online_status' => 0]);
        if($query)
        {
            return true;
        }
        return false;

    }

}