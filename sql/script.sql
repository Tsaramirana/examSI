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

insert into type (nom) values ('legere');  
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

create table rendezVous (
    id int primary key auto_increment,
    dateHeureDebut TIMESTAMP not null default now(),
    idService int REFERENCES service(id),
    idVoiture int references voiture (id),
    idSlot int references Slot(id)
);

create table temporaireRv (
    id int primary key auto_increment,
    idRV int REFERENCES rendezVous(id),
    dateHeureFin TIMESTAMP not null
);

create table horaire (
    debut time  not null ,
    fin time not null,
    dateReference date
);

create table devis (
    id int primary key auto_increment,
    idRV int REFERENCES rendezVous(id),
    datePayement TIMESTAMP
);