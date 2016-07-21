<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* Auth Controller
*/
class Auth extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function register()
	{
		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			$this->form_validation->set_rules('nama','Nama Lengkap', 'required');
			$this->form_validation->set_rules('email','Email', 'required');
			$this->form_validation->set_rules('alamat','Alamat', 'required');
			$this->form_validation->set_rules('password','Password', 'required');
			$this->form_validation->set_rules('password_confirmation','Konfirmasi Password', 'required');
			if ($this->form_validation->run() == false) {
				die('salah');
			}
		} else {
			$this->load->view('register');
		}

	}
}