<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_master extends CI_Model {
	// ambil kode
	function kode_pg($id){
		$query = $this->db->query("select ifnull(max(substr(NIP,4)),0)+1 as max_id from PEGAWAI where left(NIP,3) = '$id' ");
		$id = $query->row_array();
		$max = $id["max_id"];
		return $max;
	}

	// baca data tabel

	function getUk()
	{
		$this->db->select("*");
		$this->db->from("unit_kerja");
		$query = $this->db->get();
		return $query->result();
	}

	function getDv()
	{
		$this->db->select("*");
		$this->db->from("divisi");
		$query = $this->db->get();
		return $query->result();
	}

	function getJb()
	{
		$this->db->select('J.KODE_JABATAN AS KODE_J, J.NAMA_JABATAN AS NAMA_J, B.NAMA_JABATAN AS J_INDUK, D.NAMA_DIVISI AS NAMA_D, J.LEVEL AS LEVEL_J');
        $this->db->from('jabatan J');
        $this->db->join('jabatan B','J.JABATAN_INDUK = B.KODE_JABATAN','left');
		$this->db->join('divisi D', 'D.KODE_DIVISI = J.KODE_DIVISI','left');
		$query = $this->db->get();			
		return $query->result();
	}

	function getPg()
	{
		$this->db->select('NIP, CONCAT(J.NAMA_JABATAN, " ",IFNULL(D.NAMA_DIVISI, "")) AS NAMA_J, PASSWORD, NAMA_PEGAWAI, ALAMAT_PEGAWAI, TELP_PEGAWAI, UK.NAMA_UNIT_KERJA AS NAMA_UK ');
		$this->db->from('pegawai P');
		$this->db->join('jabatan J','P.KODE_JABATAN = J.KODE_JABATAN','left');
		$this->db->join('divisi D','D.KODE_DIVISI = J.KODE_DIVISI','left');
		$this->db->join('unit_kerja UK','UK.KODE_UNIT_KERJA = P.KODE_UNIT_KERJA');
		$query = $this->db->get();
		return $query->result();
	}

	function getJd()
	{
		$this->db->select("*");
		$this->db->from("jenis_dokumen");
		$query = $this->db->get();
		return $query->result();
	}

	function getSd()
	{
		$this->db->select("*");
		$this->db->from("status_dokumen");
		$query = $this->db->get();
		return $query->result();
	}

	function getWp()
	{
		$query = $this->db->query("SELECT W.*, P.NAMA_PEGAWAI AS NAMA_P FROM PEGAWAI P RIGHT JOIN WAJIB_PAJAK W ON W.AR = P.NIP");
		return $query->result();
	}

	function getnWp()
	{
		$query = $this->db->query("SELECT * FROM NON_WAJIB_PAJAK N LEFT JOIN UNIT_KERJA UK ON UK.KODE_UNIT_KERJA = N.KPP_NON_WP");
		return $query->result();
	}

	// baca data combobox
	function cb_jb(){
        $query = $this->db->query("select KODE_JABATAN, NAMA_JABATAN, NAMA_DIVISI
        						from jabatan j left join divisi d on j.KODE_DIVISI = d.KODE_DIVISI
        						");
        return $query->result();
    }

    function cb_dv(){
        $query = $this->db->get('divisi');
        return $query->result();
    }

    function cb_uk()
	{
		$this->db->select('*')->from('unit_kerja');
		$query = $this->db->get();
		return $query->result();
	}

	function cb_ar($id){
		$query = $this->db->query("SELECT * FROM PEGAWAI P JOIN JABATAN J ON P.KODE_JABATAN = J.KODE_JABATAN JOIN UNIT_KERJA U ON U.KODE_UNIT_KERJA = P.KODE_UNIT_KERJA JOIN DIVISI D ON D.KODE_DIVISI = J.KODE_DIVISI WHERE NAMA_JABATAN LIKE '%Account%' and NAMA_UNIT_KERJA = '$id' ");
		return $query->result();
	}

	function cb_kpp(){
		$query = $this->db->query("SELECT * FROM UNIT_KERJA WHERE NAMA_UNIT_KERJA NOT LIKE '%Wilayah%' ");
		return $query->result();
	}

	// tambah data

	function add_uk($data){
		$data = array(
			'KODE_UNIT_KERJA' => $this->input->post('kode_uk'),
			'NAMA_UNIT_KERJA' => $this->input->post('nama_uk'),
			'ALAMAT_UNIT_KERJA' => $this->input->post('alamat_uk'),
			'TELP_UNIT_KERJA' => $this->input->post('telp_uk'),
			'FAX_UNIT_KERJA' => $this->input->post('fax_uk')
			);
		$this->db->insert('unit_kerja', $data);
	}

	function add_jb(){
		$add_jb = array(
			'KODE_JABATAN' => $this->input->post('kode_jb'),
			'NAMA_JABATAN' => $this->input->post('nama_jb'),
			'JABATAN_INDUK' => $this->input->post('jb_induk'),
			'KODE_DIVISI' => $this->input->post('nama_dv'),
			'LEVEL' => $this->input->post('level')
			);
		$this->db->insert('jabatan', $add_jb);
	}

	function add_dv(){
		$add_dv = array(
			'KODE_DIVISI' => $this->input->post('kode_dv'),
			'NAMA_DIVISI' => $this->input->post('nama_dv')
			);
		$this->db->insert('divisi', $add_dv);
	}

	function add_pg($pct){
		$add_pg = array(
			'NIP' => $this->input->post('nip'),
			'PASSWORD' => rand(),
			'NAMA_PEGAWAI' => $this->input->post('namap'),
			'ALAMAT_PEGAWAI' => $this->input->post('alamatp'),
			'TELP_PEGAWAI' => $this->input->post('teleponp'),
			'EMAIL_PEGAWAI' => $this->input->post('emailp'),
			'KODE_JABATAN' => $this->input->post('jabatanp'),
			'KODE_UNIT_KERJA' => $this->input->post('unit_kerjap'),
			'FOTO_PEGAWAI' => $pct
			);
		$this->db->insert('pegawai', $add_pg);
		
		$id = $this->input->post('nip');

		$this->db->select('PASSWORD, EMAIL_PEGAWAI');
		$this->db->from('pegawai');
		$this->db->where('NIP',$id);
		$query = $this->db->get();
		
		return $query->result();
	}

	function add_jd(){
		$add_jd = array(
			'KODE_JENIS_DOKUMEN' => $this->input->post('kode_jd'),
			'NAMA_JENIS_DOKUMEN' => $this->input->post('nama_jd')
			);
		$this->db->insert('jenis_dokumen', $add_jd);
	}

	function add_sd(){
		$add_sd = array(
			'KODE_STATUS_DOKUMEN' => $this->input->post('kode_sd'),
			'NAMA_STATUS_DOKUMEN' => $this->input->post('nama_sd')
			);
		$this->db->insert('status_dokumen', $add_sd);
	}

	function add_wp(){
		$add_wp = array(
			'KODE_WP' => $this->input->post('kode_wp'),
			'NPWP' => $this->input->post('npwp'),
			'NAMA_WP' => $this->input->post('nama'),
			'ALAMAT_WP' => $this->input->post('alamat'),
			'TELP_WP' => $this->input->post('telepon'),
			'AR' => $this->input->post('ar')
			);
		$this->db->insert('wajib_pajak', $add_wp);
	}

	function add_nwp(){
		$add_nwp = array(
			'KODE_NON_WP' => $this->input->post('kode_nwp'),
			'NAMA_NON_WP' => $this->input->post('naman'),
			'ALAMAT_NON_WP' => $this->input->post('alamatn'),
			'TELP_NON_WP' => $this->input->post('telpn'),
			'KPP_NON_WP' => $this->input->post('kpp')
			);
		$this->db->insert('non_wajib_pajak', $add_nwp);
	}

	// tampil data edit

	public function get_uk($id)
	{
		$this->db->from('unit_kerja');
		$this->db->where('KODE_UNIT_KERJA',$id);
		$query = $this->db->get();
		return $query->row();
	}

	public function get_dv($id)
	{
		$this->db->from('divisi');
		$this->db->where('KODE_DIVISI',$id);
		$query = $this->db->get();
		return $query->row();
	}

	public function get_jb($id)
	{
		$this->db->select('J.KODE_JABATAN AS KODE_J, J.NAMA_JABATAN AS NAMA_J, B.KODE_JABATAN AS J_INDUK, D.KODE_DIVISI AS KODE_D, J.LEVEL AS LEVEL_J');
        $this->db->from('jabatan J');
        $this->db->join('jabatan B','J.JABATAN_INDUK = B.KODE_JABATAN','left');
		$this->db->join('divisi D', 'D.KODE_DIVISI = J.KODE_DIVISI','left');
		$this->db->where('J.KODE_JABATAN',$id);
		$query = $this->db->get();
		return $query->row();
	}

	public function get_pg($id)
	{
		$this->db->select('NIP, J.KODE_JABATAN AS KODE_J, PASSWORD, NAMA_PEGAWAI, ALAMAT_PEGAWAI, TELP_PEGAWAI, UK.KODE_UNIT_KERJA AS KODE_UK ');
		$this->db->from('pegawai P');
		$this->db->join('jabatan J','P.KODE_JABATAN = J.KODE_JABATAN','left');
		$this->db->join('divisi D','D.KODE_DIVISI = J.KODE_DIVISI','left');
		$this->db->join('unit_kerja UK','UK.KODE_UNIT_KERJA = P.KODE_UNIT_KERJA');
		$this->db->where('NIP',$id);
		$query = $this->db->get();
		return $query->row();
	}

	public function get_jd($id)
	{
		$this->db->from('jenis_dokumen');
		$this->db->where('KODE_JENIS_DOKUMEN',$id);
		$query = $this->db->get();
		return $query->row();
	}

	public function get_sd($id)
	{
		$this->db->from('status_dokumen');
		$this->db->where('KODE_STATUS_DOKUMEN',$id);
		$query = $this->db->get();
		return $query->row();
	}

	public function get_wp($id)
	{
		$query = $this->db->query("SELECT W.*, P.NIP AS NIP FROM PEGAWAI P RIGHT JOIN WAJIB_PAJAK W ON W.AR = P.NIP WHERE KODE_WP = '$id' ");
		return $query->row();
	}

	public function get_nwp($id)
	{
		$query = $this->db->query("SELECT N.*, UK.KODE_UNIT_KERJA AS KODE_UK FROM NON_WAJIB_PAJAK N LEFT JOIN UNIT_KERJA UK ON UK.KODE_UNIT_KERJA = N.KPP_NON_WP WHERE KODE_NON_WP = '$id'");
		return $query->row();
	}

	// update data
	public function update_uk(){
		$where = array(
				'KODE_UNIT_KERJA' => $this->input->post('kode_uk')
				);
		$data = array(
				'NAMA_UNIT_KERJA' => $this->input->post('nama_uk'),
				'ALAMAT_UNIT_KERJA' => $this->input->post('alamat_uk'),
				'TELP_UNIT_KERJA' => $this->input->post('telp_uk'),
				'FAX_UNIT_KERJA' => $this->input->post('fax_uk')
				);
		$this->db->where($where);
		$this->db->update('unit_kerja',$data);
	}

	public function update_dv(){
		$where = array(
				'KODE_DIVISI' => $this->input->post('kode_dv')
				);
		$data = array(
				'NAMA_DIVISI' => $this->input->post('nama_dv')
				);
		$this->db->where($where);
		$this->db->update('divisi',$data);
	}

	public function update_jb(){
		$where = array(
				'KODE_JABATAN' => $this->input->post('kode_jb')
				);
		$data = array(
				'NAMA_JABATAN' => $this->input->post('nama_jb'),
				'JABATAN_INDUK' => $this->input->post('jb_induk'),
				'KODE_DIVISI' => $this->input->post('nama_dv'),
				'LEVEL' => $this->input->post('level')
				);
		$this->db->where($where);
		$this->db->update('jabatan',$data);
	}

	public function update_pg(){
		$where = array(
				'NIP' => $this->input->post('nip')
				);
		$data = array(
				'NAMA_PEGAWAI' => $this->input->post('namap'),
				'ALAMAT_PEGAWAI' => $this->input->post('alamatp'),
				'TELP_PEGAWAI' => $this->input->post('teleponp'),
				'KODE_JABATAN' => $this->input->post('jabatanp'),
				'KODE_UNIT_KERJA' => $this->input->post('unit_kerjap')
				);
		$this->db->where($where);
		$this->db->update('pegawai',$data);
	}

	public function update_jd(){
		$where = array(
				'KODE_JENIS_DOKUMEN' => $this->input->post('kode_jd')
				);
		$data = array(
				'NAMA_JENIS_DOKUMEN' => $this->input->post('nama_jd')
				);
		$this->db->where($where);
		$this->db->update('jenis_dokumen',$data);
	}

	public function update_sd(){
		$where = array(
				'KODE_STATUS_DOKUMEN' => $this->input->post('kode_sd')
				);
		$data = array(
				'NAMA_STATUS_DOKUMEN' => $this->input->post('nama_sd')
				);
		$this->db->where($where);
		$this->db->update('status_dokumen',$data);
	}

	public function update_wp(){
		$where = array(
				'KODE_WP' => $this->input->post('kode_wp')
				);
		$data = array(
				'NPWP' => $this->input->post('npwp'),
				'NAMA_WP' => $this->input->post('nama'),
				'ALAMAT_WP' => $this->input->post('alamat'),
				'TELP_WP' => $this->input->post('telepon'),
				'AR' => $this->input->post('ar')
				);
		$this->db->where($where);
		$this->db->update('wajib_pajak',$data);
	}

	public function update_nwp(){
		$where = array(
				'KODE_NON_WP' => $this->input->post('kode_nwp')
				);
		$data = array(
				'NAMA_NON_WP' => $this->input->post('naman'),
				'ALAMAT_NON_WP' => $this->input->post('alamatn'),
				'TELP_NON_WP' => $this->input->post('telpn'),
				'KPP_NON_WP' => $this->input->post('kpp')
				);
		$this->db->where($where);
		$this->db->update('non_wajib_pajak',$data);
	}	

	// delete data
	public function delete_uk($id){
		$where = array(
				'KODE_UNIT_KERJA' => $id
				);
		$this->db->where($where);
		$this->db->delete('unit_kerja');
	}

	public function delete_dv($id){
		$where = array(
				'KODE_DIVISI' => $id
				);
		$this->db->where($where);
		$this->db->delete('divisi');
	}

	public function delete_jb($id){
		$where = array(
				'KODE_JABATAN' => $id
				);
		$this->db->where($where);
		$this->db->delete('jabatan');
	}

	public function delete_pg($id){
		$where = array(
				'NIP' => $id
				);
		$this->db->where($where);
		$this->db->delete('pegawai');
	}

	public function delete_jd($id){
		$where = array(
				'KODE_JENIS_DOKUMEN' => $id
				);
		$this->db->where($where);
		$this->db->delete('jenis_dokumen');
	}

	public function delete_sd($id){
		$where = array(
				'KODE_STATUS_DOKUMEN' => $id
				);
		$this->db->where($where);
		$this->db->delete('status_dokumen');
	}

	public function delete_wp($id){
		$where = array(
				'KODE_WP' => $id
				);
		$this->db->where($where);
		$this->db->delete('wajib_pajak');
	}

	public function delete_nwp($id){
		$where = array(
				'KODE_NON_WP' => $id
				);
		$this->db->where($where);
		$this->db->delete('non_wajib_pajak');
	}
}

/* End of file m_master.php */
/* Location: ./application/models/m_master.php */