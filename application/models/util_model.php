<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Util_model extends CI_Model {
    public function resetTables() {
        $this->db->trans_start();
    
        // Supprimer toutes les données des tables
        $this->db->truncate('voiture');
        $this->db->truncate('service');
        $this->db->truncate('rendezVous');
        $this->db->truncate('temporairerv');
        $this->db->truncate('devis');
    
        $this->db->trans_complete();
    
        if ($this->db->trans_status() === FALSE) {
            // Il y a eu une erreur lors de la transaction, effectuer un rollback
            throw new Exception("Erreur lors de la réinitialisation des tables.");
        } else {
            // Transaction réussie
            return true;
        }
    }
    // Constructeur
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    // Fonction pour convertir un fichier CSV en tableau associatif
    public function csvToArray($filename) {
        $array = array();
        if (($handle = fopen($filename, "r")) !== FALSE) {
            $header = fgetcsv($handle, 1000, ",");
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                // Nom et durée sont obligatoires, prix est optionnel
                $row = array(
                    'nom' => $data[0],
                    'duree' => (isset($data[1]) ? $data[1] : '00:00') . (strstr($data[1], ':') ? '' : ':00'),
                    'prix' => isset($data[2]) ? $data[2] : 0
                );
                $array[] = $row;
            }
            fclose($handle);
        }
        return $array;
    }

    // Fonction pour créer une table temporaire
    public function createTempTable() {
        $this->db->query("CREATE TEMPORARY TABLE temp_service (
            id INT PRIMARY KEY AUTO_INCREMENT,
            nom VARCHAR(50) NOT NULL,
            duree TIME NOT NULL,
            prix DOUBLE NOT NULL DEFAULT 0
        )");
    }

    // Fonction pour insérer des données dans la table temporaire
    public function insertIntoTempTable($data) {
        foreach ($data as $row) {
            $this->db->insert('temp_service', $row);
        }
    }

    // Fonction pour comparer le nombre de lignes entre le tableau associatif et la table temporaire
    public function compareRowCount($data) {
        $query = $this->db->query("SELECT COUNT(*) as count FROM temp_service");
        $row = $query->row_array();
        return count($data) == $row['count'];
    }

    // Fonction pour réinitialiser la table réelle
    public function resetRealTable() {
        $this->db->truncate('service');
    }

    // Fonction pour insérer des données dans la table réelle
    public function insertIntoRealTable() {
        $this->db->query("INSERT INTO service (nom, duree, prix)
            SELECT nom, duree, prix FROM temp_service");
    }

    // Fonction de synthèse pour importer le CSV dans la base de données
    public function importCsvToDatabase($filename) {
        // Convertir le CSV en tableau
        $data = $this->csvToArray($filename);

        // Créer une table temporaire et insérer les données
        $this->createTempTable();
        $this->insertIntoTempTable($data);

        // Comparer le nombre de lignes
        if ($this->compareRowCount($data)) {
            // Si valide, réinitialiser la table réelle et insérer les données de la table temporaire
            $this->resetRealTable();
            $this->insertIntoRealTable();
            return true;
        } else {
            // Si invalide, retourner false
            return false;
        }
    }

}
?>
