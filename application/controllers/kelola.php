<?php if(! defined('BASEPATH'))exit('No direct script access allowed');

Class Kelola extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('kelola_model');
        $am = $this->kelola_model->akses();
        $akses = $this->db->get_where('user_menu', ['url' => 'kelola' ])->row_array();
        if (!$this->session->userdata('email')) {
            redirect('auth');
        } else if (!$am){
            redirect('auth/error404');
        } else if ($akses['is_active'] == 2){
            redirect('auth/error404');
        }
    }

    public function index()
    {
    	$data['title'] = 'Data User';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('headercontrol', $data);
		$this->load->view('menu', $data);
		$this->load->view('kelola_view', $data);
		$this->load->view('footer',$data);
    }

    public function daftar_data()
    {
      echo $this->kelola_model->getData();
    }

    public function add()
    {
      if (!isset($_POST))
        show_404();
        
        $this->kelola_model->add();
    }

    public function hapus()
    {
        if (!isset($_POST))
        show_404();
        $this->kelola_model->hapus();  
    }

}