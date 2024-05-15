<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MDL_User extends CI_Model {
    // Client
    function saveClient($tel) {
        $sql = "insert into client(tel)  values (%s) ";
        $sql = sprintf($sql,$this->db->escape($tel));
        $this->db->query($sql);
        $insert_id = $this->db->insert_id();
        return $this->getOneClient($insert_id);
    }

    function loginClient($tel) {
        $query = $this->db->get_where('client', array('tel' => $tel));
        $user = $query->row_array();
        return $user;
    }

    public function getOneClient($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('client'); 
        return $query->row(); 
    }

    public function getOneClientByTel($tel) {
        $this->db->where('tel', $tel);
        $query = $this->db->get('client'); 
        return $query->row(); 
    }

    public function truncate() {
        $this->db->query('TRUNCATE client');
    }

    // Admin
    function login($email, $mdp) {
        $query = $this->db->get_where('admin', array('email' => $email, 'mdp' => $mdp));
        $user = $query->row_array();
        return $user;
    }

    // public function deleteById($id) {
    //     $this->db->where('id', $id);
    //     $this->db->delete('utilisateur');
    // }

    // function login($email, $mdp) {
    //     $query = $this->db->get_where('utilisateur', array('email' => $email, 'mdp' => $mdp));
    //     $user = $query->row_array();
    //     return $user;
    // }

    // function getAll(){
    //     $this->db->select('*');
    //     $this->db->from('utilisateur');
    //     $query = $this->db->get();
    //     $result = $query->result();
    //     return $result;
    // }
}
?>