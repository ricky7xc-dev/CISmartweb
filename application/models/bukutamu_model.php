<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Bukutamu_model extends CI_Model {
     
    public function __construct()
    {
        parent::__construct();
        $this->load->database();        
    }

    
    public function add()
    {
        $tanggal = $this->input->post('txtDate');
        $email = $this->input->post('txtEmail');
        $nama = $this->input->post('txtNama');
        $kritiksaran = $this->input->post('txtKritikSaran');
      
            if($this->db->simple_query("INSERT INTO bukutamu(tanggal, email, nama, kritik_saran)
                    VALUES ('$tanggal', '$email' ,'$nama', '$kritiksaran')")){       
                $data['msg'][0] = "ok";
                $data['msg'][1] = "Kritik dan Saran Telah Berhasil dikirim.....";
                redirect('/admin');
            } else {
                $error = $this->db->error();
                $myJSON = json_encode($error['code'].": ".$error['message']);
                $data['msg'][0] = "err";
                $data['msg'][1] = $myJSON;
            }

        echo json_encode($data);
    }

    public function akses()
    {
        $akses = $this->db->get_where('user_menu', ['url' => 'bukutamu' ])->row_array();
        $am = $akses['id'];
        $role = $this->session->userdata('role_id');

        $query = $this->db->query("SELECT menu_id FROM user_access_menu WHERE menu_id = '$am' AND role_id = '$role'");

        return $query->result();
    }

   
}