<?php 
    $this->load->view('template/header.php');  
?> 

<body id="adminLogin-body">
    <div class="container-fluid">
        <!-- NAVBAR -->
        <div class="row col-md-12" id="navbar-login">
            <div class="row col-md-12" id="logo">
                <img src="<?php echo base_url('assets/images/logo.png'); ?>" alt="">
            </div>
            <div class="col-md-5" id="nav-bar-buttons">
                <ul class="nav nav-pills">
                    <li role="presentation"><a href="<?php echo site_url('welcome')?>" class="sidebar-item">Accueil</a></li>
                    <li role="presentation"><a href="#" class="sidebar-item">Contact</a></li>
                </ul>
            </div>
        </div>
        <!-- NAVBAR -->
    
        <div class="row col-md-12" id="login-content">
            <h1 id="content-title">Espace administrateur</h1>
            <!-- FORMULAIRE -->
            <div class="row col-md-5">
                <form action="<?php echo base_url("backOffice/Login/login") ?>" method="post" id="login-form">
                    <div class="floating-label">
                        <input type="text" name="nom" value="admin" required>
                        <label for="nom">Identifiant</label>
                    </div>
                    <div class="floating-label">
                        <input type="password" name="mot_de_passe" value="admin" required>
                        <label for="mot_de_passe">Mot de passe</label>
                    </div>
                    <button type="submit" class="btn btn-default action-button">Se connecter</button>
                </form>
            </div>
            <!-- FORMULAIRE -->
        </div>
    </div>

    <?php 
      $this->load->view('template/footer.php');  
    ?>     
     
</body>
</html>