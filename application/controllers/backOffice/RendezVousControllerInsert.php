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
    }

    public function index() {
        $data['services'] = $this->Service_model->getAll();
        $this->load->view('backOffice/insert_rendezvous', $data);
    }

    public function insert() {
        $idVoiture = $this->session->get('user')['id']; // Récupère l'ID de la voiture depuis la session
        $data = array(
            'dateHeureDebut' => $this->input->post('dateHeureDebut'),
            'idService' => $this->input->post('idService'),
            'idVoiture' => $idVoiture
        );

        try {
            $insertId = $this->Rendezvous_model->insert($data);
            if ($insertId) {
                redirect('backOffice/RendezvousControllerInsert/index');
            }
        } catch (Exception $e) {
            $data['services'] = $this->Service_model->getAll();
            $data['error'] = $e->getMessage();
            $this->load->view('backOffice/insert_rendezvous', $data);
        }
    }
}
?>
