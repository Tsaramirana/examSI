<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Service extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Charger le modèle Service_model
        $this->load->model('Service_model');
    }

    // Fonction pour afficher tous les services
    public function index() {
        // Récupérer tous les services
        $data['services'] = $this->Service_model->getAll();

        // Charger la vue et passer les données
        $this->load->view('frontOffice/service', $data);
    }
}
?>
