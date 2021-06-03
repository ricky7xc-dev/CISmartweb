<?php if(! defined('BASEPATH'))exit('No direct script access allowed');

Class Gambar extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('gambar_model');
        if (!$this->session->userdata('email')) {
            redirect('auth');
        } else if ($this->session->userdata('role_id')==2){
            redirect('auth/error404');
        }
    }

    public function index()
    {
    	$data['title'] = 'Data Cabe';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$this->load->view('headercontrol', $data);
        $this->load->view('menu', $data);
        $this->load->view('gambar_view', $data);
        $this->load->view('footer',$data);
    }

    public function do_upload()
        {
                $config['upload_path']          = './upload/';
                $config['allowed_types']        = 'jpeg|jpg|png';
                $config['max_size']             = 100000;
                $config['max_width']            = 100000;
                $config['max_height']           = 100000;

                $this->load->library('upload', $config);

                if ( ! $this->upload->do_upload('userfile'))
                {
                        echo "Gagal Tambah";
                }
                else
                {
                        $gambar = $this->upload->data();
                        $gambar = $gambar['file_name'];
                        $nama_gambar = $this->input->post('nama_gambar', TRUE);

                        $data = array(
                            'nama_gambar' => $nama_gambar,
                            'gambar' => $gambar,
                        );

                        $this->db->insert('gambar', $data);

                        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Gambar Berhasil Ditambahkan</div>');
                        redirect('gambar');
                }
        }
    
}