<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CTL_User extends CI_Controller {
    public function __construct() {
        parent::__construct();
		$this->load->model('MDL_User');
        $this->load->model('MDL_Temp');
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

	public function indexAdmin() { 
		$this->load->view('login');	
	}	
	
	public function login(){
        $email = $this->input->post('email');
        $mdp = $this->input->post('mdp');
        $user = $this->MDL_User->login($email, $mdp);
        
        if ($user){
            $this->session->set_userdata('admin', $user);
            redirect('CTL_DevisAdmin/dashboard');
            return;
        }
        else{
			$this->session->set_flashdata('error', 'Email ou mot de passe incorrect');
            $this->load->view('login');
        }   
    }

    public function deconnexionAdmin()	{
        $this->session->unset_userdata('admin');
        redirect('CTL_User/indexAdmin');
    }

    public function reinit() {
		$this->myAdmin('/form_reinit', array());
	}

    public function reinitialiser() {
        $this->MDL_Temp->truncate();
		redirect('CTL_User/reinit');
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
		$this->load->view('login_client');	
	}	
	
	public function loginClient(){
        $tel = $this->input->post('tel');
        $user = $this->MDL_User->loginClient($tel);
        
        if ($user){
            $this->session->set_userdata('client', $user);
            redirect('CTL_DevisClient/listDevisByClient');
            return;
        }
        else{
            $client = $this->MDL_User->saveClient($tel);
            $this->session->set_userdata('client', $client);
            redirect('CTL_DevisClient/');
            return;
        }   
    }

	public function deconnexionClient()	{
        $this->session->unset_userdata('client');
        redirect('CTL_User/index');
    }		
}
