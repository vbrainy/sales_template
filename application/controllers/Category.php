<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Controller {

	function __construct(){
		parent:: __construct();
		$this->load->model('category_model');

		check_auth(); //check is logged in.
	}

	public function index()
	{
		//restricted this area, only for admin
		permittedArea();

		theme('category_index');
	}

	/**
	 * Category add method
	 *
	 */

	public function add_category(){
		//restricted this area, only for admin
		permittedArea();

		if($this->input->post())
		{
			if($this->input->post('submit') != 'add_category') die('Error! sorry');

			$this->form_validation->set_rules('category_name', 'Category Name', 'required|trim');
			$this->form_validation->set_rules('commission_percent', 'Commission', 'required|trim');

			if($this->form_validation->run() == true)
			{
				$insert = $this->category_model->add_category();
				if($insert)
				{
					$this->session->set_flashdata('successMsg', 'Category Created Success');
					redirect(base_url('category'));
				}
			}
		}


		theme('add_category');
	}




	/**
	 * Agent list from db
	 * @return Json format
	 * usable only via API
	 */

	public function categoryListJson(){
		$limit = $this->input->get('length');
		$start = $this->input->get('start');

		$queryCount = $this->category_model->categoryListCount();

		$query = $this->db->query("select categories.*, users.first_name, users.last_name
				from categories LEFT JOIN users
				ON categories.added_by = users.id ORDER BY categories.id DESC Limit {$start}, {$limit}");

		$draw = $this->input->get('draw');

		$data = [];
		$data['draw'] = $draw;
		$data['recordsTotal'] = $queryCount;
		$data['recordsFiltered'] = $queryCount;

		foreach($query->result() as $r){

			//Action Button
			$button = '';
			$button .= '<a class="btn btn-info editBtn"  href="'.base_url('category/edit/'. $r->id).'" data-toggle="tooltip" title="Edit">
						<i class="fa fa-edit"></i> </a>';
			$button .= '<a class="btn btn-danger deleteBtn" id="'.$r->id.'" data-toggle="tooltip" title="Delete">
						<i class="fa fa-trash"></i> </a>';

			$data['data'][] = array(
				$r->name,
				$r->commission_percent.'%',
				$r->first_name.' '.$r->last_name,
				$button
			);
		}

		echo json_encode($data);

	}


	public function edit($id){
		//restricted this area, only for admin
		permittedArea();

		$data['category'] = singleDbTableRow($id,'categories');

		if($this->input->post())
		{
			if($this->input->post('submit') != 'edit_category') die('Error! sorry');

			$this->form_validation->set_rules('category_name', 'Category Name', 'required|trim');
			$this->form_validation->set_rules('commission_percent', 'Commission', 'required|trim');

			if($this->form_validation->run() == true)
			{
				$insert = $this->category_model->edit_category($id);
				if($insert)
				{
					$this->session->set_flashdata('successMsg', 'Category Updated Success');
					redirect($_SERVER['HTTP_REFERER']);
				}
			}
		}

		theme('edit_category', $data);
	}


	/**
	 * This isApi for deleting an agent
	 */

	public function deleteAjax(){
		$id = $this->input->post('id');

		//get deleted user info
		$userInfo = singleDbTableRow($id,'categories');
		$categoryName = $userInfo->name;
		// add a activity
		create_activity("Deleted {$categoryName} Category");
		//Now delete permanently
		$this->db->where('id', $id)->delete('categories');
		return true;
	}

	


}
