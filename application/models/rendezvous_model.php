<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rendezvous_model extends CI_Model {

    // Nom de la table
    private $table = 'rendezVous';

    // Constructeur
    public function __construct() {
        parent::__construct();
        $this->load->database();

        $this->load->model('backoffice/service_model');
        $this->load->model('frontoffice/temporairerv_model');
        $this->load->model('backoffice/horaire_model');
        $this->load->model('backoffice/slot_model');
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
        foreach ($data as $key => $value) {
            if (empty($value) || $value == null) {
                throw new Exception("Veuillez remplir tous les champs !");
            }
        }
        if ($this->checkCreneau($data) && $this->checkHoraire($data) && $data['idSlot'] != 0) {
            $chosenService = $this->service_model->getById($data['idService']);

            if ($this->isFreeHourEnough($data)) {
                $this->db->insert($this->table, $data);
                $insertId = $this->db->insert_id();
                $tempData['idRV'] = $insertId;
                $tempData['dateHeureFin'] = Rendezvous_model::addTime($data['dateHeureDebut'], $chosenService['duree']);
                $this->temporairerv_model->insert($tempData);
                
                return $this->db->insert_id();
            } else {
                echo "Time is not enough";
                $currentDate = Rendezvous_model::extractDate($data['dateHeureDebut']);
                $horaire = $this->horaire_model->getAll()[0];

                // Insérer les données dans la table principale
                $this->db->insert($this->table, $data);
                $insertId = $this->db->insert_id();

                $endForCurrentDay = $currentDate . ' ' . $horaire['fin'];
                $tempDataForCurrentDay = array(
                    'idRV' => $insertId,
                    'dateHeureFin' => $endForCurrentDay
                );

                // Insérer les données dans la table temporairerv
                $this->temporairerv_model->insert($tempDataForCurrentDay);

                $nextDay = new DateTime(Rendezvous_model::extractDate($data['dateHeureDebut']));
                $nextDay->modify('+1 day');
                $dataForNextDay = array(
                    'dateHeureDebut' => $nextDay->format('Y-m-d') . ' ' . $horaire['debut'],
                    'idVoiture' => $data['idVoiture'],
                    'idService' => $data['idService']
                );

                $hourLeft = $this->getHourLeft($data);
                $hourLeftToStr = $hourLeft->h.':'.$hourLeft->i.':'.$hourLeft->s;

                $dataForNextDay['idSlot'] = $this->getFreeSlotId2($dataForNextDay, $hourLeftToStr);

                // Insérer les données pour le jour suivant dans la table principale
                $this->db->insert($this->table, $dataForNextDay); // Assurez-vous d'utiliser la table correcte ici
                $nextInsertId = $this->db->insert_id();

                $startForNextDay = $nextDay->format('Y-m-d') . ' ' . $horaire['debut'];
                $tempDataForNextDay = array(
                    'idRV' => $nextInsertId,
                    'dateHeureFin' => Rendezvous_model::addTime($startForNextDay, $hourLeftToStr)
                );

                // Insérer les données dans la table temporairerv
                $this->temporairerv_model->insert($tempDataForNextDay);
            }

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
        $chosenService = $this->service_model->getById($data['idService']);
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
        $chosenService = $this->service_model->getById($data['idService']);
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

    public function isSlotFree2 ($idSlot, $data, $duration) {
        $query = $this->db->get_where('detailrdv', array('dateDebut' => Rendezvous_model::extractDate($data['dateHeureDebut']), 'idSlot' => $idSlot));
        $rdvList = $query->result_array();
        $dateTimeFin = Rendezvous_model::addTime($data['dateHeureDebut'], $duration);

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
        $slotList = $this->slot_model->getAll();

        $freeSlotId = 0;
        for ($i = 0; $i < count($slotList); $i++) {
            if ($this->isSlotFree($slotList[$i]['id'], $data)) {
                $freeSlotId = $slotList[$i]['id'];
                return $freeSlotId;
            }
        }

        return $freeSlotId;
    }

    public function getFreeSlotId2 ($data, $duration) {
        $slotList = $this->slot_model->getAll();

        $freeSlotId = 0;
        for ($i = 0; $i < count($slotList); $i++) {
            if ($this->isSlotFree2($slotList[$i]['id'], $data, $duration)) {
                $freeSlotId = $slotList[$i]['id'];
                return $freeSlotId;
            }
        }

        return $freeSlotId;
    }

    // vérifie l'horaire
    public function checkHoraire ($data) {
        $chosenService = $this->service_model->getById($data['idService']);
        $dateTimeFin = Rendezvous_model::addTime($data['dateHeureDebut'], $chosenService['duree']);

        $startHour = Rendezvous_model::extractHour($data['dateHeureDebut']);
        $finishHour = Rendezvous_model::extractHour($dateTimeFin);

        $horaire = $this->horaire_model->getAll()[0];
        $begin = $horaire['debut'];
        $end = $horaire['fin'];

        return (($startHour >= $begin && $startHour <= $end) && ($finishHour >= $begin));
    }

    public function isFreeHourEnough ($data) {
        $chosenService = $this->service_model->getById($data['idService']);

        $startHour = new DateTime(Rendezvous_model::extractHour($data['dateHeureDebut']));

        $horaire = $this->horaire_model->getAll()[0];
        $end = new DateTime(Rendezvous_model::extractHour($horaire['fin']));

        $remaining = $end->diff($startHour)->h.':'.$end->diff($startHour)->i.':'.$end->diff($startHour)->s;
        $remainingTime = new DateTime($remaining);
        $durationTime = DateTime::createFromFormat('H:i:s', $chosenService['duree']);

        if ($durationTime > $remainingTime) {
            return false;
        } else {
            return true;
        }
    }

    public function getHourLeft ($data) {
        $chosenService = $this->service_model->getById($data['idService']);

        $startHour = new DateTime(Rendezvous_model::extractHour($data['dateHeureDebut']));

        $horaire = $this->horaire_model->getAll()[0];
        $end = new DateTime(Rendezvous_model::extractHour($horaire['fin']));

        $remaining = $end->diff($startHour)->h.':'.$end->diff($startHour)->i.':'.$end->diff($startHour)->s;
        $remainingTime = new DateTime($remaining);
        $durationTime = DateTime::createFromFormat('H:i:s', $chosenService['duree']);

        return $durationTime->diff($remainingTime);
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
        $this->load->model('backoffice/service_model');
        foreach ($result as $row) {
            $service = $this->service_model->getById($row['idService']);
            $events[] = array(
                'id' => $row['id'],
                'start' => $row['start'],
                'end' => $this->addTime($row['start'], $service['duree']),
                'title' => $service['nom']
            );
        }
        
    
        return $events;
    }

    public function get_rendezvous_by_voiture($idVoiture) {
        $this->db->from('v_detaildevis');
        $this->db->where('idVoiture', $idVoiture);
        $query = $this->db->get();
        return $query->result_array();
    }
    public function get_rendezvous_by_id_rendezvous($idRendezvous) {
        $this->db->from('v_detaildevis');
        $this->db->where('id', $idRendezvous);
        $query = $this->db->get();
        return $query->row_array()!=null ? $query->row_array() : array();
    }
}
?>
