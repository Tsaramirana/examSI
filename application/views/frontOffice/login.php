<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
  <?php if (isset($error)) { ?>
    <p><?php echo $error ?></p>
  <?php } ?>

  <form action="<?php echo base_url("frontOffice/Login/login") ?>">
    <input type="text" name="numero" id="">
    <select name="type" id="">
      <?php for ($i=0; $i < count($types); $i++) { ?>
        <option value="<?php echo $types[$i]["id"] ?>"><?php echo $types[$i]["nom"] ?></option>
      <?php } ?>
    </select>
    <input type="submit" value="Go">
  </form>
</body>
</html> -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/bootstrap.css">
    <link rel="stylesheet" href="../../assets/css/index.css">
    <link rel="stylesheet" href="../../assets/css/login.css">
    <link rel="shortcut icon" href="../../assets/images/logo2.png" type="image/x-icon">
    <title>FixIT</title>
</head>
<body id="login-body">
   <div class="container-fluid">
    <!-- NAVBAR -->
    <div class="row col-md-12" id="navbar-login">
        <div class="row col-md-12" id="logo">
            <img src="../../assets/images/logo.png" alt="">
        </div>
        <div class="col-md-5" id="nav-bar-buttons">
            <ul class="nav nav-pills">
                <li role="presentation"><a href="<?php echo site_url('Welcome'); ?>" class="sidebar-item">Accueil</a></li>
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
            <form action="<?php echo base_url("frontOffice/Login/login") ?>" id="login-form">
                <?php if (isset($error)) { ?>
                  <p><?php echo $error ?></p>
                <?php } ?>
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
    <?php 
        $this->load->view('template/footer.php');
    ?>
</body>
</html>