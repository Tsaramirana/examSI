<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
<<<<<<< Updated upstream
	public function index()
	{
		$this->load->view('test.php');
	}	
=======
    public function index($section = 'index', $data=array()) {
        $data['contents'] = $section;
        $data['css'] = array('bootstrap.css', 'index.css', 'login.css', 'accueil.css', 'rdv.css', 'sidebar.css', 'crud.css', 'adminLogin.css','heure.css','devis.css');
        $data['js'] = array('jquery.min.js','bootstrap.js', 'sidebar.js','npm.js', 'pagination.js', 'devis.js');
        $this->load->view('templates/template', $data);
    }  
>>>>>>> Stashed changes

	public function test () 
	{	
		// $this->load->model('voiture_model');
		// echo var_dump($this->voiture_model->informationValide('num2',-1));

		// $this->load->library('pdf');
        // $this->pdf->GeneratePDFForVoiture('100');

		echo sha1('admin');
	}
}
