<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
*Payment Controller
*/
class Payment extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->authenticate->check_login();
		// $this->authenticate->employee_can_access(array(1,2));
		$this->load->model(['sewa_model', 'sewadetail_model','pembayaran_model','pembayarandetail_model','customer_model']);
	}

	public function add()
	{
		$this->form_validation->set_rules('jumlah_bayar', 'Jumlah Bayar', 'required|is_natural_no_zero');
		$this->form_validation->set_rules('tgl_bayar', 'Tanggal Bayar', 'required');
		if ($this->form_validation->run() == false) {
			$data['pembayaran'] = $this->pembayaran_model->get_all("customer_id = '".$this->session->userdata('data')['id']."' AND status != 3")->result();
			$this->load->view('layout/header');
			$this->load->view('payment/add',$data);
			$this->load->view('layout/footer');
		} else {
			$config['upload_path']          = './uploads/';
            $config['allowed_types']        = 'gif|jpg|png';
            $config['max_size']             = 1000;
            $config['max_width']            = 2048;
            $config['max_height']           = 2048;

            $this->load->library('upload', $config);

            if ( ! $this->upload->do_upload('bukti_bayar'))
            {
                    $data['error'] = array('error' => $this->upload->display_errors());

                    $data['pembayaran'] = $this->pembayaran_model->get_all(['customer_id' => $this->session->userdata('data')['id']])->result();

					$this->load->view('layout/header');
					$this->load->view('payment/add',$data);
					$this->load->view('layout/footer');
            }
            else
            {
				// $tipe_bayar = $this->input->post('tipe_bayar');
				// //cek tipe pelunasan jika pembayaran belum sesuai dengan total yang harus dibayar
				// if ($tipe_bayar == 2) {
					
				// }
				//cek jumlah bayar minimal 50% dari total pembayaran
				// $data_bayar = $this->pembayaran_model->get_by_id(['id' => $this->input->post('pembayaran_id')]);
				// $data_sewa = $this->sewa_model->get_by_id(['id' => $data_bayar->sewa_id]);
				// $setengah = ($data_sewa->total_harga * 50) / 100;
				// if ($this->input->post('jumlah_bayar') < $setengah) {
				// 	$this->session->set_flashdata('error', array('Pembayaran '));
    //             	redirect('payment/add');
				// }

				//cek jika pembayaran tidak boleh melebihi total pembayaran
				$byr_lebih = $this->pembayaran_model->get_by_id(['id' => $this->input->post('pembayaran_id')]);
				$lebih = $this->sewa_model->get_by_id(['id' => $byr_lebih->sewa_id])->total_harga;
				if ($this->input->post('jumlah_bayar') >= $lebih) {
					$this->session->set_flashdata('err', 'Tidak bisa melebihi total pembayaran.');
	                	redirect('payment/add');
				}

				//cek sudah bayar apa belum gan
            	$bayarbelum = $this->pembayarandetail_model->get_by_id(['pembayaran_id' => $this->input->post('pembayaran_id')]);
            	if ($bayarbelum) {
            		if ($bayarbelum->tipe_bayar == $this->input->post('tipe_bayar')) {
            			$this->session->set_flashdata('err', 'Tidak bisa input tipe pembayaran yang sama.');
	                	redirect('payment/add');
            		}
            	}
            	

				//cek jika pernah melakukan 
                $uploadan = $this->upload->data();
                //nama file
                $bukti_bayar = $uploadan['file_name'];

                //reformat tgl_bayar
				$start = explode('-', $this->input->post('tgl_bayar'));
				$start_db = $start[2].'-'.$start[1].'-'.$start[0];
				$start = $start[2].'-'.$start[1].'-'.$start[0];
                //input ke pembayaran detail
                $pembayaran_detail = [
                	'pembayaran_id' => $this->input->post('pembayaran_id'),
                	'tipe_bayar' => $this->input->post('tipe_bayar'),
                	'status_bayar' => 1,
                	'jumlah_bayar' => $this->input->post('jumlah_bayar'),
                	'bukti_bayar' => $bukti_bayar,
                	'tgl_bayar' => $start
                ];
	            $this->pembayarandetail_model->save($pembayaran_detail);
                //kirim email ke user
                $sewa = $this->pembayaran_model->get_by_id(['id' => $this->input->post('pembayaran_id')]);
                $tipebayar = ($this->input->post('tipe_bayar') == 1) ? 'DP': 'Pelunasan';
				// $kirim_email = [
				// 	'email' => 'qwertynesia@gmail.com',
				// 	'nama' => 'Admin',
				// 	'subject' => $tipebayar.' Untuk ID Sewa #'.$sewa->sewa_id,
				// 	'view' => 'emails/new_dp_input',
				// 	'data' => [
				// 		'id_sewa' => $sewa->sewa_id,
				// 		'total' => $this->input->post('jumlah_bayar')
				// 	]
				// ];
				// if (sendmail($kirim_email)) {
	                $this->session->set_flashdata('sukses', 'Sukses Input pembayaran.');
	                // redirect('payment/add');
				// } else {
					// $this->session->set_flashdata('sukses', 'Sukses Input pembayaran dan gagal mengirim email ke admin.');
	                redirect('payment/add');
				// }
            }
		}
		// $data['pembayaran'] = $this->pembayaran_model->get_all(['customer_id' => $this->session->userdata('data')['id']])->result();

		// $this->load->view('layout/header');
		// $this->load->view('payment/add',$data);
		// $this->load->view('layout/footer');

	}

	public function lists()
	{
		if ($this->session->userdata('status') == 'user') {
			$data['pembayaran'] = $this->pembayaran_model->get_all(['customer_id' => $this->session->userdata('data')['id']])->result();
		} else {
			$data['pembayaran'] = $this->pembayaran_model->get_all()->result();
		}
		$bayar = array();
		if ($data['pembayaran']) {
			foreach ($data['pembayaran'] as $key => $value) {
				// $data['pembayaran_detail'] = $this->pembayarandetail_model->get_all(['pembayaran_id' => $value->id])->result();
				$b = $this->pembayarandetail_model->get_all(['pembayaran_id' => $value->id]);
				if ($b->num_rows() > 1) {
					foreach ($b->result() as $k => $v) {
						$bayar[] = $v;
					}
				}
				if ($b->num_rows() == 1) {
					$bayar[] = $b->row();
				}
			}
		} 
		// else {
		// 	$data['pembayaran_detail'] = '';
		// }
		
		$data['pembayaran_detail'] = $bayar;
		$this->load->view('layout/header');
		$this->load->view('payment/lists',$data);
		$this->load->view('layout/footer');
		
	}

	public function approve($id,$tipe_bayar,$detail_id)
	{
		if ($id && $tipe_bayar && $detail_id) {

			$sbjt = ($tipe_bayar == 1) ? 'DP' : 'Pelunasan';

			//get data pembayaran 
			$byr = $this->pembayaran_model->get_by_id(['id' => $id]);

			//udpate pembayaran
			$this->pembayaran_model->update([
					'status' => ($tipe_bayar == 1) ? 2 : 3,
					'pegawai_id' => $this->session->userdata('data')['id']
				],[
					'id' => $id
				]);

			//get data user
			$user = $this->customer_model->get_by_id(['id' => $byr->customer_id]);

			//get data detail bayar
			$dtl_byr = $this->pembayarandetail_model->get_by_id(['id' => $detail_id]);

			//update pembayaran_detail
			$this->pembayarandetail_model->update([
					'status_bayar' => 2
				],[
					'id' => $detail_id
				]);

			$kirim_email = [
				'email' => $user->email,
				'nama' => $user->nama,
				'subject' => 'Info Pembayaran '.$sbjt.' untuk ID Sewa #'.$byr->sewa_id,
				'view' => 'emails/confirm_payment',
				'data' => [
					'id_sewa' => $byr->sewa_id,
					'total' => $dtl_byr->jumlah_bayar,
					'nama' => $user->nama,
					'tipe' => $sbjt
				]
			];
			if (sendmail($kirim_email)) {
                $this->session->set_flashdata('sukses', 'Sukses Konfirmasi Pembayaran '.$sbjt.'.');
                redirect('payment/lists');
			} else {
				$this->session->set_flashdata('sukses', 'Sukses Konfirmasi Pembayaran '.$sbjt.' dan gagal mengirim email ke User.');
                redirect('payment/lists');
			}
		} else {
			redirect('payment/lists');
		}
	}
	public function pelunasan()
	{
		$this->form_validation->set_rules('jumlah_bayar', 'Jumlah Bayar', 'required');
		$this->form_validation->set_rules('tgl_bayar', 'Tanggal Bayar', 'required');
		if ($this->form_validation->run() == false) {
			$data['pembayaran'] = $this->pembayaran_model->get_all("status = 2 AND status != 3 AND status !=1")->result();
			
			$this->load->view('layout/header');
			$this->load->view('payment/lunas',$data);
			$this->load->view('layout/footer');
		} else {
			$config['upload_path']          = './uploads/';
            $config['allowed_types']        = 'gif|jpg|png';
            $config['max_size']             = 1000;
            $config['max_width']            = 2048;
            $config['max_height']           = 2048;

            $this->load->library('upload', $config);

            if ( ! $this->upload->do_upload('bukti_bayar'))
            {
                    $data['error'] = array('error' => $this->upload->display_errors());

                    $data['pembayaran'] = $this->pembayaran_model->get_all("status = 2 AND status != 3 AND status !=1")->result();

					$this->load->view('layout/header');
					$this->load->view('payment/lunas',$data);
					$this->load->view('layout/footer');
            }
            else
            {
				// $tipe_bayar = $this->input->post('tipe_bayar');
				// //cek tipe pelunasan jika pembayaran belum sesuai dengan total yang harus dibayar
				// if ($tipe_bayar == 2) {
					
				// }
				//cek jumlah bayar minimal 50% dari total pembayaran
				// $data_bayar = $this->pembayaran_model->get_by_id(['id' => $this->input->post('pembayaran_id')]);
				// $data_sewa = $this->sewa_model->get_by_id(['id' => $data_bayar->sewa_id]);
				// $setengah = ($data_sewa->total_harga * 50) / 100;
				// if ($this->input->post('jumlah_bayar') < $setengah) {
				// 	$this->session->set_flashdata('error', array('Pembayaran '));
    //             	redirect('payment/add');
				// }

				//cek sudah bayar apa belum gan
            	$bayarbelum = $this->pembayarandetail_model->get_by_id(['pembayaran_id' => $this->input->post('pembayaran_id')]);
            	if ($bayarbelum) {
            		if ($bayarbelum->tipe_bayar == $this->input->post('tipe_bayar')) {
            			$this->session->set_flashdata('err', 'Tidak bisa input tipe pembayaran yang sama.');
	                	redirect('payment/pelunasan');
            		}
            	}
            	

				//cek jika pernah melakukan 
                $uploadan = $this->upload->data();
                //nama file
                $bukti_bayar = $uploadan['file_name'];

                //reformat tgl_bayar
				$start = explode('-', $this->input->post('tgl_bayar'));
				$start_db = $start[2].'-'.$start[1].'-'.$start[0];
				$start = $start[2].'-'.$start[1].'-'.$start[0];
                //input ke pembayaran detail
                $pembayaran_detail = [
                	'pembayaran_id' => $this->input->post('pembayaran_id'),
                	'tipe_bayar' => $this->input->post('tipe_bayar'),
                	'status_bayar' => 1,
                	'jumlah_bayar' => $this->input->post('jumlah_bayar'),
                	'bukti_bayar' => $bukti_bayar,
                	'tgl_bayar' => $start
                ];
	            $this->pembayarandetail_model->save($pembayaran_detail);
                //kirim email ke user
                $sewa = $this->pembayaran_model->get_by_id(['id' => $this->input->post('pembayaran_id')]);
                $tipebayar = ($this->input->post('tipe_bayar') == 1) ? 'DP': 'Pelunasan';
				// $kirim_email = [
				// 	'email' => 'qwertynesia@gmail.com',
				// 	'nama' => 'Admin',
				// 	'subject' => $tipebayar.' Untuk ID Sewa #'.$sewa->sewa_id,
				// 	'view' => 'emails/new_dp_input',
				// 	'data' => [
				// 		'id_sewa' => $sewa->sewa_id,
				// 		'total' => $this->input->post('jumlah_bayar')
				// 	]
				// ];
				// if (sendmail($kirim_email)) {
	                $this->session->set_flashdata('sukses', 'Sukses Input pembayaran.');
	                // redirect('payment/add');
				// } else {
					// $this->session->set_flashdata('sukses', 'Sukses Input pembayaran dan gagal mengirim email ke admin.');
	                redirect('payment/pelunasan');
				// }
            }
		}
		// $data['pembayaran'] = $this->pembayaran_model->get_all(['customer_id' => $this->session->userdata('data')['id']])->result();

		// $this->load->view('layout/header');
		// $this->load->view('payment/add',$data);
		// $this->load->view('layout/footer');
	}
}