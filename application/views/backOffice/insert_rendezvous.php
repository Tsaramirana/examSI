<!DOCTYPE html>
<html>
<head>
    <title>Insérer un Rendez-vous</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2>Insérer un Rendez-vous</h2>
        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?= $error ?></div>
        <?php endif; ?>
        <form method="post" action="<?= site_url('backOffice/RendezvousControllerInsert/insert') ?>">
            <div class="form-group">
                <label for="dateHeureDebut">Date et Heure de Début:</label>
                <input type="datetime-local" class="form-control" id="dateHeureDebut" name="dateHeureDebut" required>
            </div>
            <div class="form-group">
                <label for="idService">Service:</label>
                <select class="form-control" id="idService" name="idService" required>
                    <?php foreach ($services as $service): ?>
                        <option value="<?= $service['id'] ?>"><?= $service['nom'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <?php 
        $this->load->view('template/footer.php');
    ?><button type="submit" class="btn btn-primary">Insérer</button>
        </form>
        <a href="<?php echo site_url('backOffice/Deconnexion'); ?>">Deconnexion</a>
    </div>
    <?php 
        $this->load->view('template/footer.php');
    ?>
</body>
</html>
