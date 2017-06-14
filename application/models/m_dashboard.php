<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_dashboard extends CI_Model {

	public function getNotif($nip){
		$y = $this->db->query("select kode_pemberitahuan, concat(count(*),' ',keterangan_mp) as dari, link_mp from pemberitahuan p join m_pemberitahuan m on p.keterangan_pemberitahuan = m.kode_mp join pegawai e on e.nip = p.asal_pemberitahuan join unit_kerja u on u.kode_unit_kerja = e.kode_unit_kerja where tujuan_pemberitahuan = '$nip' ")->result();
		return $y;
	}

	public function getJumlahNotif($nip){
		$y = $this->db->query("select count(*) as jml from pemberitahuan where status_pemberitahuan = 'belum' and tujuan_pemberitahuan = '$nip' ")->result();
		return $y;
	}

	public function update_notif($id){
		$where = array(
				'kode_pemberitahuan' => $id
				);
		$data = array(
				'status_pemberitahuan' => 'sudah'
				);
		$this->db->where($where);
		$this->db->update('pemberitahuan', $data);
	}

	public function getRekap($lv,$uk,$dv,$nip){
		if($lv == '0'){
			$query = $this->db->query("SELECT KT.NAMA_UNIT_KERJA AS NAMA_UNIT, COUNT(NILAI_ALKET) AS JUMLAH_DATA_ALKET, IFNULL(SUM(NILAI_ALKET),0) AS JUMLAH_NILAI_ALKET, COUNT(NILAI_REALISASI) AS JUMLAH_DATA_REALISASI, IFNULL(SUM(NILAI_REALISASI),0) AS JUMLAH_NILAI_REALISASI
				FROM alket A RIGHT JOIN unit_kerja KT ON a.UNIT_KERJA_TUJUAN = KT.KODE_UNIT_KERJA
				WHERE KT.KODE_UNIT_KERJA NOT IN ('200')
				GROUP BY KT.NAMA_UNIT_KERJA");
		} else if ($lv == '1'){
			$query = $this->db->query("SELECT NAMA_DIVISI AS NAMA_UNIT, COUNT(NILAI_ALKET) AS JUMLAH_DATA_ALKET, IFNULL(SUM(NILAI_ALKET),0) AS JUMLAH_NILAI_ALKET, COUNT(NILAI_REALISASI) AS JUMLAH_DATA_REALISASI, IFNULL(SUM(NILAI_REALISASI),0) AS JUMLAH_NILAI_REALISASI
				FROM DIVISI D JOIN JABATAN J ON J.KODE_DIVISI = D.KODE_DIVISI
				JOIN JABATAN JB ON JB.JABATAN_INDUK = J.KODE_JABATAN
				JOIN PEGAWAI P ON P.KODE_JABATAN = J.KODE_JABATAN
				JOIN UNIT_KERJA U ON U.KODE_UNIT_KERJA = P.KODE_UNIT_KERJA
				LEFT JOIN DISPOSISI S ON S.PENERIMA_DISPOSISI = P.NIP
				LEFT JOIN ALKET A ON A.NO_ALKET = S.NO_ALKET
				WHERE NAMA_UNIT_KERJA LIKE '%$uk%'
				GROUP BY NAMA_DIVISI");
		} else if ($lv == '2') {
			$query = $this->db->query("SELECT NAMA_PEGAWAI AS NAMA_UNIT, COUNT(NILAI_ALKET) AS JUMLAH_DATA_ALKET, IFNULL(SUM(NILAI_ALKET),0) AS JUMLAH_NILAI_ALKET, COUNT(NILAI_REALISASI) AS JUMLAH_DATA_REALISASI, IFNULL(SUM(NILAI_REALISASI),0) AS JUMLAH_NILAI_REALISASI
				FROM DIVISI D JOIN JABATAN J ON J.KODE_DIVISI = D.KODE_DIVISI
				JOIN PEGAWAI P ON P.KODE_JABATAN = J.KODE_JABATAN
				JOIN UNIT_KERJA U ON U.KODE_UNIT_KERJA = P.KODE_UNIT_KERJA
                LEFT JOIN DISPOSISI S ON S.PENERIMA_DISPOSISI = P.NIP
                LEFT JOIN ALKET A ON A.NO_ALKET = S.NO_ALKET
                WHERE NAMA_UNIT_KERJA LIKE '%$uk%' and NAMA_DIVISI LIKE '%$dv%' and P.NIP != '$nip'
                GROUP BY NAMA_PEGAWAI");
		} else if($lv == '3'){
			$query = $this->db->query("SELECT NAMA_PEGAWAI AS NAMA_UNIT, COUNT(NILAI_ALKET) AS JUMLAH_DATA_ALKET, IFNULL(SUM(NILAI_ALKET),0) AS JUMLAH_NILAI_ALKET, COUNT(NILAI_REALISASI) AS JUMLAH_DATA_REALISASI, IFNULL(SUM(NILAI_REALISASI),0) AS JUMLAH_NILAI_REALISASI
				FROM DIVISI D JOIN JABATAN J ON J.KODE_DIVISI = D.KODE_DIVISI
				JOIN PEGAWAI P ON P.KODE_JABATAN = J.KODE_JABATAN
				JOIN UNIT_KERJA U ON U.KODE_UNIT_KERJA = P.KODE_UNIT_KERJA
                LEFT JOIN DISPOSISI S ON S.PENERIMA_DISPOSISI = P.NIP
                LEFT JOIN ALKET A ON A.NO_ALKET = S.NO_ALKET
                WHERE NAMA_UNIT_KERJA LIKE '%$uk%' and NAMA_DIVISI LIKE '%$dv%' and P.NIP = '$nip'
                GROUP BY NAMA_PEGAWAI ");
		}

	return $query;
	}
}

/* End of file m_dashboard.php */
/* Location: ./application/models/m_dashboard.php */