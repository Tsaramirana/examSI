<?php 
    $this->load->view('template/header.php');  
?> 
<body>

    <div class="container-fluid" id="accueil-container">
        <div class="row col-md-12">
            <!-- SIDEBAR -->
            <div class="col-md-2" id="adminsidebar">
                <div class="row col-md-12" id="logo">
                    <img src="./assets/images/logo.png" alt="">
                </div>
                <div class="row col-md-12" id="adminsidebar-buttons">
                    <a href="<?php echo site_url('backOffice/ServiceController'); ?>" class="sidebar-item">Services</a>
                    <a href="#" class="active-item2 sidebar-item">Date de référence</a>
                    <a href="<?php echo site_url('backOffice/Devis'); ?>" class="sidebar-item">Devis</a>
                    <a href="<?php echo site_url('backOffice/Calendar'); ?>" class="sidebar-item">Liste RDV</a>
                    <a href="<?php echo site_url('backOffice/DataImport'); ?>" class="active-item2 sidebar-item">Importation de données</a>
                </div>
                <div class="row col-md-12 disconnect">
                    <a href="<?php echo site_url('backOffice/Partie2/supprimer_donnees'); ?>" onclick="return confirm('Voulez-vous vraiement réinitialiser votre base de donnée? Cette action est irréversible');">Réinitialisation</a>
                    <a href="<?php echo site_url('backOffice/Deconnexion'); ?>">Déconnexion</a>
                </div>
            </div>
            <!-- SIDEBAR -->
            <div class="col-md-1"></div>

            <!-- CONTENT -->
            <div class="col-md-7" id="crud-container">
            
            <div class="row col-md-12">
                <!-- FORMULAIRE -->
                    <?php if (isset($horaire)): ?>
                        <h1 class="title-emphase">Modification de l'horaire</h1>
                        <form method="post" action="<?php echo site_url('backOffice/HoraireController/updateDebut'); ?>">
                            <input type="hidden" name="id" value="">
                            <div class="form-group">
                                <label for="debut" class="p-label">Heure d'ouverture</label>
                                <input type="time" class="form-control" id="inputPassword3" name="debut" value="<?php echo $horaire['debut']; ?>">
                            </div>
                            <button type="submit" class="btn btn-default action-button">Mettre a jour</button> 
                        </form>

                        <form method="post" action="<?php echo site_url('backOffice/HoraireController/updateFin'); ?>">
                            <input type="hidden" name="id" value="">
                            <div class="form-group">
                                <label for="fin" class="p-label">Heure de fermeture</label>
                                <input type="time" class="form-control" id="inputPassword3" name="fin" value="<?php echo $horaire['fin']; ?>" >
                            </div>
                            <button type="submit" class="btn btn-default action-button">Mettre a jour</button> 
                        </form>

                        <h1 class="title-emphase">Modification de la date de reference</h1>
                        <form method="post" action="<?php echo site_url('backOffice/HoraireController/updateDateReference'); ?>">
                            <input type="hidden" name="id" value="">
                            <div class="form-group">
                                <label for="dateReference" class="p-label">Date de Référence</label>
                                <input type="date" class="form-control" id="inputPassword3" name="dateReference" value="<?php echo $horaire['dateReference']; ?>">
                            </div>
                            <button type="submit" class="btn btn-default action-button">Mettre a jour</button> 
                        </form>

                    <?php else: ?>
                        <p>Aucun horaire trouvé.</p>
                    <?php endif; ?>
                </div>

                <!-- FORMULAIRE -->
            </div>
            <!-- CONTENT -->
        </div>    
    </div>

    <?php 
        $this->load->view('template/footer.php');
    ?>
</body>
</html>
