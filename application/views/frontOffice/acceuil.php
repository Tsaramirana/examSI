<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/bootstrap.css">
    <link rel="stylesheet" href="../../assets/css/index.css">
    <link rel="stylesheet" href="../../assets/css/login.css">
    <link rel="stylesheet" href="../../assets/css/accueil.css">
    <link rel="shortcut icon" href="../../assets/images/logo2.png" type="image/x-icon">
    <title>FixIT</title>
</head>
<body id="accueil-body">
    <div class="container-fluid" id="accueil-container">
        <div class="row col-md-12">
            <!-- SIDEBAR -->
            <div class="col-md-2" id="sidebar">
                <div class="row col-md-12" id="logo">
                    <img src="../../assets/images/logo.png" alt="">
                </div>
                <div class="row col-md-12" id="sidebar-buttons">
                    <a href="#" class="active-item2 sidebar-item">Prendre rendez-vous</a>
                    <a href="<?php echo base_url("frontOffice/MesRendezVous") ?>" class="sidebar-item">Mes rendez-vous</a>
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
                    <h1 class="title-emphase">Rendez-vous</h1>
                    <p class="lead">Choisissez un créneau qui vous convient. Veuillez noter que la disponibilité des dates et des heures 
                        <br>peut varier en fonction de l'affluence. Nous vous notifierons si nécessaire.
                    </p>
                </div>
                <div class="row col-md-9" id="rdv-form">
                <?php if (isset($error)): ?>
                    <div class="alert alert-danger"><?= $error ?></div>
                <?php endif; ?>
                    <form action="<?php echo site_url('frontOffice/RendezvousControllerInsert/insert'); ?>" method="post">
                        <div class="form-group">
                            <div class="col-md-6">
                                <label for="date">Date</label>
                                <input type="datetime-local" name="dateHeureDebut" id="dateHeureDebut" class="form-control">    
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <label for="service">Service</label>
                                <select name="idService" id="idService" class="form-control">
                                  <?php foreach ($services as $service): ?>
                                      <option value="<?php echo $service['id']; ?>"><?php echo $service['nom']; ?></option>
                                  <?php endforeach; ?>
                                </select>    
                            </div>
                        </div>
                        <div class="col-md-12"><button type="submit" class="btn btn-default action-button">Valider</button></div>
                    </form>
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