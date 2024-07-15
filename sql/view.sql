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