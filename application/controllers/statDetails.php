<body id="accueil-body">
    <div class="container-fluid" id="accueil-container">
        <div class="row col-md-12">
            <!-- SIDEBAR -->
            <div class="col-md-2" id="adminsidebar">
                <div class="row col-md-12" id="logo">
                    <img src="<?php echo base_url('assets/images/logo.png'); ?>">                
                </div>
                <div class="row col-md-12" id="adminsidebar-buttons">
                    <a href="<?php echo site_url() ?>" class="active-item2 sidebar-item">Accueil</a>
                    <a href="#" class="sidebar-item">Services</a>
                    <a href="<?php echo site_url() ?>" class="sidebar-item">Heure de référence</a>
                    <a href="<?php echo site_url() ?>" class="sidebar-item">Devis</a>
                    <a href="<?php echo site_url() ?>" class="sidebar-item">Liste RDV</a>
                    <a href="<?php echo site_url() ?>" class="sidebar-item">Importation de données</a>
                    <a href="<?php echo site_url() ?>" class="sidebar-item">Gestion des slots</a>
                </div>
                <div class="row col-md-12 admin-disconnec">
                    <a href="" onclick="return confirm('Voulez-vous vraiement réinitialiser votre base de donnée? Cette action est irréversible');">Réinitialisation</a>
                    <a href="">Déconnexion</a>
                </div>
            </div>
            <!-- SIDEBAR -->
            <div class="col-md-1"></div>
            <!-- CONTENT -->
            <div class="col-md-8" id="accueil-content">
                <div class="row col-md-12" id="text-accueil-content">
                    <h1 class="title-emphase">Détails <strong>4X4</strong></h1>
                </div>
                <div class="row col-md-12" id="rdv-table">
                    <table class="table table-condensed">
                        <thead>
                            <th>Service</th>
                            <th>Date RDV</th>
                            <th>Prix</th>
                            <th></th>
                        </thead>
                        <tbody>
                            <?php 
                                for ($i=0; $i < count($list); $i++) { ?> 
                                    <tr>
                                        <td><?php echo $list['service'] ?></td>
                                        <td><?php echo $list['dateHeureDebut'] ?></td>
                                        <td><?php echo $list['prix'] ?></td>
                                    </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- CONTENT -->
        </div>
    </div>
