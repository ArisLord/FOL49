DROP TABLE IF EXISTS CONTRAT 		CASCADE;
DROP TABLE IF EXISTS HORAIRE_HEBDO 	CASCADE;
DROP TABLE IF EXISTS ROLE 			CASCADE;
DROP TABLE IF EXISTS STRUCTURE 		CASCADE;

DROP TYPE IF EXISTS t_salarie 		CASCADE;
DROP TYPE IF EXISTS t_enfant 		CASCADE;
DROP TYPE IF EXISTS t_moment 		CASCADE;
DROP TYPE IF EXISTS t_mas 			CASCADE;
DROP TYPE IF EXISTS t_jour 			CASCADE;



CREATE TYPE t_jour AS ENUM ('lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi', 'dimanche');
CREATE TYPE t_mas AS ENUM ('matin', 'apres_midi', 'soir');

CREATE TYPE t_moment AS 
( 
	mas			t_mas,
	arrivé			time,
	depart			time
);

CREATE TYPE t_enfant AS 
(
	Nom 				varchar(30),
	Prenom				varchar(30),
	Date_de_naissance	date,
	Sexe				varchar(5)
);

CREATE TYPE t_salarie AS 
(
	num_secu 			integer,
	Nom					varchar(30),
	Prenom				varchar(30),
	Date_de_naissance	date,
	Lieu_de_naissance	varchar(30),
	adresse				varchar(30),
	Telephone			varchar(10),
	Adresse_mail		varchar(30),
	enfants				t_enfant
);

CREATE TABLE HORAIRE_HEBDO
(
	salarie_HH		t_salarie,
	Jour 			t_jour,
	moment_HH		t_moment	
);

CREATE TABLE CONTRAT 
(
	salarie_c			t_salarie,
	Type_contrat		varchar(5),
	Date_embauche		date,
	Classification		varchar(30),
	Groupe				varchar(10),
	Coefficient			float,
	Fonction			varchar(30),
	Lieu_travail		varchar(30),
	Volume_horaire		varchar(30)
);

CREATE TABLE ROLE
(
	salarie_R		t_salarie,
	mot_de_passe	varchar(30), --doit stocker sous forme binaire
	role 			varchar(30)
);

CREATE TABLE STRUCTURE
(
	nom_structure			varchar(30),
	responsable_structure	varchar(30),
	salarie_S				t_salarie
);

