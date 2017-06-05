<?php 
class Upload extends CI_Controller 
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_upload','m');
        $this->load->database();
        $this->load->helper('url');
    }
  
    public function index()
    {
        $this->load->view('v_upload');
    }

    function doUpload(){
        //upload file
        $config['upload_path'] = 'uploads/';
        $config['allowed_types'] = '*';
        $config['max_filename'] = '255';
        $config['encrypt_name'] = TRUE;
        $config['max_size'] = '2024'; //1 MB

        if (isset($_FILES['fl']['name'])) {
            if (0 < $_FILES['fl']['error']) {
                echo 'Error during file upload' . $_FILES['fl']['error'];
            } else {
                if (file_exists('uploads/' . $_FILES['fl']['name'])) {
                    echo 'File already exists : uploads/' . $_FILES['fl']['name'];
                } else {
                    $this->load->library('upload');
                    $this->upload->initialize($config);
                    if (!$this->upload->do_upload('fl')) {
                        echo $this->upload->display_errors();
                    } else {
                        //echo  'File successfully uploaded '.$_FILES['file']['name'];
                        $pct = $_FILES['fl']['name'];
                        $upl = $this->m->add($pct);
                        if($upl){
                            echo 'File successfully uploaded';
                        } else {
                            echo 'File upload failed';
                        }
                    }
                }
            }
        } else {
            echo 'Please choose a file';
        }
    }
}
