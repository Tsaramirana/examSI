<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Calendar extends CI_Controller {

    public function __construct() {

        parent::__construct();
        $this->load->model('Rendezvous_model');
        $this->load->model('Service_model');
        $this->load->model('Horaire_model');
    }

    public function index() {
        $data['events'] = $this->Rendezvous_model->getAllEvents();
        $data['date_ref'] = $this->Horaire_model->getHoraire()['dateReference'] ;
        $data['services'] = $this->Service_model->getAll();
        $this->load->view('backOffice/calendar_view', $data);
    }
}
?>