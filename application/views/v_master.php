<?php $this->load->view('top'); ?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Data Master</h1>
        </div>
    </div>
    <!-- /.row -->

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Data Master</div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#unitkerja" data-toggle="tab">Unit Kerja</a></li>
                        <li><a href="#divisi" data-toggle="tab">Divisi</a></li>
                        <li><a href="#jabatan" data-toggle="tab">Jabatan</a></li>
                        <li><a href="#pegawai" data-toggle="tab">Pegawai</a></li>
                        <li><a href="#jenisdokumen" data-toggle="tab">Jenis Dokumen</a></li>
                        <li><a href="#statusdokumen" data-toggle="tab">Status Dokumen</a></li>
                        <li><a href="#wajibpajak" data-toggle="tab">Wajib Pajak</a></li>
                        <li><a href="#nonwajibpajak" data-toggle="tab">Non Wajib Pajak</a></li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">

                        <!-- Unit Kerja -->
                        <div class="tab-pane fade in active" id="unitkerja">
                            <h4>Master Unit Kerja</h4>
                            <!-- Button -->
                            <p>
                                <a class="btn btn-primary glyphicon-plus" data-toggle="modal" onclick="add_uk()"> Tambah</a>
                                <a class="btn btn-primary glyphicon-asterisk" data-toggle="modal" onclick="reload()"> Perbarui</a>
                            </p>
                            <!-- Tabel -->
                            <div class="table-responsive">
                            <table class="display nowrap" id="tbl_uk" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>Kode</th>
                                        <th>Nama</th>
                                        <th>Alamat</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Kode</th>
                                        <th>Nama</th>
                                        <th>Alamat</th>
                                        <th>Aksi</th>
                                    </tr>
                                </tfoot>
                            </table>
                            </div>
                            <!-- Modal -->
                            <div class="modal fade" id="modal_uk" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h3 class="modal-title"></h3>
                                        </div>
                                        <div class="modal-body">
                                            <form role="form" id="unit_kerja_form">

                                                <div class="form-group">
                                                    <label>Kode Unit Kerja</label>
                                                    <input type="text" class="form-control" id="kode_uk">
                                                </div>

                                                <div class="form-group">
                                                    <label>Nama Unit Kerja</label>
                                                    <input type="text" class="form-control" id="nama_uk" required>
                                                </div>

                                                <div class="form-group">
                                                    <label>Alamat Unit Kerja</label>
                                                    <input type="text" size="20" class="form-control" id="alamat_uk" required>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                                            <button type="button" class="btn btn-primary" onclick="submit_uk()" id="btn_simpan_uk">Simpan</button>
                                        </div>
                                    </div>
                                </div>
                            </div> 
                            <!-- End Modal -->
                            <script type="text/javascript">
                            var save_method;

                            $(document).ready(function() {
                                $('#tbl_uk').DataTable({
                                    "dom" : 'Bfrtip',
                                    "buttons" : [
                                    'copy', 'excel', 'print'
                                    ],
                                    "ajax": "<?php echo base_url('index.php/master/dataUk'); ?>",
                                });
                            });

                            function reload(){
                                $("#modal_uk").modal('hide');
                                var oTable = $('#tbl_uk').DataTable();
                                oTable.ajax.reload();
                            }

                            function delete_uk(id){
                                if(confirm('Anda yakin ingin menghapus data ini?'))
                                {
                                    $.ajax({
                                        url : "<?php echo base_url('index.php/master/deleteUk')?>/"+id,
                                        type: "POST",
                                        success: function(data)
                                        {
                                            reload();
                                        }
                                    });
                                }
                            }

                            function add_uk(){
                                save_method='add';
                                $('#unit_kerja_form')[0].reset();
                                $('#modal_uk').modal('show');
                                $('.modal-title').text('Tambah Data Unit Kerja');
                            }

                            function edit_uk(id){
                                save_method='update';
                                $('#unit_kerja_form')[0].reset();

                                $.ajax({
                                    url : "<?php echo site_url('master/editUk/')?>/" + id,
                                    type: "GET",
                                    dataType: "JSON",
                                    success: function(data)
                                    {
                                        $('#kode_uk').val(data.KODE_UNIT_KERJA);
                                        $('#nama_uk').val(data.NAMA_UNIT_KERJA);
                                        $('#alamat_uk').val(data.ALAMAT_UNIT_KERJA);
                                        $('#modal_uk').modal('show');
                                        $('.modal-title').text('Ubah Data Unit Kerja');
                                    },
                                    error: function (jqXHR, textStatus, errorThrown)
                                    {
                                        alert('Masalah saat mengambil data');
                                    }
                                });
}

function submit_uk(){
    var url;
    if(save_method == 'add') {
        url = "<?php echo base_url('index.php/master/addUk')?>";
    } else {
        url = "<?php echo base_url('index.php/master/updateUk')?>";
    }

    event.preventDefault();
    var kode_uk = $("#kode_uk").val();
    var nama_uk = $("#nama_uk").val();
    var alamat_uk = $("#alamat_uk").val();

    $.ajax({
        type: "POST",
        url : url,
        data: { kode_uk:kode_uk,nama_uk:nama_uk,alamat_uk:alamat_uk},
        success: function(data)
        {
            reload();
        }
    });
};
</script>
</div>

<!-- Divisi -->
<div class="tab-pane fade" id="divisi">
    <h4>Master Divisi</h4>
    <!-- Button -->
    <p>
        <a class="btn btn-primary glyphicon-plus" data-toggle="modal" onclick="add_dv()">Tambah</a>
        <a class="btn btn-primary glyphicon-asterisk" data- toggle="modal" onclick="reload_dv()"> Perbarui</a>
    </p>
    <div class="table-responsive">
    <table class="display nowrap" id="tbl_dv" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Kode</th>
                <th>Nama</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Kode</th>
                <th>Nama</th>
                <th>Aksi</th>
            </tr>
        </tfoot>
    </table>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="modal_dv" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h3 class="modal-title"></h3>
                </div>
                <div class="modal-body">
                    <form role="form" id="divisi_form">

                        <div class="form-group">
                            <label>Kode divisi</label>
                            <input type="text" class="form-control" id="kode_dv" value=<?=$kode_dv?> readonly>
                        </div>

                        <div class="form-group">
                            <label>Nama divisi</label>
                            <input type="text" class="form-control" id="nama_dv" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-primary" id="btn_simpan_dv" onclick="submit_dv()">Simpan</button>
                </div>
            </div>
        </div>
    </div> 
    <!-- End Modal -->
    <script type="text/javascript">
    var save_method;

    $(document).ready(function() {
        $('#tbl_dv').DataTable({
            "dom" : 'Bfrtip',
            "buttons" : [
            'copy', 'excel', 'print'
            ],
            "ajax": "<?php echo base_url('index.php/master/dataDv'); ?>",
        });
    });

    function reload_dv(){
        $("#modal_dv").modal('hide');
        var oTable = $('#tbl_dv').DataTable();
        oTable.ajax.reload();
    }

    function delete_dv(id){
        if(confirm('Anda yakin ingin menghapus data ini?'))
        {
            $.ajax({
                url : "<?php echo base_url('index.php/master/deleteDv')?>/"+id,
                type: "POST",
                success: function(data)
                {
                    reload_dv();
                }
            });
        }
    }

    function add_dv(){
        save_method='add';
        $('#divisi_form')[0].reset();
        $('#modal_dv').modal('show');
        $('.modal-title').text('Tambah Data Divisi');
    }

    function edit_dv(id){
        save_method='update';
        $('#divisi_form')[0].reset();

        $.ajax({
            url : "<?php echo site_url('master/editDv/')?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
                $('#kode_dv').val(data.KODE_DIVISI);
                $('#nama_dv').val(data.NAMA_DIVISI);
                $('#modal_dv').modal('show');
                $('.modal-title').text('Ubah Data Divisi');
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Masalah saat mengambil data');
            }
        });
    }

    function submit_dv(){
        var url;
        if(save_method == 'add') {
            url = "<?php echo base_url('index.php/master/addDv')?>";
        } else {
            url = "<?php echo base_url('index.php/master/updateDv')?>";
        }

        event.preventDefault();
        var kode_dv = $("#kode_dv").val();
        var nama_dv = $("#nama_dv").val();

        $.ajax({
            type: "POST",
            url : url,
            data: { kode_dv:kode_dv,nama_dv:nama_dv },
            success: function(data)
            {
                reload_dv();
            }
        });
    };
    </script>
</div>

<!-- Jabatan -->
<div class="tab-pane fade" id="jabatan">
    <h4>Master Jabatan</h4>
    <!-- Button -->
    <p><a class="btn btn-primary glyphicon-plus" data-toggle="modal" onclick="add_jb()">Tambah</a><a class="btn btn-primary glyphicon-asterisk" data- toggle="modal" onclick="reload_jb()"> Perbarui</a></p>
    <!-- Tabel -->
    <div class="table-responsive">
    <table class="display nowrap" id="tbl_jb" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Kode</th>
                <th>Nama</th>
                <th>Jabatan Induk</th>
                <th>Kode Divisi</th>
                <th>Level</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Kode</th>
                <th>Nama</th>
                <th>Jabatan Induk</th>
                <th>Kode Divisi</th>
                <th>Level</th>
                <th>Aksi</th>
            </tr>
        </tfoot>
    </table>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="modal_jb" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h3 class="modal-title"></h3>
                </div>
                <div class="modal-body">
                    <form role="form" id="jabatan_form">

                        <div class="form-group">
                            <label>Kode Jabatan</label>
                            <input type="text" class="form-control" id="kode_jb" value=<?=$kode_jb?> readonly>
                        </div>

                        <div class="form-group">
                            <label>Nama Jabatan</label>
                            <input type="text" class="form-control" id="nama_jb" required>
                        </div>

                        <div class="form-group">
                            <label>Divisi</label>
                            <select class="form-control" id="nama_dv" required>
                                <option disabled value="">-Pilih Divisi-</option>
                                <?php
                                foreach($cb_dv as $row) {
                                    echo '<option value="'.$row->KODE_DIVISI.'">'.$row->NAMA_DIVISI.' </option>';
                                }
                                ?>
                                <!-- <option value="DV3">tes</option>} -->
                                
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Jabatan Induk</label>
                            <select class="form-control" id="jb_induk" required>
                                <option disabled selected value="">-Pilih Jabatan Induk-</option>
                                <?php
                                foreach($cb_jb as $row) {
                                    echo "<option value= ".$row->KODE_JABATAN.">".$row->NAMA_JABATAN." - ".$row->NAMA_DIVISI." </option>";
                                }
                                ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Level</label>
                            <select class="form-control" id="level" required>
                                <option disabled selected value="">-Pilih Level-</option>
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-primary" id="btn_simpan_jb" onclick="submit_jb()">Simpan</button>
                </div>
            </div>
        </div>
    </div> 
    <!-- End Modal -->
    <script type="text/javascript">
    $(document).ready(function() {
        $('#tbl_jb').DataTable({
            "dom" : 'Bfrtip',
            "buttons" : [
            'copy', 'excel', 'print'
            ],
            "ajax": "<?php echo base_url('index.php/master/dataJb'); ?>"
        });
    });

    function reload_jb(){
        $("#modal_jb").modal('hide');
        var oTable = $('#tbl_jb').DataTable();
        oTable.ajax.reload();
    }

    function delete_jb(id){
        if(confirm('Anda yakin ingin menghapus data ini?'))
        {
            $.ajax({
                url : "<?php echo base_url('index.php/master/deleteJb')?>/"+id,
                type: "POST",
                success: function(data)
                {
                    reload_jb();
                }
            });
        }
    }

    function add_jb(){
        save_method='add';
        $('#jabatan_form')[0].reset();
        $('#modal_jb').modal('show');
        $('.modal-title').text('Tambah Data Jabatan');
    }

    function edit_jb(id){
        save_method='update';
        $('#jabatan_form')[0].reset();

        $.ajax({
            url : "<?php echo site_url('master/editJb')?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
                $('#kode_jb').val(data.KODE_J);
                $('#nama_jb').val(data.NAMA_J);
                $('#jb_induk').val(data.J_INDUK);
                // $('#nama_dv').val(data.KODE_D);
                $('#level').val(data.LEVEL_J);
                $('#modal_jb').modal('show');
                $('.modal-title').text('Ubah Data Jabatan');
                alert(data.KODE_D);

            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Masalah saat mengambil data');
            }
        });
    }

    function submit_jb(){
        var url;
        if(save_method == 'add') {
            url = "<?php echo base_url('index.php/master/addJb')?>";
        } else {
            url = "<?php echo base_url('index.php/master/updateJb')?>";
        }

        event.preventDefault();
        var kode_jb = $("#kode_jb").val();
        var nama_jb = $("#nama_jb").val();
        var jb_induk = $("#jb_induk").value();
        var nama_dv = $("#nama_dv").value();
        var level = $("#level").val();  

        $.ajax({
            type: "POST",
            url : url,
            data: { kode_jb:kode_jb,nama_jb:nama_jb,jb_induk:jb_induk,nama_dv:nama_dv,level:level },
            success: function(data)
            {
                reload_jb();
            }
        });
    };

    </script>
</div>

<!-- Pegawai -->
<div class="tab-pane fade" id="pegawai">
    <h4>Master Pegawai</h4>
    <!-- Button -->
    <p><a class="btn btn-primary glyphicon-plus" data-toggle="modal" onclick="add_pg()">Tambah</a><a class="btn btn-primary glyphicon-asterisk" data-  toggle="modal" onclick="reload_pg()"> Perbarui</a></p>
   <div class="table-responsive">
   <table class="display nowrap" id="tgl_pg" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>NIP</th>
                <th>JABATAN</th>
                <th>PASSWORD</th>
                <th>NAMA</th>
                <th>ALAMAT</th>
                <th>TELEPON</th>
                <th>UNIT KERJA</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>NIP</th>
                <th>JABATAN</th>
                <th>PASSWORD</th>
                <th>NAMA</th>
                <th>ALAMAT</th>
                <th>TELEPON</th>
                <th>UNIT KERJA</th>
                <th>Aksi</th>
            </tr>
        </tfoot>
    </table>
</div>
    <!-- Modal -->
    <div class="modal fade" id="modal_pg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h3 class="modal-title"></h3>
                </div>
                <div class="modal-body">
                    <form role="form" id="pegawai_form">
                        <div class="form-group">
                            <label>Unit Kerja</label>
                            <select required class="form-control" id="unit_kerjap" name="unit_kerjap" onchange="getKodePG()">
                                <option disabled selected value="">-Pilih Unit Kerja-</option>
                                <?php
                                foreach($cb_uk as $row) {
                                    echo "<option value= ".$row->KODE_UNIT_KERJA.">".$row->NAMA_UNIT_KERJA." </option>";
                                }
                                ?>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label>Nomer Induk Pegawai</label>
                            <input required type="text" class="form-control" id="nip" name="nip" readonly>
                        </div>

                        <div class="form-group">
                            <label>Nama Pegawai</label>
                            <input required type="text" class="form-control" id="namap" name="namap" required>
                        </div>

                        <div class="form-group">
                            <label>Alamat Pegawai</label>
                            <input required type="text" class="form-control" id="alamatp" name="alamatp" required>
                        </div>

                        <div class="form-group">
                            <label>Email Pegawai</label>
                            <input required type="text" class="form-control" id="emailp" name="emailp" required>
                        </div>

                        <div class="form-group">
                            <label>Telepon Pegawai</label>
                            <input required type="text" class="form-control" id="teleponp" name="teleponp" required>
                        </div>

                        <div class="form-group">
                            <label>Jabatan</label>
                            <select required class="form-control" name="jabatanp" required>
                                <option disabled selected value="">-Pilih Jabatan-</option>
                                <?php
                                foreach($cb_jb as $row) {
                                    echo "<option value= ".$row->KODE_JABATAN.">".$row->NAMA_JABATAN." - ".$row->NAMA_DIVISI." </option>";
                                }
                                ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Foto Pegawai</label>
                            <input type="file" id="fotop" name="fotop" class="form-control" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-primary" id="btn_simpan_pg">Simpan</button>
                </div>
            </div>
        </div>
    </div> 
    <!-- End Modal -->
    <script type="text/javascript">

    $(document).ready(function() {
        $('#tgl_pg').DataTable({
            "dom" : 'Bfrtip',
            "buttons" : [
            'copy', 'excel', 'print'
            ],
            "ajax": "<?php echo base_url('index.php/master/dataPg'); ?>"
        });

    $("#btn_simpan_pg").click(function(){
        var url;
        if(save_method == 'add') {
            url = "<?php echo base_url('index.php/master/addPg')?>";
        } else {
            url = "<?php echo base_url('index.php/master/updatePg')?>";
        }

        // event.preventDefault();
        // var nip = $("#nip").val();
        // var namap = $("#namap").val();
        // var alamatp = $("#alamatp").val();
        // var teleponp = $("#teleponp").val();
        // var jabatanp = $("#jabatanp").val();   
        // var unit_kerjap = $("#unit_kerjap").val();
        var form_data = new FormData(document.getElementById('pegawai_form'));

        $.ajax({
            type: "POST",
            url : url,
            data: form_data,
            success: function(data)
            {
                reload_pg();
            },
            error: function (response) {
                $('#msg').html(response);
            },
            cache: false,
            contentType: false,
            processData: false,
        });
    });
    });

    function getKodePG() {
        var element = $("#unit_kerjap").val();

        $.ajax({
            url : "<?php echo base_url('index.php/master/getKodePegawai')?>/"+element,
            type: "POST",
            success: function(data)
            {
                $("#nip").val(data);
            }
        });
    }

    function reload_pg(){
        $("#modal_pg").modal('hide');
        var oTable = $('#tbl_pg').DataTable();
        oTable.ajax.reload();
    }

    function delete_pg(id){
        if(confirm('Anda yakin ingin menghapus data ini?'))
        {
            $.ajax({
                url : "<?php echo base_url('index.php/master/deletePg')?>/"+id,
                type: "POST",
                success: function(data)
                {
                    reload_pg();
                }
            });
        }
    }

    function add_pg(){
        save_method='add';
        $('#pegawai_form')[0].reset();
        $('#modal_pg').modal('show');
        $('.modal-title').text('Tambah Data Pegawai');
    }

    function edit_pg(id){
        save_method='update';
        $('#pegawai_form')[0].reset();

        $.ajax({
            url : "<?php echo site_url('master/editPg')?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
                $("#nip").val(data.NIP);
                $("#namap").val(data.NAMA_PEGAWAI);
                $("#alamatp").val(data.ALAMAT_PEGAWAI);
                $("#teleponp").val(data.TELP_PEGAWAI);
                $("#jabatanp").val(data.KODE_J);   
                $("#unit_kerjap").val(data.KODE_UK);
                $('#modal_pg').modal('show');
                $('.modal-title').text('Ubah Data Pegawai');
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Masalah saat mengambil data');
            }
        });
    }
    </script>
</div>

<!-- Jenis Dokumen -->
<div class="tab-pane fade" id="jenisdokumen">
    <h4>Master Jenis Dokumen</h4>
    <!-- Button -->
    <p><a class="btn btn-primary glyphicon-plus" data-toggle="modal" onclick="add_jd()"> Tambah</a><a class="btn btn-primary glyphicon-asterisk" data-   toggle="modal" onclick="reload_jd()"> Perbarui</a></p>
    <div class="table-responsive">
    <table class="display nowrap" id="tbl_jd" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Kode</th>
                <th>Nama</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Kode</th>
                <th>Nama</th>
                <th>Aksi</th>
            </tr>
        </tfoot>
    </table>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="modal_jd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h3 class="modal-title"></h3>
                </div>
                <div class="modal-body">
                    <form role="form" id="jenis_dokumen_form">
                        <div class="form-group">
                            <label>Kode Jenis Dokumen</label>
                            <input type="text" class="form-control" id="kode_jd" value=<?=$kode_jd?> readonly>
                        </div>

                        <div class="form-group">
                            <label>Nama Jenis Dokumen</label>
                            <input type="text" class="form-control" id="nama_jd" required>
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-primary" onclick="submit_jd()" id="btn_simpan_jd">Simpan</button>
                </div>
            </div>
        </div>
    </div> 
    <!-- End Modal -->
    <script type="text/javascript">
    $(document).ready(function() {
        $('#tbl_jd').DataTable({
            "dom" : 'Bfrtip',
            "buttons" : [
            'copy', 'excel', 'print'
            ],
            "ajax": "<?php echo base_url('index.php/master/dataJd'); ?>"
        });
    });

    function reload_jd(){
        $("#modal_jd").modal('hide');
        var oTable = $('#tbl_jd').DataTable();
        oTable.ajax.reload();
    }

    function delete_jd(id){
        if(confirm('Anda yakin ingin menghapus data ini?'))
        {
            $.ajax({
                url : "<?php echo base_url('index.php/master/deleteJd')?>/"+id,
                type: "POST",
                success: function(data)
                {
                    reload_jd();
                }
            });
        }
    }

    function add_jd(){
        save_method='add';
        $('#jenis_dokumen_form')[0].reset();
        $('#modal_jd').modal('show');
        $('.modal-title').text('Tambah Data Jenis Dokumen');
    }

    function edit_jd(id){
        save_method='update';
        $('#jenis_dokumen_form')[0].reset();

        $.ajax({
            url : "<?php echo site_url('master/editJd')?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
                $("#kode_jd").val(data.KODE_JABATAN);
                $("#nama_jd").val(data.NAMA_JABATAN);
                $('#modal_jd').modal('show');
                $('.modal-title').text('Ubah Data Jenis Dokumen');
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Masalah saat mengambil data');
            }
        });
    }

    function submit_jd(){
        var url;
        if(save_method == 'add') {
            url = "<?php echo base_url('index.php/master/addJd')?>";
        } else {
            url = "<?php echo base_url('index.php/master/updateJd')?>";
        }

        event.preventDefault();
        var kode_jd = $("#kode_jd").val();
        var nama_jd = $("#nama_jd").val();

        $.ajax({
            type: "POST",
            url : url,
            data:{ kode_jd:kode_jd,nama_jd:nama_jd},
            success: function(data)
            {
                reload_jd();
            }
        });
    };
    </script>
</div>

<!-- Status Dokumen -->
<div class="tab-pane fade" id="statusdokumen">
    <h4>Master Status Dokumen</h4>
    <!-- Button -->
    <p><a class="btn btn-primary glyphicon-plus" data-toggle="modal" onclick="add_sd()">Tambah</a><a class="btn btn-primary glyphicon-asterisk" data-   toggle="modal" onclick="reload_sd()"> Perbarui</a></p>
    <div class="table-responsive">
    <table class="display nowrap" id="tbl_sd" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Kode</th>
                <th>Nama</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Kode</th>
                <th>Nama</th>
                <th>Aksi</th>
            </tr>
        </tfoot>
    </table>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="modal_sd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h3 class="modal-title"></h3>
                </div>
                <div class="modal-body">
                    <form role="form" id="status_dokumen_form">
                        <div class="form-group">
                            <label>Kode Status Dokumen</label>
                            <input type="text" class="form-control" id="kode_sd" value=<?=$kode_sd?> readonly>
                        </div>

                        <div class="form-group">
                            <label>Nama Status Dokumen</label>
                            <input type="text" class="form-control" id="nama_sd" required>
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-primary" onclick="submit_sd()" id="btn_simpan_sd">Simpan</button>
                </div>
            </div>
        </div>
    </div> 
    <!-- End Modal -->
    <script type="text/javascript">
    $(document).ready(function() {
        $('#tbl_sd').DataTable({
            "dom" : 'Bfrtip',
            "buttons" : [
            'copy', 'excel', 'print'
            ],
            "ajax": "<?php echo base_url('index.php/master/dataSd'); ?>"
        });
    });

    function reload_sd(){
        $("#modal_sd").modal('hide');
        var oTable = $('#tbl_sd').DataTable();
        oTable.ajax.reload();
    }

    function delete_sd(id){
        if(confirm('Anda yakin ingin menghapus data ini?'))
        {
            $.ajax({
                url : "<?php echo base_url('index.php/master/deleteSd')?>/"+id,
                type: "POST",
                success: function(data)
                {
                    reload_sd();
                }
            });
        }
    }

    function add_sd(){
        save_method='add';
        $('#status_dokumen_form')[0].reset();
        $('#modal_sd').modal('show');
        $('.modal-title').text('Tambah Data Status Dokumen');
    }

    function edit_sd(id){
        save_method='update';
        $('#status_dokumen_form')[0].reset();

        $.ajax({
            url : "<?php echo site_url('master/editSd')?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
                $("#kode_sd").val(data.KODE_STATUS_DOKUMEN);
                $("#nama_sd").val(data.NAMA_STATUS_DOKUMEN);
                $('#modal_sd').modal('show');
                $('.modal-title').text('Ubah Data Status Dokumen');
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Masalah saat mengambil data');
            }
        });
    }

    function submit_sd(){
        var url;
        if(save_method == 'add') {
            url = "<?php echo base_url('index.php/master/addSd')?>";
        } else {
            url = "<?php echo base_url('index.php/master/updateSd')?>";
        }

        event.preventDefault();
        var kode_sd = $("#kode_sd").val();
        var nama_sd = $("#nama_sd").val();

        $.ajax({
            type: "POST",
            url : url,
            data:{ kode_sd:kode_sd,nama_sd:nama_sd},
            success: function(data)
            {
                reload_sd();
            }
        });
    };
    </script>
</div>

<!-- Wajib Pajak -->
<div class="tab-pane fade" id="wajibpajak">
    <h4>Master Wajib Pajak</h4>
    <!-- Button -->
    <p><a class="btn btn-primary glyphicon-plus" data-toggle="modal" onclick="add_wp()">Tambah</a><a class="btn btn-primary glyphicon-asterisk" data-   toggle="modal" onclick="reload_wp()"> Perbarui</a></p>
    <div class="table-responsive">
    <table class="display nowrap" id="tbl_wp" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Kode</th>
                <th>NPWP</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>Account Representative</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Kode</th>
                <th>NPWP</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>Account Representative</th>
                <th>Aksi</th>
            </tr>
        </tfoot>
    </table>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="modal_wp" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h3 class="modal-title"></h3>
                </div>
                <div class="modal-body">
                    <form role="form" id="wajib_pajak_form">
                        <div class="form-group">
                            <label>Kode Wajib Pajak</label>
                            <input type="text" class="form-control" id="kode_wp" value=<?=$kode_wp?> readonly>
                        </div>

                        <div class="form-group">
                            <label>NPWP</label>
                            <input type="text" class="form-control" id="npwp" required>
                        </div>

                        <div class="form-group">
                            <label>Nama Wajib Pajak</label>
                            <input type="text" class="form-control" id="nama" required>
                        </div>

                        <div class="form-group">
                            <label>Alamat</label>
                            <input type="text" class="form-control" id="alamat" required>
                        </div>

                        <div class="form-group">
                            <label>Telepon</label>
                            <input type="text" class="form-control" id="telepon" required>
                        </div>

                        <div class="form-group">
                            <label>AR</label>
                            <select required class="form-control" id="ar" required>
                                <option disabled selected value="">-Pilih AR-</option>
                                <?php
                                foreach($cb_ar as $row) {
                                    echo "<option value= ".$row->NIP.">".$row->NAMA_PEGAWAI." - ".$row->NAMA_DIVISI." </option>";
                                }
                                ?>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-primary" onclick="submit_wp()" id="btn_simpan_wp">Simpan</button>
                </div>
            </div>
        </div>
    </div> 
    <!-- End Modal -->
    <script type="text/javascript">
    $(document).ready(function() {
        $('#tbl_wp').DataTable({
            "dom" : 'Bfrtip',
            "buttons" : [
            'copy', 'excel', 'print'
            ],
            "ajax": "<?php echo base_url('index.php/master/dataWp'); ?>",
        });
    });
    
    function reload_wp(){
        $("#modal_wp").modal('hide');
        var oTable = $('#tbl_wp').DataTable();
        oTable.ajax.reload();
    }

    function delete_wp(id){
        if(confirm('Anda yakin ingin menghapus data ini?'))
        {
            $.ajax({
                url : "<?php echo base_url('index.php/master/deleteWp')?>/"+id,
                type: "POST",
                success: function(data)
                {
                    reload_wp();
                }
            });
        }
    }

    function add_wp(){
        save_method='add';
        $('#wajib_pajak_form')[0].reset();
        $('#modal_wp').modal('show');
        $('.modal-title').text('Tambah Data Wajib Pajak');
    }

    function edit_wp(id){
        save_method='update';
        $('#wajib_pajak_form')[0].reset();

        $.ajax({
            url : "<?php echo site_url('master/editWp')?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
                $("#kode_wp").val(data.KODE_WP);
                $("#npwp").val(data.NPWP);
                $("#nama").val(data.NAMA_WP);  
                $("#alamat").val(data.ALAMAT_WP);  
                $("#telepon").val(data.TELP_WP);  
                $("#ar").val(data.AR); 
                $('#modal_wp').modal('show');
                $('.modal-title').text('Ubah Data Wajib Pajak');
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Masalah saat mengambil data');
            }
        });
    }

    function submit_wp(){
        var url;
        if(save_method == 'add') {
            url = "<?php echo base_url('index.php/master/addWp')?>";
        } else {
            url = "<?php echo base_url('index.php/master/updateWp')?>";
        }

        event.preventDefault();
        var kode_wp = $("#kode_wp").val();
        var npwp = $("#npwp").val();
        var nama = $("#nama").val();  
        var alamat = $("#alamat").val();  
        var telepon = $("#telepon").val();  
        var ar = $("#ar").val(); 

        $.ajax({
            type: "POST",
            url : url,
            data:{ kode_wp:kode_wp,npwp:npwp,nama:nama,alamat:alamat,telepon:telepon,ar:ar},
            success: function(data)
            {
                reload_wp();
            }
        });
    }; 
    </script>
</div>

<!-- Non Wajib Pajak -->
<div class="tab-pane fade" id="nonwajibpajak">
    <h4>Master Non Wajib Pajak</h4>
    <!-- Button -->
    <p><a class="btn btn-primary glyphicon-plus" data-toggle="modal" onclick="add_nwp()">Tambah</a><a class="btn btn-primary glyphicon-asterisk" data-toggle="modal" onclick="reload_nwp()"> Perbarui</a></p>
    <div class="table-responsive">
    <table class="display nowrap" id="tbl_nwp" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Kode</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>Telepon</th>
                <th>Kantor Pelayanan Pajak</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Kode</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>Telepon</th>
                <th>Kantor Pelayanan Pajak</th>
                <th>Aksi</th>
            </tr>
        </tfoot>
    </table>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="modal_nwp" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h3 class="modal-title"></h3>
                </div>
                <div class="modal-body">
                    <form role="form" id="non_wp_form">
                        <div class="form-group">
                            <label>Kode Non Wajib Pajak</label>
                            <input type="text" class="form-control" id="kode_nwp" value=<?=$kode_nwp?> readonly>
                        </div>

                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" class="form-control" id="naman" required>
                        </div>

                        <div class="form-group">
                            <label>Alamat</label>
                            <input type="text" class="form-control" id="alamatn" required>
                        </div>

                        <div class="form-group">
                            <label>Telepon</label>
                            <input type="text" class="form-control" id="telpn" required>
                        </div>

                        <div class="form-group">
                            <label>KPP</label>
                            <select required class="form-control" id="kpp" required>
                                <option disabled selected value="">-Pilih KPP-</option>
                                <?php
                                foreach($cb_kpp as $row) {
                                    echo "<option value= ".$row->KODE_UNIT_KERJA.">".$row->NAMA_UNIT_KERJA."</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-primary" onclick="submit_nwp()" id="btn_simpan_nwp">Simpan</button>
                </div>
            </div>
        </div>
    </div> 
    <!-- End Modal -->
    <script type="text/javascript">
    $(document).ready(function() {
        $('#tbl_nwp').DataTable({
            "dom" : 'Bfrtip',
            "buttons" : [
            'copy', 'excel', 'print'
            ],
            "ajax": "<?php echo base_url('index.php/master/dataNwp'); ?>"
        });
    });

    function reload_nwp(){
        $("#modal_nwp").modal('hide');
        var oTable = $('#tbl_nwp').DataTable();
        oTable.ajax.reload();
    }

    function delete_nwp(id){
        if(confirm('Anda yakin ingin menghapus data ini?'))
        {
            $.ajax({
                url : "<?php echo base_url('index.php/master/deleteNwp')?>/"+id,
                type: "POST",
                success: function(data)
                {
                    reload_nwp();
                }
            });
        }
    }

    function add_nwp(){
        save_method='add';
        $('#non_wp_form')[0].reset();
        $('#modal_nwp').modal('show');
        $('.modal-title').text('Tambah Data Non Wajib Pajak');
    }

    function edit_nwp(id){
        save_method='update';
        $('#non_wp_form')[0].reset();

        $.ajax({
            url : "<?php echo site_url('master/editNwp')?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
                $("#kode_nwp").val(data.KODE_NON_WP);
                $("#naman").val(data.NAMA_NON_WP);  
                $("#alamatn").val(data.ALAMAT_NON_WP);
                $("#telpn").val(data.TELP_NON_WP);  
                $("#kpp").val(data.KODE_UK);
                $('#modal_nwp').modal('show');
                $('.modal-title').text('Ubah Data Non Wajib Pajak');
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Masalah saat mengambil data');
            }
        });
    }

    function submit_nwp(){
        var url;
        if(save_method == 'add') {
            url = "<?php echo base_url('index.php/master/addNwp')?>";
        } else {
            url = "<?php echo base_url('index.php/master/updateNwp')?>";
        }

        event.preventDefault();
        var kode_nwp = $("#kode_nwp").val();
        var naman = $("#naman").val();  
        var alamatn = $("#alamatn").val();
        var telpn = $("#telpn").val();  
        var kpp = $("#kpp").val();

        $.ajax({
            type: "POST",
            url : url,
            data:{ kode_nwp:kode_nwp,naman:naman,alamatn:alamatn,telpn:telpn,kpp:kpp},
            success: function(data)
            {
                reload_nwp();
            }
        });
    }; 
    </script>
</div>
</div><!-- tab panes -->
</div> <!-- panel body -->
</div> <!-- panel default -->
</div> <!-- lg 12 -->
</div> <!-- row -->
</div> <!-- page wrapper -->

</body>
</html>

<?php $this->load->view('down'); ?>