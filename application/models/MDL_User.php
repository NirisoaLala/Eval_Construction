<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MDL_User extends CI_Model {
    function save($nom, $email, $mdp, $office) {
        $sql = "insert into utilisateur(nom, email, mdp, office)  values (%s, %s, %s, %s) ";
        $sql = sprintf($sql,$this->db->escape($nom),$this->db->escape($email),$this->db->escape($mdp),$this->db->escape($office));
        $this->db->query($sql);
    }

    public function truncate() {
        $this->db->query('TRUNCATE utilisateur');
    }

    public function deleteById($id) {
        $this->db->where('id', $id);
        $this->db->delete('utilisateur');
    }

    function login($email, $mdp) {
        $query = $this->db->get_where('utilisateur', array('email' => $email, 'mdp' => $mdp));
        $user = $query->row_array();
        return $user;
    }

    function getAll(){
        $this->db->select('*');
        $this->db->from('utilisateur');
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }
}
?>