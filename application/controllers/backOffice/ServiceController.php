<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ServiceController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Service_model');
    }

    public function index() {
        $data['services'] = $this->Service_model->getAll();
        $this->load->view('backOffice/service_view', $data);
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
            $this->Service_model->update($id, $data);
        } else {
            // Insert new service
            $this->Service_model->insert($data);
        }

        redirect('backOffice/ServiceController');
    }

    public function edit($id) {
        $data['service'] = $this->Service_model->getById($id);
        $data['services'] = $this->Service_model->getAll();
        $this->load->view('backOffice/service_view', $data);
    }

    public function delete($id) {
        $this->Service_model->delete($id);
        redirect('backOffice/ServiceController');
    }
}
?>
