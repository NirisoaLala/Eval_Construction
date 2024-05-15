<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CTL_Paiement extends CI_Controller {
    public function __construct() {
        parent::__construct();
		$this->load->model('MDL_Paiement');
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

    public function index(){
        $iddc = $this->input->get('iddc');
        $data['iddc'] = $iddc;
        $this->myClient('/client_form_paiement', $data);
    }

    // public function payer(){
    //     $iddc = $this->input->post('iddc');
    //     $datepaie = $this->input->post('datepaie');
    //     $montant = $this->input->post('montant');

    //     $this->MDL_Paiement->save($iddc, $datepaie, $montant);
    //     redirect('CTL_DevisClient/listDevisByClient');
    // }

    public function payer(){
        $iddc = $this->input->post('iddc');
        $datepaie = $this->input->post('datepaie');
        $montant = $this->input->post('montant');

        $dc = $this->MDL_DevisClient->getDCByDC($iddc);
        $reste = $dc->reste;

        if ($montant > $reste) {
            echo json_encode(['success' => false, 'message' => 'Le montant est plus grand que le reste a paye (reste : '.$reste.')']);
        } else {
            echo json_encode(['success' => true, 'message' => 'Paiement reussi']);
            $this->MDL_Paiement->save($iddc, $datepaie, $montant);
        }   
    }
}
?>