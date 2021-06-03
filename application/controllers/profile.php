<?php if(! defined('BASEPATH'))exit('No direct script access allowed');

Class Profile extends CI_Controller 
{

	public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('profile_model');
        $am = $this->profile_model->akses();
        $akses = $this->db->get_where('user_menu2', ['url' => 'profile' ])->row_array();
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
		$data['title'] = 'Dashboard';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		
		$this->load->view('header',$data);
    $this->load->view('profile_view',$data);
    $this->load->view('footer',$data);
	}

  public function add()
  {
      if (!isset($_POST))
        show_404();
        
        $this->profile_model->add();
  }


}