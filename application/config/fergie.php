<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config['status_sewa'] = [
	// '1' => 'Belum Dibayar',
	// '2' => 'Sudah DP',
	// '3' => 'Lunas',
	'1' => 'Booked',
	'2' => 'On Stock',
	'3' => 'Sedang Dikirim',
	'4' => 'Sudah Dikembalikan'
];

$config['status_aktivasi'] = [
	'1' => 'Belum Aktif',
	'2' => 'Aktif',
];

$config['status_user'] = [
	'1' => 'Aktif',
	'2' => 'Non Aktif',
];
$config['status_pegawai'] = [
	'1' => 'Admin',
	'2' => 'Pemilik',
	'3' => 'Staff Delivery',
];

$config['tipe_bayar'] = [
	'1' => 'DP',
	'2' => 'Pelunasan',
];

$config['status_bayar_detail'] = [
	'1' => 'Belum Diterima',
	'2' => 'Diterima',
	'3' => 'Ditolak'
];

$config['status_bayar'] = [
	'1' => 'Belum Bayar',
	'2' => 'Sudah DP',
	'3' => 'Lunas',
];