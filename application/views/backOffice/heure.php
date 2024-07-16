<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/bootstrap.css">
    <link rel="stylesheet" href="./assets/css/index.css">
    <link rel="stylesheet" href="./assets/css/sidebar.css">
    <link rel="stylesheet" href="./assets/css/accueil.css">
    <link rel="stylesheet" href="./assets/css/rdv.css">
    <link rel="stylesheet" href="./assets/css/crud.css">
    <link rel="stylesheet" href="./assets/css/heure.css">
    <link rel="shortcut icon" href="./assets/images/logo2.png" type="image/x-icon">
    <title>FixIT</title>
</head>
<body>
    <div class="container-fluid" id="accueil-container">
        <div class="row col-md-12">
            <!-- SIDEBAR -->
            <div class="col-md-2" id="adminsidebar">
                <div class="row col-md-12" id="logo">
                    <img src="./assets/images/logo.png" alt="">
                </div>
                <div class="row col-md-12" id="adminsidebar-buttons">
                    <a href="crudService.html" class="sidebar-item">Services</a>
                    <a href="#" class="active-item2 sidebar-item">Heure de référence</a>
                    <a href="devis.html" class="sidebar-item">Devis</a>
                    <a href="rdvAdmin.html" class="sidebar-item">Liste RDV</a>
                </div>
                <div class="row col-md-12 disconnect">
                    <a href="">Déconnexion</a>
                </div>
            </div>
            <!-- SIDEBAR -->
            <div class="col-md-1"></div>

            <!-- CONTENT -->
            <div class="col-md-7" id="crud-container">
            <h1 class="title-emphase">Modification heure de référence</h1>
            <div class="row col-md-12">
                <!-- FORMULAIRE -->
                <div class="col-md-8"  id="heure-formulaire">
                    <form method="post" action="">
                        <input type="hidden" name="id" value="">
                        <div class="form-group">
                            <label for="date" class="p-label">Date actuelle</label>
                            <input type="date" class="form-control" id="inputPassword3" name="date">
                        </div>
                        <button type="submit" class="btn btn-default action-button">Valider</button> 
                    </form>     
                </div>
                <!-- FORMULAIRE -->
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