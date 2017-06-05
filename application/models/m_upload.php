<?php 
class m_upload extends CI_Model {
  
    public function add($pct)
    {
        $data = array(
            'filename'      => $pct,
            'title'         => $this->input->post('judul')
        );
        $this->db->insert('files', $data);
    }
  
}