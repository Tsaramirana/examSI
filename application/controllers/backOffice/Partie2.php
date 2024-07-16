<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Partie2 extends CI_Controller {

  public function __construct() {
    parent::__construct();

    $this->load->model('Dashboard');
    $this->load->model('Util_model');
    $this->load->model('Service_model');

    $this->load->library('Session');
    if ($this->session->get("admin") == null) {
        redirect('backOffice/Login/to_login_page');
    }
  }

  // ************** Suppression des donnees **************// 
  public function supprimer_donnees() {
    $this->Util_model->resetTables();

    $data['services'] = $this->Service_model->getAll();
    $this->load->view('backOffice/service_view', $data);
  }
  
  
  // ************** Envoi des imports **************// 
  public function load_resources($section, $data=array()) {
    $data['contents'] = $section;
    $data['css'] = array('bootstrap.css', 'index.css', 'login.css', 'accueil.css', 'rdv.css', 'sidebar.css', 'crud.css', 'adminLogin.css','heure.css','devis.css');
    $data['js'] = array('jquery.min.js','bootstrap.js', 'sidebar.js','npm.js', 'pagination.js', 'devis.js');
    $this->load->view('templates/template', $data);	
  }

  // ************** Avoir le chiffre d'affaire **************// 
  public function montant_payes() {
    $payes = $this->Dashboard->montant_payes();
    $non_payes = $this->Dashboard->montant_non_payes();
    $chiffre_affaire = $this->Dashboard->chiffre_affaire();
    $chiffre_Afffaire_type = $this->Dashboard->chiffre_affaire_par_type();
    $chiffre_affaire_pour_type = $this->Dashboard->chiffre_affaire_pour_type(1);
    $voiture_traite = $this->Dashboard->voiture_traite('2024-07-12', '2024-07-30');
  }

}
?>
