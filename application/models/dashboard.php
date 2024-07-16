<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Model {

    // Constructeur
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function montant_payes() {
      $this->db->select('SUM(prixService) as total, COUNT(id) as number');
      $this->db->from('chiffre_Affaire');
      $this->db->where('datePayement IS NOT NULL');
      $this->db->where('datePayement = (SELECT dateReference FROM horaire)');
      $query = $this->db->get();
      $result = $query->result_array();
      if ($result[0]["total"] == null) 
        $result[0]["total"] = 0;
      return $result[0];
    }

    public function montant_non_payes() {
      $this->db->select('SUM(prixService) as total, COUNT(id) as number');
      $this->db->from('chiffre_Affaire');
      $this->db->where('datePayement IS NULL');
      $this->db->where('datePayement = (SELECT dateReference FROM horaire)');
      $query = $this->db->get();
      $result = $query->result_array();
      if ($result[0]["total"] == null) 
        $result[0]["total"] = 0;
      return $result[0];
    }

    public function chiffre_affaire() {
      $this->db->select('SUM(prixService) as total, COUNT(id) as number');
      $this->db->from('chiffre_Affaire');
      $this->db->where('datePayement IS NOT NULL');
      $this->db->where('datePayement = (SELECT dateReference FROM horaire)');
      $query = $this->db->get();
      $result = $query->result_array();
      if ($result[0]["total"] == null) 
        $result[0]["total"] = 0;
      return $result[0]["total"];
    }

    public function chiffre_affaire_par_type() {
        // Sous-requête pour datePayement égale à dateReference
        $subquery1 = $this->db->select('type_id, type, SUM(IF(datePayement = (SELECT dateReference FROM horaire), prixService, 0)) AS total, COUNT(IF(datePayement = (SELECT dateReference FROM horaire), 1, NULL)) AS number')
                              ->from('chiffre_Affaire')
                              ->group_by(['type_id', 'type'])
                              ->get_compiled_select();
        
        // Sous-requête pour datePayement différente de dateReference
        $subquery2 = $this->db->select('type_id, type, 0 AS total, 0 AS number')
                              ->from('chiffre_Affaire')
                              ->where('datePayement != (SELECT dateReference FROM horaire)')
                              ->group_by(['type_id', 'type'])
                              ->get_compiled_select();
        
        // Combiner les deux sous-requêtes
        $union_query = "($subquery1) UNION ALL ($subquery2)";
    
        // Requête finale pour agréger les résultats combinés
        $final_query = $this->db->select('type_id, type, SUM(total) AS total, SUM(number) AS number')
                                ->from("($union_query) AS combined_results", false)
                                ->group_by(['type_id', 'type'])
                                ->get();
    
        return $final_query->result_array();
    }

    public function chiffre_affaire_pour_type($type_id) {
        // Sélectionner toutes les colonnes
        $this->db->select('*');
        
        // Depuis la table chiffre_affaire
        $this->db->from('chiffre_affaire');
        
        // Condition where pour type_id
        $this->db->where('type_id', $type_id);
        
        // Condition where pour datePayement égale à dateReference de la table horaire
        $this->db->where('datePayement = (SELECT dateReference FROM horaire)', NULL, FALSE);
        
        // Exécuter la requête
        $query = $this->db->get();
        
        // Retourner les résultats sous forme de tableau
        return $query->result_array();
    }

  public function voiture_traite($min, $max) {
      // Sélectionner toutes les colonnes
      $this->db->select('*');
      
      // Depuis la table chiffre_affaire
      $this->db->from('chiffre_affaire');
      
      // Condition where pour dateHeureDebut >= min
      $this->db->where('dateHeureDebut >=', $min);
      
      // Condition where pour dateHeure <= max
      $this->db->where('dateHeureDebut <=', $max);
      
      // Exécuter la requête
      $query = $this->db->get();
      
      // Retourner les résultats sous forme de tableau
      return $query->result_array();
  }

  
  
  

  // create or replace view chiffre_affaire as
  // select 
  //   rendezvous.*,
  //   devis.datePayement,
  //   service.nom as nomService,
  //   service.prix as prixService,
  //   voiture.numero as numero,
  //   type.nom as type
  // from rendezvous 
  // left join devis on rendezvous.id = devis.idRV
  // join service on rendezvous.idService = service.id
  // join voiture on rendezvous.idVoiture = voiture.id
  // join type on voiture.idtype = type.id;

  // select
  //   sum(prixService) as total, 
  //   count(id) as number
  // from chiffre_Affaire
  // where 
  //   datePayement is not null
  //   and datePayement = (select dateReference from horaire); 



  // SELECT
  //     type_id,
  //     type,
      // SUM(IF(datePayement = (SELECT dateReference FROM horaire), prixService, 0)) AS total,
      // COUNT(IF(datePayement = (SELECT dateReference FROM horaire), 1, NULL)) AS number
  // FROM
  //     chiffre_Affaire
  // GROUP BY
  //     type_id
  // UNION 
  // SELECT
  //     type_id,
  //     type,
  //     0 AS total,
  //     0 AS number
  // FROM
  //     chiffre_Affaire
  // WHERE
  //     datePayement != (SELECT dateReference FROM horaire)
  // GROUP BY
  //     type_id;


  // select 
  //   * 
  // from chiffre_affaire
  // where 
  //   type_id = 1
  //   and datePayement=(SELECT dateReference FROM horaire)

  // select 
  // *
  // from chiffre_affaire
  // where 
  //   dateHeureDebut >= ''
  //   and dateHeure <= '';
}
?>
