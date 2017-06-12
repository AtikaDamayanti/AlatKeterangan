<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Laporan Realisasi Alat Keterangan Pajak</title>

    <link href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>" rel="stylesheet">
    
	<style type="text/css" media="screen">
		.td-header {
			text-align:center;
			vertical-align: middle;
		}
		th{
			text-align: left;
			padding:2px 10px 2px 10px;
		}
		html,body{
		    height:297mm;
		    width:210mm;
		    background: rgb(204,204,204);
		    font-family:Arial;
			font-weight:bold; 
		}
		a {
			text-decoration: none;
		}
		page[size="A4"] {
		  	background: white;
		  	width: 21cm;
		  	height: 29.7cm;
		  	display: block;
		  	margin: 0 auto;
		  	margin-bottom: 0.5cm;
		  	box-shadow: 0 0 0.5cm rgba(0,0,0,0.5);
		}
		@media print {
		  body, page[size="A4"] {
		   	margin: 0;
		    box-shadow: 0;
		  }
		}
		hr {
			display: block;
			border: 1.5px solid blue;
			background-color: black;
		}
	</style>
</head>
<body>
<page size="A4">
	<table border="0" align="center">
		<tr>
			<td rowspan="8" width="120" class="td-header">
				<img src="<?php echo base_url('assets/gambar/logo_pajak.png') ?>" width="100px" height="100px">
			</td>
		</tr>
		<tr>
			<td class="td-header"><a style="font-size:17px; ">KEMENTRIAN KEUANGAN REPUBLIK INDONESIA</a></td>
		</tr>
		<tr>
			<td class="td-header"><a style="font-size:14px;">DIREKTORAT JENDERAL PAJAK</a></td>
		</tr>
		<tr>
			<td class="td-header"><a style="font-size:17px;">KANTOR WILAYAH DJP JAWA TIMUR I</a></td>
		</tr>
		<tr>
			<td class="td-header"><a style="font-size:12px;">JALAN JAGIR WONOKROMO 104 SURABAYA</a></td>
		</tr>
		<tr>
			<td class="td-header"><a style="font-size:12px;">TELP (031) 8482480; FAX (031) 8481127; SITUS <u>www.pajak.go.id</u></a></td>
		</tr>
		<tr>
			<td class="td-header"><a style="font-size:12px;">LAYANAN INFORMASI DAN KELUHAN KRING PAJAK (021) 500200</a></td>
		</tr>
		<tr>
			<td class="td-header"><a style="font-size:12px;">Email pusat.pengaduan.pajak@gmail.com</a></td>
		</tr>
	</table>
	<hr>
	<table border="0" align="center" class="table table-striped table-bordered">
		<?php foreach ($detil as $value) { ?>
			<tr>
				<th>No Alket</th>
				<td><?php echo $value->NO_ALKET; ?></td>
			</tr>
			<tr>
				<th>Asal</th>
				<td><?php echo $value->asal; ?></td>
			</tr>
			<tr>
				<th>Tujuan</th>
				<td><?php echo $value->tujuan; ?></td>
			</tr>
			<tr>
				<th>Kode WP / Non WP</th>
				<td><?php echo $value->kode_p; ?></td>
			</tr>
			<tr>
				<th>Nama WP / Non WP</th>
				<td><?php echo $value->nama_p; ?></td>
			</tr>
			<tr>
				<th>Jenis Dokumen</th>
				<td><?php echo $value->nama_jenis_dokumen; ?></td>
			</tr>
			<tr>
				<th>Tgl Kirim</th>
				<td><?php echo $value->tgl_kirim; ?></td>
			</tr>
			<tr>
				<th>Tgl Terima</th>
				<td><?php echo $value->tgl_terima; ?></td>
			</tr>
			<tr>
				<th>Tgl Realisasi</th>
				<td><?php echo $value->tgl_realisasi; ?></td>
			</tr>
			<tr>
				<th>Tgl Laporan</th>
				<td><?php echo $value->tgl_laporan; ?></td>
			</tr>
			<tr>
				<th>Nilai Alket</th>
				<td><?php echo $value->nilai_alket; ?></td>
			</tr>
			<tr>
				<th>Nilai Realisasi</th>
				<td><?php echo $value->nilai_realisasi; ?></td>
			</tr>
			<tr>
				<th>Status Dokumen</th>
				<td><?php echo $value->nama_status_dokumen; ?></td>
			</tr>
			<tr>
				<th>Account Representative</th>
				<td><?php echo $value->nama_pegawai; ?></td>
			</tr>
			<tr>
				<th>Selisih</th>
				<td><?php echo $value->selisih; ?></td>
			</tr>
		<?php } ?>
	</table>
</page>
</body>
</html>