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
			die('adf');
		} else {
			$this->load->view('register');
		}

	}
}