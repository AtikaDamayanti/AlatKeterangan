<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Laporan Rekapitulasi Alat Keterangan Pajak</title>
    
    <link href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>" rel="stylesheet">
	<style type="text/css" media="screen">

		img {
			margin-right: 20px;
		}

		.atas{
			padding-top : 30px;
		}

		.kepada{
			margin: 20px 20px 10px 50px;
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
<?php foreach ($a as $value) { ?>
	<table border="0" align="center" class="atas">
		<tr>
			<td rowspan="9" width="120" class="td-header">
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
	
	<table width="650px" class="table-hovered table-bordered isi">
		<tr>
			<th>Nama Unit Kerja</th>
			<th>∑ Data Alket</th>
			<th>∑ Nilai Alket</th>
			<th>∑ Data Realisasi</th>
            <th>∑ Nilai Realisasi</th>
			<th>∑ Belum Realisasi</th>
		</tr>
		<?php foreach ($b as $key) { ?>
		<tr>
			
			<td><?php echo $key->NAMA_UNIT ?></td>
			<td><?php echo $key->JUMLAH_DATA_ALKET ?></td>
			<td><?php $angka1 = $key->JUMLAH_NILAI_ALKET; 
					$ang = number_format($angka1, "2", ",", ".");
					echo $ang;
						?></td>
			<td><?php echo $key->JUMLAH_DATA_REALISASI ?></td>
            <td><?php echo $angka2 = $key->JUMLAH_NILAI_REALISASI; 
            		$ka = number_format($angka2, "2", ",", ".");
					echo $ka;
            ?></td>
			<td><?php echo $key->JUMLAH_BELUM_REALISASI ?></td>
		</tr>
		<?php } ?>
	</table>

	<table>
		
	</table>
	<?php } ?>
</page>
</body>
</html>