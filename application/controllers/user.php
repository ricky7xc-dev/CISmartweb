<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller 

{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->helper('url');
		if (!$this->session->userdata('email')) {
			redirect('auth');
		}
	}

	public function index()
	{
		$data['title'] = 'Dashboard';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$this->load->view('header',$data);
      	$this->load->view('content',$data);
     	$this->load->view('footer',$data);
	}

}