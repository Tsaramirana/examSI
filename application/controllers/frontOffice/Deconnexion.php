<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Deconnexion extends CI_Controller {

  public function __construct() {
    parent::__construct();
    
    $this->load->helper('url');
    $this->load->library('session');

    $user = $this->session->get('user');
    if ($user == null) {
      redirect('frontOffice/Login/to_login_page');
    }
  }

  public function index() {
    $this->session->unset("user");
    $this->session->destroy();

    redirect('frontOffice/Login/to_login_page');
  }

}