<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class login extends CI_Controller {

	function __construct()
    {
        parent::__construct();
        $this->load->model('m_login','login');
        $this->load->helper('language', 'url', 'form');
    }

	public function index()
	{
		$session = $this->session->userdata('isLogin');
        if($session == FALSE)
        {
            $this->load->view('v_login');
        }
    }

	function do_login()
    {
        $nip = $this->input->post("nip");
        $password = $this->input->post("password");

        echo "<script>alert('$password')</script>";
        
        $cek = $this->login->cek_user($nip,$password);
        if(count($cek) == 1)
        {
            foreach ($cek as $c) 
            {
                $unit_kerja = $c->nama_unit_kerja;
                $jabatan = $c->nama_jabatan;
                $nama = $c->nama_pegawai;
                $divisi = $c->nama_divisi;
                $level = $c->level;
                $foto = $c->foto_pegawai;
        	}

            $this->session->set_userdata(array(
                'isLogin'	=> TRUE,
                'nip'		=> $nip,
                'unit_kerja'=> $unit_kerja,
                'divisi'    => $divisi,
                'jabatan'	=> $jabatan,
                'level'     => $level,
                'nama_pegawai'	=> $nama,
                'foto' => $foto
            ));
            
            redirect('dashboard');            
            // $get = $this->login->getUnitKerja($nip);
           
            // if($get == "Pelayan"){
            //     redirect('penerimaan');
            // } else {
            //     redirect('pengiriman');
            // } 
        } else {
        	redirect('login');
        }
    }

	function logout()
	{
		$this->session->sess_destroy();
		redirect('login','refresh');
	}

}

/* End of file login.php */
/* Location: ./application/controllers/login.php */