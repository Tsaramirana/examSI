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
                    <a href="#" class="active-item2 sidebar-item">Services</a>
                    <a href="<?php echo site_url('backOffice/HoraireController'); ?>" class="sidebar-item">Date de référence</a>
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
            <div class="col-md-9" id="crud-container">
            <h1 class="title-emphase">Gestion des services</h1>
            <div class="row col-md-12">
                <!-- FORMULAIRE -->
                <div class="col-md-5"  id="crud-formulaire">
                    <form method="post" action="<?php echo site_url('backOffice/ServiceController/save'); ?>">
                    <input type="hidden" name="id" value="<?php echo isset($service) ? $service['id'] : ''; ?>">
                        <div class="form-group">
                            <label for="nom" class="p-label">Intitulé</label>
                            <input type="text" class="form-control" id="inputPassword3" name="nom"  value="<?php echo isset($service) ? $service['nom'] : ''; ?>" >
                        </div>
                        <div class="form-group">
                            <label for="duree" class="p-label">Durée</label>
                            <input type="time" class="form-control" id="inputPassword3" placeholder="(en heure)" name="duree"  value="<?php echo isset($service) ? $service['duree'] : ''; ?>" >
                        </div>
                        <div class="form-group">
                            <label for="prix" class="p-label">Tarif</label>
                            <input type="number" class="form-control" id="inputPassword3" name="prix" value="<?php echo isset($service) ? $service['prix'] : ''; ?>" >
                        </div>
                        <button type="submit" class="btn btn-default action-button"><?php echo isset($service) ? 'Modifier' : 'Ajouter'; ?></button> 
                    </form>     
                </div>

                <!-- FORMULAIRE -->
                <div class="col-md-1"></div>
                <!-- TABLE -->
                <div class="col-md-6" id="CRUD-table">
                    <table class="table table-condensed">
                        <thead>
                            <th>Intitulé</th>
                            <th>Durée (heure)</th>
                            <th>Prix</th>
                            <th></th>
                            <th></th>
                        </thead>
                        <tbody>
                            <?php foreach ($services as $service): ?>
                                <tr>
                                    <td><?php echo $service['nom']; ?></td>
                                    <td><?php echo $service['duree']; ?></td>
                                    <td><?php echo $service['prix']; ?></td>
                                    <td><a href="<?php echo site_url('backOffice/ServiceController/edit/'.$service['id']); ?>" class="btn btn-warning"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a></td>
                                    <td><a href="<?php echo site_url('backOffice/ServiceController/delete/'.$service['id']); ?>" onclick="return confirm('Are you sure you want to delete this item?');" class="btn btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <!-- TABLE -->
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
