<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->library('Template');
        $this->load->helper('url');
    }

	public function index()
	{
		$this->data['title'] = 'Menu';
		$this->template->view('menu_view', $this->data);
	}
}
