<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {

	function __construct(){
		parent:: __construct();
		$this->load->model('product_model');

		check_auth(); //check is logged in.
	}

	/**
	 * Listing all product
	 */

	public function index()
	{
		//restricted this area, only for admin
		//permittedArea();

		theme('all_invoice');
	}

	//FIXME Adding product

	/**
	 * Product NEw Sell page
	 */

	public function new_product_sell(){
		//restricted this area, only for admin
		permittedArea(['admin', 'agent']);

		//Get Decision who in online?
		$user = loggedInUserData();
		$userID = $user['user_id'];

		if($user['role'] == 'admin')
		{
			$data['users'] = $this->db->order_by('id', 'desc')->get_where('users', ['role' => 'agent']);
		}
		else
		{
			$data['users'] = $this->db->where('created_by', $userID)->order_by('id', 'desc')->get_where('users', ['role' => 'agent']);
		}


		$data['category'] = $this->db->order_by('name', 'asc')->get('categories');

		if($this->input->post()) {
			if ($this->input->post('submit') != 'add_new_sell') die('Error! sorry');

			$sellProduct = $this->product_model->sell();
			if($sellProduct){
				redirect(base_url('product/invoice/'.$sellProduct));
			}
			else{
				setFlashGoBack('errorMsg', 'Something went wrong! please try again later.');
			}

			//print_r($this->input->post());
		}

			theme('new_product_sell', $data);
	}


	/**
	 * Get validate customer ID
	 */

	public function validateCustomerCodeApi(){
		$customerID = $this->input->post('customerID');
		$query = $this->db->get_where('users', ['id' => $customerID]);
		if($query->num_rows() > 0)
		{
			foreach($query->result() as $r);
			$data['status'] 		= 'true';
			$data['customerName']	= $r->first_name.' '.$r->last_name;
			$data['customerAddress']	= nl2br($r->street_address);
			$data['customerAddress']	.= '<br />Contact No : '.$r->contactno ;
			$data['customerAddress']	.= ($r->passport_no != '') ?
										'<br /> Passport No : '. $r->passport_no :
										'<br /> NID Card No : '. $r->national_id;
		}
		else{
			$data['status'] 			= 'false';
			$data['customerName']		= '';
			$data['customerAddress']	= '';
		}

		echo json_encode($data);
	}


	/**
	 * All invoice
	 * @invoice list
	 */

	public function all_invoice(){
		//theme('all_invoice');
	}




	/**
	 * @invoiceListJson from db
	 * @return Json format
	 * usable only via API
	 */

	public function invoiceListJson(){

		$user = loggedInUserData();
		$userID = $user['user_id'];


		$limit = $this->input->get('length');
		$start = $this->input->get('start');

		$search = $this->input->get('search');
		$searchValue = $search['value'];

		$searchByID = '';


		$queryCount = $this->product_model->invoiceListCount();


		//Get Decision who in online?
		if($user['role'] == 'admin')
		{
			if($searchValue != '')
			{
				$searchByID = " WHERE invoice.id = '{$searchValue}'";
			}

			$query = $this->db->query("select invoice.*, users.first_name as userFirstName,
				users.last_name as userLastName, users.street_address as userStreetAddress,
				agent.first_name as agentFirstName, agent.last_name as agentLastName,
				agent.street_address as agentStreetAddress
				from invoice LEFT JOIN users
				ON invoice.customer_id = users.id
				LEFT JOIN users AS agent ON invoice.sales_by = agent.id
				{$searchByID}
				ORDER BY invoice.id DESC Limit {$start}, {$limit}");
		}
		elseif($user['role'] == 'agent')
		{

			if($searchValue != '')
			{
				$searchByID = " AND invoice.id = '{$searchValue}'";
			}

			$query = $this->db->query("select invoice.*, users.first_name as userFirstName,
				users.last_name as userLastName, users.street_address as userStreetAddress,
				agent.first_name as agentFirstName, agent.last_name as agentLastName,
				agent.street_address as agentStreetAddress
				from invoice LEFT JOIN users
				ON invoice.customer_id = users.id
				LEFT JOIN users AS agent ON invoice.sales_by = agent.id
				WHERE invoice.sales_by = {$userID}  {$searchByID}
				ORDER BY invoice.id DESC Limit {$start}, {$limit}");

		}
		elseif($user['role'] == 'user')
		{
			if($searchValue != '')
			{
				$searchByID = " AND invoice.id = '{$searchValue}'";
			}

			$query = $this->db->query("select invoice.*, users.first_name as userFirstName,
				users.last_name as userLastName, users.street_address as userStreetAddress,
				agent.first_name as agentFirstName, agent.last_name as agentLastName,
				agent.street_address as agentStreetAddress
				from invoice LEFT JOIN users
				ON invoice.customer_id = users.id
				LEFT JOIN users AS agent ON invoice.sales_by = agent.id
				WHERE invoice.sales_by = {$userID}  {$searchByID}
				ORDER BY invoice.id DESC Limit {$start}, {$limit}");
		}


		$draw = $this->input->get('draw');

		$data = [];
		$data['draw'] = $draw;
		$data['recordsTotal'] = $queryCount;
		$data['recordsFiltered'] = $queryCount;


		if($query -> num_rows() > 0) {
			foreach ($query->result() as $r) {

				//Action Button
				$button = '';
				$button .= '<a class="btn btn-info editBtn"  href="' . base_url('product/invoice/' . $r->id) . '" data-toggle="tooltip" title="View">
						<i class="fa fa-eye"></i> </a>
						 <a href="'.base_url('product/pdf_invoice/'.$r->id).'" class="btn btn-primary" ><i class="fa fa-file-pdf-o"></i> </a>
						';

				$data['data'][] = array(
					$r->id,
					$r->userFirstName . ' ' . $r->userLastName,
					$r->total_product,
					$r->total_price,
					$r->agentFirstName . ' ' . $r->agentLastName,
					date('d/m/Y h:i A', $r->created_at),
					$button
				);
			}
		}
		else{
			$data['data'][] = array(
				'You have no product' , '', '', '', '', '', ''
			);
		}

		echo json_encode($data);

	}

	/**
	 * @param int $id
	 */

	//Todo Need to be check why setFlashGoBack() not work message.

	public function invoice($id = 0){
		if($id == 0) setFlashGoBack('successMsg', 'Insufficient parameter');

		$data['invoiceQuery'] = $this->product_model->getInvoiceDetails($id);
		$data['invoiceItem'] = $this->product_model->getAllItemByInvoice($id);

		theme('invoice', $data);
	}

	/**
	 * @param int $id
	 *
	 * Make invoice pdf
	 */


	public function pdf_invoice($id = 0){
		if($id == 0) setFlashGoBack('successMsg', 'Insufficient parameter');

		$data['invoiceQuery'] = $this->product_model->getInvoiceDetails($id);
		$data['invoiceItem'] = $this->product_model->getAllItemByInvoice($id);

		$this->load->library('pdf');
		$this->pdf->load_view('pdf_invoice', $data);
		$this->pdf->render();
		$this->pdf->stream("invoice-id-".$id."-at-".date('d-m-Y-h:i').".pdf");

	}



	/**
	 * This isApi for deleting an agent
	 */

	public function deleteAjax(){
		$id = $this->input->post('id');

		//get deleted user info
		$userInfo = singleDbTableRow($id);
		$fullName = user_full_name($userInfo);
		// add a activity
		create_activity("Deleted {$fullName} from Agent");
		//Now delete permanently
		$this->db->where('id', $id)->delete('users');
		return true;
	}




}
