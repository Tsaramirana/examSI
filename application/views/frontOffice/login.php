<body id="login-body">
   <div class="container-fluid">
    <?php if (isset($error)) { ?>
        <p class="bg-danger"><?php echo $error ?></p>
    <?php } ?>
    
    <!-- NAVBAR -->
    <div class="row col-md-12" id="navbar-login">
        <div class="row col-md-12" id="logo">
            <img src="<?php echo base_url('assets/images/logo.png'); ?>">        
        </div>
        <div class="col-md-5" id="nav-bar-buttons">
            <ul class="nav nav-pills">
                <li role="presentation"><a href="<?php echo site_url('welcome/index') ?>" class="sidebar-item">Accueil</a></li>
                <li role="presentation"><a href="#" class="sidebar-item">Contact</a></li>
            </ul>
        </div>
    </div>
    <!-- NAVBAR -->

    <div class="row col-md-12" id="login-content">
        <h1 id="content-title">Accédez à nos services</h1>
        <p class="lead">Entrez ces quelques informations concernant votre véhicule.</p>
        <!-- FORMULAIRE -->
        <div class="row col-md-5">
            <form  action="<?php echo base_url("Front/login") ?>" id="login-form" method="post">
                <div class="floating-label">
                    <input type="text" name="numero" required>
                    <label for="numero">Numéro de matriculation</label>
                </div>
                <div class="floating-label">
                    <select name="type" required>
                        <option value="" disabled selected hidden></option>
                        <?php for ($i=0; $i < count($types); $i++) { ?>
                            <option value="<?php echo $types[$i]["id"] ?>"><?php echo $types[$i]["nom"] ?></option>
                        <?php } ?>
                    </select>
                    <label for="type">Type</label>
                </div>
                <button type="submit" class="btn btn-default action-button">Se connecter</button>
            </form>
        </div>
        <!-- FORMULAIRE -->
    </div>
   </div> 
