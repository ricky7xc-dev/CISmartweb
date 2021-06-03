<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Userpage extends CI_Controller 

{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->helper('url');
	}

	public function index()
	{
		$this->load->view('userpage/headeruser');
      	$this->load->view('userpage/contentuser');
     	$this->load->view('userpage/footeruser');
	}


}