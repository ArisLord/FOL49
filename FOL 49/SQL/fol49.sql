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

CREATE TABLE CDI (
	NUM_SECU varchar(14),
	volume_hebdo integer,
	FOREIGN KEY (NUM_SECU) REFERENCES SALARIE(NUM_SECU) ON DELETE CASCADE
    )ENGINE=INNODB;


CREATE TABLE role(
	num_secutire varchar(14),
	mot_de_passe varchar(300),
	role varchar(30)
	FOREIGN KEY (num_secutire) REFERENCES SALARIE(NUM_SECU) ON DELETE CASCADE
    )ENGINE=INNODB;
