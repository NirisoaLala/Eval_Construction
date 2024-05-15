<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CTL_DevisClient extends CI_Controller {
    public function __construct() {
        parent::__construct();
		$this->load->model('MDL_DevisClient');
        $this->load->model('MDL_Finition');
        $this->load->model('MDL_Maison');
        $this->load->model('MDL_TravauxClient'); 
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

    public function index() {
        $data['maisonList'] = $this->MDL_Maison->getAll();
        // $data['maisonList'] = $this->MDL_Maison->getMaison();
        $data['finitionList'] = $this->MDL_Finition->getAll();
        $this->myClient('/client_form_devis', $data);
    }

    public function devisClient() {
        $idclient = $_SESSION['client']['id'];
        $idmaison = $this->input->post('maison');
        $idfinition = $this->input->post('finition');
        $datecreation = $this->input->post('datecreation');
        $datedebut = $this->input->post('datedebut');
        $lieu = $this->input->post('lieu');

        $maison = $this->MDL_Maison->getOne($idmaison);
        $finition = $this->MDL_Finition->getOne($idfinition);

        $debut = strtotime($datedebut);
        $fin = strtotime("+{$maison->duree} days", $debut);
        $datefin = date('Y-m-d', $fin);

        $dc = $this->MDL_DevisClient->save($idclient, $idmaison, $idfinition, $datecreation, $datedebut, $datefin, $finition->pourcentage, $lieu);

        $dclist = $this->MDL_DevisClient->getDetailsByDC($dc->id);
        foreach ($dclist as $row) {
            $this->MDL_TravauxClient->save($row->id, $row->idst, $row->pu, $row->qte);
        }
        redirect('CTL_DevisClient/');
    }

    public function listDevisByClient() {
        $idclient = $_SESSION['client']['id'];
        $data['devisList'] = $this->MDL_DevisClient->getDCByClient($idclient);
        $this->myClient('/client_list_devis', $data);
    }

    public function detailsDevis() {
        $iddc = $this->input->get('iddc');
        $data['detailsList'] = $this->MDL_DevisClient->getDCDetails($iddc);
        $data['dcList'] = $this->MDL_DevisClient->getDC($iddc);
        // $data['sumList'] = $this->MDL_DevisClient->getSumTrav($iddc);
        $this->myClient('/client_list_devis_details2', $data);
    }

    public function exportPDF() {
        $iddc = $this->input->get('iddc');
        $donnees = $this->MDL_DevisClient->getDCDetails($iddc);
        $donnees1= json_encode($donnees);
        // $data = $this->MDL_DevisClient->getDC($iddc);
        $data = $this->MDL_DevisClient->getDCByDC($iddc);
        $this->load->library('Devis');
        // $devislist = json_decode($this->input->post('devis'), true);
        $devislist = json_decode($donnees1, true);
        $header = array('Code', 'Designation', 'Prix Unitaire', 'Quantite', 'Montant');
        $pdf = new Devis();
        $pdf->AddPage();
        $pdf->table_livraison($header, $devislist, $data);
        $pdf->Output();
    }
    
}
