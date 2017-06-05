<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>AJAX File upload using Codeigniter, jQuery</title>
        <script src="<?php echo base_url('/assets/js/jquery-1.12.4.js'); ?>" type="text/javascript"></script>
        <script type="text/javascript">
        $(document).ready(function() {
                $("#upload").click(function(){
                    var form_data = new FormData(document.getElementById('myForm'));

                    $.ajax({
                        url: "<?php echo site_url('upload/doUpload') ?>",
                        type: "post",
                        data: form_data,
                        success: function (data) {
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
            });
        </script>
    </head>
    <body>
        <form id="myForm" method="post" enctype="multipart/form-data">
        <p id="msg"></p>
        <input type="file" id="fl" name="fl" />
        <input type="text" id="judul" name="judul">
        <button id="upload">Upload</button>
    </body>
</html>