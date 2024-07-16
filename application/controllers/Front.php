<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Front extends CI_Controller {
  public function __construct() {
    parent::__construct();
  }
  /*********************ACCUEIL******************/
  public function reserve() {
    try {
        $user = $this->session->get('user');
        if ($user == null) {
            redirect('welcome/index');
        } else {
            $date = $this->input->post('date');
            $time = $this->input->post('heure');
            $toAdd['idService'] = $this->input->post('service');
            $toAdd['dateHeureDebut'] = $this->rendezvous_model->combineDateTime($date, $time);
            $this->rendezvous_model->insert($toAdd);
            $this->load_resources('frontOffice/accueil');
        }
    } catch (Exception $e) {
      $data['error'] = $e->getMessage();
      $this->load_resources('frontOffice/accueil', $data);
    }
  }
  public function to_list_rdv() {
    $user = $this->session->get('user');
    if ($user == null) {
      redirect('welcome/index');
    } else {
      $data['list'] = $this->rendezvous_model->getAllForUser($user['id']);
      
      foreach ($data['list'] as $key => $rdv) {
          $service = $this->service_model->getById($rdv['idService']);
          $data['list'][$key]['service'] = $service['nom'];
          $data['list'][$key]['prix'] = $service['prix'];
      }
      
      $this->load_resources('frontOffice/rdv', $data);
  }
  }
  public function to_accueil_page() {
    $user = $this->session->get('user');
    if ($user == null) {
      redirect('welcome/index');
    } else {
      $data['service'] = $this->service_model->getAll();
      $this->load_resources('frontOffice/accueil', $data);
    }
  }

  /***************LOGIN***********************/
	public function to_login_page() {
    $types = $this->type_model->getAll();
    $data['types'] = $types;
    $this->load_resources('frontOffice/login', $data);
  }	

  public function login() {
    $numero_voiture = $this->input->post('numero');
    $type_voiture = $this->input->post('type');

		$voiture = $this->voiture_model->informationValide($numero_voiture,$type_voiture);
    
    if ($voiture == null) {
      $data['error'] = "Erreur lors de la connection veuillez reessayer!";
      $this->to_login_page();
    }
    else {
      $this->session->set('user', $voiture);
      $this->to_accueil_page();
    }
  }

  /********************UTILITAIRES****************/
  public function load_resources($section, $data=array()) {
    $data['contents'] = $section;
    $data['css'] = array('bootstrap.css', 'index.css', 'login.css', 'accueil.css', 'rdv.css', 'sidebar.css', 'crud.css', 'adminLogin.css','heure.css','devis.css');
    $data['js'] = array('jquery.min.js','bootstrap.js', 'sidebar.js','npm.js', 'pagination.js', 'devis.js');
    $this->load->view('templates/template', $data);	
  }
}