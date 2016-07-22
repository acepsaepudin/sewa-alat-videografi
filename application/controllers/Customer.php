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
			$this->customer_model->update([
					'status' => $this->input->post('status')
				],[
					'id' => $id
				]);

			$this->session->set_flashdata('sukses', 'Berhasil Mengubah Data Customer');
			redirect('customer');
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
}