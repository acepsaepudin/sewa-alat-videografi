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
						'aktivasi' => 1
					]);
				$res_email = $this->sendmail($this->input->post('email'), $this->input->post('nama'));
				if ($res_email) {
					$this->session->set_flashdata('sukses', 'Berhasil register, Selanjutnya menunggu aktivasi oleh admin.');
					$this->load->view('register');
				} else {
					$this->session->set_flashdata('sukses', 'Ada Kesalahan dalam sistem, Mohon coba beberapa saat lagi.');
					$this->load->view('register');
				}
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

	public function sendmail($email,$name)
	{
		//set email library configuration
		 $config = Array(
		 'protocol' => 'smtp',
		 'smtp_host' => 'ssl://smtp.googlemail.com',
		 'smtp_port' => 465,
		 'smtp_user' => 'robotcontractors@gmail.com',
		 'smtp_pass' => '123!@#qweem0np45s',
		 );
		 
		 //load email library
		 $this->load->library('email', $config);
		 $this->email->set_newline("\r\n");
		 $this->email->set_mailtype("html");
		 //set email information and content
		 $this->email->from('robotcontractors@googlemail.com', 'Pondok Traveler');
		 $this->email->to($email,$name);
		 $data['user'] = ['nama' => $name, 'email' => $email];
		 $message = $this->load->view('emails/register_success',$data,TRUE);
		 $this->email->subject('Selamat Datang di Pondok Traveler  ');
		 $this->email->message($message);
		 
		 if($this->email->send())
		 {
		 // echo 'Your email was sent, fool.';
		 	return TRUE;
		 }
		 
		 else
		 {
		 	return FALSE;
		 	// show_error($this->email->print_debugger());
		 }
	}
}