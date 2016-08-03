<?php
/**
* 
*/
class Ajaxnotif extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model(['customer_model','sewa_model']);
	}

	public function get_register_user()
	{
		//get user belum aktivasi
		$users = $this->customer_model->get_all(['aktivasi' => 2]);
		if ($users->num_rows() > 0) {
			echo json_encode([
				'error' => 1,
				'total' => $users->num_rows()
				]);
			exit();
		} else {
			echo json_encode([
				'error' => 0,
				'total' => 0
				]);
			exit();
		}
	}

	public function get_sewa_alat_to_admin()
	{
		//get sewa yang masih status booked
		$sewa = $this->sewa_model->get_all(['status' => 1]);
		if ($sewa->num_rows() > 0) {
			echo json_encode([
				'error' => 1,
				'total' => $sewa->num_rows()
				]);
			exit();
		} else {
			echo json_encode([
				'error' => 0,
				'total' => 0
				]);
			exit();
		}
	}
}