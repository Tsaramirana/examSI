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
                    <a href="<?php echo site_url('backOffice/HoraireController'); ?>" class="sidebar-item">Date de référence</a>
                    <a href="#" class="active-item2 sidebar-item">Devis</a>
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
            <div class="col-md-9" id="crud-container">
            <h1 class="title-emphase">Gestion des services</h1>
            <div class="row col-md-12">
                <!-- TABLE -->
                <div class="col-md-10" id="long-table">
                    <table class="table table-condensed">
                        <thead>
                            <th>Matricule</th>
                            <th>Type véhicule</th>
                            <th>Type réparation</th>
                            <th>Date de paiement</th>
                            <th>Prix</th>
                            <th></th>
                        </thead>
                        <tbody>
                            <?php foreach ($devis_details as $detail): ?>
                            <tr>
                                <td><?php echo $detail['numero']; ?></td>
                                <td><?php echo $detail['type']; ?></td>
                                <td><?php echo $detail['service']; ?></td>
                                <td><?php echo $detail['dateHeureDebut']; ?></td>
                                <td><?php echo $detail['prix']; ?></td>
                                <!-- <td><button class="btn btn-success" onclick="pay(<?php echo $detail['devis_id']; ?>)"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Payer</button></td> -->
                                <td>
                                    <form action="<?php echo site_url('backOffice/devis/update'); ?>" method="post">
                                        <input type="hidden" name="devis_id" value="<?php echo $detail['devis_id']; ?>">
                                        <input type="date" name="datePayement" required>
                                        <button class="btn btn-success" type="submit"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Payer</button></button>
                                    </form>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <center><nav><ul class="pagination pagination-lg"></ul></nav></center>
                </div>
                <!-- TABLE -->

                <!-- FORMULAIRE -->
                <div class="row hidden" id="back-button-container"><button id="back-button" href="index.html">&#8592;</button></div>
                <div class="col-md-8 hidden"  id="heure-formulaire">
                    <form method="post" action="">
                        <input type="hidden" name="id" value="" id="id-input">
                        <div class="form-group">
                            <label for="date" class="p-label">Date payement</label>
                            <input type="date" class="form-control" id="inputPassword3" name="date">
                        </div>
                        <button type="submit" class="btn btn-default action-button">Valider</button> 
                    </form>     
                </div>
                <!-- FORMULAIRE -->

                </div>
            </div>
            <!-- CONTENT -->
        </div>    
    </div>
    <?php 
        $this->load->view('template/footer.php');
    ?>
</body>
</html>
