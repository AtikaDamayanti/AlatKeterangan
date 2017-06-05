<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_login extends CI_Model {

	function cek_user($nip,$password)
	{
		$query = $this->db->query("SELECT nip, password, nama_pegawai, nama_jabatan, nama_divisi, nama_unit_kerja, level, foto_pegawai
					FROM pegawai p JOIN unit_kerja k ON k.kode_unit_kerja = p.kode_unit_kerja
					JOIN jabatan j ON j.kode_jabatan = p.kode_jabatan
					LEFT JOIN divisi d ON d.kode_divisi = j.kode_divisi
					WHERE NIP = '$nip' AND PASSWORD='$password'");
		return $query->result();
	}

	function getUnitKerja($nip){
		$q = $this->db->query("select substr(nama_unit_kerja, 8, 7) as nama_unit 
					from unit_kerja uk 
					join pegawai p on p.KODE_UNIT_KERJA = uk.KODE_UNIT_KERJA
					where nip = '$nip' ");
		foreach ($q->result() as $value) {
			$v = $value->nama_unit;
		}
		return $v;
	}
	

}

/* End of file m_dashdoard.php */
/* Location: ./application/models/m_dashdoard.php */