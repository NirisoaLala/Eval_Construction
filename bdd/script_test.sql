create database construction;
\c construction

create database construction_eval;
\c construction_eval

create table admin(
    id serial primary key,
    nom varchar(100) not null,
    email varchar(200) not null,
    mdp varchar(100) not null
);

create table client(
    id serial primary key,
    tel varchar(20) not null
);

-- create table travaux(
--     id serial primary key,
--     code varchar(10) not null,
--     nom varchar(200) not null
-- );

-- create table sous_travaux(
--     id serial primary key,
--     code varchar(10) not null,
--     designation varchar(200) not null,
--     unite varchar(20),
--     pu double precision default 0,
--     idtravaux int references travaux(id)
-- );

create table sous_travaux(
    id serial primary key,
    code varchar(10) not null,
    designation varchar(200) not null,
    unite varchar(20),
    pu double precision default 0
);

create table travaux_prix(
    id serial primary key,
    idst int references sous_travaux(id),
    pu double precision default 0,
    datemodif date default current_date
);

create table maison(
    id serial primary key,
    nom varchar(200) not null,
    description text,
    duree int,
    surface double precision
);

create table devis(
    id serial primary key,
    idmaison int references maison(id) not null,
    idst int references sous_travaux(id) not null,
    qte double precision default 0
);

create table finition(
    id serial primary key,
    nom varchar(100) not null,
    pourcentage double precision default 0
);

create table devis_client(
    id serial primary key,
    idclient int references client(id) not null,
    idmaison int references maison(id) not null,
    idfinition int references finition(id) not null,
    datecreation date default current_date, 
    datedebut date default current_date,
    datefin date,
    etat int default 1, 
    pourcentage double precision default 0,
    refdevis varchar(20),
    lieu varchar(150)
);

create table travaux_client(
    id serial primary key,
    iddc int references devis_client(id) not null,
    idst int references sous_travaux(id) not null,
    pu double precision default 0,
    qte double precision default 0
);

create table paiement(
    id serial primary key,
    iddc int references devis_client(id) not null,
    datepaie date default current_date,
    montant double precision default 0,
    refpaiement varchar(20)
);

create table devis_admin(
    id serial primary key,
    idadmin int references admin(id) not null,
    iddc int references devis_client(id) not null
);

create table temp_maison_travaux(
    typemaison varchar(200),
    description text,
    surface double precision,
    codetravaux varchar(20),
    typetravaux varchar(200),
    unite varchar(200),
    pu double precision,
    qte double precision,
    duree int
);

create table temp_devis(
    client varchar(20),
    refdevis varchar(45),
    typemaison varchar(200),
    finition varchar(200),
    tauxfinition double precision,
    datedevis date,
    datedebut date,
    lieu varchar(200)
);

create table temp_paiement(
    refdevis varchar(45),
    refpaiement varchar(45),
    datepaie date,
    montant double precision
);

create or replace view v_dc as
select dc.id, dc.idclient, dc.idmaison, m.nom, d.idst, st.code, st.designation, st.unite, st.pu, d.qte
from devis_client dc
join maison m on dc.idmaison = m.id
join devis d on m.id = d.idmaison
join sous_travaux st on d.idst = st.id;

create or replace view v_dc_byclient as
select dc.idclient, dc.id, dc.idmaison, m.nom as maison, dc.idfinition, f.nom as finition, dc.datecreation, dc.datedebut, dc.datefin, sum(tc.pu * tc.qte) as montant, (sum(tc.pu * tc.qte) * dc.pourcentage) / 100 as pourcentage, sum(tc.pu * tc.qte) + ((sum(tc.pu * tc.qte) * dc.pourcentage) / 100) as montant_total, dc.refdevis
from devis_client dc
join travaux_client tc on dc.id = tc.iddc
join maison m on dc.idmaison = m.id
join finition f on dc.idfinition = f.id
group by dc.idclient, dc.id, dc.idmaison, m.nom, dc.idfinition, f.nom, dc.datecreation, dc.datedebut, dc.datefin;

-- create or replace view v_dc_details as
-- select dc.id, dc.idclient, st.idtravaux, t.code as code_trav, t.nom as travaux, tc.idst, st.code as code_st, st.designation, tc.pu, tc.qte, (tc.pu * tc.qte) montant 
-- from v_dc_byclient dc
-- join travaux_client tc on dc.id = tc.iddc
-- join sous_travaux st on tc.idst = st.id
-- join travaux t on st.idtravaux = t.id
-- group by dc.id, dc.idclient, st.idtravaux, t.code, t.nom, tc.idst, tc.idst, st.code, st.designation, tc.pu, tc.qte;

create or replace view v_dc_details as
select dc.id, dc.idclient, tc.idst, st.code as code_st, st.designation, tc.pu, tc.qte, (tc.pu * tc.qte) montant 
from v_dc_byclient dc
join travaux_client tc on dc.id = tc.iddc
join sous_travaux st on tc.idst = st.id
group by dc.id, dc.idclient, tc.idst, tc.idst, st.code, st.designation, tc.pu, tc.qte;

create or replace view v_dc_admin as
select dc.idclient, dc.id, dc.idmaison, dc.maison, dc.idfinition, dc.finition, dc.datecreation, dc.datedebut, dc.datefin, dc.montant, dc.pourcentage, dc.montant_total, coalesce(sum(p.montant), 0) as paie, (dc.montant_total - coalesce(sum(p.montant), 0)) as reste, ((100 * coalesce(sum(p.montant), 0)) / dc.montant_total) as pourcent, dc.refdevis
from v_dc_byclient dc
left join paiement p on dc.id = p.iddc
group by dc.idclient, dc.id, dc.idmaison, dc.maison, dc.idfinition, dc.finition, dc.datecreation, dc.datedebut, dc.datefin, dc.montant, dc.pourcentage, dc.montant_total, dc.refdevis;

create or replace view v_dash as
SELECT EXTRACT(YEAR FROM datecreation) AS annee, TO_CHAR(datecreation, 'Month') AS mois, SUM(montant_total) AS montant
FROM  v_dc_byclient
GROUP BY EXTRACT(YEAR FROM datecreation), TO_CHAR(datecreation, 'Month');

create or replace view v_maison as
select m.id, m.nom, m.description, m.duree, sum(d.qte * st.pu) as montant, m.surface
from maison m 
join devis d on m.id = d.idmaison
join sous_travaux st on d.idst = st.id
group by m.id, m.nom, m.description, m.duree;