<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->library('Template');
        $this->load->helper('url');
    }

	public function index()
	{
		$this->data['title'] = 'Home';
		$this->template->view('home_view', $this->data);
	}
}
