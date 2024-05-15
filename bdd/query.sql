ALTER TABLE devis_client ALTER COLUMN refdevis SET DEFAULT 'DV';

insert into maison(nom, description, duree, surface)
select distinct typemaison, description, duree, surface
from temp_maison_travaux;

insert into sous_travaux(code, designation, unite, pu)
select distinct codetravaux, typetravaux, unite, pu
from temp_maison_travaux;

insert into devis(idmaison, idst, qte)
select distinct m.id as idmaison, t.id as idst, tmt.qte
from temp_maison_travaux tmt
join sous_travaux t on tmt.codetravaux = t.code
join maison m on tmt.typemaison = m.nom;

insert into client(tel)
select distinct client
from temp_devis;

insert into finition(nom, pourcentage)
select distinct finition, tauxfinition
from temp_devis;

insert into devis_client(idclient, idmaison, idfinition, datecreation, datedebut, datefin, pourcentage, refdevis, lieu)
select distinct c.id as idclient, m.id as idmaison, f.id as idfinition, td.datedevis as datecreation, td.datedebut, (td.datedebut + m.duree) as datefin, td.tauxfinition, td.refdevis, td.lieu 
from temp_devis td
join client c on td.client = c.tel
join finition f on td.finition = f.nom
join maison m on td.typemaison = m.nom;

insert into paiement(iddc, datepaie, montant, refpaiement)
select dc.id as iddc, tp.datepaie, tp.montant, tp.refpaiement
from temp_paiement tp
join devis_client dc on tp.refdevis = dc.refdevis;

select refdevis, refpaiement, datepaie, montant
from temp_paiement;

select distinct client, typemaison, finition, datedevis, datedebut, tauxfinition, refdevis, lieu
from temp_devis;

select distinct finition, tauxfinition
from temp_devis;

select distinct client
from temp_devis;

select distinct typemaison, description, duree, surface
from temp_maison_travaux;

select distinct codetravaux, typetravaux, unite, pu
from temp_maison_travaux;

select distinct typemaison, codetravaux, qte
from temp_maison_travaux;

select typemaison, description, duree, surface
from temp_maison_travaux
group by typemaison, description, duree, surface;

select codetravaux, typetravaux, unite, pu
from temp_maison_travaux
group by codetravaux, typetravaux, unite, pu;

select typemaison, codetravaux, qte
from temp_maison_travaux
group by typemaison, codetravaux, qte;

-------------------------------------------------------------------------------------------------------------------

alter table maison add column surface double precision;
alter table devis_client add column refdevis varchar(20), lieu varchar(150);
alter table paiement add column refpaiement varchar(20);

select sum(paie) as paiement
from v_dc_admin;

select idclient, id, idmaison, maison, idfinition, finition, datecreation, datedebut, datefin, montant, pourcentage, montant_total, paie, reste, ((100 * paie) / montant_total) as pourcent
from v_dc_admin;

ALTER TABLE sous_travaux DROP COLUMN idtravaux CASCADE;

select m.id, m.nom, m.description, m.duree, sum(d.qte * st.pu) as montant
from maison m 
join devis d on m.id = d.idmaison
join sous_travaux st on d.idst = st.id
group by m.id, m.nom, m.description, m.duree;

SELECT EXTRACT(YEAR FROM datecreation) AS annee, TO_CHAR(datecreation, 'Month') AS mois, SUM(montant_total) AS montant
FROM  v_dc_byclient
GROUP BY EXTRACT(YEAR FROM datecreation), TO_CHAR(datecreation, 'Month');

select datecreation, sum(montant_total) as montant
from v_dc_byclient
group by datecreation;

select sum(montant_total) as montant_devis
from v_dc_byclient;

select dc.idclient, dc.id, dc.idmaison, dc.maison, dc.idfinition, dc.finition, dc.datecreation, dc.datedebut, dc.datefin, dc.montant, dc.pourcentage, dc.montant_total, coalesce(sum(p.montant), 0) as paie, (dc.montant_total - coalesce(sum(p.montant), 0)) as reste
from v_dc_byclient dc
left join paiement p on dc.id = p.iddc
group by dc.idclient, dc.id, dc.idmaison, dc.maison, dc.idfinition, dc.finition, dc.datecreation, dc.datedebut, dc.datefin, dc.montant, dc.pourcentage, dc.montant_total;

select id, idclient, idtravaux, code_trav, travaux, sum(montant) as montant
from v_dc_details
group by id, idclient, idtravaux, code_trav, travaux;

select dc.id, dc.idclient, st.idtravaux, t.code as code_trav, t.nom as travaux, tc.idst, st.code as code_st, st.designation, tc.idst, tc.pu, tc.qte, (tc.pu * tc.qte) montant 
from v_dc_byclient dc
join travaux_client tc on dc.id = tc.iddc
join sous_travaux st on tc.idst = st.id
join travaux t on st.idtravaux = t.id
group by dc.id, dc.idclient, st.idtravaux, t.code, t.nom, tc.idst, tc.idst, st.code, st.designation, tc.pu, tc.qte;

select dc.idclient, dc.id, dc.idmaison, m.nom as maison, dc.idfinition, f.nom as finition, dc.datecreation, dc.datedebut, dc.datefin, sum(tc.pu * tc.qte) as montant, (sum(tc.pu * tc.qte) * dc.pourcentage) / 100 as pourcentage, sum(tc.pu * tc.qte) + ((sum(tc.pu * tc.qte) * dc.pourcentage) / 100) as montant_total
from devis_client dc
join travaux_client tc on dc.id = tc.iddc
join maison m on dc.idmaison = m.id
join finition f on dc.idfinition = f.id
group by dc.idclient, dc.id, dc.idmaison, m.nom, dc.idfinition, f.nom, dc.datecreation, dc.datedebut, dc.datefin;

select dc.id, dc.idclient, dc.idmaison, m.nom, d.idst, st.code, st.designation, st.unite, st.pu, d.qte
from devis_client dc
join maison m on dc.idmaison = m.id
join devis d on m.id = d.idmaison
join sous_travaux st on d.idst = st.id;

alter table devis_client add column pourcentage double precision default 0;

drop view v_dc_byclient;
drop view v_dc;

drop table devis_admin;
drop table paiement;
drop table travaux_client;
drop table devis_client;
drop table finition;
drop table devis;
drop table maison;
drop table travaux_prix;
drop table sous_travaux;
drop table travaux;
drop table client;
drop table admin;

truncate devis_admin;
truncate paiement;
truncate travaux_client;
truncate devis_client;
truncate finition;
truncate devis;
truncate maison;
truncate travaux_prix;
truncate sous_travaux;
truncate travaux;
truncate client;
truncate admin;

delete from devis_admin;
delete from paiement;
delete from travaux_client;
delete from devis_client;
delete from finition;
delete from devis;
delete from maison;
delete from travaux_prix;
delete from sous_travaux;
delete from travaux;
delete from client;
delete from admin;

drop database construction;