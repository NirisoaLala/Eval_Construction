<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MDL_Finition extends CI_Model {
    function getAll(){
        $this->db->select('*');
        $this->db->from('finition');
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }

    public function getOne($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('finition'); 
        return $query->row(); 
    }

    public function getOneByName($nom) {
        $this->db->where('nom', $nom);
        $query = $this->db->get('finition'); 
        return $query->row(); 
    }

    function update($id, $pourcentage) {
        $sql = "update finition set pourcentage = %s where id = %s";
        $sql = sprintf($sql,$this->db->escape($pourcentage), $this->db->escape($id));
        $this->db->query($sql);
    }
}
?>