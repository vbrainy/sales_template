<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Activity extends CI_Controller {

	function __construct(){
		parent:: __construct();
		check_auth();
	}

	public function index()
	{
		theme('activity');
	}

	public function users($user_id = 0){
		if($user_id != null)
		{
			$data['showFor'] = 'singUser';
			$data['showForID'] = $user_id;
		}else{
			$data['showFor'] = 'allUsers';
		}


		theme('activity', $data);
	}

	/**
	 * activityJsonApi for DataTable
	 */

	public function activityJsonApi(){

		$user_data = loggedInUserData();
		$session_user_id = $user_data['user_id'];

		$limit = $this->input->get('length');
		$start = $this->input->get('start');

		if($this->input->get('showFor')){

			$showFor = $this->input->get('showFor');

			if($showFor == 'allUsers'){
				$queryCount = $this->db->count_all_results('activities');

				$query = $this->db->query("select activities.*, users.first_name, users.last_name
				from activities
				LEFT JOIN users on activities.user_id = users.id
				ORDER BY activities.id DESC limit $start, $limit");
			}else{
				$queryCount = $this->db->where('user_id', $showFor)->count_all_results('activities');

				$query = $this->db->query("select activities.*, users.first_name, users.last_name
				from activities
				LEFT JOIN users on activities.user_id = users.id
				WHERE activities.user_id = '$showFor'
				ORDER BY activities.id DESC limit $start, $limit");
			}

		}else {

			$queryCount = $this->db->where('user_id', $session_user_id)->count_all_results('activities');
			//$query = $this->user_model->agentList($limit, $start);

			$query = $this->db->query("select activities.*, users.first_name, users.last_name
				from activities
				LEFT JOIN users on activities.user_id = users.id
				WHERE activities.user_id = '$session_user_id'
				ORDER BY activities.id DESC limit $start, $limit");
		}

		$draw = $this->input->get('draw');

		$data = [];
		$data['draw'] = $draw;
		$data['recordsTotal'] = $queryCount;
		$data['recordsFiltered'] = $queryCount;

		if($query->num_rows() > 0) {
			foreach ($query->result() as $r) {
				$ownerID = $r->user_id;
				if ($ownerID == $session_user_id) {
					$owner = 'You ';
				} else {
					$owner = $r->first_name . ' ' . $r->last_name;
				}

				$data['data'][] = array(
					'<strong>' . $owner . '</strong> ' . $r->activity . ' <br /><p class="text-muted">' . date('l jS \of F Y h:i:s A', $r->created_at) . '</p>'
				);
			}
		}else{
			$data['data'][] = array(
				'There have no activity'
			);
		}

		echo json_encode($data);	}



	/**
	 * Log out now
	 */

	public function logout(){
		$this->login->set_user_offline();
		$this->session->unset_userdata('logged_user'); // unset logged_user
		redirect(base_url());
	}
}
