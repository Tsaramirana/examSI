<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Devis extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Devis_detail');
        $this->load->library('Session');
        $this->load->helper('url');

        if ($this->session->get("admin") == null) {
            redirect('backOffice/Login/to_login_page');
        }
    }

    // Afficher tous les devis avec les détails des rendez-vous
    public function index() {
        $data['devis_details'] = $this->Devis_detail->getAllDetails();
        $this->load->view('backOffice/devis_list', $data);
    }

    // Mettre à jour la date de payement d'un devis
    public function update() {
        $devis_id = $this->input->post('devis_id');
        $datePayement = $this->input->post('datePayement');

        $this->Devis_detail->updateDatePayement($devis_id, $datePayement);

        // Rediriger vers la liste des devis après la mise à jour
        $data['devis_details'] = $this->Devis_detail->getAllDetails();
        $this->load->view('backOffice/devis_list', $data);
    }
}
?>
