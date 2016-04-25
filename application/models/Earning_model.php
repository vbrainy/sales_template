<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Earning_model extends CI_Model {


  /**
     * @return Agent List
     * Agent List Query
     */

    public function earningListCount(){
        $user = loggedInUserData();
        $userID = $user['user_id'];

        //Get Decision who in online?
        if($user['role'] == 'admin')
        {
            $query = $this->db->where('income_for', 'admin')->count_all_results('earnings');
        }
        else{
            $query = $this->db->where('user_id',$userID)->count_all_results('earnings');
        }

        return $query;
    }


    public function singleUserEarningCount($userID = 0){

        $query = $this->db->where('user_id',$userID)->count_all_results('earnings');

        return $query;
    }
    /**
     * @return mixed
     * Get Total Earning
     */


    public function totalEarning(){
        $user = loggedInUserData();
        $userID = $user['user_id'];

        //Get Decision who in online?
        if($user['role'] == 'admin')
        {
            $query = $this->db->select_sum('amount')->where('income_for', 'admin')->get('earnings');
        }
        else
        {
            $query = $this->db->select_sum('amount')->get_where('earnings', ['user_id' => $userID]);
        }

        return $query;
    }

    /**
     * @return mixed
     * Get referral Earnings through this method
     */

    public function referralEarnings($userID = 0){
        $user = loggedInUserData();

        if($userID == 0) {
            $userID = $user['user_id'];
        }

        $query = $this->db->select_sum('amount')->get_where('earnings', ['income_for' => 'referralUser', 'user_id' => $userID]);

        return $query;
    }


    /**
     * @return bool
     * @return payment ID
     * pay agent, admin or user
     */


    public function make_payment(){
        $customer_referral_id = $this->input->post('payee_referralCode');
        $customer_info = singleDbTableRow($customer_referral_id, 'users', 'referral_code');

        //Redirect if user/customer not found..

        if( ! $customer_info)
        {
            //set error message and go back
            setFlashGoBack('errorMsg', 'Client Not Found!');
        }

        $customer_id = $customer_info->id;

        //Get ID From currently logged in User
        //this used by pay_by
        $sales_by = $this->session->userdata('logged_user')['user_id'];

        $amount 			= $this->input->post('amount');

        $paymentData = [
            'payee_id'              => $customer_id,
            'payee_referralCode'    => $customer_referral_id,
            'amount'                => $amount,
            'pay_by'                => $sales_by,
            'pay_for'                => $customer_info->role,
            'status'                => 'approved',
            'created_at'            => time(),
            'modified_at'           => time(),
        ];

        $insertPayment = $this->db->insert('payment', $paymentData);
        $payment_id = $this->db->insert_id();

        //Determine if invoice insert success
        if($insertPayment)
        {
            //Create activity for withdraw and make payment
            create_activity('have made a '.$amount.' amount payment for '.user_full_name($customer_info));
            create_activity('have withdraw '.$amount.' amount ', $customer_id);

            return $payment_id;
        }
        else{
            return false;
        }

    }


    public function withdrawal($userID = 0){
        $user = loggedInUserData();

        if($userID == 0) {
            $userID = $user['user_id'];
        }

        $query = $this->db->select_sum('amount')->get_where('payment', ['payee_id' => $userID]);

        return $query;
    }


    /**
     * @param int $userID
     * @return mixed
     * get single total earning info
     */

    public function singleTotalEarning($userID = 0){

        $userInfo = singleDbTableRow($userID);
        $query = $this->db->select_sum('amount')->get_where('earnings', ['user_id' => $userID]);

        return $query;
    }



    public function withdrawCount(){
        $user = loggedInUserData();
        $userID = $user['user_id'];

        //Get Decision who in online?
        if($user['role'] == 'admin')
        {
            $query = $this->db->where('pay_for', 'admin')->count_all_results('payment');
        }
        else{
            $query = $this->db->where('payee_id', $userID)->count_all_results('payment');
        }

        return $query;
    }




}