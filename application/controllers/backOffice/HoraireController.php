<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class HoraireController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Horaire_model');
    }

    public function index() {
        $data['horaire'] = $this->Horaire_model->getHoraire();
        $this->load->view('backOffice/horaire_view', $data);
    }

    public function updateDebut() {
        $debut = $this->input->post('debut');
        $this->Horaire_model->updateDebut($debut);
        redirect('backOffice/HoraireController');
    }

    public function updateFin() {
        $fin = $this->input->post('fin');
        $this->Horaire_model->updateFin($fin);
        redirect('backOffice/HoraireController');
    }

    public function updateDateReference() {
        $dateReference = $this->input->post('dateReference');
        $this->Horaire_model->updateDateReference($dateReference);
        redirect('backOffice/HoraireController');
    }
}
?>
