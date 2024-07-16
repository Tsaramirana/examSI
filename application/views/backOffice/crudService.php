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
                    <a href="heure.html" class="sidebar-item">Heure de référence</a>
                    <a href="devis.html" class="sidebar-item">Devis</a>
                    <a href="devis.html" class="sidebar-item">Liste RDV</a>
                </div>
                <div class="row col-md-12 disconnect">
                    <a href="">Déconnexion</a>
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
                    <form method="post" action="">
                        <input type="hidden" name="id" value="">
                        <div class="form-group">
                            <label for="intitule" class="p-label">Intitulé</label>
                            <input type="text" class="form-control" id="inputPassword3" name="intitule">
                        </div>
                        <div class="form-group">
                            <label for="duree" class="p-label">Durée</label>
                            <input type="number" class="form-control" id="inputPassword3" placeholder="(en heure)" name="duree">
                        </div>
                        <div class="form-group">
                            <label for="prix" class="p-label">Tarif</label>
                            <input type="number" class="form-control" id="inputPassword3" name="prix">
                        </div>
                        <button type="submit" class="btn btn-default action-button">Valider</button> 
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
                            <tr>
                                <td>Réparation simple</td>
                                <td>1</td>
                                <td>150 000</td>
                            </tr>
                            <?php foreach ($services as $service): ?>
                                <tr>
                                    <td><?php echo $service['id']; ?></td>
                                    <td><?php echo $service['nom']; ?></td>
                                    <td><?php echo $service['duree']; ?></td>
                                    <td><?php echo $service['prix']; ?></td>
                                    <td>
                                        <td><a href="<?php echo site_url('Back/editService/'.$service['id']); ?>" class="btn btn-warning"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a></td>
                                        <td><a href="<?php echo site_url('Back/deleteService/'.$service['id']); ?>" onclick="return confirm('Are you sure you want to delete this item?');" class="btn btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a></td>
                                    </td>
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
    <script src="./assets/js/jquery.min.js"></script>
    <script src="./assets/js/bootstrap.js"></script>
    <script src="./assets/js/sidebar.js"></script>
    <script src="./assets/js/npm.js"></script>
</body>
</html>