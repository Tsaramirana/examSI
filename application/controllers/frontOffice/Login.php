<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

  public function __construct() {
    parent::__construct();

    $this->load->model('type_model');
    $this->load->model('voiture_model');
    $this->load->library('session');
    $this->load->helper('url');
  }

	public function to_login_page() {
    $types = $this->type_model->getAll();
    $data['types'] = $types;
		$this->load->view('frontOffice/login.php', $data);
	}	

  public function login() {
    $numero_voiture = $this->input->get('numero');
    $type_voiture = $this->input->get('type');

		$voiture = $this->voiture_model->informationValide($numero_voiture,$type_voiture);
    
    if ($voiture == null) {
      $data['error'] = "Erreur lors de la connection veuillez reessayer!";
      
      $types = $this->type_model->getAll();
      $data['types'] = $types;
      
      $this->load->view('frontOffice/login.php', $data);
    }
    else {
      $this->session->set('user', $voiture);
      $this->load->view('frontOffice/acceuil.php');

      // redirect('frontOffice/Acceuil/to_acceuil_page');
    }
  }

}