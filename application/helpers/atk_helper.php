<?php
function gen_id($kd, $table, $kolom, $panjang, $awal)
{
  $ci =& get_instance();
  $query = $ci->db->query("select ifnull(max(substr(".$kolom.",".$awal.")),0)+1 as max_id from ".$table."");
  $id = $query->row_array();
  $max = $id["max_id"];
  return strtoupper($kd).str_pad($max,$panjang,"0",STR_PAD_LEFT);
  //Penggunaan echo gen_id("kode awal", "nama tabel", "nama kolom", "panjang karakter setelah - ");
}

function tgl($tgl)
{
	$date=date_create($tgl);
    return date_format($date,"d-m-Y");
    //Change date format to indonesian (from string)
}

function rp($angka)
{
	return "Rp ".number_format($angka, "0", ",", ".");
	//Cange number to rupiah format
}

function cb($name,$table,$field,$pk,$selected){
    $ci = get_instance();
    $cmb = "<select name='$name' id='$name' class='form-control'>";
    $data = $ci->db->get($table)->result();
    $cmb .="<option value=''>-Pilih ".ucfirst($table)."-</option>";

    foreach ($data as $d){
        $cmb .="<option value='".$d->$pk."'";
        $cmb .= $selected==$d->$pk?" selected='selected'":'';
        $cmb .=">".  strtoupper($d->$field)."</option>";
    }
    $cmb .="</select>";
    return $cmb;
}