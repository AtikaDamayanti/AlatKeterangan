<?php $this->load->view('top'); ?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Dashboard</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">Laporan Dan Rekapitulasi Alat Keterangan Pajak</div>
                <div class="panel-body">
                	<div class="table-responsive">
                	<table class="display nowrap" id="tbl_rekap" cellspacing="0" width="100%">
					<thead>
						<tr>
							<th>Nama Unit Kerja</th>
							<th>∑ Data Alket</th>
							<th>∑ Nilai Alket</th>
							<th>∑ Data Realisasi</th>
							<th>∑ Nilai Realisasi</th>
						</tr>
					</thead>
					<tfoot>
						<tr>
							<th>Nama Unit Kerja</th>
							<th>∑ Data Alket</th>
							<th>∑ Nilai Alket</th>
							<th>∑ Data Realisasi</th>
							<th>∑ Nilai Realisasi</th>
						</tr>
					</tfoot>
					</table>
				</div>
					<script type="text/javascript">
                        $(document).ready(function() {
                            $('#tbl_rekap').DataTable({
                                "dom" : 'Bfrtip',
                                "buttons" : [
                                'copy', 'excel', 'print'
                                ],
                                "ajax": "<?php echo base_url('index.php/dashboard/dataRekap'); ?>",
                            });
                        });
                     </script>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Diagram Rekapitulasi Alat Keterangan
                </div>
                <div class="panel-body">
                    <div id="morris-bar-chart">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
    $(document).ready(function () {
        $.ajax({
            type: 'GET',
            url : '<?php echo site_url("dashboard/dataRekapChart"); ?>',
            dataType : 'json',
            success: function(data)
            {
                var graph = Morris.Bar({
                    element: 'morris-bar-chart',
                    data : data, 
                    xkey: 'NAMA_UNIT',
                    ykeys: ['JUMLAH_DATA_ALKET', 'JUMLAH_DATA_REALISASI'],
                    labels: ['BELUM REALISASI', 'REALISASI'],
                    hideHover: 'auto',
                    resize: true
                });
            }
        });
    });
    </script>
</div>
<?php $this->load->view('down'); ?>