<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class pengiriman extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('m_pengiriman','pengiriman');
        $this->load->helper('language', 'url', 'form');
    }

    public function index()
	{
		//ambil kode
		$data['kode_ak'] = gen_id('AK', 'alket', 'NO_ALKET', 3,3);

		//ambil combobox
		$data['cb_jd'] = $this->pengiriman->cb_jd();
		$data['cb_uk'] = $this->pengiriman->cb_uk();
		$data['cb_wp'] = $this->pengiriman->cb_wp();
		$data['cb_nwp'] = $this->pengiriman->cb_nwp();

		$this->load->view('v_pengiriman',$data);
	}

	//tampil data
	public function dataAk(){
	    $result = $this->pengiriman->getAk();
	    $data = array();
	    foreach ($result as $value) {
	    	$row = array();
	    	$row[] = $value->NO_ALKET;
	    	$row[] = $value->UK_ASAL;
	    	$row[] = $value->UK_TUJUAN;
	    	$row[] = $value->KODE;
	    	$row[] = $value->NPWP;
	    	$row[] = $value->NAMA;
	    	$row[] = $value->NAMA_JENIS_DOKUMEN;
	    	$row[] = $value->LEMBAR;
	    	$row[] = $value->NILAI_ALKET;
	    	$row[] = $value->TGL_KIRIM;
	    	$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Ubah" onclick="edit_ak('."'".$value->NO_ALKET."'".')"><i class="glyphicon glyphicon-pencil"></i> Ubah</a>
				  	<a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_ak('."'".$value->NO_ALKET."'".')"><i class="glyphicon glyphicon-trash"></i> Hapus</a>';
			$data[] = $row;
	    }
	    echo json_encode(['data' => $data]);
	}

	public function dataTrm(){
		$result = $this->pengiriman->getTrm();
	    $data = array();
	    foreach ($result as $value) {
	    	$row = array();
	    	$row[] = $value->NAMA_UNIT_KERJA;
	    	$row[] = $value->NO_ALKET;
	    	$row[] = $value->TGL_KIRIM;
	    	$row[] = $value->TGL_TERIMA;
	    	$data[] = $row;
		}
		echo json_encode(['data' => $data]);
	}

	public function dataDps(){
		$result = $this->pengiriman->getDps();
	    $data = array();
	    foreach ($result as $value) {
	    	$row = array();
	    	$row[] = $value->uk_tujuan;
	    	$row[] = $value->dari;
	    	$row[] = $value->kepada;
	    	$row[] = $value->no_alket;
	    	$row[] = $value->tgl_disposisi;
	    	$data[] = $row;
		}
		echo json_encode(['data' => $data]);
	}

	public function dataRls(){
		$result = $this->pengiriman->getRls();
	    $data = array();
	    foreach ($result as $value) {
	    	$row = array();
	    	$row[] = $value->NAMA_UNIT_KERJA;
	    	$row[] = $value->NO_ALKET;
	    	$row[] = $value->TGL_KIRIM;
	    	$row[] = $value->TGL_LAPORAN;
	    	$row[] = $value->SELISIH_WAKTU;
	    	$row[] = $value->NILAI_ALKET;
	    	$row[] = $value->NILAI_REALISASI;
	    	$row[] = $value->SELISIH_NILAI;
	    	$data[] = $row;
		}
		echo json_encode(['data' => $data]);
	}

	// tambah data
	public function addAk(){
		$asal = $this->session->userdata('nip');

	    $config['upload_path'] = 'uploads/';
        $config['allowed_types'] = '*';
        $config['max_filename'] = '255';
        $config['max_size'] = '3024'; //1 MB

        if (isset($_FILES['file']['name'])) {
            if (0 < $_FILES['file']['error']) {
                echo 'Error during file upload' . $_FILES['file']['error'];
            } else {
                if (file_exists('uploads/' . $_FILES['file']['name'])) {
                    echo 'File already exists : uploads/' . $_FILES['file']['name'];
                } else {
                    $this->load->library('upload');
                    $this->upload->initialize($config);
                    if (!$this->upload->do_upload('file')) {
                        echo $this->upload->display_errors();
                    } else {
                        //echo  'File successfully uploaded '.$_FILES['file']['name'];
                        $pct = $_FILES['file']['name'];
                        $this->pengiriman->add_ak($pct, $asal);

                    }
                }
            }
        } else {
            echo 'Please choose a file';
        }
	}

	// edit data
	public function editAk($id){
		$data = $this->pengiriman->get_ak($id);
		echo json_encode($data);
	}

	// update data
	public function updateAk(){
		$this->pengiriman->update_ak();
	}

	//hapus data
	public function deleteAk($id){
		$this->pengiriman->delete_ak($id);
	}
}

?>
