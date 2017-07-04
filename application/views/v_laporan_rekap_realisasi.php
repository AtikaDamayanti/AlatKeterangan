<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Laporan Realisasi Alat Keterangan Pajak</title>
    
    <link href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>" rel="stylesheet">
	<style type="text/css" media="screen">

		.td-header{
			padding: 5px 5px 5px 5px;
		}

		img {
			margin-right: 20px;
		}

		.kepada{
			margin: 20px 20px 10px 100px;
		}

		.td-header {
			text-align:center;
			vertical-align: middle;
		}
		
		.isi {
			margin-left:50px;
			border: 1px solid #ddd;
			border-collapse: collapse;
		}

		.isi tr{
			margin:0px 30px 30px 30px;
			border-bottom: 2px solid #ddd;
			border-top: 2px solid #ddd;
		}
		
		.isi td{
			border: 2px solid #ddd;
			width: 350px;
			padding: 5px;
		}
		
		.isi tr:nth-child(even) {
			background-color: #f2f2f2
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
<?php foreach ($detil as $value) { ?>
	<table align="center" class="atas">
		<tr>
			<td rowspan="9" width="200" class="td-header">
				<img src="<?php echo base_url('assets/gambar/logo_pajak.png') ?>" width="150px" height="150px">
			</td>
		</tr>
		<tr height="20px"></tr>
		<tr>
			<td class="td-header"><a style="font-size:17px; ">KEMENTRIAN KEUANGAN REPUBLIK INDONESIA</a></td>
		</tr>
		<tr>
			<td class="td-header"><a style="font-size:14px;">DIREKTORAT JENDERAL PAJAK</a></td>
		</tr>
		<tr>
			<td class="td-header"><a style="font-size:17px;"><?php echo $value->asal ?></a></td>
		</tr>
		<tr>
			<td class="td-header"><a style="font-size:12px;"><?php echo $value->alamat_asal ?></a></td>
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
	
	<table class="kepada">
		<tr>
			<td width="100px">Nomor</td>
			<td width="10px"> : </td>
			<td width="400px">Isi</td>
			<td><?php 
				$tanggal= mktime(date("m"),date("d"),date("Y"));
				echo date("d M Y", $tanggal);
				date_default_timezone_set('Asia/Jakarta');
				?>
			</td>
		</tr>
		<tr>
			<td width="100px">Sifat</td>
			<td width="10px"> : </td>
			<td width="400px">Rahasia</td>
		</tr>
		<tr>
			<td width="100px">Perihal</td>
			<td width="10px"> : </td>
			<td width="400px">Laporan Realisasi Alat Keterangan Pajak</td>
		</tr>
		<tr height="30px">
		</tr>
		<tr>
			<td>Kepada Yth.</td>
		</tr>
		<tr>
			<td colspan="3"><?php echo $value->tujuan ?></td>
		</tr>
		<tr>
			<td colspan="3"><?php echo $value->alamat_tujuan ?></td>
		</tr>
		<tr height="30px">
		</tr>
	</table>

	<table width="700px" class="isi">
		<tr>
			<td>No Alket</td>
			<td><?php echo $value->NO_ALKET; ?></td>
		</tr>
		<tr>
			<td>Kode WP / Non WP</td>
			<td><?php echo $value->kode_p; ?></td>
		</tr>
		<tr>
			<td>Nama WP / Non WP</td>
			<td><?php echo $value->nama_p; ?></td>
		</tr>
		<tr>
			<td>Jenis Dokumen</td>
			<td><?php echo $value->nama_jenis_dokumen; ?></td>
		</tr>
		<tr>
			<td>Tgl Kirim</td>
			<td><?php echo $value->tgl_kirim; ?></td>
		</tr>
		<tr>
			<td>Tgl Terima</td>
			<td><?php echo $value->tgl_terima; ?></td>
		</tr>
		<tr>
			<td>Tgl Realisasi</td>
			<td><?php echo $value->tgl_realisasi; ?></td>
		</tr>
		<tr>
			<td>Tgl Laporan</td>
			<td><?php echo $value->tgl_laporan; ?></td>
		</tr>
		<tr>
			<td>Nilai Alket</td>
			<td><?php echo $value->nilai_alket; ?></td>
		</tr>
		<tr>
			<td>Nilai Realisasi</td>
			<td><?php echo $value->nilai_realisasi; ?></td>
		</tr>
		<tr>
			<td>Status Dokumen</td>
			<td><?php echo $value->nama_status_dokumen; ?></td>
		</tr>
		<tr>
			<td>Account Representative</td>
			<td><?php echo $value->nama_pegawai; ?></td>
		</tr>
		<tr>
			<td>Selisih</td>
			<td><?php echo $value->selisih; ?></td>
		</tr>
		
	</table>
	<?php } ?>
</page>
</body>
</html>