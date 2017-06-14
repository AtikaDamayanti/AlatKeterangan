<?php 
    $session = $this->session->userdata('isLogin');
    
    if($session == true){
        $nama = $_SESSION['nama_pegawai'];
        $jabatan = $_SESSION['jabatan'];
        $divisi = $_SESSION['divisi'];
        $unit_kerja = $_SESSION['unit_kerja'];
        $nip = $_SESSION['nip'];
        $foto = $_SESSION['foto'];
    } else {
        Header('Location: ' . base_url() . 'index.php/login');
    }
?>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Sistem Informasi Alat Keterangan Pajak</title>

    <script src="<?php echo base_url('/assets/js/jquery-1.12.4.js'); ?>" type="text/javascript"></script>
    
    <link href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/metisMenu.min.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/sb-admin-2.min.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/morris.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/font-awesome.min.css'); ?>" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url('assets/css/select2.min.css') ?>" rel="stylesheet" />

    <link href="<?php echo base_url('/assets/css/buttons.dataTables.min.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('/assets/css/jquery.dataTables.min.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/dp/css/bootstrap-datepicker3.min.css')?>" rel="stylesheet">
 <link rel="stylesheet" href="//code.jquery.com/ui/1.11.0/themes/smoothness/jquery-ui.css">
    <style type="text/css">
        .center {
            float: none;
            margin: 0 auto 0px auto;
        }
    </style>
</head>
<body onload="jumlah()">
    <div id="wrapper">
        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand"><?php echo $unit_kerja; ?></a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <div id="jumlah" onclick="isi()">
                        
                        </div>
                    </a>    
                    <ul class="dropdown-menu dropdown-alerts">
                        <li>
                            <a href="#">
                                <div id="isi"></div>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="login/logout"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- /.navbar-top-links -->

             <script type="text/javascript">  
                    function isi(){
                        $.ajax({
                            url : "<?php echo site_url('dashboard/getNotif/');?>",
                            type: "GET",
                            success: function(data) {
                                $("#isi").html(data);
                            },
                            error: function (jqXHR, textStatus, errorThrown)
                            {
                                alert('Masalah saat mengambil data');
                            }
                        });
                    }

                    function jumlah(){
                        $.ajax({
                            url : "<?php echo site_url('dashboard/getJumlahNotif/');?>",
                            type: "GET",
                            success: function(data) {
                                $("#jumlah").html(data);
                            },
                            error: function (jqXHR, textStatus, errorThrown)
                            {
                                alert('Masalah saat mengambil data');
                            }
                        });
                    }

                    function updateNotif(id) {
                        $.ajax({
                            url : "<?php echo site_url('dashboard/updateNotif/'); ?>/" + id,
                            type : "POST",
                            success : function(data) {
                                return data;
                            },
                            error: function (jqXHR, textStatus, errorThrown)
                            {
                                alert('Update');
                            }
                        });
                    }
                //}
            </script>

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <div class="center col-sm-5">
                                    <img src="<?php echo base_url('uploads/'.$foto); ?>" class="img-responsive img-circle">
                                </div>
                                <div class="info">
                                    <p class="text-primary" align="center"><?php 
                                    echo "<b>".$nama."</b>" .'<br>'. $jabatan.'<br>'.$divisi;
                                    ?></p>
                                </div>
                        </div>
                        </li>
                        <li>
                            <a href="dashboard"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>
                        <?php if(substr($this->session->userdata('unit_kerja'),7,7) == 'Wilayah'){ ?>
                        <li>
                            <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Pengiriman<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li class="active">
                                    <a href="pengiriman"> Kirim</a>
                                </li>
                                <li>
                                    <a href="pengiriman"> Terima</a>
                                </li>
                                <li>
                                    <a href="pengiriman"> Disposisi</a>
                                </li>
                                <li>
                                    <a href="pengiriman"> Realisasi</a>
                                </li>
                            </ul>
                        </li>

                        <?php }
                        if(substr($this->session->userdata('unit_kerja'),7,7) == 'Pelayan'){ ?>
                        <li>
                            <a href="#"><i class="fa fa-download fa-fw"></i> Penerimaan<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <?php if($this->session->userdata('level') == '1' or $this->session->userdata('level') == '2') { ?>
                                <li>
                                    <a href="penerimaan"> Terima</a>
                                </li>
                                <?php } ?>
                                <li>
                                    <a href="penerimaan"> Realisasi</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <?php } ?>
                        <li>
                            <a href="#"><i class="fa fa-list fa-fw"></i> Master<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <?php if($this->session->userdata('level') == '0') { ?>
                                <li>
                                    <a href="master"> Unit Kerja</a>
                                </li>
                                <li>
                                    <a href="master"> Divisi</a>
                                </li>
                                <li>
                                    <a href="master"> Jabatan</a>
                                </li>
                                <li>
                                    <a href="master"> Pegawai</a>
                                </li>
                                <li>
                                    <a href="master"> Jenis Dokumen</a>
                                </li>
                                <li>
                                    <a href="master"> Status Dokumen</a>
                                </li>
                                <?php } ?>
                                <li>
                                    <a href="master"> Wajib Pajak</a>
                                </li>
                                <li>
                                    <a href="master"> Non Wajib Pajak</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>
