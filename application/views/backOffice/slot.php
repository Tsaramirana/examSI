<body id="accueil-body">
    <div class="container-fluid" id="accueil-container">
        <div class="row col-md-12">
            <!-- SIDEBAR -->
            <div class="col-md-2" id="adminsidebar">
                <div class="row col-md-12" id="logo">
                    <img src="<?php echo base_url('assets/images/logo.png'); ?>">                
                </div>
                <div class="row col-md-12" id="adminsidebar-buttons">
                    <a href="<?php echo site_url() ?>" class="sidebar-item">Accueil</a>
                    <a href="<?php echo site_url() ?>" class="sidebar-item">Services</a>
                    <a href="<?php echo site_url() ?>" class="sidebar-item">Heure de référence</a>
                    <a href="<?php echo site_url() ?>" class="sidebar-item">Devis</a>
                    <a href="<?php echo site_url() ?>" class="sidebar-item">Liste RDV</a>
                    <a href="<?php echo site_url() ?>" class="sidebar-item">Importation de données</a>
                    <a href="<?php echo site_url() ?>" class="active-item2 sidebar-item">Gestion des slots</a>
                </div>
                <div class="row col-md-12 admin-disconnect">
                    <a href="<?php echo site_url() ?>" onclick="return confirm('Voulez-vous vraiement réinitialiser votre base de donnée? Cette action est irréversible');">Réinitialisation</a>
                    <a href="<?php echo site_url() ?>">Déconnexion</a>
                </div>
            </div>
            <!-- SIDEBAR -->

            <div class="col-md-1"></div>
            <!-- CONTENT -->
            <div class="col-md-8" id="accueil-content">
                <div class="row col-md-12" id="text-accueil-content">
                    <h1 class="title-emphase">Occupation des slots</h1>
                </div>
                <div class="row col-md-12" id="rdv-table">
                    <table class="table table-condensed">
                        <thead>
                            <th>Nom</th>
                            <th>Type véhicule</th>
                            <th>Date et heure</th>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- CONTENT -->
        </div>
    </div>
