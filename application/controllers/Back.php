<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Back extends CI_Controller {
    public function __construct() {
        parent::__construct();
    }
    /***********DASHBOARD***************/
    public function to_dashboard(){
        $data = array();
        $this->load_resources('backOffice/accueil', $data);
    }
    /*********SERVICE*******************/
    public function crudService() {
        $data['services'] = $this->service_model->getAll();
        $this->load_resources('backOffice/crudService', $data);
    }

    public function save() {
        $id = $this->input->post('id');
        $data = array(
            'nom' => $this->input->post('nom'),
            'duree' => $this->input->post('duree'),
            'prix' => $this->input->post('prix')
        );

        if ($id) {
            // Update existing service
            $this->service_model->update($id, $data);
        } else {
            // Insert new service
            $this->service_model->insert($data);
        }
        $this->crudService();
    }

    public function edit($id) {
        $data['service'] = $this->service_model->getById($id);
        $data['services'] = $this->service_model->getAll();
        $this->crudService();
    }

    public function delete($id) {
        $this->service_model->delete($id);
        $this->crudService();
    }

    /**************LOGIN****************/
    public function to_login_page() {
		$this->load_resources('backOffice/adminLogin');
    }

    public function login() {
        $nom = $this->input->post('identifiant');
        $mot_de_passe = $this->input->post('password');

        if ($this->admin_model->isAdmin($nom, $mot_de_passe)) {
            $this->session->set("admin", "admin");
            $this->to_dashboard();
        }
        else {
        $data['error'] = 'Informations incorrects, veuiller reessayer!';
        $this->load_resources('backOffice/adminLogin', $data);
        }
    }

    /********************UTILITAIRES****************/
    public function load_resources($section, $data=array()) {
        $data['contents'] = $section;
        $data['css'] = array('bootstrap.css', 'index.css', 'login.css', 'accueil.css', 'rdv.css', 'sidebar.css', 'crud.css', 'adminLogin.css','heure.css','devis.css', 'import.css', 'main.min.css', 'dashboard.css');
        $data['js'] = array('jquery.min.js','bootstrap.js', 'sidebar.js','npm.js', 'pagination.js', 'devis.js','dashboard.js');
        $this->load->view('templates/template', $data);	
    }
}
?>