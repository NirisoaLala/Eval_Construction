<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MDL_TravauxClient extends CI_Model {
    function save($iddc, $idst, $pu, $qte) {
        $sql = "insert into travaux_client(iddc, idst, pu, qte)  values (%s, %s, %s, %s) ";
        $sql = sprintf($sql,$this->db->escape($iddc), $this->db->escape($idst), $this->db->escape($pu), $this->db->escape($qte));
        $this->db->query($sql);
    }

}
?>