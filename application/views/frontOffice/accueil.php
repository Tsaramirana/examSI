<body id="accueil-body">
    <div class="container-fluid" id="accueil-container">
        <div class="row col-md-12">
            <!-- SIDEBAR -->
            <div class="col-md-2" id="sidebar">
                <div class="row col-md-12" id="logo">
                    <img src="<?php echo base_url('assets/images/logo.png'); ?>">                
                </div>
                <div class="row col-md-12" id="sidebar-buttons">
                    <a href="<?php echo site_url('Front/to_accueil_page')?>" class="active-item2 sidebar-item">Prendre rendez-vous</a>
                    <a href="<?php echo site_url('Front/to_list_rdv')?>" class="sidebar-item">Mes rendez-vous</a>
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
                    <?php if (isset($error)) { ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo $error; ?>
                        </div>
                    <?php } ?>
                    <h1 class="title-emphase">Rendez-vous</h1>
                    <p class="lead">Choisissez un créneau qui vous convient. Veuillez noter que la disponibilité des dates et des heures 
                        <br>peut varier en fonction de l'affluence. Nous vous notifierons si nécessaire.
                    </p>
                </div>
                <div class="row col-md-9" id="rdv-form">
                    <form action="<?php echo site_url('Front/reserve')?>" method="post">
                        <div class="form-group">
                            <div class="col-md-6">
                                <label for="date">Date</label>
                                <input type="date" name="date" id="" class="form-control">    
                            </div>
                            <div class="col-md-6">
                                <label for="heure">Heure</label>
                                <input type="time" name="heure" id="" class="form-control">    
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <label for="service">Service</label>
                                <select name="service" id="" class="form-control">
                                <?php for ($i=0; $i < count($service); $i++) { ?>
                                    <option value="<?php echo $service[$i]["id"] ?>">
                                        <?php echo $service[$i]["nom"] ?>
                                    </option>
                                <?php } ?>
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
