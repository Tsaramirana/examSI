<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

  public function __construct() {
    parent::__construct();
  }

  public function to_login_page() {
		$this->load->view('backOffice/login');
  }

  public function login() {
    $nom = $this->input->get('nom');
    $mot_de_passe = $this->input->get('mot_de_passe');

    if ($this->admin_model->isAdmin($nom, $mot_de_passe)) {
      $this->session->set("admin", "admin");
      redirect('backOffice/ServiceController');
    }
    else {
      $data['error'] = 'Informations incorrects, veuiller reessayer!';
      $this->load->view('backOffice/login');
    }
  }

}