<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model {

    // Nom de la table
    private $table = 'admin';

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
        // Vérifier si le mot de passe est présent dans les données
        if (isset($data['mdp'])) {
            // Hacher le mot de passe avec SHA-1
            $data['mdp'] = sha1($data['mdp']);
        }

        // Insérer les données dans la base de données
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    // Mettre à jour un service
    public function update($id, $data) {
        // Vérifier si le mot de passe est présent dans les données
        if (isset($data['mdp'])) {
            // Hacher le mot de passe avec SHA-1
            $data['mdp'] = sha1($data['mdp']);
        }

        // Mettre à jour les données dans la base de données
        $this->db->where('id', $id);
        return $this->db->update($this->table, $data);
    }

    // Supprimer un service
    public function delete($id) {
        $this->db->where('id', $id);
        return $this->db->delete($this->table);
    }

    // Vérifier si un login est un administrateur
    public function isAdmin($login, $password) {
        // Hacher le mot de passe avec SHA-1
        $hashed_password = sha1($password);

        // Rechercher l'utilisateur dans la base de données
        $this->db->where('nom', $login);
        $this->db->where('mdp', $hashed_password);
        $query = $this->db->get($this->table);

        // Vérifier si une correspondance a été trouvée
        if ($query->num_rows() == 1) {
            return true;
        } else {
            return false;
        }
    }
}
?>
