<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	function __construct(){
		parent:: __construct();
		$this->load->model('login');
		$this->load->model('product_model');
		$this->load->model('earning_model');
		$this->load->model('agent_model');
		$this->load->model('user_model');

		check_auth();
	}

	public function index()
	{
		$data['earnings'] = $this->earning_model->totalEarning();
		$data['referralEarnings'] = $this->earning_model->referralEarnings();
		$data['withdrawal'] = $this->earning_model->withdrawal();
		$data['totalInvoice'] = $this->product_model->invoiceListCount();
		$data['totalAgent'] = $this->agent_model->agentListCount();
		$data['totalUser'] = $this->user_model->agentListCount();


		$year = date('Y');

		$querySales = $this->db->query("SELECT MONTHNAME(FROM_UNIXTIME(created_at)) as m,
						sum(invoice.total_price) as amount
						FROM invoice
						WHERE YEAR(FROM_UNIXTIME(created_at)) = {$year}
						GROUP BY MONTH(FROM_UNIXTIME(created_at))");


		//print_r($querySales->num_rows());

		$data['salesGraphJson'] = json_encode($querySales->result_array());

		theme('dashboard', $data);
	}

	/**
	 * Log out now
	 */

	public function logout(){
		$this->login->set_user_offline();
		$this->session->unset_userdata('logged_user'); // unset logged_user
		redirect(base_url());
	}
}
