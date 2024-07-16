<?php 
    $this->load->view("templates/header");
    if (isset($resultat)){
        $data['resultat'] = $resultat;
        $this->load->view($contents, $data); 
    }
    else {
        $this->load->view($contents);
    }
    $this->load->view("templates/footer");
?>
