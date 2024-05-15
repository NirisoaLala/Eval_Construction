<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CTL_DevisAdmin extends CI_Controller {
    public function __construct() {
        parent::__construct();
		$this->load->model('MDL_DevisClient');
        $this->load->library('session');
    }

    // Admin
    public function myAdmin($page, $data){
        if (isset($_SESSION['admin'])) {
            $content = array('page' => $page, 'data' => $data);
            $this->load->view('inc/page_admin', $content);
        } else {
            redirect('welcome');
        }
    }

    // Client
    public function myClient($page, $data){
        if (isset($_SESSION['client'])) {
            $content = array('page' => $page, 'data' => $data);
            $this->load->view('inc/page_client', $content);
        } else {
            redirect('welcome');
        }
    }

    public function listDevis() {
        $data['devisList'] = $this->MDL_DevisClient->getDCList();
        $this->myAdmin('/admin_list_devis', $data);
    }

    public function detailsDevis() {
        $iddc = $this->input->get('iddc');
        $data['detailsList'] = $this->MDL_DevisClient->getDCDetails($iddc);
        // $data['sumList'] = $this->MDL_DevisClient->getSumTrav($iddc);
        $data['dcList'] = $this->MDL_DevisClient->getDC($iddc);
        $this->myAdmin('/admin_list_devis_details', $data);
    }

    public function dashboard() {
        // $data['dashList'] = $this->MDL_DevisClient->getDashboardByYear(2024);
        $data['montant'] = $this->MDL_DevisClient->getMontantTotal();
        $data['paiement'] = $this->MDL_DevisClient->getPaiementTotal();
        $this->myAdmin('/admin_dashboard', $data);
    }

    public function getDash() {
        $annee = $this->input->post('annee');
        $data['dashList'] = $this->MDL_DevisClient->getDashboardByYear($annee);
        $data['montant'] = $this->MDL_DevisClient->getMontantTotal();
        $data['paiement'] = $this->MDL_DevisClient->getPaiementTotal();
        $this->myAdmin('/admin_dashboard', $data);
    }

    // Import
    public function donneesPage() {
        $this->myAdmin('/admin_form_import_donnees', array());
    }
    
    public function paiePage() {
        $this->myAdmin('/admin_form_import_paiement', array());
    }
}
