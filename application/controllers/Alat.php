<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* Auth Controller
*/
class Alat extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('alat_model');
	}

	public function index()
	{
		$data['alat'] = $this->alat_model->get_all();
		$this->load->view('layout/header');
		$this->load->view('alat/index',$data);
		$this->load->view('layout/footer');

	}

	public function add()
	{
		$this->load->view('layout/header');
		$this->load->view('alat/add');
		$this->load->view('layout/footer');
	}

	public function store()
	{
		$this->form_validation->set_rules('nama','Nama','required');
		$this->form_validation->set_rules('deskripsi','Deskripsi','required');
		$this->form_validation->set_rules('stok','Stok','required|is_natural');
		$this->form_validation->set_rules('harga_harian','Harga Per Hari','required|is_natural');

		if ($this->form_validation->run() == false) {
			$this->session->set_flashdata('error', validation_errors());
			$this->load->view('layout/header');
			$this->load->view('alat/add');
			$this->load->view('layout/footer');
		} else {
			$this->alat_model->save([
					'nama' => $this->input->post('nama'),
					'deskripsi' => $this->input->post('deskripsi'),
					'stok' => $this->input->post('stok'),
					'harga_harian' => $this->input->post('harga_harian'),
				]);

			$this->session->set_flashdata('sukses', 'Berhasil Menambah Data Alat');
			redirect('alat');
		}
	}

	public function edit($id)
	{
		$alat = $this->alat_model->get_by_id(['id' => $id]);
		if ($alat) {
			$data['alat'] = $alat;
			$this->load->view('layout/header');
			$this->load->view('alat/edit',$data);
			$this->load->view('layout/footer');
		} else {
			redirect('alat');
		}
	}

	public function update($id)
	{
		$this->form_validation->set_rules('nama','Nama','required');
		$this->form_validation->set_rules('deskripsi','Deskripsi','required');
		$this->form_validation->set_rules('stok','Stok','required');
		$this->form_validation->set_rules('harga_harian','Harga Per Hari','required');

		$alat = $this->alat_model->get_by_id(['id' => $id]);
		if ($this->form_validation->run() == false) {
			$this->session->set_flashdata('error', validation_errors());
			$this->load->view('layout/header');
			$this->load->view('alat/edit',$data);
			$this->load->view('layout/footer');
		} else {
			$this->load->model('alat_model');
			$this->alat_model->update([
					'nama' => $this->input->post('nama'),
					'deskripsi' => $this->input->post('deskripsi'),
					'stok' => $this->input->post('stok'),
					'harga_harian' => $this->input->post('harga_harian'),
				],[
					'id' => $id
				]);

			$this->session->set_flashdata('sukses', 'Berhasil Mengubah Data Alat');
			redirect('alat');
		}
	}

	public function destroy($id)
	{
		$alat = $this->alat_model->get_by_id(['id' => $id]);
		if ($alat) {
			$this->alat_model->destroy(['id' => $id]);
			$this->session->set_flashdata('sukses','Berhasil Menghapus Data Alat');
			redirect('alat');
		}
	}
}