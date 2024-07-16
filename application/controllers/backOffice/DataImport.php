<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DataImport extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('util_model'); // Charger le modèle util_model
        $this->load->model('util2_model'); // Charger le modèle util2_model
        // $this->load->model('Service_model'); // Charger le modèle Service_model
    }

    public function index() {
      $this->load->view('backOffice/import');
    }

    public function service() {
        // Vérifier si le formulaire a été soumis et le fichier téléchargé
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['service'])) {
            $service_file = $_FILES['service'];

            // Vérifier s'il n'y a pas d'erreur lors du téléchargement
            if ($service_file['error'] === UPLOAD_ERR_OK) {
                // Définir le dossier de destination pour le fichier de service
                $upload_path = './uploads/services/';
                $service_file_name = $service_file['name'];
                $service_file_path = $upload_path . $service_file_name;

                // Déplacer le fichier téléchargé vers le dossier de destination
                if (move_uploaded_file($service_file['tmp_name'], $service_file_path)) {
                    // Appeler votre fonction pour importer le fichier CSV dans la base de données
                    $this->util_model->importCsvToDatabase($service_file_path);

                    // Charger les données pour l'affichage
                    $data['services'] = $this->Service_model->getAll();
                    $this->load->view('backOffice/service_view', $data);
                } else {
                    echo "Erreur lors de l'enregistrement du fichier de service.";
                }
            } else {
                echo "Erreur lors du téléchargement du fichier de service.";
            }
        } else {
            echo "Le formulaire de service n'a pas été soumis correctement.";
        }
    }

    public function travaux() {
        // Vérifier si le formulaire a été soumis et le fichier téléchargé
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['travaux'])) {
            $travaux_file = $_FILES['travaux'];

            // Vérifier s'il n'y a pas d'erreur lors du téléchargement
            if ($travaux_file['error'] === UPLOAD_ERR_OK) {
                // Définir le dossier de destination pour le fichier de travaux
                $upload_path = './uploads/travaux/';
                $travaux_file_name = $travaux_file['name'];
                $travaux_file_path = $upload_path . $travaux_file_name;

                // Déplacer le fichier téléchargé vers le dossier de destination
                if (move_uploaded_file($travaux_file['tmp_name'], $travaux_file_path)) {
                    // Appeler votre fonction pour traiter l'import des travaux (util2_model)
                    $this->util2_model->processImport($travaux_file_path);

                    // Charger les données pour l'affichage
                    $data['services'] = $this->Service_model->getAll();
                    $this->load->view('backOffice/service_view', $data);
                } else {
                    echo "Erreur lors de l'enregistrement du fichier de travaux.";
                }
            } else {
                echo "Erreur lors du téléchargement du fichier de travaux.";
            }
        } else {
            echo "Le formulaire de travaux n'a pas été soumis correctement.";
        }
    }

}



