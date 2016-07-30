<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* Auth Controller
*/
class Employees extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->authenticate->check_login();
		$this->load->model('pegawai_model');
	}

	public function index()
	{
		$data['employees'] = $this->pegawai_model->get_all();
		$this->load->view('layout/header');
		$this->load->view('employees/index',$data);
		$this->load->view('layout/footer');

	}
	public function add()
	{
		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			$this->form_validation->set_rules('nama', 'Nama','required');
			$this->form_validation->set_rules('email', 'Email','required|valid_email|is_unique[pegawai.email]');
			$this->form_validation->set_rules('password', 'Password','required');
			$this->form_validation->set_rules('password_confirmation', 'Konfirmasi Password','required|matches[password]');
			$this->form_validation->set_rules('alamat', 'Alamat','required');
			if ($this->form_validation->run() == FALSE) {
				$this->load->view('layout/header');
				$this->load->view('employees/add');
				$this->load->view('layout/footer');	
			} else {
				$input = [
					'nama' => $this->input->post('nama'),
					'jabatan' => $this->input->post('jabatan'),
					'email' => $this->input->post('email'),
					'password' => md5($this->input->post('password')),
					'alamat' => $this->input->post('alamat')
				];
				$this->pegawai_model->save($input);
				$this->session->set_flashdata('sukses', 'Berhasil Menambah Data Pegawai');
				redirect('employees');
			}
		} else {

			$this->load->view('layout/header');
			$this->load->view('employees/add');
			$this->load->view('layout/footer');		
		}
	}

	public function edit($id)
	{
		$alat = $this->pegawai_model->get_by_id(['id' => $id]);
		if ($alat) {
			$data['employees'] = $alat;
			$this->load->view('layout/header');
			$this->load->view('employees/edit',$data);
			$this->load->view('layout/footer');
		} else {
			redirect('employees');
		}
	}

	public function update($id)
	{
		$data['employees'] = $this->pegawai_model->get_by_id(['id' => $id]);

		if ($this->input->post('password') || $this->input->post('password_confirmation')) {
			$this->form_validation->set_rules('password', 'Password','required');
			$this->form_validation->set_rules('password_confirmation', 'Konfirmasi Password','required|matches[password]');
			if ($this->form_validation->run() == false) {
				$this->session->set_flashdata('error', validation_errors());
				$this->load->view('layout/header');
				$this->load->view('employees/edit',$data);
				$this->load->view('layout/footer');
			}
		}
		$this->form_validation->set_rules('nama', 'Nama','required');
		$this->form_validation->set_rules('alamat', 'Alamat','required');

		if ($this->form_validation->run() == false) {
			$this->session->set_flashdata('error', validation_errors());
			$this->load->view('layout/header');
			$this->load->view('employees/edit',$data);
			$this->load->view('layout/footer');
		} else {
			if ($this->input->post('password')) {
				$this->pegawai_model->update([
					'nama' => $this->input->post('nama'),
					'jabatan' => $this->input->post('jabatan'),
					'password' => md5($this->input->post('password')),
					'alamat' => $this->input->post('alamat')
				],[
						'id' => $id
					]);
			} else {
				$this->pegawai_model->update([
					'nama' => $this->input->post('nama'),
					'jabatan' => $this->input->post('jabatan'),
					'alamat' => $this->input->post('alamat')
				],[
						'id' => $id
					]);
			}

			$this->session->set_flashdata('sukses', 'Berhasil Mengubah Data Pegawai');
			redirect('employees');
		}
	}

	public function destroy($id)
	{
		$employees = $this->pegawai_model->get_by_id(['id' => $id]);
		if ($employees) {
			$this->pegawai_model->destroy(['id' => $id]);
			$this->session->set_flashdata('sukses','Berhasil Menghapus Data employees');
			redirect('employees');
		}
	}
	public function sendmail($data)
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
		 $this->email->to($data->email,$data->nama);
		 // $data['user'] = $data;
		 $message = $this->load->view('emails/activation_success',$data,TRUE);
		 $this->email->subject('Aktivasi Akun Pondok Traveler  ');
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