<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MDL_DevisClient extends CI_Model {
    function save($idclient, $idmaison, $idfinition, $datecreation, $datedebut, $datefin, $pourcentage, $lieu) {
        $sql = "insert into devis_client(idclient, idmaison, idfinition, datecreation, datedebut, datefin, pourcentage, lieu)  values (%s, %s, %s, %s, %s, %s, %s, %s) ";
        $sql = sprintf($sql,$this->db->escape($idclient), $this->db->escape($idmaison), $this->db->escape($idfinition), $this->db->escape($datecreation), $this->db->escape($datedebut), $this->db->escape($datefin), $this->db->escape($pourcentage), $this->db->escape($lieu));
        $this->db->query($sql);
        $insert_id = $this->db->insert_id();
        return $this->getOne($insert_id);
    }

    // function save($idclient, $idmaison, $idfinition, $datedebut, $datefin) {
    //     $sql = "insert into devis_client(idclient, idmaison, idfinition, datedebut, datefin)  values (%s, %s, %s, %s, %s, %s) ";
    //     $sql = sprintf($sql,$this->db->escape($idclient), $this->db->escape($idmaison), $this->db->escape($idfinition), $this->db->escape($datedebut), $this->db->escape($datefin));
    //     $this->db->query($sql);
    // }

    public function getOne($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('devis_client'); 
        return $query->row(); 
    }

    public function getOneByRef($ref) {
        $this->db->where('refdevis', $ref);
        $query = $this->db->get('devis_client'); 
        return $query->row(); 
    }

    public function getDetailsByDC($iddc) {
        $this->db->select("*");
        $this->db->from('v_dc');
        $this->db->where('id', $iddc);
        $query = $this->db->get();
        return $query->result();
    }

    public function getDCByClient($idclient) {
        $this->db->select("*");
        $this->db->from('v_dc_byclient');
        $this->db->where('idclient', $idclient);
        $query = $this->db->get();
        return $query->result();
    }

    public function getDC($iddc) {
        $this->db->select("*");
        $this->db->from('v_dc_byclient');
        $this->db->where('id', $iddc);
        $query = $this->db->get();
        return $query->row();
    }

    public function getDCDetails($iddc) {
        $this->db->select("*");
        $this->db->from('v_dc_details');
        $this->db->where('id', $iddc);
        $query = $this->db->get();
        return $query->result();
    }

    // Admin
    public function getDCList() {
        $this->db->select("*");
        $this->db->from('v_dc_admin');
        $query = $this->db->get();
        return $query->result();
    }

    public function getDCByDC($iddc) {
        $this->db->select("*");
        $this->db->from('v_dc_admin');
        $this->db->where('id', $iddc);
        $query = $this->db->get();
        return $query->row();
    }

    public function getDashboardByYear($annee) {
        $this->db->select("*");
        $this->db->from('v_dash');
        $this->db->where('annee', $annee);
        $query = $this->db->get();
        return $query->result();
    }

    public function getMontantTotal() {
        $this->db->select("sum(montant_total) as montant_devis");
        $this->db->from('v_dc_byclient');
        $query = $this->db->get(); 
        return $query->row();
    }

    public function getPaiementTotal() {
        $this->db->select("sum(paie) as paiement");
        $this->db->from('v_dc_admin');
        $query = $this->db->get(); 
        return $query->row();
    }
}
?>