DROP TABLE IF EXISTS recette;

create table recette
(id_rec int(5) NOT NULL AUTO_INCREMENT,
nom_rec varchar(50) NOT NULL,
date_creation datetime NOT NULL,
pseudo_rec varchar(50),
email_rec varchar(50),
descript_rec VARCHAR (250),
image varchar(50),
CONSTRAINT pk_rec PRIMARY KEY(id_rec)
)ENGINE=InnoDB;

DROP TABLE IF EXISTS ingredient;

create table ingredient
(id_ingre int(5) NOT NULL AUTO_INCREMENT,
nom_ingre varchar(50) NOT NULL,
unite varchar(50) NOT NULL,
CONSTRAINT pk_ingre PRIMARY KEY(id_ingre)
)ENGINE=InnoDB;

DROP TABLE IF EXISTS categorie;

create table categorie
(id_cat int(5) NOT NULL AUTO_INCREMENT,
nom_cat varchar(50) NOT NULL,
CONSTRAINT pk_cat PRIMARY KEY(id_cat)
)ENGINE=InnoDB;

DROP TABLE IF EXISTS note;

create table note
(id_note int(5) NOT NULL AUTO_INCREMENT,
note int(2) NOT NULL,
pseudo_note varchar(50),
commentaire varchar(200),
CONSTRAINT pk_note PRIMARY KEY(id_note)
)ENGINE=InnoDB;

DROP TABLE IF EXISTS evaluer;

CREATE TABLE evaluer
(id_rec int(5) NOT NULL,
id_note int(5) NOT NULL,
CONSTRAINT pk_eval PRIMARY KEY(id_rec, id_note)
)ENGINE=InnoDB;

DROP TABLE IF EXISTS appartenir;

CREATE table appartenir
(id_rec int(5) NOT NULL,
id_cat int(5) NOT NULL,
CONSTRAINT pk_appart PRIMARY KEY(id_rec, id_cat)
)ENGINE=InnoDB;

DROP TABLE IF EXISTS comporter;

CREATE table comporter
(id_rec int(5) NOT NULL,
id_ingre int(5) NOT NULL,
poid int(5),
CONSTRAINT pk_comp PRIMARY KEY(id_rec, id_ingre)
)ENGINE=InnoDB;