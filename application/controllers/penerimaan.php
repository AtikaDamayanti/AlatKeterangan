<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class penerimaan extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('m_penerimaan','penerimaan');
        $this->load->helper('language', 'url', 'form');
    }

    public function getid(){
    	$this->penerimaan->generate_id();
    }

	public function index()
	{
		$uk = $this->session->userdata('unit_kerja');
		$dv = $this->session->userdata('divisi');
		$jb = $this->session->userdata('jabatan');
		$lv = $this->session->userdata('level');
		$nip = $this->session->userdata('nip');

		if ($lv == '1'){
			$data['cb_kpp'] = $this->penerimaan->cb_kpp_kasi($uk, $dv);
		} else if ($lv == '2' or $lv == '3'){
			$data['cb_kpp'] = $this->penerimaan->cb_kpp_ar($uk, $dv, $nip);
		} else {
			$data = "";
		}
		$data['level'] = $lv;
		$data['divisi'] = $dv;

		$data['cb_status_dok'] = $this->penerimaan->cb_status_dok();

		$this->load->view('v_penerimaan',$data);
	}

	//ambil data
	public function getDetilAk($id){
		$data = $this->penerimaan->getDetilAk($id);
		echo json_encode($data);
	}

	public function getDetil($id){
		$data = $this->penerimaan->get_detil_ak($id);
		echo json_encode($data);	
	}

	//tampil data
	public function dataTrm(){
		$uk = $this->session->userdata('unit_kerja');
		$dv = $this->session->userdata('divisi');
		$jb = $this->session->userdata('jabatan');
		$lv = $this->session->userdata('level');
		$nip = $this->session->userdata('nip');

		$result = $this->penerimaan->getTrm($uk, $lv, $dv, $nip);
	    $data = array();
	    $no = 1;
	    foreach ($result as $value) {
	    	$row = array();
	    	$row[] = $no;
	    	$row[] = $value->NO_ALKET;
	    	$row[] = $value->STATUS;
	    	$row[] = $value->TGL_KIRIM;
	    	$row[] = '<a class="btn btn-sm btn-success" href="javascript:void(0)" title="Terima" onclick="add_trm('."'".$value->NO_ALKET."'".')"><i class="glyphicon glyphicon-pencil"></i> Terima</a>'; 
	    	$data[] = $row;
	    	$no++;
		}
		echo json_encode(['data' => $data]);
	}

	public function dataRls(){
		$uk = $this->session->userdata('unit_kerja');
		$dv = $this->session->userdata('divisi');
		$jb = $this->session->userdata('jabatan');
		$lv = $this->session->userdata('level');
		$nip = $this->session->userdata('nip');

		$result = $this->penerimaan->getRls($nip, $uk, $dv, $lv);
	    $data = array();
	    $no = 1;
	    foreach ($result as $value) {
	    	$row = array();
	    	$row[] = $no;
	    	$row[] = $value->NO_ALKET;
	    	$row[] = $value->STATUS;
	    	$row[] = $value->NILAI_ALKET;
	    	$row[] = $value->NILAI_REALISASI;
	    	$row[] = $value->TGL_REALISASI;
	    	$row[] = $value->TGL_LAPORAN;
	    	if ($lv == '1' or $lv =='2' or ($lv == '3' and $value->NILAI_REALISASI != NULL)){
	    		$row[] = '<a class="btn btn-sm btn-success" href="javascript:void(0)" title="Lihat" onclick="lihat_detil_ak('."'".$value->NO_ALKET."'".')"><i class="glyphicon glyphicon-eye-open"></i> Lihat</a>
	    					<a class="btn btn-sm btn-success" title="Cetak" href='.site_url().'/penerimaan/cetak/'.$value->NO_ALKET.'>
	    					<i class="glyphicon glyphicon-print"></i> Cetak</a>';
	    	} else if ($lv == '3' and $value->NILAI_REALISASI == NULL){
	    		$row[] = '<a class="btn btn-sm btn-warning" href="javascript:void(0)" title="Realisasi" onclick="add_rls('."'".$value->NO_ALKET."'".')"><i class="glyphicon glyphicon-pencil"></i> Realisasi</a>';
	    	}
	    	$data[] = $row;
	    	$no++;
		}
		echo json_encode(['data' => $data]);	
	}

	// tambah data
	public function addTrm(){
		$nip = $this->session->userdata('nip');
		$this->penerimaan->add_trm($nip);
	}

	public function addRls(){
		$nip = $this->session->userdata('nip');
		$this->penerimaan->add_rls($nip);
	}

	public function cetak($id){
		$data['detil'] = $this->penerimaan->get_detil_ak($id);
		$this->load->view('v_laporan_rekap_realisasi', $data);
	}

}

/* End of file penerimaan.php */
/* Location: ./application/controllers/penerimaan.php */