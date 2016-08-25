<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model(['alat_model','pembayaran_model']);
		$this->authenticate->check_login();
	}

	public function index()
	{
		// echo '<pre>';
		// print_r($_SESSION);
		// echo '</pre>';
		// exit;
		$data['alat'] = $this->alat_model->get_all();
		$data['dp'] = $this->pembayaran_model->get_all(['status' => 2]);
		$data['lunas'] = $this->pembayaran_model->get_all(['status' => 3]);
		$data['belumbayar'] = $this->pembayaran_model->get_all(['status' => 1]);
		$this->load->view('layout/header');
		$this->load->view('home/index',$data);
		$this->load->view('layout/footer');
	}
}