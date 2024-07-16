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
                    <a href="<?php echo site_url() ?>" class="sidebar-item">Heure de référence</a>
                    <a href="<?php echo site_url() ?>" class="active-item2 sidebar-item">Devis</a>
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
                            <th>Date RDV</th>
                            <th>Prix</th>
                            <th></th>
                        </thead>
                        <tbody>
                            <tr>
                                <td>4231TAH</td>
                                <td>Légère</td>
                                <td>Réparation complexe</td>
                                <td>2024-07-16</td>
                                <td>800 000</td>
                                <td><button class="btn btn-success" onclick="pay(1)"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Payer</button></td>
                            </tr>
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
