<body>
    <div class="container-fluid" id="accueil-container">
        <div class="row col-md-12">
            <!-- SIDEBAR -->
            <div class="col-md-2" id="adminsidebar">
                <div class="row col-md-12" id="logo">
                    <img src="<?php echo base_url('assets/images/logo.png'); ?>">                
                </div>
                <div class="row col-md-12" id="adminsidebar-buttons">
                    <a href="<?php echo site_url() ?>" class="active-item2 sidebar-item">Accueil</a>
                    <a href="<?php echo site_url() ?>" class="sidebar-item">Services</a>
                    <a href="<?php echo site_url() ?>" class="sidebar-item">Heure de référence</a>
                    <a href="<?php echo site_url() ?>" class="sidebar-item">Devis</a>
                    <a href="<?php echo site_url() ?>" class="sidebar-item">Liste RDV</a>
                    <a href="<?php echo site_url() ?>" class="sidebar-item">Importation de données</a>
                    <a href="<?php echo site_url() ?>" class="sidebar-item">Gestion des slots</a>

                </div>
                <div class="row col-md-12 admin-disconnect">
                    <a href="<?php echo site_url() ?>" onclick="return confirm('Voulez-vous vraiement réinitialiser votre base de donnée? Cette action est irréversible');">Réinitialisation</a>
                    <a href="<?php echo site_url() ?>">Déconnexion</a>
                </div>
            </div>
            <!-- SIDEBAR -->
            <div class="col-md-1"></div>

            <!-- CONTENT -->
            <div class="col-md-9" id="accueil-content">
                <div class="row col-md-12" id="text-accueil-content">
                    <h1 class="title-emphase">Tableau de bord</h1>
                </div>
                <div class="row col-md-12" id="dashboard">
                    <!-- STAT 1 -->
                    <div class="row col-md-12" id="statistics1">
                        <div class="col-md-4" id="turnover-container">
                            <h6>Chiffre d'affaire du jour</h6>
                            <h1>15 000 000</h1>
                            <p>MGA</p>
                        </div>
                        <div class="col-md-7" id="graphics">
                            <h6>Graphic des payés et impayés</h6>
                            <div class="graphics-content"></div>
                        </div>
                    </div>

                    <!-- STAT 2 -->
                    <div class="row col-md-12" id="statistics2">
                        <div id="stat21" class="stat2-items">
                            <!-- REDIRIGER VERS statDetails -->
                            <h6><a href="<?php echo site_url() ?>" style="text-decoration: none; color: white">Légère </a></h6>
                            <h2>2 000 000</h2>
                            <p>MGA</p>
                        </div>
                        <div id="stat22" class="stat2-items">
                            <h6><a href="<?php echo site_url() ?>" style="text-decoration: none; color: white">4X4 </a></h6>
                            <h2>12 000 000</h2>
                            <p>MGA</p>
                        </div>
                        <div id="stat23" class="stat2-items">
                            <h6><a href="<?php echo site_url() ?>" style="text-decoration: none; color: white">utilitaire </a></h6>
                            <h2>1 000 000</h2>
                            <p>MGA</p>
                        </div>
                    </div>

                    <!-- STAT 3 -->
                    <div class="row col-md-12" id="statistics3">
                        <div class="row col-md-12">
                            <div class="row col-md-12">
                                <h6>Nombre de voitures journalière</h6>
                            </div>
                            <div class="col-md-12 row">
                                <form class="form-inline" action="" id="dashboard-form">
                                    <div class="form-group">
                                        <input type="date" class="form-control" name="date-min">
                                        <input type="date" class="form-control" name="date-max">
                                        <button type="submit" class="btn action-button">Filter</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="row col-md-12">
                            <table class="table" id="long-table">
                                <thead>
                                    <th>#</th>
                                    <th>Date RDV</th>
                                    <th>Nombre de voitures</th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>2024-05-09</td>
                                        <td>12</td>
                                    </tr>
                                </tbody>
                            </table>
                            <center><nav><ul class="pagination pagination-lg"></ul></nav></center>        
                        </div>
                    </div>
                </div>
            </div>
            <!-- CONTENT -->
        </div>
</div>
