<?php $this->load->view('top'); ?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Pengiriman dan Pemantauan Alat Keterangan Pajak</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">Pengiriman dan Pemantauan Alat Keterangan Pajak</div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#kirim" data-toggle="tab">Kirim</a></li>
                        <li><a href="#terima" data-toggle="tab">Terima</a></li>
                        <li><a href="#disposisi" data-toggle="tab">Disposisi</a></li>
                        <li><a href="#realisasi" data-toggle="tab">Realisasi</a></li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                    	
                    	<!-- Kirim -->
                    	<div class="tab-pane fade in active" id="kirim">
                    		<h4>Kirim Data Alat Keterangan Pajak</h4>
                            <!-- Button -->
                            <p>
                                <a class="btn btn-primary glyphicon-plus" data-toggle="modal" onclick="add_ak()"> Tambah</a>
                                <a class="btn btn-primary glyphicon-asterisk" data-toggle="modal" onclick="reload_ak()"> Perbarui</a>
                            </p>
                            <!-- Tabel -->
                            <table class="display nowrap" id="tbl_ak" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Asal</th>
                                        <th>Tujuan</th>
                                        <th>NPWP</th>
                                        <th>Nama</th>
                                        <th>Jenis</th>
                                        <th>Lembar</th>
                                        <th>Nilai</th>
                                        <th>Tanggal Kirim</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Asal</th>
                                        <th>Tujuan</th>
                                        <th>NPWP</th>
                                        <th>Nama</th>
                                        <th>Jenis</th>
                                        <th>Lembar</th>
                                        <th>Nilai</th>
                                        <th>Tanggal Kirim</th>
                                        <th>Aksi</th>
                                    </tr>
                                </tfoot>
                            </table>
                            <!-- Modal -->
                            <div class="modal fade" id="modal_ak" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h3 class="modal-title"></h3>
                                        </div>
                                        <div class="modal-body">
                                            <form role="form" id="alket_form" enctype="multipart/form-data" method="post">
                                            	<div class="form-group">
                                                    <label>No Alat Keterangan</label>
                                                    <input type="text" class="form-control" id="no_alket" value=<?=$kode_ak?> readonly>
                                                </div>

                                                <div class="form-group">
                                                    <label>Unit Kerja Asal</label>
                                                    <select class="form-control" id="uk_asal" required>
                                                      <option disabled selected value="">-Pilih Unit Kerja-</option>
                                                      <?php
                                                      foreach($cb_uk as $row) {
                                                         echo "<option value= ".$row->KODE_UNIT_KERJA.">".$row->NAMA_UNIT_KERJA." </option>";
                                                     }
                                                     ?>
                                                 </select>
                                             </div>

                                             <div class="form-group">
                                                <label>Unit Kerja Tujuan</label>
                                                <select class="form-control" id="uk_tujuan" required>
                                                  <option disabled selected value="">-Pilih Unit Kerja-</option>
                                                  <?php
                                                  foreach($cb_uk as $row) {
                                                     echo "<option value= ".$row->KODE_UNIT_KERJA.">".$row->NAMA_UNIT_KERJA." </option>";
                                                 }
                                                 ?>
                                             </select>
                                         </div>

                                         <div class="form-group">
                                            <label>Data Wajib Pajak</label>	
                                            <select class="form-control" id="kode_wp" id="kode_wp" required>
                                              <option disabled selected value="">-Pilih Wajib Pajak-</option>
                                              <?php
                                              foreach($cb_wp as $row) {
                                                 echo "<option value= ".$row->KODE_WP.">".$row->NAMA_WP." - ".$row->NPWP." </option>";
                                             }
                                             ?>
                                         </select>
                                     </div>

                                     <div class="form-group">
                                        <label>Jenis Dokumen</label>
                                        <select class="form-control" id="jenis_dokumen" required>
                                          <option disabled selected value="">-Pilih Jenis Dokumen-</option>
                                          <?php
                                          foreach($cb_jd as $row) {
                                             echo "<option value= ".$row->KODE_JENIS_DOKUMEN.">".$row->NAMA_JENIS_DOKUMEN." </option>";
                                         }
                                         ?>
                                     </select>
                                 </div>

                                 <div class="form-group">
                                    <label>Lembar</label>
                                    <input type="text" class="form-control" id="lembar" required>
                                </div>

                                <div class="form-group">
                                    <label>Nilai Alket</label>
                                    <input type="text" class="form-control" id="nilai_alket" required>
                                </div>

                                <div class="form-group">
                                    <label>Dokumen</label>
                                    <input type="file" id="file" nama="file" class="form-control" required>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                            <button type="button" class="btn btn-primary" id="btn_simpan_ak">Simpan</button>
                        </div>
                    </div>
                </div>
            </div> 
            <!-- End Modal -->
            <script type="text/javascript">
                var save_method;

                $(document).ready(function() {

                $("#btn_simpan_ak").click(function(){
                    var url;
                    if(save_method == 'add') {
                        url = "<?php echo site_url('pengiriman/addAk')?>";
                    } else {
                        url = "<?php echo site_url('pengiriman/updateAk')?>";
                    }

                var form_data = new FormData(document.getElementById('alket_form'));
                
                $.ajax({
                    type: "POST",
                    url : url,
                    data : form_data,
                    success: function(data)
                    {
                        //reload_ak();
                        alert(data);
                    },
                    error: function (response) {
                        $('#msg').html(response);
                    },
                    cache: false,
                    contentType: false,
                    processData: false,
                });
                });

                $('#tbl_ak').DataTable({
                    "dom" : 'Bfrtip',
                    "buttons" : [
                    'copy', 'excel', 'print'
                    ],
                    "ajax": "<?php echo base_url('index.php/pengiriman/dataAk'); ?>",
                });
            });

        //$("#kode_wp").select2({width : 'resolve'});

        function reload_ak(){
            $("#modal_ak").modal('hide');
            var oTable = $('#tbl_ak').DataTable();
            oTable.ajax.reload();
        }

        function delete_ak(id){
            if(confirm('Anda yakin ingin menghapus data ini?'))
            {
                $.ajax({
                    url : "<?php echo site_url('pengiriman/deleteAk')?>/"+id,
                    type: "POST",
                    success: function(data)
                    {
                        reload_ak();
                    }
                });
            }
        }

        function add_ak(){
            save_method='add';
            $('#alket_form')[0].reset();
            $('#modal_ak').modal('show');
            $('.modal-title').text('Tambah Data Alat Keterangan Pajak');
        }

        function edit_ak(id){
            save_method='update';
            $('#alket_form')[0].reset();

            $.ajax({
                url : "<?php echo site_url('pengiriman/editAk/')?>/" + id,
                type: "GET",
                dataType: "JSON",
                success: function(data)
                {
                    $("#no_alket").val(data[0].NO_ALKET);
                    $("#uk_asal").val(data[0].UK_ASAL);
                    $("#uk_tujuan").val(data[0].UK_TUJUAN);
                    $("#kode_wp").val(data[0].KODE_WP);
                    $("#jenis_dokumen").val(data[0].KODE_JD);
                    $("#lembar").val(data[0].LEMBAR);
                    $("#nilai_alket").val(data[0].NILAI_ALKET);
                    $("#file").val(data[0].DOKUMEN);
                    $('#modal_ak').modal('show');
                    $('.modal-title').text('Ubah Data Alat Keterangan Pajak');
                    alert(data[0].NO_ALKET);

                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Masalah saat mengambil data');
                }
            });
        }
    </script>
                        </div>

                        <!-- Terima -->
                        <div class="tab-pane fade" id="terima">
                            <h4>Terima Data Alat Keterangan Pajak</h4>
                            <!-- Button -->
                            <p>
                                <a class="btn btn-primary glyphicon-asterisk" data-toggle="modal" onclick="reload_trm()"> Perbarui</a>
                            </p>
                            <!-- Tabel -->
                            <table class="display nowrap" id="tbl_trm" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>Tujuan</th>
                                        <th>No Alket</th>
                                        <th>Tanggal Kirim</th>
                                        <th>Tanggal Terima</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Tujuan</th>
                                        <th>No Alket</th>
                                        <th>Tanggal Kirim</th>
                                        <th>Tanggal Terima</th>
                                    </tr>
                                </tfoot>
                            </table>
                            <script type="text/javascript">
                                var save_method;

                                $(document).ready(function() {
                                    $('#tbl_trm').DataTable({
                                        "dom" : 'Bfrtip',
                                        "buttons" : [
                                        'copy', 'excel', 'print'
                                        ],
                                        "ajax": "<?php echo base_url('index.php/pengiriman/dataTrm'); ?>",
                                    });
                                });

                                function reload_trm(){
                                    var oTable = $('#tbl_trm').DataTable();
                                    oTable.ajax.reload();
                                }
                            </script>
                        </div>

                        <div class="tab-pane fade" id="disposisi">
                            <h4>Disposisi Data Alat Keterangan Pajak</h4>
                            <!-- Button -->
                            <p>
                                <a class="btn btn-primary glyphicon-asterisk" data-toggle="modal" onclick="reload_dps()"> Perbarui</a>
                            </p>
                            <!-- Tabel -->
                            <table class="display nowrap" id="tbl_dps" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>KPP Tujuan</th>
                                        <th>Dari</th>
                                        <th>Untuk</th>
                                        <th>No Alket</th>
                                        <th>Tanggal Disposisi</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>KPP Tujuan</th>
                                        <th>Dari</th>
                                        <th>Untuk</th>
                                        <th>No Alket</th>
                                        <th>Tanggal Disposisi</th>
                                    </tr>
                                </tfoot>
                            </table>
                            <script type="text/javascript">
                                var save_method;

                                $(document).ready(function() {
                                    $('#tbl_dps').DataTable({
                                        "dom" : 'Bfrtip',
                                        "buttons" : [
                                        'copy', 'excel', 'print'
                                        ],
                                        "ajax": "<?php echo base_url('index.php/pengiriman/dataDps'); ?>",
                                    });
                                });

                                function reload_dps(){
                                    var oTable = $('#tbl_dps').DataTable();
                                    oTable.ajax.reload();
                                }
                            </script>
                        </div>
                        <div class="tab-pane fade" id="realisasi">
                            <h4>Realisasi Data Alat Keterangan Pajak</h4>
                            <!-- Button -->
                            <p>
                                <a class="btn btn-primary glyphicon-asterisk" data-toggle="modal" onclick="reload_rls()"> Perbarui</a>
                            </p>
                            <!-- Tabel -->
                            <table class="display nowrap" id="tbl_rls" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>KPP</th>
                                        <th>No Alket</th>
                                        <th>Tanggal Kirim</th>
                                        <th>Tanggal Laporan</th>
                                        <th>Selisih Waktu</th>
                                        <th>Nilai Alket</th>
                                        <th>Nilai Realisasi</th>
                                        <th>Selisih Nilai</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>KPP</th>
                                        <th>No Alket</th>
                                        <th>Tanggal Kirim</th>
                                        <th>Tanggal Laporan</th>
                                        <th>Selisih Waktu</th>
                                        <th>Nilai Alket</th>
                                        <th>Nilai Realisasi</th>
                                        <th>Selisih Nilai</th>
                                    </tr>
                                </tfoot>
                            </table>
                            <script type="text/javascript">
                                var save_method;

                                $(document).ready(function() {
                                    $('#tbl_rls').DataTable({
                                        "dom" : 'Bfrtip',
                                        "buttons" : [
                                        'copy', 'excel', 'print'
                                        ],
                                        "ajax": "<?php echo base_url('index.php/pengiriman/dataRls'); ?>",
                                    });
                                });

                                function reload_rls(){
                                    var oTable = $('#tbl_rls').DataTable();
                                    oTable.ajax.reload();
                                }
                            </script>
                        </div>
                    </div> <!-- tab panes -->
                </div> <!-- panel body -->
            </div> <!-- panel default -->
        </div> <!-- lg 12 -->
    </div> <!-- row -->
</div> <!-- page wrapper -->
<?php $this->load->view('down'); ?>