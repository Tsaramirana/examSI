create database garage;
use garage ;

create table admin (
    id int primary key auto_increment,
    nom VARCHAR(50) not null,
    mdp VARCHAR(256) not null
);
insert into admin (nom,mdp) values ('admin', sha1('admin'));

create table type (
    id int primary key auto_increment,
    nom VARCHAR(50) not null
);
  
insert into type (nom) values ('4x4');  
insert into type (nom) values ('utilitaire');  

create table voiture (
    id int primary key auto_increment,
    numero VARCHAR(10) not null,
    idType int REFERENCES type (id),
    unique(numero)
);

create table slot (
    id int primary key auto_increment,
    nom VARCHAR(50) not null
);

insert into slot (nom) values ('A');  
insert into slot (nom) values ('B');  
insert into slot (nom) values ('C');

create table service (
    id int primary key auto_increment,
    nom VARCHAR(50) not null,
    duree time not null,
    prix double ,
    CHECK (prix >= 0)
);

insert into service values (default, 'Réparation simple', '01:00:00', 150000);
insert into service values (default, 'Réparation standard', '02:00:00', 250000);
insert into service values (default, 'Réparation complexe', '08:00:00', 800000);
insert into service values (default, 'Entretien', '02:30:00', 800000);

create table rendezVous (
    id int primary key auto_increment,
    dateHeureDebut TIMESTAMP not null default now(),
    idService int REFERENCES service(id),
    idVoiture int references voiture (id),
    idSlot int references Slot(id),
    prix double ,
    check (prix>=0)
);

create table temporaireRv (
    id int primary key auto_increment,
    idRV int REFERENCES rendezVous(id),
    dateHeureFin TIMESTAMP not null
);


create table devis (
    id int primary key auto_increment,
    idRV int REFERENCES rendezVous(id),
    datePayement TIMESTAMP
);

create table horaire (
    debut time  not null ,
    fin time not null,
    dateReference date
);

CREATE TABLE temporaireCSV (
    voiture VARCHAR(10),
    type_voiture VARCHAR(50),
    datetime_rdv DATETIME,
    type_service VARCHAR(50),
    montant DECIMAL(10, 2),
    date_paiement DATE
);


insert into horaire values ('08:00:00', '18:00:00', now());


ALTER TABLE type CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci;
ALTER TABLE voiture CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci;
ALTER TABLE service CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci;
ALTER TABLE rendezVous CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci;
ALTER TABLE temporaireRv CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci;