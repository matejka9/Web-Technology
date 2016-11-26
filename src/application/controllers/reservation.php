<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reservation extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->library('Template');
        $this->load->helper('url');
        $this->load->model('reservation_model');
    }

	public function index()
	{
		$this->template->view('reservation_view');

	}
	public function objednaj(){

		if($this->reservation_model->objednaj()){
			echo json_encode(array("result" => 1));
		} else {
			$data["error"] = "4";
			echo json_encode(array("result" => 2));
		}
	}
}
