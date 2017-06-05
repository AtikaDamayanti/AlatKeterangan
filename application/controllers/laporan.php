<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class laporan extends CI_Controller {

	public function index()
	{
		$this->load->view('v_laporan_rekap_realisasi');
	}

}

/* End of file laporan.php */
/* Location: ./application/controllers/laporan.php */