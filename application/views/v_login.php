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
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title fa fa-sign-in"> Sign In</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" action="<?php echo base_url('index.php/login/do_login'); ?>" method="post">
                            <fieldset>
                                <img src="<?=base_url()?>assets/gambar/logo_pajak.png" style="margin-bottom:20px; padding : 10px 10px 10px 5px">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="nip" placeholder="NIP" autofocus>
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" placeholder="Password" name="password">
                                </div>
                                <input type="submit" id="submit" value="Login" class="btn btn-md btn-success btn-block">
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="<?php echo base_url('assets/js/jquery.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/metisMenu.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/sb-admin-2.js'); ?>"></script>
</body>
</html>