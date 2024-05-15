<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MDL_Travaux extends CI_Model {
    function update($id, $code, $designation, $unite, $pu) {
        $sql = "update sous_travaux set code = %s, designation = %s, unite = %s, pu = %s where id = %s";
        $sql = sprintf($sql,$this->db->escape($code), $this->db->escape($designation), $this->db->escape($unite), $this->db->escape($pu), $this->db->escape($id));
        $this->db->query($sql);
    }

    function getAll(){
        $this->db->select('*');
        $this->db->from('sous_travaux');
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }

    public function getOne($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('sous_travaux'); 
        return $query->row(); 
    }

    public function getOneByCode($code) {
        $this->db->where('code', $code);
        $query = $this->db->get('sous_travaux'); 
        return $query->row(); 
    }

}
?>