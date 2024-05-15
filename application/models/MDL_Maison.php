<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MDL_Maison extends CI_Model {
    function getAll(){
        $this->db->select('*');
        $this->db->from('v_maison');
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }

    public function getOne($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('maison'); 
        return $query->row(); 
    }

    public function getMaison() {
        $this->db->select('m.id, m.nom, m.description, m.duree, sum(d.qte * st.pu) as montant');
        $this->db->from('maison m');
        $this->db->join('devis d', 'm.id = d.idmaison');
        $this->db->join('sous_travaux st', 'd.idst = st.id');
        $this->db->group_by('m.id, m.nom, m.description, m.duree');
        $query = $this->db->get();
        $result = $query->result();
    }

    public function getOneByName($nom) {
        $this->db->where('nom', $nom);
        $query = $this->db->get('maison'); 
        return $query->row(); 
    }
}
?>