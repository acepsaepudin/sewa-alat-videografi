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
			$this->form_validation->set_rules('email','Email', 'required|valid_email|is_unique[customer.email]');
			$this->form_validation->set_rules('alamat','Alamat', 'required');
			$this->form_validation->set_rules('password','Password', 'required');
			$this->form_validation->set_rules('password_confirmation','Konfirmasi Password', 'required|matches[password]');
			if ($this->form_validation->run() == false) {
				$this->load->view('register');
			} else {
				$this->load->model('customer_model');
				$this->customer_model->save([
						'email' => $this->input->post('email'),
						'password' => md5($this->input->post('password')),
						'nama' => $this->input->post('nama'),
						'alamat' => $this->input->post('alamat'),
						'status' => 1,
					]);
				$this->session->set_flashdata('sukses', 'Berhasil register, Selanjutnya menunggu aktivasi oleh admin.');
				$this->load->view('register');
			}
		} else {
			$this->load->view('register');
		}

	}

	public function login()
	{
		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			$this->form_validation->set_rules('email','Email', 'required|valid_email');
			$this->form_validation->set_rules('password','Password', 'required');
			if ($this->form_validation->run() == false) {
				$this->load->view('login');
			} else {

				$array_data = [
						'email' => $this->input->post('email'),
						'password' => md5($this->input->post('password')),
					];
				$this->authenticate->login($array_data);
			}
		} else {
			$this->load->view('login');
		}

	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('auth/login');
	}
}