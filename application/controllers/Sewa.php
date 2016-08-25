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
		$this->load->model(['alat_model', 'sewa_model','sewadetail_model','pembayaran_model','customer_model']);
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

		if ($this->session->userdata('status') == 'admin') {
			$data['alat'] = $this->alat_model->get_all();
		} else {

			$data['alat'] = $this->alat_model->get_all('stok > 0');
		}
		$this->load->view('layout/header');
		$this->load->view('sewa/add', $data);
		$this->load->view('layout/footer');
	}

	public function add_item()
	{
		if ($this->input->is_ajax_request()) {
			$this->form_validation->set_rules('jumlah','Jumlah','required|numeric');
			// $this->form_validation->set_rules('start','Tanggal Sewa','required');
			// $this->form_validation->set_rules('end','Total Hari','required');
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
				// $start = explode('-', $this->input->post('start'));
				// $start_db = $start[2].'-'.$start[1].'-'.$start[0];
				// $start = $start[2].'-'.$start[1].'-'.$start[0];

				//reformat end
				// $end = explode('-', $this->input->post('end'));
				// $end = $end[2].'-'.$end[1].'-'.$end[0];
				// $start = new DateTime($start);
				// $end = new DateTime($end);
				// $total = $start->diff($end);
				// echo '<pre>';
				// print_r($total);
				// echo '</pre>';
				// exit;
				// $total = ($total->days == 0) ? 1 : $total->days;

				$array_data = [
							'alat_id' => $this->input->post('alat_id'),
							'jumlah' => $this->input->post('jumlah'),
							// 'tgl_sewa' => $start_db,
							// 'total_hari' => $total,
							// 'total' => ($alat->harga_harian*$total)*$this->input->post('jumlah')
							'total' => $alat->harga_harian*$this->input->post('jumlah')
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
		// if ($this->input->server('REQUEST_METHOD') == 'POST') {
		// 	$this->form_validation->set_rules('tgl_sewa','Tanggal Sewa','required');
		// 	$this->form_validation->set_rules('total_hari','Total Hari ','required');
			
		// 	if ($this->form_validation->run() == false) {
		// 		if (isset($_SESSION['tmp_sewa'])) {
		// 	    $sewa = $_SESSION['tmp_sewa'];
		// 	    //get nama alat
		// 	    foreach ($sewa as $key => $value) {
			    	
		// 	    	$sewa[$key]['nama_alat'] = $this->alat_model->get_by_id(['id' => $value['alat_id']])->nama;
		// 	    }
		// 	  	$data['sewa'] = $sewa;
		// 		}
		// 		$this->load->view('layout/header');
		// 		$this->load->view('sewa/store_all_item_form', $data);
		// 		$this->load->view('layout/footer');
		// 	}
		// 	die('lulus');
		// 	//hitung tiap alat yang disewa
		// 	$sewa_details = $_SESSION['tmp_sewa'];
		// 	$total_bayar = 0;
		// 	foreach ($sewa_details as $key => $value) {
		// 		$total_bayar += $value['total'];
		// 	}
		// 	//input ke tabel sewa
		// 	$id = $this->sewa_model->save([
		// 			'tanggal_input' => date('Y-m-d'),
		// 			'total_harga' => $total_bayar,
		// 			'customer_id' => $_SESSION['data']['id']
		// 		]);
		// 	//simpan ke tabel sewa_detail
		// 	foreach ($sewa_details as $key => $value) {
		// 		$this->sewadetail_model->save([
		// 				'sewa_id' => $id,
		// 				'alat_id' => $value['alat_id'],
		// 				'tgl_sewa' => $value['tgl_sewa'],
		// 				'total_hari' => $value['total_hari'],
		// 				'jumlah' => $value['jumlah'],
		// 				'status' => '1'
		// 			]);
		// 		//update stok 
		// 		$alat = $this->alat_model->get_by_id(['id' => $value['alat_id']]);
		// 		$stok = $alat->stok;
		// 		$stok -= $value['jumlah'];
		// 		// $stok = $alat->stok - $this->input->post('jumlah');
		// 		$this->alat_model->update(['stok' => $stok], ['id' => $value['alat_id']]);
		// 	}
		// 	unset($_SESSION['tmp_sewa']);
		// 	$this->session->set_flashdata('sukses', 'Silahkan Melakukan pembayaran.');
		// 	redirect('sewa/add');
		// } else {
			if (isset($_SESSION['tmp_sewa'])) {
			    $sewa = $_SESSION['tmp_sewa'];
			    //get nama alat
			    foreach ($sewa as $key => $value) {
			    	
			    	$sewa[$key]['nama_alat'] = $this->alat_model->get_by_id(['id' => $value['alat_id']])->nama;
			    }
			  	$data['sewa'] = $sewa;
			}
			$this->load->view('layout/header');
			$this->load->view('sewa/store_all_item_form', $data);
			$this->load->view('layout/footer');
		// }
	}

	public function lists()
	{
		if ($this->session->userdata('status') == 'admin') {
			$sewa = $this->sewa_model->get_all();
		} else {

			$sewa = $this->sewa_model->get_all(['customer_id' => $this->session->userdata('data')['id']]);
		}
		if ($sewa) {
			$tmp_sewa = $sewa->result();
			foreach ($tmp_sewa as $key => $value) {
				//get sewa detail
				$tmp_sewa[$key]->nama = $this->customer_model->get_by_id(['id' => $value->customer_id])->nama;
				$tmp_sewa[$key]->detail = $this->sewadetail_model->get_by_id(['sewa_id' => $value->id]);
				// $key[$value]->nama_alat = $this->alat_model->get_by_id(['id' => ])
			}
			
		$data['sewa'] = ($tmp_sewa) ? $tmp_sewa : '';
		}
		
		$this->load->view('layout/header');
		$this->load->view('sewa/lists', $data);
		$this->load->view('layout/footer');
	}

	public function list_details($id_sewa)
	{
		$details = $this->sewadetail_model->get_all(['sewa_id' => $id_sewa])->result();
		$new_array = array();
		
		if ($details) {
			foreach ($details as $key => $value) {
				$details[$key]->nama_alat = $this->alat_model->get_by_id(['id' => $value->alat_id])->nama;
			}
		}
		$data['id_sewa'] = $id_sewa;
		$data['sewa'] = $this->sewa_model->get_by_id(['id' => $id_sewa]);
		$data['details'] = ($details) ? $details : '';
		$this->load->view('layout/header');
		$this->load->view('sewa/list_details', $data);
		$this->load->view('layout/footer');	
	}

	public function kirim($id_sewa)
	{
		if ($id_sewa) {
			//kirim email
			//update status ke dikirim
			$this->sewa_model->update(['status' => 3],['id' => $id_sewa]);
			$this->session->set_flashdata('sukses', 'Silahkan melakukan pengiriman Alat.');
			redirect('sewa/lists');
		} else {
			redirect('sewa/lists');
		}
	}

	public function input_sewa()
	{
		$this->form_validation->set_rules('tgl_sewa','Tanggal Sewa','required');
		$this->form_validation->set_rules('total_hari','Total Hari ','required');
			
		if ($this->form_validation->run() == false) {
			if (isset($_SESSION['tmp_sewa'])) {
		    $sewa = $_SESSION['tmp_sewa'];
		    //get nama alat
		    foreach ($sewa as $key => $value) {
		    	
		    	$sewa[$key]['nama_alat'] = $this->alat_model->get_by_id(['id' => $value['alat_id']])->nama;
		    }
		  	$data['sewa'] = $sewa;
			}
			$this->load->view('layout/header');
			$this->load->view('sewa/store_all_item_form', $data);
			$this->load->view('layout/footer');
		} else {
			//get user info
			$info_user = $this->customer_model->get_by_id(['id' => $_SESSION['data']['id']]);
			
			//hitung tiap alat yang disewa
			$sewa_details = $_SESSION['tmp_sewa'];
			$total_bayar = 0;
			foreach ($sewa_details as $key => $value) {
				$total_bayar += $value['total'];
			}

			//reformat tgl_sewa
			$start = explode('-', $this->input->post('tgl_sewa'));
			$start_db = $start[2].'-'.$start[1].'-'.$start[0];
			$start = $start[2].'-'.$start[1].'-'.$start[0];
			
			//input ke tabel sewa
			$id = $this->sewa_model->save([
					'tanggal_input' => date('Y-m-d'),
					'total_harga' => ($total_bayar * $this->input->post('total_hari')),
					'customer_id' => $_SESSION['data']['id'],
					'tgl_sewa' => $start,
					'total_hari' => $this->input->post('total_hari'),
					'status' => '1'
				]);
			//simpan ke tabel sewa_detail
			foreach ($sewa_details as $key => $value) {
				$this->sewadetail_model->save([
						'sewa_id' => $id,
						'alat_id' => $value['alat_id'],
						'jumlah' => $value['jumlah'],
					]);
				//update stok 
				$alat = $this->alat_model->get_by_id(['id' => $value['alat_id']]);
				$stok = $alat->stok;
				$stok -= $value['jumlah'];
				// $stok = $alat->stok - $this->input->post('jumlah');
				$this->alat_model->update(['stok' => $stok], ['id' => $value['alat_id']]);
			}

			//input ke pembayaran
			$pembayaran_id = $this->pembayaran_model->save([
								'customer_id' => $_SESSION['data']['id'],
								'sewa_id' => $id,
								//set status belum bayar
								'status' => 1
							]);
			$data_alat = $this->sewadetail_model->get_all(['sewa_id' => $id])->result();
			$sewas = $this->sewa_model->get_by_id(['id' => $id]);

			foreach ($data_alat as $key => $value) {
				$data_alat[$key]->nama = $this->alat_model->get_by_id(['id' => $value->alat_id])->nama;
			}
			//kirim email ke admin
			$kirim_email = [
				'email' => $info_user->email,
				'nama' => 'Admin',
				'subject' => 'Invoice Pondok Traveller',
				'view' => 'emails/new_order',
				'data' => [
					'id_sewa' => $id,
					'nama' => $info_user->nama,
					'alat' => $data_alat,
					'sewa' => $sewas
				]
			];
			// sendmail($kirim_email);
			unset($_SESSION['tmp_sewa']);
			if (sendmail($kirim_email)) {
				$this->session->set_flashdata('sukses', 'Silahkan Melakukan pembayaran.');
				redirect('sewa/add');
			} else {
				$this->session->set_flashdata('sukses', 'Input sewa selesai, dan gagal mengirim email ke Admin.');
				redirect('sewa/add');
			}
			
		}
	}

	public function edit($id)
	{
		$this->form_validation->set_rules('stok', 'Stok', 'required|numeric');
		$this->form_validation->set_rules('id_sewa', 'ID Sewa', 'required');
		if ($this->form_validation->run() == false) {
			$data['alat'] = $this->alat_model->get_by_id(['id' => $id]);
			$this->load->view('layout/header');
			$this->load->view('sewa/edit', $data);
			$this->load->view('layout/footer');
		} else {
			$this->alat_model->update([
					'stok' => $this->input->post('stok')
				], [
					'id' => $id
				]);
			$this->sewa_model->update([
					'status' => 4
				], [
					'id' => $this->input->post('id_sewa')
				]);
			$this->session->set_flashdata('sukses', 'Alat Sudah dikembalikan.');
			redirect('sewa/edit/'.$id);
		}
	}

}