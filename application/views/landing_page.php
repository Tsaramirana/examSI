<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/bootstrap.css">
    <link rel="stylesheet" href="./assets/css/index.css">
    <link rel="shortcut icon" href="./assets/images/logo2.png" type="image/x-icon">
    <title>FixIT</title>
</head>
<body id="index-body">
   <div class="container-fluid">
    <!-- NAVBAR -->
    <div class="row col-md-12" id="navbar">
        <div class="col-md-7" id="logo">
            <img src="./assets/images/logo.png" alt="" width="200px">
        </div>
        <div class="col-md-5" id="nav-bar-buttons">
            <ul class="nav nav-pills">
                <li role="presentation" class="active-item"><a href="#">Accueil</a></li>
                <li role="presentation"><a href="#">A propos</a></li>
                <li role="presentation"><a href="#">Contact</a></li>
                <li role="presentation" class="emphase"><a href="<?php echo base_url("backOffice/Login/to_login_page") ?>">Administrateur</a></li>
            </ul>
        </div>
    </div>
    <!-- NAVBAR -->

    <!-- MAIN CONTENT -->
    <div class="row col-md-12" id="content">
        <!-- LEFT -->
        <div class="col-md-6" id="left">
            <div class="row" id="content-text">
                <h1 class="col-md-12" id="content-title">Confiez votre véhicule <br>à des professionnels</h1>
                <p class="col-md-8 random-text lead">Lorem ipsum dolor sit amet consectetur adipisicing elit.Natus quas, pariatur iusto voluptatibus quo quia non? Ea eligendi atque, cumque vero voluptatum amet dignissimos, asperiores maiores doloremque dolorum expedita temporibus?</p>
            </div>
            <div class="row col-md-12" id="content-button">
                <a href="<?php echo base_url("frontOffice/Login/to_login_page") ?>" class="btn btn-default action-button">Prendre rendez-vous</a>
            </div>
            <div class="row col-md-12" id="statistiques">
                <div class="item1 statistiques-item">
                    <h1 class="intrigue">15</h1>
                    <p>ans d'expérience</p>
                </div>
                <div class="item2 statistiques-item">
                    <h1 class="intrigue">+25</h1>
                    <p>professionnels</p>
                </div>
                <div class="item3 statistiques-item">
                    <h1 class="intrigue">95%</h1>
                    <p>satisfaction client</p>
                </div>
            </div>
        </div>
        <!-- LEFT -->

        <!-- RIGHT -->
        <div class="col-md-6" id="right">
            <div class="row col-md-12">
                <img src="./assets/images/index-right.png" alt="" id="image-right">
            </div>
        </div>
        <!-- RIGHT -->
    </div>
    <!-- MAIN CONTENT -->
   </div> 
</body>
</html>