<?php $this->load->view('top'); ?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Penerimaan Alat Keterangan Pajak</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">Penerimaan Alat Keterangan Pajak</div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs">
                        <li class=<?php if($level=='3') { echo "hide";  } else { "active"; } ?>><a href="#baru" data-toggle="tab">Terima</a></li>
                        <li class=<?php if($level=='3') { echo "active";  } ?>><a href="#realisasi" data-toggle="tab">Realisasi</a></li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <!-- Terima -->
                        <div class="<?php if($level=='3') { echo "tab-pane hide";  } else { echo "tab-pane fade in active"; } ?>" id="baru">
                            <h4>Data Baru Alat Keterangan Pajak</h4>
                            <!-- Button -->
                            <p>
                                <a class="btn btn-primary glyphicon-asterisk" data-toggle="modal" onclick="reload_dps()"> Perbarui</a>
                            </p>
                            <!-- Tabel -->
                            <table class="display nowrap" id="tbl_trm" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>No Alket</th>
                                        <th>Status</th>
                                        <th>Tanggal Terima</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>No Alket</th>
                                        <th>Status</th>
                                        <th>Tanggal Terima</th>
                                        <th>Aksi</th>
                                    </tr>
                                </tfoot>
                            </table>
                            <!-- Modal -->
                            <div class="modal fade" id="modal_trm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h3 class="modal-title"></h3>
                                        </div>
                                        <div class="modal-body">
                                            <form role="form" id="terima_form">
                                                <input type="text" id="alket_no" class="form-control" disabled>
                                                <div class="form-group">
                                                    <label for="tujuan">Tujuan</label>
                                                    <select class="form-control" id="tujuan" required>
                                                        <option disabled selected value="">-Pilih Tujuan-</option>
                                                        <?php
                                                        foreach($cb_kpp as $row) {
                                                            echo "<option value= ".$row->NIP.">".$row->LENGKAP." </option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Keterangan</label>
                                                    <textarea id="keterangan" name="keterangan" class="form-control"></textarea>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                                            <button type="button" class="btn btn-primary" onclick="submit_trm()" id="btn_simpan_ak">Simpan</button>
                                        </div>
                                    </div>
                                </div>
                            </div> 
                            <!-- End Modal -->
                            <script type="text/javascript">
                            var save_method;

                            $(document).ready(function() {
                                $('#tbl_trm').DataTable({
                                    "dom" : 'Bfrtip',
                                    "buttons" : [
                                    'copy', 'excel', 'print'
                                    ],
                                    "ajax": "<?php echo base_url('index.php/penerimaan/dataTrm'); ?>",
                                });
                            });

                            function reload_trm(){
                                $("#modal_trm").modal('hide');
                                var oTable = $('#tbl_trm').DataTable();
                                oTable.ajax.reload();
                            }

                            function add_trm(id){
                                $('#terima_form')[0].reset();

                                $.ajax({
                                    url : "<?php echo site_url('penerimaan/getDetilAk/')?>/" + id,
                                    type: "GET",
                                    dataType: "JSON",
                                    success: function(data)
                                    {
                                        $("#alket_no").val(data[0].NO_ALKET);
                                        $('#modal_trm').modal('show');
                                        $('.modal-title').text('Disposisi Alat Keterangan Pajak');
                                    }
                                });
                            }

                            function submit_trm(){
                                event.preventDefault();
                                var alket_no = $("#alket_no").val();
                                var tujuan = $("#tujuan").val();
                                var keterangan = $("#keterangan").val();

                                $.ajax({
                                    type: "POST",
                                    url : "<?php echo site_url('penerimaan/addTrm')?>",
                                    data: { alket_no:alket_no,tujuan:tujuan, keterangan:keterangan},
                                    success: function(data)
                                    {
                                        reload_trm();
                                    }, error: function (jqXHR, textStatus, errorThrown)
                                    {
                                        alert(jqXHR.responseText);
                                    }
                                });
                            };
                        </script>
                        </div>
            
                        <!-- Realisasi -->
                    	<div class="<?php if($level=='3') { echo "tab-pane fade in active";  } else { echo "tab-pane fade"; } ?> table-responsive" id="realisasi">
                            <h4> Realisasi Data Alat Keterangan Pajak</h4>
                            <!-- Button -->
                            <p>
                                <a class="btn btn-primary glyphicon-asterisk" data-toggle="modal" onclick="reload_drls()"> Perbarui</a>
                            </p>
                            <!-- Tabel -->
                            <table class="display nowrap" id="tbl_drls" cellspacing="0" width="100%">
                                <thead>                                    <tr>
                                        <th>No Alket</th>
                                        <th>Kode Status</th>
                                        <th>Nilai Alket</th>
                                        <th>Nilai Realisasi</th>
                                        <th>Tanggal Realisasi</th>
                                        <th>Tanggal Laporan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>No Alket</th>
                                        <th>Kode Status</th>
                                        <th>Nilai Alket</th>
                                        <th>Nilai Realisasi</th>
                                        <th>Tanggal Realisasi</th>
                                        <th>Tanggal Laporan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </tfoot>
                            </table>
                            <script type="text/javascript">
                            var save_method;

                            $(document).ready(function() {
                                $('#tbl_drls').DataTable({
                                    "dom" : 'Bfrtip',
                                    "buttons" : [
                                    'copy', 'excel', 'print'
                                    ],
                                    "ajax": "<?php echo base_url('index.php/penerimaan/dataRls/'); ?>",
                                });
                            });

                            function reload_drls(){
                                $("#modal_rls").modal('hide');
                                var oTable = $('#tbl_drls').DataTable();
                                oTable.ajax.reload();
                            }
                            </script>
                    	</div>

                        <!-- Lihat Alket -->
                        <div class="modal fade" id="modal_detil_ak" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        <h3 class="modal-title"></h3>
                                    </div>
                                    <div class="modal-body">
                                        
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default glyphicon-print" data-toogle="modal">Tutup</button>
                                    </div>
                                </div>
                            </div>
                        </div> 
                        <script type="text/javascript">

                            function lihat_detil_ak(id){
                                $.ajax({
                                    url : "<?php echo site_url('penerimaan/getDetil/')?>/" + id,
                                    type: "GET",
                                    dataType: "JSON",
                                    success: function(data)
                                    {
                                        var trHTML = '';
                                        $.each(data, function(i, item){
                                            trHTML += '<table class="table table-striped table-bordered">' +
                                                '<tr><th>No</th><td>' + item.NO_ALKET + '</td></tr>' +
                                                '<tr><th>Asal</th><td>' + item.asal + '</td></tr>' +
                                                '<tr><th>Tujuan</th><td>' + item.tujuan + '</td></tr>' +
                                                '<tr><th>Kode WP / Non WP</th><td>' + item.kode_p + '</td></tr>' +
                                                '<tr><th>Nama WP / Non WP</th><td>' + item.nama_p + '</td></tr>' +
                                                '<tr><th>Jenis Dokumen</th><td>' + item.nama_jenis_dokumen + '</td></tr>' +
                                                '<tr><th>Tgl Kirim</th><td>' + item.tgl_kirim + '</td></tr>' +
                                                '<tr><th>Tgl Terima</th><td>' + item.tgl_terima + '</td></tr>' +
                                                '<tr><th>Tgl Realisasi</th><td>' + item.tgl_realisasi + '</td></tr>' +
                                                '<tr><th>Tgl Laporan</th><td>' + item.tgl_laporan + '</td></tr>' +
                                                '<tr><th>Nilai Alket</th><td>' + item.nilai_alket + '</td></tr>' +
                                                '<tr><th>Nilai Realisasi</th><td>' + item.nilai_realisasi + '</td></tr>' +
                                                '<tr><th>Status Dokumen</th><td>' + item.nama_status_dokumen + '</td></tr>' +
                                                '<tr><th>AR</th><td>' + item.nama_pegawai + '</td></tr>' +
                                                '<tr><th>Selisih</th><td>' + item.selisih + '</td></tr>' +
                                                '</table>';
                                        });
                                        $(".modal-body").append(trHTML);
                                        $('#modal_detil_ak').modal('show');
                                        $('.modal-title').text('Data Realisasi Alat Keterangan Pajak');
                                    }
                                });
                            }
                        </script>

                        <!-- Realisasi Alket -->
                        <div class="modal fade" id="modal_rls" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        <h3 class="modal-title"></h3>
                                    </div>
                                    <div class="modal-body">
                                        <form role="form" id="realisasi_form">
                                        <input type="text" class="form-control" id="noalket" disabled>
                                        <input type="text" class="form-control" id="kode" disabled>

                                        <div class="form-group">
                                            <label>Tanggal Realisasi</label>
                                            <input type="text" class="form-control datepicker" id="tgl_real" required>
                                        </div>

                                        <div class="form-group">
                                            <label>Nilai Realisasi</label>
                                            <input type="text" class="form-control" id="nilai_real" required>
                                        </div>

                                        <div class="form-group">
                                            <label>Keterangan</label>
                                            <textarea class="form-control" id="keterangan" required></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Status Realisasi</label>
                                            <select class="form-control" id="status" name="status" required>
                                                <option disabled selected value="">-Pilih Status Realisasi-</option>
                                                <?php
                                                foreach($cb_status_dok as $row) {
                                                    echo "<option value= ".$row->KODE_STATUS_DOKUMEN.">".$row->NAMA_STATUS_DOKUMEN." </option>";
                                                }
                                                ?>
                                            </select>
                                        </div>

                                        <?php if ($divisi == 'Ekstentifikasi') { ?>
                                        <div class="form-group">
                                            <label>Mutasi Wajib Pajak</label>
                                            <input type="checkbox" id="mutasi" value="ya"> Ya<br>
                                            <input type="text" class="form-control" id="npwp_mutasi" name="npwp_mutasi" data-mask="__.___.___._-___.___" >
                                            <select class="form-control" id="ar_wp" required>
                                                <option disabled selected value="">-Pilih AR-</option>
                                                <?php
                                                foreach($cb_kpp as $row) {
                                                    echo "<option value= ".$row->NIP.">".$row->LENGKAP." </option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <?php } ?>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                                        <button type="button" class="btn btn-primary" onclick="submit_rls()" id="btn_simpan_rls">Simpan</button>
                                    </div>
                                </div>
                            </div>
                        </div> 
                        <script type="text/javascript">
                            $(document).ready(function() {
                                
                                //datepicker
                                $('.datepicker').datepicker({
                                    autoclose: true,
                                    format: "yyyy-mm-dd",
                                    todayHighlight: true,
                                    orientation: "top auto",
                                    todayBtn: true,
                                    todayHighlight: true,  
                                });

                                $("#npwp_mutasi").hide();
                                $("#ar_wp").hide();

                                $('#mutasi').click(function() {
                                    if ($(this).is(':checked')) {
                                        $("#npwp_mutasi").show();
                                        $("#ar_wp").show();    
                                        $("npwp_mutasi").mask('__.___.___._-___.___');
                                    } else {
                                        $("#npwp_mutasi").hide();
                                        $("#ar_wp").hide();    
                                    }
                                });
                            });

                            function add_rls(id){
                                $('#realisasi_form')[0].reset();

                                $.ajax({
                                    url : "<?php echo site_url('penerimaan/getDetilAk/')?>/" + id,
                                    type: "GET",
                                    dataType: "JSON",
                                    success: function(data)
                                    {
                                        $("#noalket").val(data[0].NO_ALKET);
                                        $("#kode").val(data[0].KODE);
                                        $('#modal_rls').modal('show');
                                        $('.modal-title').text('Disposisi Alat Keterangan Pajak');
                                    }
                                });
                            };

                            function submit_rls(){
                                event.preventDefault();
                                var noalket = $("#noalket").val();
                                var tgl_real = $("#tgl_real").val();
                                var nilai_real = $("#nilai_real").val();
                                var keterangan = $("#keterangan").val();
                                var status = $("#status").val();
                                var npwp_mutasi = $("#npwp_mutasi").val();
                                var ar_wp = $("#ar_wp").val();
                                var kode = $("#kode").val();

                                $.ajax({
                                    type: "POST",
                                    url : "<?php echo site_url('penerimaan/addRls')?>",
                                    data: { noalket:noalket,tgl_real:tgl_real,nilai_real:nilai_real,keterangan:keterangan,status:status,npwp_mutasi:npwp_mutasi,ar_wp:ar_wp,kode:kode},
                                    success: function(data)
                                    {
                                        reload_drls();
                                    }, error: function (jqXHR, textStatus, errorThrown)
                                    {
                                        alert(jqXHR.responseText);
                                    }
                                });
                            };
                        </script>

                        <script type="text/javascript">
                            Array.prototype.forEach.call(document.body.querySelectorAll("*[data-mask]"), applyDataMask);

                            function applyDataMask(field) {
                                var mask = field.dataset.mask.split('');
                                
                                // For now, this just strips everything that's not a number
                                function stripMask(maskedData) {
                                    function isDigit(char) {
                                        return /\d/.test(char);
                                    }
                                    return maskedData.split('').filter(isDigit);
                                }
                                
                                // Replace `_` characters with characters from `data`
                                function applyMask(data) {
                                    return mask.map(function(char) {
                                        if (char != '_') return char;
                                        if (data.length == 0) return char;
                                        return data.shift();
                                    }).join('')
                                }
                                
                                function reapplyMask(data) {
                                    return applyMask(stripMask(data));
                                }
                                
                                function changed() {   
                                    var oldStart = field.selectionStart;
                                    var oldEnd = field.selectionEnd;
                                    
                                    field.value = reapplyMask(field.value);
                                    
                                    field.selectionStart = oldStart;
                                    field.selectionEnd = oldEnd;
                                }
                                
                                field.addEventListener('click', changed)
                                field.addEventListener('keyup', changed)
                            }
                        </script>                        

                    </div> <!-- tab panes -->
                </div> <!-- panel body -->
            </div> <!-- panel default -->
        </div> <!-- lg 12 -->
    </div> <!-- row -->
</div> <!-- page wrapper -->
<?php $this->load->view('down'); ?>