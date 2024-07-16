INSERT INTO voiture (numero, idType) VALUES
('ABC123', 1),
('DEF456', 2),
('GHI789', 3),
('JKL012', 1),
('MNO345', 2); 

INSERT INTO rendezVous (dateHeureDebut, idService, idVoiture, idSlot) VALUES
('2024-07-10 10:00:00', 1, 1, 1),
('2024-07-11 11:00:00', 2, 2, 2),
('2024-07-12 12:00:00', 3, 3, 3),
('2024-07-13 13:00:00', 1, 4, 1),
('2024-07-14 14:00:00', 2, 5, 2);

INSERT INTO devis (idRV, datePayement) VALUES
(1, null),
(2, '2024-07-11 16:00:00'),
(3, null),
(4, '2024-07-13 18:00:00'),
(5, '2024-07-14 19:00:00');