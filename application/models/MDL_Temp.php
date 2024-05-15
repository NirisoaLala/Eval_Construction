<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MDL_Temp extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->model('MDL_Travaux');
        $this->load->model('MDL_User');
        $this->load->model('MDL_Finition');
        $this->load->model('MDL_Maison');
        $this->load->model('MDL_TravauxClient');
        $this->load->model('MDL_DevisClient');
    }

    function saveMaisonTravaux($typemaison, $description, $surface, $codetravaux, $typetravaux, $unite, $pu, $qte, $duree) {
        $sql = "insert into temp_maison_travaux(typemaison, description, surface, codetravaux, typetravaux, unite, pu, qte, duree)  values (%s, %s, %s, %s, %s, %s, %s, %s, %s) ";
        $sql = sprintf($sql,$this->db->escape($typemaison), $this->db->escape($description), $this->db->escape($surface), $this->db->escape($codetravaux),$this->db->escape($typetravaux), $this->db->escape($unite), $this->db->escape($pu), $this->db->escape($qte), $this->db->escape($duree));
        $this->db->query($sql);
    }

    function saveDevis($client, $refdevis, $typemaison, $finition, $tauxfinition, $datedevis, $datedebut, $lieu) {
        $sql = "insert into temp_devis(client, refdevis, typemaison, finition, tauxfinition, datedevis, datedebut, lieu)  values (%s, %s, %s, %s, %s, %s, %s, %s) ";
        $sql = sprintf($sql,$this->db->escape($client), $this->db->escape($refdevis), $this->db->escape($typemaison), $this->db->escape($finition),$this->db->escape($tauxfinition), $this->db->escape($datedevis), $this->db->escape($datedebut), $this->db->escape($lieu));
        $this->db->query($sql);
    }

    function savePaiement($refdevis, $refpaiement, $datepaie, $montant) {
        $sql = "insert into temp_paiement(refdevis, refpaiement, datepaie, montant)  values (%s, %s, %s, %s) ";
        $sql = sprintf($sql,$this->db->escape($refdevis), $this->db->escape($refpaiement), $this->db->escape($datepaie), $this->db->escape($montant));
        $this->db->query($sql);
    }

    public function saveMaison(){
        $this->db->query('
            insert into maison(nom, description, duree, surface)
            select distinct typemaison, description, duree, surface
            from temp_maison_travaux;
        ');
    }

    public function saveTravaux(){
        $this->db->query('
            insert into sous_travaux(code, designation, unite, pu)
            select distinct codetravaux, typetravaux, unite, pu
            from temp_maison_travaux;
        ');
    }

    public function saveDevisData(){
        $this->db->query('
            insert into devis(idmaison, idst, qte)
            select distinct m.id as idmaison, t.id as idst, tmt.qte
            from temp_maison_travaux tmt
            join sous_travaux t on tmt.codetravaux = t.code
            join maison m on tmt.typemaison = m.nom;
        ');
    }

    public function saveClient(){
        $this->db->query('
            insert into client(tel)
            select distinct client
            from temp_devis;
        ');
    }

    public function saveFinition(){
        $this->db->query('
            insert into finition(nom, pourcentage)
            select distinct finition, tauxfinition
            from temp_devis;
        ');
    }

    // public function saveDevisClient(){
    //     $this->db->query('
    //         insert into devis_client(idclient, idmaison, idfinition, datecreation, datedebut, datefin, pourcentage, refdevis, lieu)
    //         select distinct c.id as idclient, m.id as idmaison, f.id as idfinition, td.datedevis as datecreation, td.datedebut, (td.datedebut + m.duree) as datefin, td.tauxfinition, td.refdevis, td.lieu 
    //         from temp_devis td
    //         join client c on td.client = c.tel
    //         join finition f on td.finition = f.nom
    //         join maison m on td.typemaison = m.nom;
    //     ');
    //     $iddc = $this->db->insert_id();
    //     $dclist = $this->MDL_DevisClient->getDetailsByDC($iddc);
    //     foreach ($dclist as $row) {
    //         $this->MDL_TravauxClient->save($row->id, $row->idst, $row->pu, $row->qte);
    //     }
    // }

    public function saveDevisClient(){
        $this->db->distinct();
        $this->db->select('client, typemaison, finition, datedevis, datedebut, tauxfinition, refdevis, lieu');
        $this->db->from('temp_devis');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            foreach ($result as $row) {
                $client = $this->MDL_User->getOneClientByTel($row['client']);
                $finition = $this->MDL_Finition->getOneByName($row['finition']);
                $maison = $this->MDL_Maison->getOneByName($row['typemaison']);
                $debut = strtotime($row['datedebut']);
                $fin = strtotime("+{$maison->duree} days", $debut);
                $datefin = date('Y-m-d', $fin);

                $data = array(
                    'idclient' => $client->id,
                    'idmaison' => $maison->id,
                    'idfinition' => $finition->id,
                    'datecreation' => $row['datedevis'],
                    'datedebut' => $row['datedebut'],
                    'datefin' => $datefin,
                    'pourcentage' => $row['tauxfinition'],
                    'refdevis' => $row['refdevis'],
                    'lieu' => $row['lieu']
                );
                $this->db->insert('devis_client', $data);

                $iddc = $this->db->insert_id();
                $dclist = $this->MDL_DevisClient->getDetailsByDC($iddc);
                foreach ($dclist as $row) {
                    $this->MDL_TravauxClient->save($row->id, $row->idst, $row->pu, $row->qte);
                }
            }
        }
    }

    public function savePaiementData() {
        $this->db->query('
            insert into paiement(iddc, datepaie, montant, refpaiement)
            select dc.id as iddc, tp.datepaie, tp.montant, tp.refpaiement
            from temp_paiement tp
            join devis_client dc on tp.refdevis = dc.refdevis;
        ');
    }

    public function truncate(){
        $this->db->query('TRUNCATE TABLE temp_paiement RESTART IDENTITY');   
        $this->db->query('TRUNCATE TABLE temp_devis RESTART IDENTITY');
        $this->db->query('TRUNCATE TABLE temp_maison_travaux RESTART IDENTITY');
        $this->db->query('TRUNCATE TABLE paiement RESTART IDENTITY'); 
        $this->db->query('TRUNCATE TABLE travaux_client RESTART IDENTITY CASCADE');     
        $this->db->query('TRUNCATE TABLE devis_client RESTART IDENTITY CASCADE'); 
        $this->db->query('TRUNCATE TABLE finition RESTART IDENTITY CASCADE');           
        $this->db->query('TRUNCATE TABLE devis RESTART IDENTITY CASCADE');
        $this->db->query('TRUNCATE TABLE maison RESTART IDENTITY CASCADE');
        $this->db->query('TRUNCATE TABLE sous_travaux RESTART IDENTITY CASCADE');     
        $this->db->query('TRUNCATE TABLE client RESTART IDENTITY CASCADE');       
    }
}
?>