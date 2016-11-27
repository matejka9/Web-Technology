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
		$this->data['title'] = 'Reservation';
		$this->template->view('reservation_view', $this->data);

	}
	public function rezervuj(){
		log_message('error', 'SOM NA ZACIATKU');
		$numberOfPersons = $this->input->post('numberOfPersons');
		$datum = $this->input->post('datum');
		$cas = $this->input->post('cas');
		$nearWindow = $this->input->post('nearWindow');
		$isSmoking = $this->input->post('isSmoking');
		$sitAlone = $this->input->post('sitAlone');
		$name = $this->input->post('name');

		log_message('error', 'VYBRAL SOM POST');

		$goodTables = array();

		$stolyDobre = $this->reservation_model->vyberVhodneStoly($numberOfPersons, $isSmoking, $nearWindow);

		foreach ($stolyDobre as $row)
		{
			log_message('error', '' . $row->id);
			$goodTables[$row->id]  = $row ;
		}

		$stolyIds = array_keys($goodTables);



		log_message('error', $datum);
		$od = $datum + $cas;
		$do = ($datum + $cas) + 30*60*1000;

		$stolyZle = $this->reservation_model->vyberObsadeneStoly($stolyIds, $od, $do);

		log_message('error', count($stolyZle));

		foreach ($stolyZle as $row)
		{
			if (isset($goodTables[$row->id_stol])){
				if ($row->sitalone == 1 || $sitAlone === 'true'){
					unset($goodTables[$row->id_stol]);
				} else {
					$table = $goodTables[$row->id_stol];
					$table->pocet = $table->pocet - $row->pocet;
					log_message('error', 'Pocet volnych miest' . $table->pocet);

					if ($table->pocet < 0){
						log_message('error', 'Snazim sa removovat');
						unset($goodTables[$row->id_stol]);
					}
				}
			}
		}

		if(count($goodTables) > 0 ){
			$goodTableId = array_keys($goodTables)[0];
			$idReservation = $this->reservation_model->rezervujStol($goodTableId, $numberOfPersons, $od, $sitAlone, $name);

			echo json_encode(array("result" => $idReservation));
		} else {
			echo json_encode(array("result" => -1));
		}
		

	}

	public function zrusRezervaciu(){
		$reservationTableId = $this->input->post('reservationTableId');
		$this->reservation_model->zrusRezervaciu($reservationTableId);
		echo json_encode(array("result" => 1));
	}

}
