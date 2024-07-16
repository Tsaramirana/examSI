<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RendezvousControllerInsert extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Rendezvous_model');
        $this->load->model('Service_model');
        $this->load->model('Slot_model');
        $this->load->model('admin_model');
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->library('pdf');

        $user = $this->session->get('user');
        
        if ($user == null) {
            $this->load->helper('url');
            redirect('frontOffice/Login/to_login_page');
        }
    }

    public function index() {
        $data['services'] = $this->Service_model->getAll();
        $this->load->view('backOffice/insert_rendezvous', $data);
    }

    public function insert() {
        if ($this->input->post('fromcalendar')=='ok') {
            $idVoiture = $this->input->post('idVoiture');
        }else{
            $idVoiture = $this->session->get('user')['id']; // Récupère l'ID de la voiture depuis la session
        }
        $data = array(
            'dateHeureDebut' => $this->input->post('dateHeureDebut'),
            'idService' => $this->input->post('idService'),
            'idVoiture' => $idVoiture
        );

        try {
            $insertId = $this->Rendezvous_model->insert($data);
            if ($insertId) {
                $chosenService = $this->Service_model->getById($data['idService']);
                $voiture = $this->session->get('user');
                $this->pdf->GeneratePDF($data['dateHeureDebut'], $voiture['numero'], $chosenService['nom'], $chosenService['prix']);
            }
        } catch (Exception $e) {
            $data['services'] = $this->Service_model->getAll();
            $data['error'] = $e->getMessage();
            $this->load->view('frontOffice/acceuil', $data);
        }
    }
}
?>
