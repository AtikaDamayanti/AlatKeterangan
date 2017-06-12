<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class dashboard extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('m_dashboard','dashboard');
        $this->load->helper('language', 'url', 'form');
    }

	public function index()
	{
		$this->load->view('v_dashboard');
	}

	public function getNotif(){
		$nip = $this->session->userdata('nip');
		$result = $this->dashboard->getNotif($nip);
		$data = array();
		foreach ($result as $value) {
			echo "<a href='$value->link_mp'><i class='fa fa-tasks fa-fw'></i> 
            <span class='pull-right text-muted small' onclick='updateNotif(".$value->kode_pemberitahuan.")'>".$value->dari."</span></a>";
		}
	}

	public function getJumlahNotif(){
		$nip = $this->session->userdata('nip');
		$result = $this->dashboard->getJumlahNotif($nip);
		$data = array();
		foreach ($result as $value) {
			echo "<span class='label label-danger'>$value->jml</span><i class='fa fa-bell fa-fw'></i> <i class='fa fa-caret-down'></i>";
		}
	}

	public function updateNotif($id){
		$this->dashboard->update_notif();
	}

	public function dataRekap(){
		$lv = $this->session->userdata('level');
		$uk = $this->session->userdata('unit_kerja');
		$dv = $this->session->userdata('divisi');
		$nip = $this->session->userdata('nip');
		
		$result = $this->dashboard->getRekap($lv,$uk,$dv,$nip)->result();
	    $data = array();
	    foreach ($result as $value) {
	    	$row = array();
	    	$row[] = $value->NAMA_UNIT;
	    	$row[] = $value->JUMLAH_DATA_ALKET;
	    	$row[] = rp($value->JUMLAH_NILAI_ALKET);
	    	$row[] = $value->JUMLAH_DATA_REALISASI;
	    	$row[] = rp($value->JUMLAH_NILAI_REALISASI);
	    	$data[] = $row;
	    }
	    echo json_encode(['data' => $data]);
	}

	public function dataRekapChart(){
		$lv = $this->session->userdata('level');
		$uk = $this->session->userdata('unit_kerja');
		$dv = $this->session->userdata('divisi');
		$nip = $this->session->userdata('nip');
		
		$res = $this->dashboard->getRekap($lv,$uk,$dv,$nip)->result();
		foreach ($res as $value) {
			$data[] = array(
				'NAMA_UNIT' => $value->NAMA_UNIT,
				'JUMLAH_DATA_ALKET' => $value->JUMLAH_DATA_ALKET,
				'JUMLAH_DATA_REALISASI' => $value->JUMLAH_DATA_REALISASI
				);
		}
		echo json_encode($data);

	}

}

/* End of file dashboard.php */
/* Location: ./application/controllers/dashboard.php */