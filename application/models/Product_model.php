<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_model extends CI_Model {

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


  /**
     * Product sell method
     * insert invoice, individual product
    * @return bool
     */


    public function sell(){

        $c_id = $this->input->post('customerID');
        $customer_info = singleDbTableRow($c_id);

        //Redirect if user/customer not found..

        if( ! $customer_info)
        {
            //set error message and go back
            setFlashGoBack('errorMsg', 'Client Not Found!');
        }

        //get customer referral Code
        $customer_referral_id = $customer_info->referral_code;

        $customer_id = $customer_info->id;

        //$referral_id = singleDbTableRow($customer_info->referredByCode, 'users', 'referral_code')->id;

        //Get ID From currently logged in User
        $sales_by = $this->session->userdata('logged_user')['user_id'];


        $qty 			= $this->input->post('qty');
        $productName 	= $this->input->post('productName');
        $categories 	= $this->input->post('categories');
        $itemPrice 		= $this->input->post('price');

        $totalProduct = count($qty);

        $invoiceData = [
            'total_product'         => $totalProduct,
            'customer_id'           => $customer_id,
            'customer_referral_id'  => $customer_referral_id,
            'sales_by'              => $sales_by,
            'created_at'            => time(),
            'modified_at'           => time(),
        ];

        $insertInvoice = $this->db->insert('invoice', $invoiceData);

        $invoice_id = $this->db->insert_id();

        // Get Each sales Item and insert to sales_item table

        $HTMLrow = '';

        for($i = 0; $i < $totalProduct; $i++){

            $quantity = $qty[$i];

            $categoryID = $categories[$i];
            $product_name = $productName[$i];
            $price = $itemPrice[$i] * $quantity;
            $total_price[] = $price;

            $categoryCommission = singleDbTableRow($categoryID, 'categories')->commission_percent;

            // Get commission base on category
            $commission         = get_percent($price, $categoryCommission);
            $commissionArray[]  = $commission;

            $sales_itemData = [
                'category_id'   => $categoryID,
                'product_name'  => $product_name,
                'invoice_id'    => $invoice_id,
                'qty'           => $quantity,
                'item_price'    => $itemPrice[$i],
                'price'         => $price,
                'commission'    => $commission,
                'created_at'    => time(),
                'modified_at'   => time(),
            ];

            $sales_itemInsert = $this->db->insert('sales_item', $sales_itemData);

            //HTML For Email
            $HTMLrow .= '<tr>
                        <td style="padding:5px;text-align:center;">'.$i.'</td>
                        <td style="padding:5px;text-align:center;">'.$product_name.'</td>
                        <td style="padding:5px;text-align:center;">'.$itemPrice[$i].'</td>
                        <td style="padding:5px;text-align:center;">'.$quantity.'</td>
                        <td style="padding:5px;text-align:center;">'.$price.'</td>
                    </tr>';


        }

        //Calculate Commission for Admin, agent, and customer
        $totalCommission = array_sum($commissionArray);
        $total_price = array_sum($total_price);

        //Update Total Price in Invoice
        $this->db->where('id', $invoice_id)->update('invoice', ['total_price' => $total_price]);
        //Create activity about sell product
        create_activity('sell out product, amount : '. $total_price);

        //$settings = get_admin_settings();

        $agent_commision    = get_percent($totalCommission, get_option('agent_commision'));
        $user_commision     = get_percent($totalCommission, get_option('user_commision'));
        $referral_commision = get_percent($totalCommission, get_option('referral_commision'));
        $admin_commision    = get_percent($totalCommission, get_option('admin_commision'));

        // Insert data for Agent Earning

        $agentEarning = [
            'user_id'       => $sales_by,
            'amount'        => $agent_commision,
            'invoice_id'    => $invoice_id,
            'income_type'   => 'onSales',
            'income_for'    => 'agent',
            'created_at'    => time(),
            'modified_at'   => time(),
        ];

        $this->db->insert('earnings', $agentEarning);

        // Insert data for User Earning

        $userEarning = [
            'user_id'       => $customer_id,
            'amount'        => $user_commision,
            'invoice_id'    => $invoice_id,
            'income_type'   => 'onPurchase',
            'income_for'    => 'user', //client
            'created_at'    => time(),
            'modified_at'   => time(),
        ];

        $this->db->insert('earnings', $userEarning);

        // Insert data for Admin Earning

        $adminEarning = [
            'user_id'       => 1,
            'amount'        => $admin_commision,
            'invoice_id'    => $invoice_id,
            'income_type'   => 'admin',
            'income_for'    => 'admin', //client
            'created_at'    => time(),
            'modified_at'   => time(),
        ];

        $this->db->insert('earnings', $adminEarning);

        // Insert data for referral for This Customer

        $referralEarning = [
            'user_id'       => $c_id,
            'amount'        => $referral_commision,
            'invoice_id'    => $invoice_id,
            'income_type'   => 'referral',
            'income_for'    => 'referralUser', //client
            'created_at'    => time(),
            'modified_at'   => time(),
        ];

        $this->db->insert('earnings', $referralEarning);


        //Determine if invoice insert success
        if($insertInvoice)
        {

           /**
                     * Send Email to customer Now
                     */



            $HTMLrow .= '<tr>
                        <td style="padding:5px;text-align:center;" colspan="4">Total Price</td>
                        <td style="padding:5px;text-align:center;">'.$total_price.'</td>
                    </tr>';

            $email_data = [
                'userData'     => $customer_info,
                'tableRow'      => $HTMLrow
            ];

            //send email to new user
            //$settings = get_admin_settings();
            $adminEmail = get_option('default_email');
            $subject = 'Hi '.user_full_name($customer_info).', your order details @'.date('d-m-Y h:i a');
            $this->load->library('email');
            $this->email->set_mailtype("html");
            $this->email->from($adminEmail, get_option('company_name'));
            $this->email->to($customer_info->email);
            $this->email->cc($adminEmail);
            $this->email->subject($subject);
            $message = $this->load->view('product_sell_email_tpl',$email_data,TRUE);
            $this->email->message($message);
            $this->email->send();
            //Email END:



            return $invoice_id;
        }
        else{
            return false;
        }

    }

    /**
     * @return mixed
     */

    public function invoiceListCount(){
        $user = loggedInUserData();
        $userID = $user['user_id'];
        //Get Decision who in online?
        if($user['role'] == 'admin')
        {
            $query = $this->db->count_all_results('invoice');
        }
        elseif($user['role'] == 'agent'){
            $query = $this->db->where('sales_by', $userID)->count_all_results('invoice');
        }
        elseif($user['role'] == 'user'){
            $query = $this->db->where('customer_id', $userID)->count_all_results('invoice');
        }

        return $query;
    }

    /**
     * @param int $id
     * @return mixed
     * Get invoice details
     *
     */

    public function getInvoiceDetails($id = 0){

        $query = $this->db->query("select invoice.*, users.first_name as userFirstName,
				users.last_name as userLastName,
				users.contactno as userContactNo, users.email as userEmail,
				users.street_address as userStreetAddress,

				agent.first_name as agentFirstName, agent.last_name as agentLastName,
				agent.contactno as agentContactNo, agent.email as agentEmail,
				agent.street_address as agentStreetAddress
				from invoice LEFT JOIN users
				ON invoice.customer_id = users.id
				LEFT JOIN users AS agent ON invoice.sales_by = agent.id WHERE invoice.id = {$id}");

        return $query;
    }

    /**
     * @param int $id
     * @return mixed
     * return all sales item by invoice id with category name
     */

    public function getAllItemByInvoice($id = 0){
        //$query = $this->db->get_where('sales_item', ['invoice_id' => $id]);

        $query = $this->db->query("select sales_item.*, categories.name as categoryName
                from sales_item LEFT JOIN categories
                ON sales_item.category_id = categories.id
                WHERE sales_item.invoice_id = {$id}");
        return $query;
    }





}