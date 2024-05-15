<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MDL_Paiement extends CI_Model {
    function save($iddc, $datepaie, $montant) {
        $sql = "insert into paiement(iddc, datepaie, montant)  values (%s, %s, %s) ";
        $sql = sprintf($sql,$this->db->escape($iddc), $this->db->escape($datepaie),$this->db->escape($montant));
        $this->db->query($sql);
    }
}
?>