<?php if(! defined('BASEPATH'))exit('No direct script access allowed');

Class Shop extends CI_Controller 
{

	public function __construct()
  {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('shop_model');
        $am = $this->shop_model->akses();
        $akses = $this->db->get_where('user_menu', ['url' => 'shop' ])->row_array();
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
    $data['cabe'] = $this->shop_model->show_data()->result();
    $data['cabe2'] = $this->shop_model->show_data2()->result();
    $data['cabe3'] = $this->shop_model->show_data3()->result();
    $data['cabe4'] = $this->shop_model->show_data4()->result();
    $data['title'] = 'Dashboard';
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		
		$this->load->view('header',$data);
    $this->load->view('shop_view',$data);
    $this->load->view('footer',$data);
  }

	public function detailproduk($kode_cabe)
  {
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    $data['detailcabe'] = $this->shop_model->detail_produk($kode_cabe);
    $this->load->view('header');
  	$this->load->view('detail_produk', $data);
  	$this->load->view('footer');
  }

  public function cari()
  {
    $am = $this->shop_model->akses1();
    $akses1 = $this->db->get_where('user_menu3', ['url' => 'shop/cari' ])->row_array();
        if (!$this->session->userdata('email')) {
            redirect('auth');
        } else if (!$am){
            redirect('auth/error404');
        } else if ($akses1['is_active'] == 2){
            redirect('auth/error404');
        }
        
    $cari=$this->input->post('cari', true);
    $data['produk']=$this->shop_model->cari($cari);
    $data['title'] = 'Cari';
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    
    $this->load->view('header',$data);
    $this->load->view('cari_view',$data);
    $this->load->view('footer',$data);
  }

  public function add()
  {
    if (!isset($_POST))
    show_404();
        
    $this->shop_model->add();
  }

  public function add1()
  {
    if (!isset($_POST))
    show_404();
        
    $this->shop_model->add1();
  }

  public function add2()
  {
    if (!isset($_POST))
    show_404();
        
    $this->shop_model->add2();
  }

  public function add3()
  {
    if (!isset($_POST))
    show_404();
        
    $this->shop_model->add3();
  }

  public function add4()
  {
    if (!isset($_POST))
    show_404();
        
    $this->shop_model->add4();
  }

}