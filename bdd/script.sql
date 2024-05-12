create database construction;
\c construction

create table utilisateur(
    id serial primary key,
    nom varchar(100) not null,
    email varchar(200) not null,
    mdp varchar(100) not null,
    office int default 5 not null
);