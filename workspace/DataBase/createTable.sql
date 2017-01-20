DROP TABLE administrateur;
DROP TABLE photo;
DROP TABLE evenement;
DROP TABLE periode;
DROP TABLE utilisateur;
DROP TABLE photoProfil;

CREATE TABLE utilisateur(
nom VARCHAR NOT NULL,
prenom VARCHAR NOT NULL,
id SERIAL UNIQUE,
photoProfil VARCHAR,
mdp VARCHAR NOT NULL,
pseudo VARCHAR,
administrateur BOOL);

CREATE TABLE administrateur(
id integer PRIMARY KEY REFERENCES utilisateur(id),
creationEvenement bool NOT NULL,
suppressionEvenement bool NOT NULL,
creationPeriode bool NOT NULL,
suppressionPeriode bool NOT NULL);

CREATE TABLE evenement(
date DATE NOT NULL,
nomEvenement VARCHAR NOT NULL,
id SERIAL UNIQUE);

CREATE TABLE periode(
nomPeriode VARCHAR NOT NULL,
id SERIAL UNIQUE,
heureDebut TIME NOT NULL,
heureFin TIME NOT NULL,
idEvenement integer REFERENCES evenement(id));

CREATE TABLE photo(
heurePhoto TIME,
id SERIAL UNIQUE,
description VARCHAR,
urlPhoto VARCHAR NOT NULL,
pseudoAuteur VARCHAR,
idPeriode integer REFERENCES periode(id),
valide BOOL
);

CREATE TABLE photoProfil(
idUtilisateur integer REFERENCES utilisateur(id),
urlPhoto VARCHAR NOT NULL
);