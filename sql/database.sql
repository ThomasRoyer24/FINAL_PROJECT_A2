------------------------------------------------------------
--        Script Postgre 
------------------------------------------------------------



------------------------------------------------------------
-- Table: localisation
------------------------------------------------------------
CREATE TABLE public.localisation(
	id_localisation   SERIAL NOT NULL ,
	city              VARCHAR (50) NOT NULL ,
	adresse           VARCHAR (50)   ,
	CONSTRAINT localisation_PK PRIMARY KEY (id_localisation)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: username
------------------------------------------------------------
CREATE TABLE public.username(
	id_user           SERIAL NOT NULL ,
	mail              VARCHAR (50) NOT NULL ,
	password          VARCHAR (50) NOT NULL ,
	first_name        VARCHAR (50) NOT NULL ,
	last_name         VARCHAR (50) NOT NULL ,
	birth_date        TIMESTAMP   ,
	statistics        INT  NOT NULL ,
	rating            INT   ,
	sports_form       VARCHAR (50)  ,
	id_localisation   INT  NOT NULL  ,
	CONSTRAINT username_PK PRIMARY KEY (id_user)

	,CONSTRAINT username_localisation_FK FOREIGN KEY (id_localisation) REFERENCES public.localisation(id_localisation)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: match
------------------------------------------------------------
CREATE TABLE public.match(
	id_match                SERIAL NOT NULL ,
	sport                   VARCHAR (50) NOT NULL ,
	max_number_players      INT  NOT NULL ,
	actual_number_players   INT  NOT NULL ,
	date_match              TIMESTAMP  NOT NULL ,
	duration                INT  NOT NULL ,
	price                   FLOAT  NOT NULL ,
	score                   INT   ,
	min_number_players      INT  NOT NULL ,
	id_user                 INT  NOT NULL ,
	id_localisation         INT  NOT NULL ,
	id_user_username        INT    ,
	CONSTRAINT match_PK PRIMARY KEY (id_match)

	,CONSTRAINT match_username_FK FOREIGN KEY (id_user) REFERENCES public.username(id_user)
	,CONSTRAINT match_localisation0_FK FOREIGN KEY (id_localisation) REFERENCES public.localisation(id_localisation)
	,CONSTRAINT match_username1_FK FOREIGN KEY (id_user_username) REFERENCES public.username(id_user)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: participer
------------------------------------------------------------
CREATE TABLE public.participer(
	id_match       INT  NOT NULL ,
	id_user        INT  NOT NULL ,
	confirmation   BOOL  NOT NULL ,
	ischeck        BOOL  NOT NULL ,
	number_team    INT  NOT NULL  ,
	CONSTRAINT participer_PK PRIMARY KEY (id_match,id_user)

	,CONSTRAINT participer_match_FK FOREIGN KEY (id_match) REFERENCES public.match(id_match)
	,CONSTRAINT participer_username0_FK FOREIGN KEY (id_user) REFERENCES public.username(id_user)
)WITHOUT OIDS;



