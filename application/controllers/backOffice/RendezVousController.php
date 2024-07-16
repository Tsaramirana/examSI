<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RendezvousController extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->load->view('backOffice/calendar_view');
    }

    public function getEvents() {
        $events = $this->Rendezvous_model->getAll();
        $data = array();

        foreach ($events as $event) {
            $data[] = array(
                'id' => $event['id'],
                'title' => 'Rendez-vous',
                'start' => $event['dateHeureDebut']
            );
        }

        echo json_encode($data);
    }
}

?>
