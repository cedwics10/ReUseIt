--
-- base de données: 'mediatek'
--
create database if not exists mediatek default character set utf8 collate utf8_general_ci;
use mediatek;
-- --------------------------------------------------------
-- creation des tables

set foreign_key_checks = 0;

-- table oeuvre
drop table if exists oeuvre;
create table oeuvre (
	oeu_id int not null auto_increment primary key,
	oeu_titre varchar(20) not null,
	oeu_date_achat datetime not null,
	oeu_prix_achat float not null,
	oeu_support int not null
)engine=innodb;

-- table support
drop table if exists support;
create table support (
	sup_id int not null auto_increment primary key,
	sup_libelle varchar(20) not null
)engine=innodb;

-- table auteur
drop table if exists auteur;
create table auteur (
	aut_id int not null auto_increment primary key,
	aut_nom varchar(20) not null,
	aut_prenom varchar(20) not null
)engine=innodb;

-- table produire
drop table if exists produire;
create table produire (
	pro_id int not null auto_increment primary key,
	pro_auteur int not null,
	pro_oeuvre int not null
)engine=innodb; 


set foreign_key_checks =1;

-- contraintes
alter table produire add constraint cs1 foreign key (pro_auteur) references auteur(aut_id);
alter table produire add constraint cs2 foreign key (pro_oeuvre) references oeuvre(oeu_id);
alter table oeuvre add constraint cs3 foreign key (oeu_support) references support(sup_id);