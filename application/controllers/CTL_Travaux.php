<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CTL_Travaux extends CI_Controller {
    public function __construct() {
        parent::__construct();
		$this->load->model('MDL_Travaux');
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
        $data['travauxList'] = $this->MDL_Travaux->getAll();
        $this->myAdmin('/admin_list_travaux', $data);
    }

    public function updateForm() {
        $idst = $this->input->get('idst');
        $data['idst'] = $idst;
        $data['travaux'] = $this->MDL_Travaux->getOne($idst);
        $this->myAdmin('/admin_form_travaux_modif', $data);
    }

    public function travauxModif() {
        $idst = $this->input->post('idst');
        $code = $this->input->post('code');
        $designation = $this->input->post('designation');
        $pu = $this->input->post('pu');
        $unite = $this->input->post('unite');

        $this->MDL_Travaux->update($idst, $code, $designation, $unite, $pu);
        redirect('CTL_Travaux/');
    }

    // Import
    public function importMaisonTravaux(){
        if(isset($_FILES['file']) && $_FILES['file']['error'] == UPLOAD_ERR_OK && isset($_FILES['filemt']) && $_FILES['filemt']['error'] == UPLOAD_ERR_OK) {
            $upload_directory = 'C:/wamp64/www/Eval_Construction/csv/';
            
            $file_name = basename($_FILES['file']['name']);
            $file_name_mt = basename($_FILES['filemt']['name']);
            
            $target_path = $upload_directory . $file_name;
            $target_path_mt = $upload_directory . $file_name_mt;
            
            if(move_uploaded_file($_FILES['file']['tmp_name'], $target_path) && move_uploaded_file($_FILES['filemt']['tmp_name'], $target_path_mt)) {
                $csv_content = file_get_contents($target_path);
                $csv_content_mt = file_get_contents($target_path_mt);

                redirect('CTL_Travaux/saveMaisonTravaux/'.$_FILES['file']['name'].'/'.$_FILES['filemt']['name']);
            } else {
                echo 'Erreur';
            }
        } else {
            echo 'Aucun fichier à importer ou erreur lors du téléchargement.';
        }
    }

    // public function saveMaisonTravaux($filename, $filenamemt) {
    //     $file_path = 'C:/wamp64/www/Eval_Construction/csv/' . $filename;
    //     $filemt_path = 'C:/wamp64/www/Eval_Construction/csv/' . $filenamemt;
    //     if (($handle = fopen($file_path, 'r')) !== FALSE && ($handle_mt = fopen($filemt_path, 'r')) !== FALSE) {
    //         while (($data = fgetcsv($handle_mt, 1000, ',')) !== FALSE) {
    //             $surface = str_replace(",", ".", $data[2]);
    //             $pu = str_replace(",", ".", $data[6]);
    //             $qte = str_replace(",", ".", $data[7]);
    //             $this->MDL_Temp->saveMaisonTravaux($data[0], $data[1], $surface, $data[3], $data[4], $data[5], $pu, $qte, $data[8]);
    //         }
    //         $this->MDL_Temp->saveMaison();
    //         $this->MDL_Temp->saveTravaux();
    //         $this->MDL_Temp->saveDevisData();

    //         while (($data = fgetcsv($handle, 1000, ',')) !== FALSE) {
    //             $variable = str_replace(",", ".", str_replace("%", "", $data[4]));
    //             $this->MDL_Temp->saveDevis($data[0], $data[1], $data[2], $data[3], $variable, $data[5], $data[6], $data[7]);
    //         }
    //         $this->MDL_Temp->saveClient();
    //         $this->MDL_Temp->saveFinition();
    //         $this->MDL_Temp->saveDevisClient();

    //         fclose($handle);
    //         redirect('CTL_DevisAdmin/donneesPage');
    //     } else {
    //         echo 'Erreur lors de l\'ouverture du fichier CSV.';
    //     }
    // }

    public function saveMaisonTravaux($filename, $filenamemt) {
        $file_path = 'C:/wamp64/www/Eval_Construction/csv/' . $filename;
        $filemt_path = 'C:/wamp64/www/Eval_Construction/csv/' . $filenamemt;
        if (($handle = fopen($file_path, 'r')) !== FALSE && ($handle_mt = fopen($filemt_path, 'r')) !== FALSE) {
            $line = 1;
            $est1er = true;
            while (($data = fgetcsv($handle_mt, 1000, ',')) !== FALSE) {
                if ($est1er) {
                    $est1er = false;
                    continue;
                }
                $surface = str_replace(",", ".", $data[2]);
                $pu = str_replace(",", ".", $data[6]);
                $qte = str_replace(",", ".", $data[7]);
                if ($surface < 0) {
                    $error = "Surface invalide ligne ".$line." dans ".$filenamemt;
                    redirect('CTL_DevisAdmin/donneesPage?error='.$error);
                } elseif ($pu < 0) {
                    $error = "Prix unitaire invalide ligne ".$line." dans ".$filenamemt;
                    redirect('CTL_DevisAdmin/donneesPage?error='.$error);
                } elseif ($qte < 0) {
                    $error = "Quantite invalide ligne ".$line." dans ".$filenamemt;
                    redirect('CTL_DevisAdmin/donneesPage?error='.$error);
                } elseif ($data[8] < 0) {
                    $error = "Duree invalide ligne ".$line." dans ".$filenamemt;
                    redirect('CTL_DevisAdmin/donneesPage?error='.$error);
                } else {
                    $this->MDL_Temp->saveMaisonTravaux($data[0], $data[1], $surface, $data[3], $data[4], $data[5], $pu, $qte, $data[8]);
                }
                $line++;
            }
            $this->MDL_Temp->saveMaison();
            $this->MDL_Temp->saveTravaux();
            $this->MDL_Temp->saveDevisData();

            $line1 = 1;
            $est1ere = true;
            while (($data = fgetcsv($handle, 1000, ',')) !== FALSE) {
                if ($est1ere) {
                    $est1ere = false;
                    continue;
                }
                $variable = str_replace(",", ".", str_replace("%", "", $data[4]));
                if ($variable < 0) {
                    $error = "Taux finition invalide ligne ".$line." dans ".$filename;
                    redirect('CTL_DevisAdmin/donneesPage?error='.$error);
                }
                $this->MDL_Temp->saveDevis($data[0], $data[1], $data[2], $data[3], $variable, $data[5], $data[6], $data[7]);
                $line1++;
            }
            $this->MDL_Temp->saveClient();
            $this->MDL_Temp->saveFinition();
            $this->MDL_Temp->saveDevisClient();

            fclose($handle);
            redirect('CTL_DevisAdmin/donneesPage');
        } else {
            echo 'Erreur lors de l\'ouverture du fichier CSV.';
        }
    }

    public function importPaiement(){
        if(isset($_FILES['file']) && $_FILES['file']['error'] == UPLOAD_ERR_OK) {
            $upload_directory = 'C:/wamp64/www/Eval_Construction/csv/';
            $file_name = basename($_FILES['file']['name']);
            $target_path = $upload_directory . $file_name;
            if(move_uploaded_file($_FILES['file']['tmp_name'], $target_path)) {
                $csv_content = file_get_contents($target_path);
                redirect('CTL_Travaux/savePaiement/'.$_FILES['file']['name']);
            } else {
                echo 'Erreur';
            }
        } else {
            echo 'Aucun fichier à importer ou erreur lors du téléchargement.';
        }
    }

    // public function savePaiement($filename) {
    //     $file_path = 'C:/wamp64/www/Eval_Construction/csv/' . $filename;
    //     if (($handle = fopen($file_path, 'r')) !== FALSE) {
    //         while (($data = fgetcsv($handle, 1000, ',')) !== FALSE) {
    //             $this->MDL_Temp->savePaiement($data[0], $data[1], $data[2], $data[3]);
    //         }
    //         $this->MDL_Temp->savePaiementData();
    //         fclose($handle);
    //         redirect('CTL_DevisAdmin/paiePage');
    //     } else {
    //         echo 'Erreur lors de l\'ouverture du fichier CSV.';
    //     }
    // }

    public function savePaiement($filename) {
        $file_path = 'C:/wamp64/www/Eval_Construction/csv/' . $filename;
        if (($handle = fopen($file_path, 'r')) !== FALSE) {
            $line = 1;
            $est1er = true;
            while (($data = fgetcsv($handle, 1000, ',')) !== FALSE) {
                if ($est1er) {
                    $est1er = false;
                    continue;
                }
                if ($data[3] < 0) {
                    $error = "Montant invalide ligne ".$line." dans ".$filename;
                    redirect('CTL_DevisAdmin/paiePage?error='.$error);
                }
                $this->MDL_Temp->savePaiement($data[0], $data[1], $data[2], $data[3]);
                $line++;
            }
            $this->MDL_Temp->savePaiementData();
            fclose($handle);
            redirect('CTL_DevisAdmin/paiePage');
        } else {
            echo 'Erreur lors de l\'ouverture du fichier CSV.';
        }
    }
}
?>