<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_penerimaan extends CI_Model {

	//ambil data
	public function getDetilAk($id){
		$query = $this->db->query("select NO_ALKET, IF(KODE_WP IS NULL, KODE_NON_WP, KODE_WP) AS KODE from alket where NO_ALKET = '$id' ");
		return $query->result();
	}

	//combobox
	function cb_kpp_kasi($uk, $dv)
	{
		$query = $this->db->query("select NIP, concat(nama_jabatan,' ',SUBSTRING(nama_divisi,1, LENGTH(nama_divisi)),' - ',NAMA_PEGAWAI) as LENGKAP
			from pegawai p join jabatan j on p.KODE_JABATAN = j.KODE_JABATAN
			join divisi d on d.KODE_DIVISI = j.KODE_DIVISI
			join unit_kerja uk on uk.KODE_UNIT_KERJA = p.KODE_UNIT_KERJA
			where NAMA_UNIT_KERJA like '%$uk%' and NAMA_DIVISI like '%$dv%' and nama_jabatan like '%Kepala%' ");
		return $query->result();
	}

	function cb_status_dok()
	{
		$query = $this->db->query("select * from status_dokumen where kode_status_dokumen in ('SD003','SD004') ");
		return $query->result();
	}

	function cb_kpp_ar($uk, $dv, $nip)
	{
		$query = $this->db->query("select NIP, concat(nama_jabatan,' ',SUBSTRING(nama_divisi,1, LENGTH(nama_divisi)),' - ',NAMA_PEGAWAI) as LENGKAP
			from pegawai p join jabatan j on p.KODE_JABATAN = j.KODE_JABATAN
			join divisi d on d.KODE_DIVISI = j.KODE_DIVISI
			join unit_kerja uk on uk.KODE_UNIT_KERJA = p.KODE_UNIT_KERJA
			where NAMA_UNIT_KERJA like '%$uk%' and NAMA_DIVISI like '%$dv%' and nama_jabatan like '%Account%' ");
		return $query->result();
	}

	// tampil data tabel
	public function getTrm($uk, $lv, $dv, $nip){
		if ($lv == '1'){
			$query = $this->db->query("SELECT NO_ALKET, IF(KODE_WP IS NULL, 'Non Wajib Pajak','Wajib Pajak') AS STATUS, TGL_KIRIM 
						FROM ALKET a
						JOIN unit_kerja KT ON KT.KODE_UNIT_KERJA = A.UNIT_KERJA_TUJUAN
						WHERE TGL_TERIMA = '0000-00-00 00:00:00' and
						nama_unit_kerja like '%$uk%' ");	
		} else if($lv == '2'){
			$query = $this->db->query("SELECT a.NO_ALKET, IF(KODE_WP IS NULL, 'Non Wajib Pajak','Wajib Pajak') AS STATUS, TGL_KIRIM 
						FROM ALKET a
						JOIN unit_kerja KT ON KT.KODE_UNIT_KERJA = A.UNIT_KERJA_TUJUAN
                        JOIN disposisi d on d.NO_ALKET = a.no_alket
                        JOIN pegawai p on p.NIP = d.PENERIMA_DISPOSISI
                        join jabatan j on j.KODE_JABATAN = p.KODE_JABATAN
                        join divisi v on v.KODE_DIVISI = j.KODE_DIVISI
						WHERE penerima_disposisi = '$nip' and
						a.NO_ALKET not in (SELECT SP.NO_ALKET FROM DISPOSISI SP WHERE PENGIRIM_DISPOSISI = '$nip') and
						nama_unit_kerja like '%$uk%' and 
						nama_divisi like '%$dv%' ");
		} else if ($lv == '3'){
			$query = $this->db->query("SELECT a.NO_ALKET, IF(KODE_WP IS NULL, 'Non Wajib Pajak','Wajib Pajak') AS STATUS, TGL_KIRIM 
						FROM ALKET a
						JOIN unit_kerja KT ON KT.KODE_UNIT_KERJA = A.UNIT_KERJA_TUJUAN
                        JOIN disposisi d on d.NO_ALKET = a.no_alket
                        JOIN pegawai p on p.NIP = d.PENERIMA_DISPOSISI
                        join jabatan j on j.KODE_JABATAN = p.KODE_JABATAN
                        join divisi v on v.KODE_DIVISI = j.KODE_DIVISI
						WHERE nama_unit_kerja like '%$uk%' and 
						nama_divisi like '%$dv%' and 
						penerima_disposisi = '$nip'");
		}
		
		return $query->result();
	}

	public function getRls($nip, $uk, $dv, $lv){
		if ($lv == '1'){
			$query = $this->db->query("SELECT a.NO_ALKET, IF(KODE_WP IS NULL, 'Non Wajib Pajak','Wajib Pajak') AS STATUS, NILAI_ALKET, IF(NILAI_REALISASI IS NULL,0,NILAI_REALISASI) AS NILAI_REALISASI, TGL_REALISASI, TGL_LAPORAN
						FROM ALKET a
                        JOIN disposisi d on d.NO_ALKET = a.no_alket
                        join pegawai p on p.nip = d.PENERIMA_DISPOSISI
                        join unit_kerja uk on uk.KODE_UNIT_KERJA = p.KODE_UNIT_KERJA
                        join jabatan j on j.KODE_JABATAN = p.KODE_JABATAN
                        join divisi v on v.kode_divisi = j.KODE_DIVISI 
                        WHERE NAMA_UNIT_KERJA like '%$uk%' AND PENGIRIM_DISPOSISI = '$nip' ");
		} else if ($lv == '2'){
			$query = $this->db->query("SELECT a.NO_ALKET, IF(KODE_WP IS NULL, 'Non Wajib Pajak','Wajib Pajak') AS STATUS, NILAI_ALKET, IF(NILAI_REALISASI IS NULL,0,NILAI_REALISASI) AS NILAI_REALISASI, TGL_REALISASI, TGL_LAPORAN
						FROM ALKET a
                        JOIN disposisi d on d.NO_ALKET = a.no_alket
                        join pegawai p on p.nip = d.PENERIMA_DISPOSISI
                        join unit_kerja uk on uk.KODE_UNIT_KERJA = p.KODE_UNIT_KERJA
                        join jabatan j on j.KODE_JABATAN = p.KODE_JABATAN
                        join divisi v on v.kode_divisi = j.KODE_DIVISI 
                        WHERE NAMA_UNIT_KERJA like '%$uk%' and NAMA_DIVISI like '%$dv%' AND PENGIRIM_DISPOSISI = '$nip' ");
		} else if ($lv == '3'){
			$query = $this->db->query("SELECT a.NO_ALKET, IF(KODE_WP IS NULL, 'Non Wajib Pajak','Wajib Pajak') AS STATUS, NILAI_ALKET, NILAI_REALISASI, TGL_REALISASI, TGL_LAPORAN
						FROM ALKET a
                        JOIN disposisi d on d.NO_ALKET = a.no_alket
                        join pegawai p on p.nip = d.PENERIMA_DISPOSISI
                        join unit_kerja uk on uk.KODE_UNIT_KERJA = p.KODE_UNIT_KERJA
                        join jabatan j on j.KODE_JABATAN = p.KODE_JABATAN
                        join divisi v on v.kode_divisi = j.KODE_DIVISI
                        WHERE NAMA_UNIT_KERJA like '%$uk%' and NAMA_DIVISI like '%$dv%' and PENERIMA_DISPOSISI = '$nip' ");
		}
		return $query->result();
	}

	public function get_detil_ak($id){
		$query = $this->db->query("SELECT NO_ALKET, ua.nama_unit_kerja as asal, ut.nama_unit_kerja as tujuan, if(a.kode_wp is null, a.kode_non_wp, a.kode_wp) as kode_p, if(a.kode_wp is null, nama_non_wp, nama_wp) as nama_p, nama_jenis_dokumen, lembar, nilai_alket, tgl_kirim, tgl_terima, tgl_realisasi, tgl_laporan, nilai_realisasi, keterangan, nama_status_dokumen, nama_pegawai, if(nilai_realisasi > nilai_alket, concat('+ ',nilai_realisasi-nilai_alket), concat('- ',nilai_realisasi-nilai_alket)) as selisih
			FROM ALKET a
			join unit_kerja ua on ua.KODE_UNIT_KERJA = a.unit_kerja_asal
			join unit_kerja ut on ut.KODE_UNIT_KERJA = a.unit_kerja_tujuan
			left join wajib_pajak wp on wp.KODE_WP = a.kode_wp
			left join non_wajib_pajak nwp on nwp.KODE_NON_WP = a.kode_non_wp
			left join pegawai p on p.NIP = a.nip
			join jenis_dokumen jd on jd.KODE_JENIS_DOKUMEN = a.kode_jenis_dokumen
			join status_dokumen sd on sd.KODE_STATUS_DOKUMEN = a.kode_status_dokumen
			where no_alket = '$id' ");
		return $query->result();
	}

	//tambah data
	function add_trm($nip){
		$penerima = $this->input->post('tujuan');
		$add_trm = array(
			'NO_ALKET' => $this->input->post('alket_no'),
			'TGL_DISPOSISI' => date("Y-m-d h:i:s"),
			'PENGIRIM_DISPOSISI' => $nip,
			'PENERIMA_DISPOSISI' => $penerima,
			'KETERANGAN' => $this->input->post('keterangan') 
			);
		$this->db->insert('disposisi', $add_trm);

		$where = array(
				'NO_ALKET' => $this->input->post('alket_no')
				);
		$data = array(
				'TGL_TERIMA' => date("Y-m-d h:i:s")
				);
		$this->db->where($where);
		$this->db->update('alket',$data);

		$id = gen_id(date("ymd"), 'pemberitahuan', 'kode_pemberitahuan', 3, 7);
		$tujuan = $this->db->query("select nip from pegawai where nip = '$penerima' ")->result_array();

		$add_notif = array(
			'kode_pemberitahuan' => $id,
			'status_pemberitahuan' => 'belum',
			'asal_pemberitahuan' => $nip,
			'tujuan_pemberitahuan' => $tujuan["0"]["nip"],
			'keterangan_pemberitahuan' => 'MP02' 
		);
		$this->db->insert('pemberitahuan', $add_notif);
	}

	function add_rls($nip){
		$data = array(
			'TGL_REALISASI' => $this->input->post('tgl_real'),
			'TGL_LAPORAN' => date("Y-m-d h:i:s"),
			'NILAI_REALISASI' => $this->input->post('nilai_real'),
			'KETERANGAN' => $this->input->post('keterangan'), 
			'KODE_STATUS_DOKUMEN' => $this->input->post('status'), 
			'NIP' => $nip
			);
		$where = array(
				'NO_ALKET' => $this->input->post('noalket'));
		$this->db->where($where);
		$this->db->update('alket',$data);

		$npwp = $this->input->post('npwp_mutasi');
		$ar = $this->input->post('ar_wp');
		$kode = $this->input->post('kode');
		if(!empty($npwp)){
			$query = $this->db->query("SELECT (SELECT CONCAT('WP',MAX(substr(KODE_WP, 3))+1) FROM wajib_pajak) AS KODE_WP, NAMA_NON_WP, ALAMAT_NON_WP, TELP_NON_WP FROM non_wajib_pajak WHERE KODE_NON_WP = '$kode' ")->result();
			foreach ($query as $value) {
				$dt['NPWP'] = $npwp;
				$dt['KODE_WP'] = $value->KODE_WP;
				$dt['NAMA_WP'] = $value->NAMA_NON_WP;
				$dt['ALAMAT_WP'] = $value->ALAMAT_NON_WP;
				$dt['TELP_WP'] = $value->TELP_NON_WP;
				$dt['AR'] = $ar;
				$this->db->insert('wajib_pajak',$dt);
			};
		}

		$id = gen_id(date("ymd"), 'pemberitahuan', 'kode_pembe ritahuan', 3);
		$tujuan = $this->db->query("select nip, kode_unit_kerja from pegawai p join jabatan j on p.kode_jabatan = j.kode_jabatan join jabatan b on j.kode_jabatan = b.jabatan_induk where nip = '$nip' ")->result_array();

		for ($i=0; $i < sizeOf($tujuan); $i++) { 
			if($tujuan[$i]["kode_unit_kerja"] == '20001') {
				$kp = 'MP03';
			} else {
				$kp = 'MP04';
			}

			$add_notif = array(
			'kode_pemberitahuan' => $id,
			'status_pemberitahuan' => 'belum',
			'asal_pemberitahuan' => $nip,
			'tujuan_pemberitahuan' => $tujuan[$i]["nip"],
			'keterangan_pemberitahuan' => $kp 
			);
			$this->db->insert('pemberitahuan', $add_notif);
		}


	}

}

/* End of file m_penerimaan.php */
/* Location: ./application/models/m_penerimaan.php */