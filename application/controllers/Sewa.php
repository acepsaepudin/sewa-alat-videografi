<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* Auth Controller
*/
class Sewa extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model(['alat_model', 'sewa_model','sewadetail_model']);
	}

	public function add()
	{
		// echo '<pre>';
		// print_r($this->session->all_userdata());
		// echo '</pre>';
		// exit;
		//show tmp sewa
		if (isset($_SESSION['tmp_sewa'])) {
		    $sewa = $_SESSION['tmp_sewa'];
		    //get nama alat
		    foreach ($sewa as $key => $value) {
		    	
		    	$sewa[$key]['nama_alat'] = $this->alat_model->get_by_id(['id' => $value['alat_id']])->nama;
		    }
		  	$data['sewa'] = $sewa;
		}
		
		$data['alat'] = $this->alat_model->get_all('stok > 0');
		$this->load->view('layout/header');
		$this->load->view('sewa/add', $data);
		$this->load->view('layout/footer');
	}

	public function add_item()
	{
		if ($this->input->is_ajax_request()) {
			$this->form_validation->set_rules('jumlah','Jumlah','required|numeric');
			$this->form_validation->set_rules('start','Tanggal Sewa','required');
			$this->form_validation->set_rules('end','Total Hari','required');
			$this->form_validation->set_error_delimiters('', '');
			if ($this->form_validation->run() == false) {
				echo json_encode([
					'error' => 1,
					'datas' => [
							'jumlah' => form_error('jumlah'),
							'start' => form_error('start'),
							'end' => form_error('end')
						]
					]);
				exit();
			} else {
				//check jumlah tidak melebihi total stok
				//get data alat
				$alat = $this->alat_model->get_by_id(['id' => $this->input->post('alat_id')]);
				if ($this->input->post('jumlah') > $alat->stok) {
					echo json_encode([
						'error' => 1,
						'datas' => [
								'jumlah' => 'Jumlah melebihi stok.',
							]
						]);
					exit();
				}
				//reformat start
				$start = explode('-', $this->input->post('start'));
				$start_db = $start[2].'-'.$start[1].'-'.$start[0];
				$start = $start[2].'-'.$start[1].'-'.$start[0];

				//reformat end
				$end = explode('-', $this->input->post('end'));
				$end = $end[2].'-'.$end[1].'-'.$end[0];
				$start = new DateTime($start);
				$end = new DateTime($end);
				$total = $start->diff($end);
				$total = ($total->days == 0) ? 1 : $total->days;

				$array_data = [
							'alat_id' => $this->input->post('alat_id'),
							'jumlah' => $this->input->post('jumlah'),
							'tgl_sewa' => $start_db,
							'total_hari' => $total,
							'total' => ($alat->harga_harian*$total)*$this->input->post('jumlah')
						];
				//reduce the stock of alat
				// $stok = $alat->stok - $this->input->post('jumlah');
				// $this->alat_model->update(['stok' => $stok], ['id' => $alat->id]);

				//save to session
				if (!isset($_SESSION['tmp_sewa'])) {
				    $_SESSION['tmp_sewa'] = array();
				}
				$_SESSION['tmp_sewa'][] = $array_data;
				// $this->session->set_userdata('tmp_sewa', $array_data);
				$this->session->set_flashdata('sukses', 'Berhasil Menambah Sewa.');
				echo json_encode([
						'error' => 2,
						'url' => site_url('sewa/add')
					]);
				exit();
			}
		} else {
			redirect('sewa');
		}
	}

	public function delete_item($key)
	{
		unset($_SESSION['tmp_sewa'][$key]);
		$this->session->set_flashdata('sukses', 'Berhasil Menghapus Sewa.');
		redirect('sewa/add');
	}

	public function store_all_item()
	{
		//hitung tiap alat yang disewa
		$sewa_details = $_SESSION['tmp_sewa'];
		$total_bayar = 0;
		foreach ($sewa_details as $key => $value) {
			$total_bayar += $value['total'];
		}

		//input ke tabel sewa
		$id = $this->sewa_model->save([
				'tanggal_input' => date('Y-m-d'),
				'total_harga' => $total_bayar,
				'customer_id' => $_SESSION['data']['id']
			]);
		//simpan ke tabel sewa_detail
		foreach ($sewa_details as $key => $value) {
			$this->sewadetail_model->save([
					'sewa_id' => $id,
					'alat_id' => $value['alat_id'],
					'tgl_sewa' => $value['tgl_sewa'],
					'total_hari' => $value['total_hari'],
					'jumlah' => $value['jumlah'],
					'status' => '1'
				]);
			//update stok 
			$alat = $this->alat_model->get_by_id(['id' => $value['alat_id']]);
			$stok = $alat->stok;
			$stok -= $value['jumlah'];
			// $stok = $alat->stok - $this->input->post('jumlah');
			$this->alat_model->update(['stok' => $stok], ['id' => $value['alat_id']]);
		}
		unset($_SESSION['tmp_sewa']);
		$this->session->set_flashdata('sukses', 'Silahkan Melakukan pembayaran.');
		redirect('sewa/add');
	}

	public function lists()
	{
		$sewa = $this->sewa_model->get_all(['customer_id' => $this->session->userdata('data')['id']]);
		if ($sewa) {
			$tmp_sewa = $sewa->result();
			foreach ($tmp_sewa as $key => $value) {
				//get sewa detail
				$tmp_sewa[$key]->detail = $this->sewadetail_model->get_by_id(['sewa_id' => $value->id]);
				// $key[$value]->nama_alat = $this->alat_model->get_by_id(['id' => ])
			}
			
		$data['sewa'] = ($tmp_sewa) ? $tmp_sewa : '';
		}
		$this->load->view('layout/header');
		$this->load->view('sewa/lists', $data);
		$this->load->view('layout/footer');
	}
}