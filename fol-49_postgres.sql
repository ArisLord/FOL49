

-- CREATE TYPE T_SALARIE AS (
-- 	  NUM_SECU varchar(14),
--   	NOM varchar(30) ,
--   	PRENOM varchar(30) ,
--   	DAT_NAISS date ,
--   	LIEU_NAISS varchar(30) ,
--   	situation_familiale varchar(100),
--   	ADRESSE varchar(30) ,
--   	VILLE varchar(30) ,
--   	TELEPHONE varchar(10),
--   	MAIL varchar(100),
--   	mot_de_passe varchar(300),
--   	role varchar(30)
-- );

--  CREATE TYPE T_enfant AS (
--    Parent T_SALARIE,
--    NOM varchar(30),
--    PRENOM varchar(30),
--    DAT_NAISS date,
--    sexe varchar(1),
--    a_charge boolean 

-- );

-- CREATE TYPE T_CDI_2 AS (
--   volume_hebdo integer,
--   Volume_horaire_vacances integer
-- ); 
-- CREATE TYPE T_CDII_2 AS (

--   periode_scolaire integer,
--   vacances integer,
--   nbr_semaines_NT integer,
--   num_semaine_NT varchar(300)
-- ); 

-- CREATE TYPE T_CDD AS (
--   TYPE_CDD varchar(30),
--   motif varchar(300),
--   personne_remplace T_SALARIE,
--   date_debut date,
--   date_fin date,
--   heure_travaille integer
-- ); 
-- CREATE TYPE tranche2 AS (
--   arrivee varchar(30),
--   depart varchar(30),
--   nom_structure varchar(30)
-- );

-- CREATE TYPE JOURNEE2 AS (
--   MATIN tranche2,
--   MIDI tranche2,
--   SOIR tranche2
-- );


-- ---table 
-- CREATE table SALARIE OF T_SALARIE(
-- 	NUM_SECU primary key
-- );

--CREATE table ENFANT OF T_enfant;


-- CREATE table CONTRAT(
--   SALARIE T_SALARIE,
--   type_contrat varchar(30),
--   date_embauche date,
--   classification varchar(30),
--   groupe varchar(30),
--   coefficient varchar(30),
--   fonction varchar(30),
--   lieu_travail varchar(300),
--   rens_sup varchar(300),
--   CDI T_CDI_2,
--   CDII T_CDII_2,
--   CDD T_CDD

-- );

-- CREATE table horaire_semaine(
--   SALARIE T_SALARIE,
--   LUNDI JOURNEE2,
--   MARDI JOURNEE2,
--   MERCREDI JOURNEE2,
--   JEUDI JOURNEE2,
--   VENDREDI JOURNEE2,
--   SAMEDI  JOURNEE2
-- );

-- CREATE table horaire_vacances(
--   SALARIE T_SALARIE,
--   LUNDI JOURNEE2,
--   MARDI JOURNEE2,
--   MERCREDI JOURNEE2,
--   JEUDI JOURNEE2,
--   VENDREDI JOURNEE2,
--   SAMEDI  JOURNEE2
-- );
-- 

-- -- CREATE TABLE CONTRAT_EN_ATTENTE (
-- -- 	SALARIE T_SALARIE
-- -- );

-- CREATE TABLE Volume_horaire (
--    SALARIE T_SALARIE,
--    LUNDI integer,
--    MARDI integer,
--    MERCREDI integer,
--    JEUDI integer,
--    VENDREDI integer,
--    SAMEDI  integer

-- ); 
-- CREATE TABLE Volume_horaire_vacances (
--    SALARIE T_SALARIE,
--    LUNDI integer,
--    MARDI integer,
--    MERCREDI integer,
--    JEUDI integer,
--    VENDREDI integer,
--    SAMEDI  integer
--); 


-- CREATE OR REPLACE FUNCTION contrat_fait() RETURNS TRIGGER AS
--    $$
--    DECLARE

--    BEGIN

--       DELETE FROM CONTRAT_EN_ATTENTE C WHERE (C.salarie).num_secu = (NEW.salarie).num_secu; 
--       RETURN NEW;

--    END;
--    $$ LANGUAGE plpgsql;

-- CREATE TRIGGER contrat_fait AFTER INSERT ON CONTRAT FOR EACH ROW EXECUTE PROCEDURE contrat_fait();

-- CREATE TABLE EMPLOI_DU_TEMPS_A_FINALISER (
--    salarie T_SALARIE

-- );

-- INSERT INTO EMPLOI_DU_TEMPS_A_FINALISER values((SELECT S FROM SALARIE S WHERE S.num_secu='1200'));

-- CREATE TABLE STRUCTURE (
--    NOM_STRUCTURE varchar(100)

-- );

-- insert INTO STRUCTURE values('ALAE La Possonnière');
-- insert INTO STRUCTURE values('ALAE Le Louroux Béconnais');
-- insert INTO STRUCTURE values('ALAE St Gemmes Sur Loire');
-- insert INTO STRUCTURE values('ALSH Andard');
-- insert INTO STRUCTURE values('ALSH Bauné');
-- insert INTO STRUCTURE values('ALSH Corné');
-- insert INTO STRUCTURE values('ALSH Saint Mathurin Sur Loire');
-- insert INTO STRUCTURE values('Service Vacances');


-- INSERT INTO EMPLOI_DU_TEMPS_A_FINALISER values((SELECT S FROM SALARIE S WHERE S.num_secu='1400'));

-- CREATE TABLE PEUT_CREER_MDP (
-- 	SALARIE T_SALARIE

-- )
-- ;

-- CREATE OR REPLACE FUNCTION drop() RETURNS VOID AS 
-- $$
-- DECLARE
--  cursor_sal CURSOR FOR SELECT S FROM SALARIE S;
-- BEGIN
-- 	FOR I in cursor_sal
-- 	LOOP
-- 		INSERT into CONTRAT_EN_ATTENTE values((I.S));
-- 	END LOOP;
--  END;
-- $$ LANGUAGE plpgsql;

-- SELECT drop();


-- INSERT into CONTRAT_EN_ATTENTE values((SELECT S FROM SALARIE S WHERE S.num_secu in ('1300')));

-- CREATE TABLE VACANCES_DATES (
-- 	Date_vacance date,
-- 	intitule varchar(100)

-- );

;
