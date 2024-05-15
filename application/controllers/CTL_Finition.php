<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CTL_Finition extends CI_Controller {
    public function __construct() {
        parent::__construct();
		$this->load->model('MDL_Finition');
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
        $data['finitionList'] = $this->MDL_Finition->getAll();
        $this->myAdmin('/admin_list_finition', $data);
    }

    public function updateForm() {
        $idf = $this->input->get('idf');
        $data['idf'] = $idf;
        $data['finition'] = $this->MDL_Finition->getOne($idf);
        $this->myAdmin('/admin_form_finition_modif', $data);
    }

    public function finitionModif() {
        $idf = $this->input->post('idf');
        $pourcentage = $this->input->post('pourcentage');

        $this->MDL_Finition->update($idf, $pourcentage);
        redirect('CTL_Finition/');
    }
}
?>