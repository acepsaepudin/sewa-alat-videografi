<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* Auth Controller
*/
class Customer extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('customer_model');
	}

	public function index()
	{
		$data['customer'] = $this->customer_model->get_all();
		$this->load->view('layout/header');
		$this->load->view('customer/index',$data);
		$this->load->view('layout/footer');

	}

	public function edit($id)
	{
		$alat = $this->customer_model->get_by_id(['id' => $id]);
		if ($alat) {
			$data['customer'] = $alat;
			$this->load->view('layout/header');
			$this->load->view('customer/edit',$data);
			$this->load->view('layout/footer');
		} else {
			redirect('customer');
		}
	}

	public function update($id)
	{
		$this->form_validation->set_rules('status','Status','required');

		$customer = $this->customer_model->get_by_id(['id' => $id]);
		if ($this->form_validation->run() == false) {
			$this->session->set_flashdata('error', validation_errors());
			$this->load->view('layout/header');
			$this->load->view('customer/edit',$customer);
			$this->load->view('layout/footer');
		} else {
			//send email success activation
			$res_email = $this->sendmail($customer);
			if ($res_email) {
				$this->customer_model->update([
						'aktivasi' => $this->input->post('status')
					],[
						'id' => $id
					]);

				$this->session->set_flashdata('sukses', 'Berhasil Mengubah Data Customer');
				redirect('customer');
			} else {
				$this->session->set_flashdata('sukses', 'Ada Kesalahan Dalam Mengirim Email, Data Gagal Di Update.');
				redirect('customer');
			}
		}
	}

	public function destroy($id)
	{
		$customer = $this->customer_model->get_by_id(['id' => $id]);
		if ($customer) {
			$this->customer_model->destroy(['id' => $id]);
			$this->session->set_flashdata('sukses','Berhasil Menghapus Data Customer');
			redirect('customer');
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