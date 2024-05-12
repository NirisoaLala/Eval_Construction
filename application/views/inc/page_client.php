<?php 
    $this->load->view('inc/header');

    $this->load->view('inc/menu_client');

    $this->load->view('pages/'.$page,$data);

    $this->load->view('inc/footer');

?>