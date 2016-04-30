<?php
/**
 * User: mhshohel
 * Date: 5/1/15
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Initiate helper function
 * theme()
 */

if(! function_exists('theme'))
{
    function theme($view_file = '', $data = []){
        $data['title'] = ucfirst($view_file); //capitalize theme first latter.
        $CI =& get_instance();
        //$CI->load->view('header', $data);
        $CI->load->view($view_file, $data);
        $CI->load->view('footer');
    }
}

/**
 * Check if logged_in
 * if not logged in, redirect to login page
 */

if( ! function_exists('check_auth'))
{
    function check_auth(){
        $CI =& get_instance();

        if( ! $CI->session->userdata('logged_user'))
        {
            $CI->session->set_flashdata('loggedIn_fail', 'You are not permitted !');
            $CI->session->set_userdata('redirect_auth_uri', uri_string());
            redirect(base_url());
        }
    }
}
/**
 *  @return false or Logged in user data;
 */

if( ! function_exists('loggedInUserData'))
{
    function loggedInUserData(){
        $CI =& get_instance();
        if($CI->session->userdata('logged_user'))
        {
            return $CI->session->userdata('logged_user');
        }
        return false;
    }
}

/**
 * if fail admin area due to login case, save fail url
 * @return fail url
 */

if( ! function_exists('redirect_auth_uri'))
{
    function redirect_auth_uri(){
        $CI =& get_instance();
        if($CI->session->userdata('redirect_auth_uri'))
        {
            return $CI->session->userdata('redirect_auth_uri');
        }
    }
}

if( ! function_exists('is_logged_in'))
{
    function is_logged_in($user_label = '')
    {
        $CI =& get_instance();

        if ($CI->session->userdata('logged_user')) {
            return true;
        }
        return false;
    }
}

/**
 * Admin menu link helper
 * It will generate a active class in menu link
 */

if(! function_exists('menu_link'))
{
    function menu_link($link = '', $text){
        $get_link = base_url($link);
        $active = ($get_link == current_url()) ? 'active' : '';
        $link = '<li class="'.$active.'"><a href="'.$get_link.'"><i class="fa fa-angle-double-right"></i>'.$text.'</a></li>';
        return $link;
    }
}

/**
 * Generate Dynamic breadcrumb
 */

if( ! function_exists('breadcrumb'))
{
    function breadcrumb(){
        $CI =& get_instance();
        $segments = $CI->uri->segment_array();
        $total_segments = count($segments);

        $html ='';
        $html .= '<ol class="breadcrumb">';
        $html .= '<li><a href="'.base_url().'"><i class="fa fa-dashboard"></i> Home</a></li>';

        for($i = 1; $i <= $total_segments; $i++)
        {
            if($i <= 2) { // Take only first 2 segments
                if ($i == $total_segments) {
                    $html .= '<li class="active">' . ucfirst($segments[$i]) . '</li>';
                } else {
                    $html .= '<li><a href="' . base_url($segments[$i]) . '"> ' . ucfirst($segments[$i]) . '</a></li>';
                }
            }
        }
        $html .= '</ol>';

        return $html;
    }
}

/**
 * Get Profile by user session ID
 * @return Object
 */

if( ! function_exists('get_profile'))
{
    function get_profile(){
        $CI =& get_instance();
        $user_info = $CI->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
        $query = $CI->db->get_where('users', ['id' => $user_id]);
        foreach($query->result() as $profile);
        return $profile;
    }
}

/**
 * @param int $user_id
 * @return mixed
 */

if( ! function_exists('get_profile_by_id'))
{
    function get_profile_by_id($user_id = 1){
        $CI =& get_instance();
        $query = $CI->db->get_where('users', ['id' => $user_id]);
        if($query->num_rows() > 0)
        {
            foreach($query->result() as $profile);
            return $profile;
        }
        return false;
    }
}


/**
 * @return string
 * customized flashdata helper function
 */

if( ! function_exists('flash_msg'))
{
    function flash_msg(){
        $CI =& get_instance();
        $html = '';
        if($CI->session->flashdata('successMsg'))
        {
            $html .= '<div class="alert alert-success alert-dismissable">
                <i class="fa fa-check"></i>
                <button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>
                <b>Done!</b> '.$CI->session->flashdata('successMsg').'</div>';
        }
        if($CI->session->flashdata('errorMsg'))
        {
            $html .= '<div class="alert alert-danger alert-dismissable">
                <i class="fa fa-check"></i>
                <button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>
                <b>Error!</b> '.$CI->session->flashdata('errorMsg').'</div>';
        }
        return $html;
    }
}

/**
 * Left Admin Menu Li Active
 * @return active or null
 */

if( ! function_exists('menu_li_active'))
{
    function menu_li_active($base_segment = ''){
        $CI =& get_instance();
        if($CI->uri->segment(1) == $base_segment)
        {
            return ' active';
        }
        return '';
    }
}

/**
 * @param string $activity
 * Activity create helper
 * Create an activity for currently logged in user
 */

if( ! function_exists('create_activity'))
{
    function create_activity($activity = '', $user_id = 0){
        $CI =& get_instance();
        $user_info = $CI->session->userdata('logged_user');

        if($user_id == 0) {
            $user_id = $user_info['user_id'];
        }

        $data = [
            'user_id'       => $user_id,
            'activity'      => $activity,
            'created_at'    => time(),
        ];
        if($activity != '')
        {
            $CI->db->insert('activities', $data);
        }
    }
}

/**
 * @param string $user_data_object
 * @return string
 */

if( ! function_exists('user_full_name'))
{

    function user_full_name($user_data_object = ''){
        if($user_data_object == '') return '';
        return $user_data_object->first_name.' '.$user_data_object->last_name;
    }
}

/**
 * @param string $photo_name
 * @param string $email
 * @return string
 * return profile photo url
 * from email or db saved photo
 */

if( ! function_exists('profile_photo_url'))
{
    function profile_photo_url($photo_name = '', $email = 'example@example.com'){
        $url = '';
        if($photo_name != '')
        {
            $url .= base_url('uploads/'.$photo_name);
        }
        elseif($email != '')
        {
            $url .= "http://www.gravatar.com/avatar/" . md5( strtolower( trim( $email ) ) );
        }
        return $url;
    }
}

/**
 * @param int $id
 * @param string $table
 * @param string $column
 * @return bool
 * @return Single row by give table id or false
 */

if( ! function_exists('singleDbTableRow'))
{
    function singleDbTableRow($id = 1, $table = 'users', $column = 'id'){
        $CI =& get_instance();
        $query = $CI->db->get_where($table, [$column => $id ]);
        if($query->num_rows() > 0)
        {
            foreach($query->result() as $row);
            return $row;
        }
        return false;
    }
}

/**
 * @param string $role
 */

if( ! function_exists('permittedArea'))
{
    function permittedArea($permission = ['admin','agents']){

        $authDta = loggedInUserData();
        if( ! in_array($authDta['role'], $permission))
        {
            $CI =& get_instance();

            //show_error('Dude! You are not permitted in this area');
            $CI->session->set_flashdata('errorMsg', 'Dude! You are not permitted in this area');
            redirect(base_url('dashboard'));
        }
    }
}

/**
 * @param int $limit
 * Get Activity list
 * Limit number as Parameter
 */


if( ! function_exists('get_activity'))
{
    function get_activity($limit = 10){
        $authDta = loggedInUserData();
        $user_id = $authDta['user_id'];
        $CI =& get_instance();

        $query = $CI->db->order_by('id', 'desc')->get_where('activities', ['user_id' => $user_id]);
        if($query->num_rows() > 0){

        }
    }
}

/**
 * @return bool
 */
if( ! function_exists('get_admin_settings')){

    function get_admin_settings(){
        $CI =& get_instance();
        $query = $CI->db->order_by('id','desc')->get('admin_settings', 1);
        if($query->num_rows() > 0){
            foreach($query->result() as $row);
            return $row;
        }
        return false;
    }
}


/**
 * Credit
 */
if( ! function_exists('creditsMhs')) {
    function creditsMhs() {
        $html = '<p style="position: absolute; bottom: 0; padding: 0 10px;">
<!--Powered by: <a href="https://www.facebook.com/mhcode" target="_blank" title="Software Company" data-toggle="tooltip"> MhCode </a>-->
Version: 1.5
</p>';
        echo $html;
    }
}

/**
 * Return percent base on amount
 *
 * @param int $amount
 * @param int $percent
 * @return float
 */

if( ! function_exists('get_percent')) {
    function get_percent($amount = 0, $percent = 0)
    {
        $calculate = ($amount / 100) * $percent;
        return $calculate;
    }
}

/**
 * @param string $key
 * @param string $message
 */

if( ! function_exists('setFlashGoBack')) {
    function setFlashGoBack($key = 'successMsg', $message = '')
    {
        $CI =& get_instance();
        $CI->session->set_flashdata($key, $message); //set uploading error into flash
        redirect($_SERVER['HTTP_REFERER']); // redirect with error
    }
}

/**
 * @param int $number
 * @param int $decimalPlace
 * @return int|string
 */

if( ! function_exists('amountFormat')) {
    function amountFormat($number = 0, $decimalPlace = 2)
    {
        $default_currency = get_option('default_currency');
        $number = ($number != 0) ? $default_currency.number_format($number, $decimalPlace) : $default_currency.'0.00';
        return $number;
    }
}

/**
 * @param string $option
 * @param string $default_value
 * @return string
 *
 * return pre-defined or new Option and its value
 */

if( ! function_exists('get_option')) {

    function get_option($option = '', $default_value = '')
    {
        $CI =& get_instance();
        if($option != '')
        {
            $query = $CI->db->get_where('options', ['option' => $option]);

            if($query->num_rows() > 0)
            {
                foreach($query->result() as $r);
                return $r->value;
            }else
            {
                $CI->db->insert('options', ['option' => $option, 'value' => $default_value]);
                return $default_value;
            }

        }
        return $option;
    }
}