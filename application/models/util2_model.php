<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Util2_model extends CI_Model {

    // Constructeur
    public function __construct() {
        parent::__construct();
        $this->load->database();
        // Charger le modèle Rendezvous_model
        $this->load->model('Rendezvous_model');
    }

    // Fonction pour convertir un fichier CSV en tableau associatif
    public function csvToArray($filename) {
        $array = array();
        if (($handle = fopen($filename, "r")) !== FALSE) {
            $header = fgetcsv($handle, 1000, ",");
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                $row = array(
                    'voiture' => $data[0],
                    'type_voiture' => $data[1],
                    'datetime_rdv' => $this->combineDateTime($data[2], $data[3]),
                    'type_service' => $data[4],
                    'montant' => $data[5],
                    'date_paiement' => isset($data[6]) ? $this->convertDate($data[6]) : null
                );
                $array[] = $row;
            }
            fclose($handle);
        }
        return $array;
    }

    // Fonction pour convertir la date du format JJ/MM/AAAA au format AAAA-MM-JJ
    private function convertDate($date) {
        if ($date != null) {
            $dateArray = explode('/', $date);
            return $dateArray[2] . '-' . $dateArray[1] . '-' . $dateArray[0];
        }else{
            return null;
        }
    }

    // Fonction pour combiner la date et l'heure en un datetime
    private function combineDateTime($date, $time) {
        return $this->convertDate($date) . ' ' . $time;
    }

    // Fonction pour insérer les données dans la table temporaireCSV
    public function insertIntoTemporaireCSV($data) {
        $this->db->trans_start(); // Démarrer une transaction

        foreach ($data as $row) {
            $this->db->insert('temporaireCSV', $row);
        }

        $this->db->trans_complete(); // Compléter la transaction

        return $this->db->trans_status(); // Retourne true si la transaction a réussi, false sinon
    }

    public function insertDistinctTypesAndVoitures() {
        // Désactiver l'auto-commit
        $this->db->trans_begin();
        
        // Première requête : insérer des types distincts
        $sql1 = "INSERT INTO type (nom)
                 SELECT DISTINCT type_voiture 
                 FROM temporaireCSV
                 WHERE type_voiture NOT IN (SELECT nom FROM type)";
    
        // Exécuter la première requête
        $this->db->query($sql1);
    
        // Deuxième requête : insérer des voitures avec idType correspondant
        $sql2 = "INSERT INTO voiture (numero, idType)
                 SELECT DISTINCT t.voiture numero, 
                     (SELECT id FROM type WHERE type.nom = t.type_voiture LIMIT 1) AS idType
                 FROM temporaireCSV as t where t.voiture not in  (select numero from voiture)";
    
        // Exécuter la deuxième requête
        $this->db->query($sql2);
    
        // Vérifier si la transaction a réussi
        if ($this->db->trans_status() === FALSE) {
            // Si une erreur s'est produite, annuler la transaction
            $this->db->trans_rollback();
            return false;
        } else {
            try {
                echo "0";
                echo "1";
                // Récupérer tous les éléments de rendez-vous depuis temporaireCSV
                $query = $this->db->get('temporaireCSV');
                $rendezVous = $query->result_array();
                echo "2";
    
                // Boucler sur chaque rendez-vous et les insérer
                foreach ($rendezVous as $row) {
                    $data = array(
                        'dateHeureDebut' => $row['datetime_rdv'],
                        'idService' => $this->getServiceId($row['type_service']),
                        'idVoiture' => $this->getVoitureId($row['voiture']),
                        'prix' => $row['montant']
                    );
                    $this->Rendezvous_model->insert($data);
                }
            } catch (Exception $e) {
                $this->db->trans_rollback();
                return false;
            }
    
            // Valider la transaction
            $this->db->trans_commit();
            return true;
        }
    }
    
    // Fonction pour obtenir l'ID du service
    private function getServiceId($serviceNom) {
        $query = $this->db->get_where('service', array('nom' => $serviceNom));
        $service = $query->row();
        if ($service) {
            return $service->id;
        } else {
            // Insérer le nouveau service et retourner son ID
            $this->db->insert('service', array('nom' => $serviceNom, 'duree' => '01:00:00', 'prix' => 0)); // Valeurs par défaut pour durée et prix
            return $this->db->insert_id();
        }
    }
    
    // Fonction pour obtenir l'ID de la voiture
    private function getVoitureId($voitureNumero) {
        $query = $this->db->get_where('voiture', array('numero' => $voitureNumero));
        $voiture = $query->row();
        if ($voiture) {
            return $voiture->id;
        } else {
            // Insérer la nouvelle voiture et retourner son ID
            $typeId = $this->getTypeIdFromTemporaireCSV($voitureNumero); // Fonction pour obtenir le type de voiture depuis temporaireCSV
            $this->db->insert('voiture', array('numero' => $voitureNumero, 'idType' => $typeId));
            return $this->db->insert_id();
        }
    }
    
    // Fonction pour obtenir le type de voiture depuis temporaireCSV
    private function getTypeIdFromTemporaireCSV($voitureNumero) {
        $query = $this->db->get_where('temporaireCSV', array('voiture' => $voitureNumero));
        $tempVoiture = $query->row();
        if ($tempVoiture) {
            $query = $this->db->get_where('type', array('nom' => $tempVoiture->type_voiture));
            $type = $query->row();
            if ($type) {
                return $type->id;
            }
        }
        return null;
    }

    // Fonction de synthèse pour importer le CSV dans la table temporaireCSV
    public function importCsvToDatabase($filename) {
        $this->clearTable();
        // Convertir le CSV en tableau
        $data = $this->csvToArray($filename);

        // Insérer les données dans la table temporaireCSV
        $success = $this->insertIntoTemporaireCSV($data);

        if ($success) {
            return true;
        } else {
            return false;
        }
    }

    public function processImport ($filename){
        if ($this->importCsvToDatabase($filename)) {
            if ($this->insertDistinctTypesAndVoitures()) {
                
            }else{
                throw new Exception("Impossible d'importer les donnees de votre fichier.");
            }
        }else{
            throw new Exception("Impossible d'importer les donnees de votre fichier.");
        }
    }

    // Fonction pour effacer toutes les données de la table temporaireCSV
    public function clearTable() {
        $this->db->empty_table('temporaireCSV');
    }
}
?>
