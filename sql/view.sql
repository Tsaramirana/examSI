create or replace view detailrdv as 
    select 
    rendezvous.*, date(dateHeureDebut) as dateDebut, temporairerv.dateHeureFin 
    from rendezvous 
    join temporairerv 
    on rendezvous.id = temporairerv.idRv;

-- create or replace view v_devis AS
--     select detailrdv.* , service.nom as nomService 
--     from detailrdv 
--     join service 
--     on detailrdv.idService = service.id;

  create or replace view chiffre_affaire as
  select 
    rendezvous.*,
    devis.datePayement,
    service.nom as nomService,
    service.prix as prixService,
    voiture.numero as numero,
    type.id as type_id,
    type.nom as type
  from rendezvous 
  left join devis on rendezvous.id = devis.idRV
  join service on rendezvous.idService = service.id
  join voiture on rendezvous.idVoiture = voiture.id
  join type on voiture.idtype = type.id;


-- create or replace view chiffre_affaire as
-- select 
--   rendezvous.*,
--   devis.datePayement,
--   service.nom as nomService,
--   service.prix as prixService,
--   voiture.numero as numero,
--   type.nom as type
-- from rendezvous 
-- left join devis on rendezvous.id = devis.idRV
-- join service on rendezvous.idService = service.id
-- join voiture on rendezvous.idVoiture = voiture.id
-- join type on voiture.idtype = type.id;

-- select
--   sum(prixService) as total, 
--   count(id) as number
-- from chiffre_Affaire
-- where 
--   datePayement is not null
--   and datePayement = (select dateReference from horaire); 



-- SELECT
--     type_id,
--     type,
--     SUM(IF(datePayement = (SELECT dateReference FROM horaire), prixService, 0)) AS total,
--     COUNT(IF(datePayement = (SELECT dateReference FROM horaire), 1, NULL)) AS number
-- FROM
--     chiffre_Affaire
-- GROUP BY
--     type_id
-- UNION 
-- SELECT
--     type_id,
--     type,
--     0 AS total,
--     0 AS number
-- FROM
--     chiffre_Affaire
-- WHERE
--     datePayement != (SELECT dateReference FROM horaire)
-- GROUP BY
--     type_id;

-- select 
--   * 
-- from chiffre_affaire
-- where 
--   type_id = 1
--   and datePayement=(SELECT dateReference FROM horaire)