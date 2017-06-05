<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_pengiriman extends CI_Model {

	// ambil kode
	function kode_ak(){
		$kd = 'AK';
		$query = $this->db->query("select IFNULL(MAX(substr(NO_ALKET, 3)),0)+1 as max_id from alket");
		$row = $query->row_array();
		$max_id = $row['max_id'];
		$kode = $kd.$max_id;
		return $kode;
	}

	//data combobox
	function cb_jd(){
        $query = $this->db->query("select * from jenis_dokumen");
        return $query->result();
    }

    function cb_uk()
	{
		$this->db->select('*')->from('unit_kerja');
		$query = $this->db->get();
		return $query->result();
	}

	function cb_wp()
	{
		$this->db->select('*')->from('wajib_pajak');
		$query = $this->db->get();
		return $query->result();
	}


	//tampil data edit
	public function get_ak($id)
	{
		$query = $this->db->query("SELECT NO_ALKET, KA.KODE_UNIT_KERJA AS UK_ASAL, KT.KODE_UNIT_KERJA AS UK_TUJUAN, A.KODE_WP AS KODE_WP, NPWP, NAMA, A.KODE_JENIS_DOKUMEN AS KODE_JD, LEMBAR, NILAI_ALKET, TGL_KIRIM
			FROM alket A JOIN wajib_pajak P ON P.KODE_WP = A.KODE_WP 
			JOIN unit_kerja KA ON KA.KODE_UNIT_KERJA = A.UNIT_KERJA_ASAL
			JOIN unit_kerja KT ON KT.KODE_UNIT_KERJA = A.UNIT_KERJA_TUJUAN
			JOIN jenis_dokumen J ON J.KODE_JENIS_DOKUMEN = A.KODE_JENIS_DOKUMEN
			WHERE NO_ALKET = '$id' ");
		return $query->result();
	}

	// tampil data tabel
	public function getAk(){
		$this->db->select('NO_ALKET, KA.NAMA_UNIT_KERJA AS UK_ASAL, KT.NAMA_UNIT_KERJA AS UK_TUJUAN, NPWP, NAMA_WP, NAMA_JENIS_DOKUMEN, LEMBAR, NILAI_ALKET, TGL_KIRIM');
		$this->db->from('alket A');
		$this->db->join('wajib_pajak P','P.KODE_WP = A.KODE_WP');
		$this->db->join('unit_kerja KA','KA.KODE_UNIT_KERJA = A.UNIT_KERJA_ASAL');
		$this->db->join('unit_kerja KT','KT.KODE_UNIT_KERJA = A.UNIT_KERJA_TUJUAN');
		$this->db->join('jenis_dokumen J','J.KODE_JENIS_DOKUMEN = A.KODE_JENIS_DOKUMEN');
		$query = $this->db->get();
        return $query->result();
	}

	public function getTrm(){
		$query = $this->db->query("SELECT NO_ALKET, NAMA_UNIT_KERJA, TGL_KIRIM, TGL_TERIMA 
						FROM ALKET a
						JOIN unit_kerja KT ON KT.KODE_UNIT_KERJA = A.UNIT_KERJA_TUJUAN
						WHERE TGL_TERIMA != '0000-00-00 00:00:00' ");
		return $query->result();
	}

	public function getDps(){
		$query = $this->db->query("select nama_unit_kerja as uk_tujuan, concat(j.nama_jabatan,' ',p.nama_pegawai) as dari, concat(b.nama_jabatan,' ',g.nama_pegawai) as kepada, a.no_alket as NO_ALKET,  tgl_disposisi from disposisi d join pegawai p on p.nip = d.PENERIMA_DISPOSISI join pegawai g on g.nip = d.PENGIRIM_DISPOSISI join jabatan j on j.KODE_JABATAN = p.KODE_JABATAN join jabatan b on b.KODE_JABATAN = g.KODE_JABATAN join alket a on a.NO_ALKET = d.NO_ALKET join unit_kerja uk on uk.KODE_UNIT_KERJA = a.UNIT_KERJA_TUJUAN");
		return $query->result();
	}

	public function getRls(){
		$query = $this->db->query("select NAMA_UNIT_KERJA, NO_ALKET, TGL_KIRIM, TGL_LAPORAN, (TGL_LAPORAN-TGL_KIRIM) AS SELISIH_WAKTU, NILAI_ALKET, NILAI_REALISASI, (NILAI_REALISASI-NILAI_ALKET) AS SELISIH_NILAI
			from alket a
			JOIN WAJIB_PAJAK W ON A.KODE_WP = W.KODE_WP
			JOIN UNIT_KERJA K on A.UNIT_KERJA_TUJUAN = K.KODE_UNIT_KERJA 
			JOIN PEGAWAI P ON P.NIP = W.AR 
			JOIN JABATAN J ON J.KODE_JABATAN = P.KODE_JABATAN 
			JOIN DIVISI D ON D.KODE_DIVISI = J.KODE_DIVISI
			where tgl_realisasi != '0000-00-00 00:00:00'");
        return $query->result();
	}

	// tambah data
	function add_ak($pct){
		$add_ak = array(
			'NO_ALKET' => $this->input->post('no_alket'),
			'UNIT_KERJA_ASAL' => $this->input->post('uk_asal'),
			'UNIT_KERJA_TUJUAN' => $this->input->post('uk_tujuan'),
			'KODE_WP' => $this->input->post('kode_wp'),
			'KODE_JENIS_DOKUMEN' => $this->input->post('jenis_dokumen'),
			'LEMBAR' => $this->input->post('lembar'),
			'NILAI_ALKET' => $this->input->post('nilai_alket'),
			'TGL_KIRIM' => date("Y-m-d h:i:sa"),
			'KODE_STATUS_DOKUMEN' => 'SD001',
			'DOKUMEN' => $pct
			);
		$this->db->insert('alket', $add_ak);
	}

		// update data
		public function update_ak(){
			$where = array(
					'NO_ALKET' => $this->input->post('no_alket')
					);
			$data = array(
					'UNIT_KERJA_ASAL' => $this->input->post('uk_asal'),
					'UNIT_KERJA_TUJUAN' => $this->input->post('uk_tujuan'),
					'KODE_WP' => $this->input->post('kode_wp'),
					'KODE_JENIS_DOKUMEN' => $this->input->post('jenis_dokumen'),
					'LEMBAR' => $this->input->post('lembar'),
					'NILAI_ALKET' => $this->input->post('nilai_alket')
					);
			$this->db->where($where);
			$this->db->update('alket',$data);
		}

		//delete data
		public function delete_ak($id){
		$where = array(
				'NO_ALKET' => $id
				);
		$this->db->where($where);
		$this->db->delete('alket');
	}	

	}

?>