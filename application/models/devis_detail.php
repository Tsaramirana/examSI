<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Devis_detail extends CI_Model {

    // Constructeur
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    // Récupérer tous les devis avec les détails des rendez-vous
    public function getAllDetails() {
        $this->db->select('devis.id as devis_id, devis.datePayement, rendezVous.id as rendezvous_id, rendezVous.dateHeureDebut, rendezVous.idService, rendezVous.idVoiture, rendezVous.idSlot');
        $this->db->from('devis');
        $this->db->join('rendezVous', 'devis.idRV = rendezVous.id');
        $query = $this->db->get();
        return $query->result_array();
    }

    // Récupérer les détails d'un devis par son ID
    public function getDetailsById($id) {
        $this->db->select('devis.id as devis_id, devis.datePayement, rendezVous.id as rendezvous_id, rendezVous.dateHeureDebut, rendezVous.idService, rendezVous.idVoiture, rendezVous.idSlot');
        $this->db->from('devis');
        $this->db->join('rendezVous', 'devis.idRV = rendezVous.id');
        $this->db->where('devis.id', $id);
        $query = $this->db->get();
        return $query->row_array();
    }

       // Mettre à jour la date de payement d'un devis
    public function updateDatePayement($id, $datePayement) {
        $this->db->where('id', $id);
        $this->db->update('devis', array('datePayement' => $datePayement));
    }
}
?>
