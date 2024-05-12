<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CTL_User extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

    public function __construct() {
        parent::__construct();
		$this->load->model('MDL_User'); 
        $this->load->library('session');
    }

	public function maVue($page, $data){
        if (isset($_SESSION['user'])) {
            $office = $_SESSION['user']['office'];
            $content = array('page' => $page, 'data' => $data);
            if($office == 5){
                $this->load->view('inc/page_client', $content);
            }
            $this->load->view('inc/page_admin', $content);
        } else {
            redirect('CTL_User/');
        }
    }

	public function index() { 
		$this->load->view('login');	
	}	
	
	public function login(){
        $email = $this->input->post('email');
        $mdp = $this->input->post('mdp');
        $user = $this->MDL_User->login($email, $mdp);
        
        if ($user){
            $this->session->set_userdata('user', $user);
            redirect('CTL_User/accueil');
            return;
        }
        else{
			$this->session->set_flashdata('error', 'Email ou mot de passe incorrect');
            $this->load->view('login');
        }   
    }

	public function deconnexion()	{
        $this->session->unset_userdata('user');
        redirect('CTL_User/');
    }		

	public function accueil() {
		$this->maVue('/form_reinit', array());
	}

    public function reinitialiser() {
        $this->MDL_User->truncate();
		redirect('CTL_User/accueil');
	}
}
