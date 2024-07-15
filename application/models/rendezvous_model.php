<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include("service_model.php");
include("temporairerv_model.php");
include("horaire_model.php");
class Rendezvous_model extends CI_Model {

    // Nom de la table
    private $table = 'rendezVous';

    // Constructeur
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    // Récupérer tous les services
    public function getAll() {
        $query = $this->db->get($this->table);
        return $query->result_array();
    }

    // Récupérer un service par ID
    public function getById($id) {
        $query = $this->db->get_where($this->table, array('id' => $id));
        return $query->row_array();
    }

    static function addTime ($timestamp, $heure_et_minute) {
        // Créer un objet DateTime à partir du timestamp fourni
        $date = new DateTime($timestamp);
    
        // Séparer les heures et les minutes à partir de la chaîne fournie
        list($heures_a_ajouter, $minutes_a_ajouter) = explode(':', $heure_et_minute);
    
        // Ajouter les heures et les minutes
        $interval = 'PT' . $heures_a_ajouter . 'H' . $minutes_a_ajouter . 'M';
        $date->add(new DateInterval($interval));
    
        // Retourner le nouveau timestamp au format yyyy-mm-dd hh:mm:ss
        return $date->format('Y-m-d H:i:s');
    }

    // Ajouter un service
    public function insert($data) {
        $this->db->insert($this->table, $data);
        $insertId = $this->db->insert_id();
        $tempData['idRV'] = $insertId;
        $chosenService = (new Service_model())->getById($data['idService']);
        $tempData['dateHeureFin'] = Rendezvous_model::addTime($data['dateHeureDebut'], $chosenService['duree']);
        (new Temporairerv_model())->insert($tempData);
        
        return $this->db->insert_id();
    }

    // Mettre à jour un service
    public function update($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update($this->table, $data);
    }

    // Supprimer un service
    public function delete($id) {
        $this->db->where('id', $id);
        return $this->db->delete($this->table);
    }
}
?>
