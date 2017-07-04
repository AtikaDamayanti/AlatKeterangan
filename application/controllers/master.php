<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class master extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('m_master','master');
        $this->load->helper('language', 'url', 'form');
    }

	public function index()
	{
		$id = $this->session->userdata('unit_kerja');

		//ambil kode
		// $data['kode_dv'] = gen_id('DV', 'divisi', 'KODE_DIVISI', 3, 3);
		// $data['kode_jb'] = gen_id('JB', 'jabatan', 'KODE_JABATAN', 3, 3);
		// $data['kode_jd'] = gen_id('JD', 'jenis_dokumen', 'KODE_JENIS_DOKUMEN', 3, 3);
		// $data['kode_sd'] = gen_id('SD', 'status_dokumen', 'KODE_STATUS_DOKUMEN', 3, 3);
		// $data['kode_wp'] = gen_id('WP', 'wajib_pajak', 'KODE_WP', 3, 3);
		// $data['kode_nwp'] = gen_id('NW', 'non_wajib_pajak', 'KODE_NON_WP', 3, 3);
		
		//ambil combobox
		$data['cb_dv'] = $this->master->cb_dv();
        $data['cb_jb'] = $this->master->cb_jb();
        $data['cb_uk'] = $this->master->cb_uk();
        $data['cb_ar'] = $this->master->cb_ar($id);
        $data['cb_kpp'] = $this->master->cb_kpp();

		$this->load->view('v_master',$data);
	}

	public function getKodePegawai($id){
		$result = $this->master->kode_pg($id);
		echo strtoupper($id).str_pad($result,2,"0",STR_PAD_LEFT);
	}

	public function getKodeJd()
	{
		$data = gen_id('JD', 'jenis_dokumen', 'KODE_JENIS_DOKUMEN', 3, 3);
		echo json_encode($data);
	}

	public function getKodeJb()
	{
		$data = gen_id('JB', 'jabatan', 'KODE_JABATAN', 3, 3);
		echo json_encode($data);
	}

	public function getKodeDv()
	{
		$data = gen_id('DV', 'divisi', 'KODE_DIVISI', 3, 3);
		echo json_encode($data);
	}	

	public function getKodeSd()
	{
		$data = gen_id('SD', 'status_dokumen', 'KODE_STATUS_DOKUMEN', 3, 3);
		echo json_encode($data);
	}

	public function getKodeWp()
	{
		$data = gen_id('WP', 'wajib_pajak', 'KODE_WP', 3, 3);
		echo json_encode($data);
	}

	public function getKodeNwp()
	{
		$data = gen_id('NW', 'non_wajib_pajak', 'KODE_NON_WP', 3, 3);
		echo json_encode($data);
	}

	//ambil data tabel
	public function dataUk(){
	    $result = $this->master->getUk();
	    $data = array();
	    $no = 1;
	    foreach ($result as $value) {
	    	$row = array();
	    	$row[] = $no;
	    	$row[] = $value->KODE_UNIT_KERJA;
	    	$row[] = $value->NAMA_UNIT_KERJA;
	    	$row[] = $value->ALAMAT_UNIT_KERJA;
	    	$row[] = $value->TELP_UNIT_KERJA;
	    	$row[] = $value->FAX_UNIT_KERJA;
	    	$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" 		title="Ubah" onclick="edit_uk('."'".$value->KODE_UNIT_KERJA."'".')"><i 		class="glyphicon glyphicon-pencil"></i> Ubah</a>
				  	<a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_uk('."'".$value->KODE_UNIT_KERJA."'".')"><i class="glyphicon glyphicon-trash"></i> Hapus</a>';
			$data[] = $row;
			$no++;
	    }
	    echo json_encode(['data' => $data]);
	}

	public function dataDv(){
	    $result = $this->master->getDv();
	    $data = array();
	    $no = 1;
	    foreach ($result as $value) {
	    	$row = array();
	    	$row[] = $no;
	    	$row[] = $value->KODE_DIVISI;
	    	$row[] = $value->NAMA_DIVISI;
	    	$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" 		title="Ubah" onclick="edit_dv('."'".$value->KODE_DIVISI."'".	')"><i class="glyphicon glyphicon-pencil"></i> Ubah</a>
				  	<a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_dv('."'".$value->KODE_DIVISI."'".')"><i class="glyphicon glyphicon-trash"></i> Hapus</a>';
			$data[] = $row;
			$no++;
	    }
	    echo json_encode(['data' => $data]);
	}

	public function dataJb(){
	    $result = $this->master->getJb();
	    $data = array();
	    $no = 1;
	    foreach ($result as $value) {
	    	$row = array();
	    	$row[] = $no;
	    	$row[] = $value->KODE_J;
	    	$row[] = $value->NAMA_J;
	    	$row[] = $value->J_INDUK;
	    	$row[] = $value->NAMA_D;
	    	$row[] = $value->LEVEL_J;
	    	$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" 		title="Ubah" onclick="edit_jb('."'".$value->KODE_J."'".	')"><i class="glyphicon glyphicon-pencil"></i> Ubah</a>
				  	<a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_jb('."'".$value->KODE_J."'".')"><i class="glyphicon glyphicon-trash"></i> Hapus</a>';
			$data[] = $row;
		    $no++;
	    }
	    echo json_encode(['data' => $data]);
	}

	public function dataPg(){
	    $result = $this->master->getPg();
	    $data = array();
	    $no = 1;
	    foreach ($result as $value) {
	    	$row = array();
	    	$row[] = $no;
	    	$row[] = $value->NIP;
	    	$row[] = $value->NAMA_J;
	    	$row[] = $value->NAMA_UK;
	    	$row[] = $value->NAMA_PEGAWAI;
	    	$row[] = $value->ALAMAT_PEGAWAI;
	    	$row[] = $value->TELP_PEGAWAI;
	    	$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" 		title="Ubah" onclick="edit_pg('."'".$value->NIP."'".	')"><i class="glyphicon glyphicon-pencil"></i> Ubah</a>
				  	<a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_pg('."'".$value->NIP."'".')"><i class="glyphicon glyphicon-trash"></i> Hapus</a>';
			$data[] = $row;
	 	   	$no++;
	    }
	    echo json_encode(['data' => $data]);
	}

	public function dataJd(){
	    $result = $this->master->getJd();
	    $data = array();
	    $no = 1;
	    foreach ($result as $value) {
	    	$row = array();
	    	$row[] = $no;
	    	$row[] = $value->KODE_JENIS_DOKUMEN;
	    	$row[] = $value->NAMA_JENIS_DOKUMEN;
	    	$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" 		title="Ubah" onclick="edit_jd('."'".$value->KODE_JENIS_DOKUMEN."'".	')"><i class="glyphicon glyphicon-pencil"></i> Ubah</a>
				  	<a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_jd('."'".$value->KODE_JENIS_DOKUMEN."'".')"><i class="glyphicon glyphicon-trash"></i> Hapus</a>';
			$data[] = $row;
	    }
	    echo json_encode(['data' => $data]);
	}

	public function dataSd(){
	    $result = $this->master->getSd();
	    $data = array();
	    $no = 1;
	    foreach ($result as $value) {
	    	$row = array();
	    	$row[] = $no;
	    	$row[] = $value->KODE_STATUS_DOKUMEN;
	    	$row[] = $value->NAMA_STATUS_DOKUMEN;
	    	$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" 		title="Ubah" onclick="edit_sd('."'".$value->KODE_STATUS_DOKUMEN."'".	')"><i class="glyphicon glyphicon-pencil"></i> Ubah</a>
				  	<a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_sd('."'".$value->KODE_STATUS_DOKUMEN."'".')"><i class="glyphicon glyphicon-trash"></i> Hapus</a>';
			$data[] = $row;
	    	$no++;
	    }
	    echo json_encode(['data' => $data]);
	}

	public function dataWp(){
	    $result = $this->master->getWp();
	    $data = array();
	    $no = 1;
	    foreach ($result as $value) {
	    	$row = array();
	    	$row[] = $no;
	    	$row[] = $value->KODE_WP;
	    	$row[] = $value->NPWP;
	    	$row[] = $value->NAMA_WP;
	    	$row[] = $value->ALAMAT_WP;
	    	$row[] = $value->TELP_WP;
	    	$row[] = $value->NAMA_P;
	    	$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Ubah" onclick="edit_wp('."'".$value->KODE_WP."'".	')"><i class="glyphicon glyphicon-pencil"></i> Ubah</a>
				  	<a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_wp('."'".$value->KODE_WP."'".')"><i class="glyphicon glyphicon-trash"></i> Hapus</a>';
	    	$data[] = $row;
	    	$no++;
	    }
	    echo json_encode(['data' => $data]);
	}

	public function dataNwp(){
	    $result = $this->master->getNwp();
	    $data = array();
	    $no = 1;
	    foreach ($result as $value) {
	    	$row = array();
	    	$row[] = $no;
	    	$row[] = $value->KODE_NON_WP;
	    	$row[] = $value->NAMA_NON_WP;
	    	$row[] = $value->ALAMAT_NON_WP;
	    	$row[] = $value->TELP_NON_WP;
	    	$row[] = $value->NAMA_UNIT_KERJA;
	    	$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" 		title="Ubah" onclick="edit_nwp('."'".$value->KODE_NON_WP."'".	')"><i class="glyphicon glyphicon-pencil"></i> Ubah</a>
				  	<a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_nwp('."'".$value->KODE_NON_WP."'".')"><i class="glyphicon glyphicon-trash"></i> Hapus</a>';
	    	$data[] = $row;
	    	$no++;
	    }
	    echo json_encode(['data' => $data]);
	}

	//tambah data

	public function addUk(){
		$this->master->add_uk();
	}

	public function addJb(){
		$this->master->add_jb();
	}

	public function addDv(){
		$this->master->add_dv();
	}

	public function addPg(){
		$config['upload_path'] = 'uploads/';
        $config['allowed_types'] = '*';
        $config['max_filename'] = '255';
        $config['max_size'] = '3024'; //1 MB

        if (isset($_FILES['fotop']['name'])) {
            $this->load->library('upload');
            $this->upload->initialize($config);
            if (!$this->upload->do_upload('fotop')) {
                echo $this->upload->display_errors();
            } else {
                $pct = $_FILES['fotop']['name'];
                //add to db
                $result = $this->master->add_pg($pct);
                //get password from db
			    foreach ($result as $value) {
			    	$p = $value->PASSWORD;
			    	$e = $value->EMAIL_PEGAWAI;
				}
                $this->send_email($p, $e);
            }
        } else {
            echo 'Please choose a file';
        }
	}

	public function send_email($p, $e){
		$this->load->library('email');

		$sender = 'atikarizkyy@gmail.com';
		$pasw = '19950714Atika';

		$config['protocol']		= 'smtp';
		$config['smtp_host']    = 'smtp.gmail.com';
		$config['smtp_port']    = '465';
		$config['smtp_timeout'] = '7';
		$config['smtp_user']    = 'atikarizkyy@gmail.com';
		$config['smtp_pass']    = '19950714Atika';
		$config['charset']    	= 'utf-8';
		$config['newline']    	= "\r\n";
		$config['mailtype'] 	= 'html'; // or html
		$config['validation'] 	= TRUE;
		$this->email->initialize($config);  

			$this->email->from($sender, 'Atika Damayanti');
			$this->email->to($e);
			// $this->email->cc('another@another-example.com');
			// $this->email->bcc('them@their-example.com');
			$this->email->subject('Your Password');
			$this->email->message('Your Password is '.$p);
			if($this->email->send())
	        {
	        	echo $this->email->print_debugger(); echo 'mail send'.$body;
	        }
	        else {
	        	echo $this->email->print_debugger();
	    	}
	}

	public function addJd(){
		$this->master->add_jd();
	}

	public function addSd(){
		$this->master->add_sd();
	}

	public function addWp(){
		$this->master->add_wp();
	}

	public function addNwp(){
		$this->master->add_nwp();
	}

	// edit data
	public function editUk($id)
	{
		$data = $this->master->get_uk($id);
		echo json_encode($data);
	}

	public function editDv($id)
	{
		$data = $this->master->get_dv($id);
		echo json_encode($data);
	}

	public function editJb($id)
	{
		$data = $this->master->get_jb($id);
		echo json_encode($data);
	}

	public function editPg($id)
	{
		$data = $this->master->get_pg($id);
		echo json_encode($data);
	}

	public function editJd($id)
	{
		$data = $this->master->get_jd($id);
		echo json_encode($data);
	}

	public function editSd($id)
	{
		$data = $this->master->get_sd($id);
		echo json_encode($data);
	}

	public function editWp($id)
	{
		$data = $this->master->get_wp($id);
		echo json_encode($data);
	}

	public function editNwp($id)
	{
		$data = $this->master->get_nwp($id);
		echo json_encode($data);
	}

	// update data
	public function updateUk(){
		$this->master->update_uk();
	}

	public function updateDv(){
		$this->master->update_dv();
	}

	public function updateJb(){
		$this->master->update_jb();
	}

	public function updatePg(){
		$this->master->update_pg();
	}

	public function updateJd(){
		$this->master->update_jd();
	}

	public function updateSd(){
		$this->master->update_sd();
	}

	public function updateWp(){
		$this->master->update_wp();
	}

	public function updateNwp(){
		$this->master->update_nwp();
	}

	// delete data
	public function deleteUk($id){
		$this->master->delete_uk($id);
	}

	public function deleteDv($id){
		$this->master->delete_dv($id);
	}

	public function deleteJb($id){
		$this->master->delete_jb($id);
	}

	public function deletePg($id){
		$this->master->delete_pg($id);
	}

	public function deleteJd($id){
		$this->master->delete_jd($id);
	}

	public function deleteSd($id){
		$this->master->delete_sd($id);
	}

	public function deleteWp($id){
		$this->master->delete_wp($id);
	}

	public function deleteNwp($id){
		$this->master->delete_nwp($id);
	}

}

?>