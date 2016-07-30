<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
*Payment Controller
*/
class Payment extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->authenticate->check_login();
		// $this->authenticate->employee_can_access(array(1,2));
		$this->load->model('pegawai_model');
	}

	public function add()
	{
		// $data['employees'] = $this->pegawai_model->get_all();
		$this->load->view('layout/header');
		$this->load->view('payment/add');
		$this->load->view('layout/footer');

	}
}