<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Voiture_model extends CI_Model {

    // Nom de la table
    private $table = 'voiture';

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

    // Récupérer un service par Numero
    public function getByNumero($numero) {
        $query = $this->db->get_where($this->table, array('numero' => $numero));
        return $query->row_array();
    }

    // Voir si les informations sont completes : si oui -> insertion (si besoin) retour true sinon false
    public function informationValide ($numero, $idType){ //retourne la voiture en base si les infos sont valides ; sinon null 
        if($numero!='' && $idType >=0){
            $data = $this->getByNumero($numero);
            if(count($data)){
                $data = [];
                $data['numero'] = $numero;
                $data['idType'] = $idType;
                $this->insert($data);
                $data = $this->getByNumero($numero);
            }
            return $data;
        }
        return null;
    }
}
?>
