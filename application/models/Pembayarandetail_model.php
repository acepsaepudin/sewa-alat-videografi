<?php

class Pembayarandetail_model extends MY_Model
{

	function __construct()
	{
		parent::__construct();
		$this->table = 'pembayaran_detail';
	}
}