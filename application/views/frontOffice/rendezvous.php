<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FixIT</title>
    <link rel="stylesheet" href="<?php echo base_url("/assets/css/bootstrap.css") ?>">
    <link rel="stylesheet" href="<?php echo base_url("/assets/css/index.css") ?>">
    <link rel="stylesheet" href="<?php echo base_url("/assets/css/login.css") ?>">
    <link rel="stylesheet" href="<?php echo base_url("/assets/css/accueil.css") ?>">
    <link rel="stylesheet" href="<?php echo base_url("/assets/css/rdv.css") ?>">
    <link rel="shortcut icon" href="<?php echo base_url("/assets/images/logo2.png") ?>" type="image/x-icon">
</head>
<body id="accueil-body">
    <div class="container-fluid" id="accueil-container">
        <div class="row col-md-12">
            <!-- SIDEBAR -->
            <div class="col-md-2" id="sidebar">
                <div class="row col-md-12" id="logo">
                    <img src="<?php echo base_url("/assets/images/logo.png") ?>" alt="">
                </div>
                <div class="row col-md-12" id="sidebar-buttons">
                    <a href="<?php echo base_url("frontOffice/Acceuil/to_acceuil_page") ?>" class="sidebar-item">Prendre rendez-vous</a>
                    <a href="#" class="active-item2 sidebar-item">Mes rendez-vous</a>
                </div>
                <div class="row col-md-12 disconnect">
                    <a href="<?php echo base_url("frontOffice/Deconnexion") ?>">Déconnexion</a>
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
                            <th>Date et heure</th>
                        </thead>

                        <tbody>
                            <?php foreach($rendezVous as $rdv): ?>
                            <tr>
                                <td><?php echo $rdv['service_nom']; ?></td>
                                <td><?php echo $rdv['dateHeureDebut']; ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- CONTENT -->
        </div>
    </div>
</body>
</html>