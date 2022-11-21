--
-- base de données: 'reuseit'
--
drop database if exists reuseit;
create database if not exists reuseit default character set utf8 collate utf8_general_ci;
use reuseit;
-- --------------------------------------------------------
-- creation des tables

set foreign_key_checks = 0;

-- members table
drop table if exists members;
create table members (
	mem_id int not null auto_increment primary key,
	mem_username varchar(100) not null,
	mem_password varchar(100) not null,
	mem_photo varchar(100) not null,
    mem_arrival_date varchar(100) not null,
    mem_description text not null,
    mem_status int not null
)engine=innodb;

-- lists table
drop table if exists lists;
create table lists (
	lis_id int not null auto_increment primary key,
	lis_id_member int not null,
	lis_date varchar(100) not null,
	lis_name varchar(100) not null,
	lis_description text not null,
	lis_visbility varchar(100) not null
)engine=innodb;

-- tasks table
drop table if exists tasks;
create table tasks (
	tas_id int not null auto_increment primary key,
	tas_id_list int not null,
	tas_name varchar(100) not null,
	tas_description text not null,
    tas_importance int not null,
    tas_due_date varchar(100) not null,
    tas_status int not null
)engine=innodb;

-- forums table
drop table if exists forums;
create table forums (
	for_id int not null auto_increment primary key,
	for_name varchar(500) not null,
	for_description text not null,
	for_date varchar(100) not null,
    for_status int not null
)engine=innodb;

-- subjects table
drop table if exists subjects;
create table subjects (
	sub_id int not null auto_increment primary key,
	sub_id_forum int not null,
	sub_id_member int not null,
	sub_id_task int,
	sub_name varchar(500) not null,
	sub_pinned int not null,
	sub_status int not null,
	sub_date varchar(100) not null
)engine=innodb;


-- messages table
drop table if exists messages;
create table messages (
	mes_id int not null auto_increment primary key,
	mes_id_member int not null,
	mes_id_subject int not null,
	mes_date varchar(100) not null,
	mes_content text not null,
    mes_status int not null,
	mes_ip varchar(500) not null
)engine=innodb;

-- private messages subject table
drop table if exists pmsubjects;
create table pmsubjects (
	pms_id int not null auto_increment primary key,
	pms_id_author int not null,
	pms_name varchar(500) not null,
	pms_task int,
    pms_status int not null,
	pms_ip varchar(500) not null
)engine=innodb;

-- private messages answers table
drop table if exists pmanswers;
create table pmanswers (
	pma_id int not null auto_increment primary key,
	pma_id_subject int,
	pma_id_sender int,
	pma_message text not null,
	pma_time varchar(100) not null
)engine=innodb;

-- private messages recievers table
drop table if exists pmrecievers;
create table pmrecievers (
	pmr_id int not null auto_increment primary key,
	pmr_id_pmsubject int not null,
	pmr_id_answer int not null,
	pmr_id_reciever int not null,
	pmr_date_recieved varchar(100),
	pmr_date_read varchar(100)
)engine=innodb;

-- private messages not recieve table
drop table if exists pmnotrecieve;
create table pmnotrecieve (
	pmn_id int not null auto_increment primary key,
	pmn_id_pmsubject int not null,
	pmn_id_member int not null,
	pmn_date_stop varchar(100) not null
)engine=innodb;

-- private blacklist table
drop table if exists blacklist;
create table blacklist (
	bla_id int not null auto_increment primary key,
	bla_id_member int not null,
	bla_id_blacklisted int not null
)engine=innodb;

set foreign_key_checks =1;

-- constraints
alter table lists add constraint author_lists foreign key (lis_id_member) references members(mem_id);
alter table tasks add constraint list_of_task foreign key (tas_id_list) references lists(lis_id);

alter table subjects add constraint subjects_forum foreign key (sub_id_forum) references forums(for_id);
alter table subjects add constraint author_subject foreign key (sub_id_member) references members(mem_id);

alter table messages add constraint mess_subject foreign key (mes_id_subject) references subjects(sub_id);
alter table messages add constraint mess_member foreign key (mes_id_member) references members(mem_id);

alter table pmsubjects add constraint author_pm foreign key (pms_id_author) references members(mem_id);

alter table pmanswers add constraint pma_subject foreign key (pma_id_subject) references pmsubjects(pms_id);
alter table pmanswers add constraint pma_sender foreign key (pma_id_sender) references members(mem_id);

alter table pmrecievers add constraint pmr_subject foreign key (pmr_id_pmsubject) references pmsubjects(pms_id);
alter table pmrecievers add constraint pmr_reciever foreign key (pmr_id_reciever) references members(mem_id);
alter table pmrecievers add constraint pmr_answer foreign key (pmr_id_answer) references pmanswers(pma_id);

alter table pmnotrecieve add constraint sub_stop_pmr foreign key (pmn_id_pmsubject) references pmsubjects(pms_id);
alter table pmnotrecieve add constraint stop_pmr foreign key (pmn_id_member) references members(mem_id);

alter table blacklist add constraint bla_member1 foreign key (bla_id_member) references members(mem_id);
alter table blacklist add constraint bla_member2 foreign key (bla_id_blacklisted) references members(mem_id);