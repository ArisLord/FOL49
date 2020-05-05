--creation des table


CREATE TABLE SALARIE(
	NUM_SECU varchar(14) NOT NULL PRIMARY KEY,
	NOM varchar(30),
	PRENOM varchar(30),
	DAT_NAISS DATE,
	LIEU_NAISS varchar(30),
	situation_familiale varchar(100),
	ADRESSE varchar(30),
	VILLE varchar(30),
	TELEPHONE varchar(10),
	MAIL varchar(100)
)ENGINE=INNODB;

CREATE TABLE CDII (
	NUM_SECU varchar(14),
	duree_min integer,
	periode_scolaire integer,
	nbr_semaine_NT integer,
	num_semaine_NT i=varchar(50),
	FOREIGN KEY (NUM_SECU) REFERENCES SALARIE(NUM_SECU) ON DELETE CASCADE
    )ENGINE=INNODB;


