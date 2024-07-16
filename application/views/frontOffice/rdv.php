<body id="accueil-body">
    <div class="container-fluid" id="accueil-container">
        <div class="row col-md-12">
            <!-- SIDEBAR -->
            <div class="col-md-2" id="sidebar">
                <div class="row col-md-12" id="logo">
                    <img src="<?php echo base_url('assets/images/logo.png'); ?>">                
                </div>
                <div class="row col-md-12" id="sidebar-buttons">
                    <a href="<?php echo site_url('Front/to_accueil_page') ?>" class="sidebar-item">Prendre rendez-vous</a>
                    <a href="#" class="active-item2 sidebar-item">Mes rendez-vous</a>
                </div>
                <div class="row col-md-12 disconnect">
                    <a href="">Déconnexion</a>
                </div>
            </div>
            <!-- SIDEBAR -->
            <div class="col-md-1"></div>
            <!-- CONTENT -->
            <div class="col-md-8" id="accueil-content">
                <div class="row col-md-12" id="text-accueil-content">
                    <h1 class="title-emphase">Liste de mes rendez-vous</h1>
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
                                        <td><button class="btn">X Annuler</button></td>
                                    </tr>
                                <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- CONTENT -->
        </div>
    </div>
