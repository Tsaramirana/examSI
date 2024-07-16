<body>
    <div class="container-fluid" id="accueil-container">
        <div class="row col-md-12">
            <!-- SIDEBAR -->
            <div class="col-md-2" id="adminsidebar">
                <div class="row col-md-12" id="logo">
                    <img src="<?php echo base_url('assets/images/logo.png'); ?>">                
                </div>
                <div class="row col-md-12" id="adminsidebar-buttons">
                    <a href="<?php echo site_url() ?>" class="sidebar-item">Accueil</a>
                    <a href="#" class="sidebar-item">Services</a>
                    <a href="<?php echo site_url() ?>" class="active-item2 sidebar-item">Heure de référence</a>
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
            <div class="col-md-7" id="crud-container">
            <h1 class="title-emphase">Modification heure de référence</h1>
            <div class="row col-md-12">
                <!-- FORMULAIRE -->
                <div class="col-md-8"  id="heure-formulaire">
                    <form method="post" action="">
                        <input type="hidden" name="id" value="">
                        <div class="form-group">
                            <label for="date" class="p-label">Date actuelle</label>
                            <input type="date" class="form-control" id="inputPassword3" name="date">
                        </div>
                        <button type="submit" class="btn btn-default action-button">Valider</button> 
                    </form>     
                </div>
                <!-- FORMULAIRE -->
            </div>
            <!-- CONTENT -->
        </div>    
    </div>
