<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->authenticate->check_login();
	}

	public function index()
	{
		// echo '<pre>';
		// print_r($_SESSION);
		// echo '</pre>';
		// exit;
		$this->load->view('layout/header');
		$this->load->view('home/index');
		$this->load->view('layout/footer');
	}
}