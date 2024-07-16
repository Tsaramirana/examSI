<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include("service_model.php");
include("temporairerv_model.php");
include("horaire_model.php");
include("slot_model.php");

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

    // Ajouter un service
    public function insert($data) {
        $data['idSlot'] = $this->getFreeSlotId($data);

        if ($this->checkCreneau($data) && $this->checkHoraire($data) && $data['idSlot'] != 0) {
            $this->db->insert($this->table, $data);
            $insertId = $this->db->insert_id();
            $tempData['idRV'] = $insertId;
            $chosenService = (new Service_model())->getById($data['idService']);
            $tempData['dateHeureFin'] = Rendezvous_model::addTime($data['dateHeureDebut'], $chosenService['duree']);
            (new Temporairerv_model())->insert($tempData);
            
            return $this->db->insert_id();
        } else {
            if (!$this->checkCreneau($data)) {
                throw new Exception("Créneau indisponible!");
            } 
            if (!$this->checkHoraire($data)) {
                throw new Exception("L'horaire choisi ne correspond pas à nos horaires!");
            }
            if ($data['idSlot'] == 0) {
                throw new Exception("Plus aucun slot de libre pour cette tranche horaire!");
            }
        } 

        return 0;
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

    static function extractDate ($timestamp) {
        $date  = date('Y-m-d', strtotime($timestamp));

        return $date;
    }

    static function extractHour ($timestamp) {
        $dateTime  = new DateTime($timestamp);

        $time = $dateTime->format('H:i:s');

        return $time;
    }

    // vérifie s'il y a un créneau, true s'il y a  un créneau, false sinon
    public function checkCreneau ($data) {
        $query = $this->db->get_where('detailrdv', array('dateDebut' => Rendezvous_model::extractDate($data['dateHeureDebut']), 'idSlot' => $data['idSlot']));
        $rdvList = $query->result_array();
        $chosenService = (new Service_model())->getById($data['idService']);
        $dateTimeFin = Rendezvous_model::addTime($data['dateHeureDebut'], $chosenService['duree']);

        for ($i=0; $i < count($rdvList); $i++)
        {
            if (($data["dateHeureDebut"]>=$rdvList[$i]["dateHeureDebut"]&&$data["dateHeureDebut"]<=$rdvList[$i]["dateHeureFin"])
            ||($dateTimeFin>=$rdvList[$i]["dateHeureDebut"]&&$dateTimeFin<=$rdvList[$i]["dateHeureFin"]))
            {
                return false;
            }
            else if (($rdvList[$i]["dateHeureDebut"]>=$data["dateHeureDebut"]&&$rdvList[$i]["dateHeureDebut"]<=$dateTimeFin)
            ||($rdvList[$i]["dateHeureFin"]>=$data["dateHeureDebut"]&&$rdvList[$i]["dateHeureFin"]<=$dateTimeFin))
            {
                return false;
            }
        }

        return true;
    }

    public function isSlotFree ($idSlot, $data) {
        $query = $this->db->get_where('detailrdv', array('dateDebut' => Rendezvous_model::extractDate($data['dateHeureDebut']), 'idSlot' => $idSlot));
        $rdvList = $query->result_array();
        $chosenService = (new Service_model())->getById($data['idService']);
        $dateTimeFin = Rendezvous_model::addTime($data['dateHeureDebut'], $chosenService['duree']);

        for ($i=0; $i < count($rdvList); $i++)
        {
            if (($data["dateHeureDebut"]>=$rdvList[$i]["dateHeureDebut"]&&$data["dateHeureDebut"]<=$rdvList[$i]["dateHeureFin"])
            ||($dateTimeFin>=$rdvList[$i]["dateHeureDebut"]&&$dateTimeFin<=$rdvList[$i]["dateHeureFin"]))
            {
                return false;
            }
            else if (($rdvList[$i]["dateHeureDebut"]>=$data["dateHeureDebut"]&&$rdvList[$i]["dateHeureDebut"]<=$dateTimeFin)
            ||($rdvList[$i]["dateHeureFin"]>=$data["dateHeureDebut"]&&$rdvList[$i]["dateHeureFin"]<=$dateTimeFin))
            {
                return false;
            }
        }

        return true;
    } 

    public function getFreeSlotId ($data) {
        $slotList = (new Slot_model())->getAll();

        $freeSlotId = 0;
        for ($i = 0; $i < count($slotList); $i++) {
            if ($this->isSlotFree($slotList[$i]['id'], $data)) {
                $freeSlotId = $slotList[$i]['id'];
                return $freeSlotId;
            }
        }

        return $freeSlotId;
    }

    // vérifie l'horaire
    public function checkHoraire ($data) {
        $chosenService = (new Service_model())->getById($data['idService']);
        $dateTimeFin = Rendezvous_model::addTime($data['dateHeureDebut'], $chosenService['duree']);

        $startHour = Rendezvous_model::extractHour($data['dateHeureDebut']);
        $finishHour = Rendezvous_model::extractHour($dateTimeFin);

        $horaire = (new Horaire_model())->getAll()[0];
        $begin = $horaire['debut'];
        $end = $horaire['fin'];

        return (($startHour >= $begin && $startHour <= $end) && ($finishHour >= $begin && $finishHour <= $end));
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

    public function getAllEvents() {
        $this->db->select('id, dateHeureDebut as start, dateHeureDebut as end, idService');
        $query = $this->db->get($this->table);
        $result = $query->result_array();
    
        $events = array();
        foreach ($result as $row) {
            $service = $this->Service_model->getById($row['idService']);
            $events[] = array(
                'id' => $row['id'],
                'start' => $row['start'],
                'end' => $this->addTime($row['start'], $service['duree']),
                'title' => $service['nom']
            );
        }
    
        return $events;
    }
    
}
?>
