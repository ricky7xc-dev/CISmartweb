<?php if(! defined('BASEPATH'))exit('No direct script access allowed');

Class Shopscrap extends CI_Controller 
{

	public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('shopscrap_model');
        $am = $this->shopscrap_model->akses();
        $akses = $this->db->get_where('user_menu', ['url' => 'shopscrap' ])->row_array();
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
      	$this->load->view('shopscrap_view',$data);
      	$this->load->view('footer',$data);
	}

}