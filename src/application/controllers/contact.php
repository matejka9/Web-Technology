<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->library('Template');
        $this->load->helper('url');
    }

	public function index()
	{
		$this->data['title'] = 'Contact';
		$this->template->view('contact_view', $this->data);
	}
}
