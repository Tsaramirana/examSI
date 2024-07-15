<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Horaire_model extends CI_Model {

    // Nom de la table
    private $table = 'horaire';

    // Constructeur
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    // Récupérer l'horaire
    public function getHoraire() {
        $query = $this->db->get($this->table);
        return $query->row_array();
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

    // Ajouter un service
    public function insert($data) {
        $this->db->insert($this->table, $data);
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

    // Mettre à jour le début
    public function updateDebut($debut) {
        $this->db->update($this->table, array('debut' => $debut));
        return $this->db->affected_rows();
    }

    // Mettre à jour la fin
    public function updateFin($fin) {
        $this->db->update($this->table, array('fin' => $fin));
        return $this->db->affected_rows();
    }

    // Mettre à jour la date de référence
    public function updateDateReference($dateReference) {
        $this->db->update($this->table, array('dateReference' => $dateReference));
        return $this->db->affected_rows();
    }

}
?>
