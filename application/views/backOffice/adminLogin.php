<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/bootstrap.css">
    <link rel="stylesheet" href="./assets/css/index.css">
    <link rel="stylesheet" href="./assets/css/login.css">
    <link rel="stylesheet" href="./assets/css/adminLogin.css">
    <link rel="shortcut icon" href="./assets/images/logo2.png" type="image/x-icon">
    <title>FixIT</title>
</head>
<body id="adminLogin-body">
    <div class="container-fluid">
        <!-- NAVBAR -->
        <div class="row col-md-12" id="navbar-login">
            <div class="row col-md-12" id="logo">
                <img src="<?php echo base_url('assets/images/logo.png'); ?>" alt="">
            </div>
            <div class="col-md-5" id="nav-bar-buttons">
                <ul class="nav nav-pills">
                    <li role="presentation"><a href="<?php echo site_url('welcome/index')?>" class="sidebar-item">Accueil</a></li>
                    <li role="presentation"><a href="#" class="sidebar-item">Contact</a></li>
                </ul>
            </div>
        </div>
        <!-- NAVBAR -->
    
        <div class="row col-md-12" id="login-content">
            <h1 id="content-title">Espace administrateur</h1>
            <!-- FORMULAIRE -->
            <div class="row col-md-5">
                <form action="<?php echo base_url("Back/login") ?>" method="post" id="login-form">
                    <div class="floating-label">
                        <input type="text" name="identifiant" required>
                        <label for="identifiant">Identifiant</label>
                    </div>
                    <div class="floating-label">
                        <input type="password" name="password" required>
                        <label for="password">Mot de passe</label>
                    </div>
                    <button type="submit" class="btn btn-default action-button">Se connecter</button>
                </form>
            </div>
            <!-- FORMULAIRE -->
        </div>
    </div>       
</body>
</html>