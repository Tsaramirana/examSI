<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MesRendezVous extends CI_Controller {

  public function __construct() {
    parent::__construct();

    $this->load->model('Rendezvous_model');
    $this->load->library('session');
    $user = $this->session->get('user');
    if ($user == null) {
      $this->load->helper('url');
      redirect('frontOffice/Login/to_login_page');
    }
  }

  public function index() {
    $voiture = $this->session->get('user');
    $data['rendezVous'] = $this->Rendezvous_model->getByVoitureId($voiture['id']);
    // Charger la vue et passer les données
    $this->load->view('frontOffice/rendezvous', $data);
  }

}