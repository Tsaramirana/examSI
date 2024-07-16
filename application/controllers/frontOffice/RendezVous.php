<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RendezVous extends CI_Controller {
    public function __construct() {
        parent::__construct();

        $this->load->library('session');
        $user = $this->session->get('user');
        if ($user == null) {
            $this->load->helper('url');
            redirect('frontOffice/Login/to_login_page');
        }
    }

    public function index() {
        $this->load->view('frontOffice/rendezvous');
    }
   
}
