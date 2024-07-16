<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Liste des Devis</title>
</head>
<body>
    <h1>Liste des Devis</h1>
    <table border=1>
        <thead>
            <tr>
                <th>ID Devis</th>
                <th>Date de Payement</th>
                <th>ID Rendez-Vous</th>
                <th>Date Heure Début</th>
                <th>ID Service</th>
                <th>ID Voiture</th>
                <th>ID Slot</th>
                <th>Modifier</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($devis_details as $detail): ?>
            <tr>
                <td><?php echo $detail['devis_id']; ?></td>
                <td><?php echo $detail['datePayement']; ?></td>
                <td><?php echo $detail['rendezvous_id']; ?></td>
                <td><?php echo $detail['dateHeureDebut']; ?></td>
                <td><?php echo $detail['idService']; ?></td>
                <td><?php echo $detail['idVoiture']; ?></td>
                <td><?php echo $detail['idSlot']; ?></td>
                <td>
                    <form action="<?php echo site_url('backOffice/devis/update'); ?>" method="post">
                        <input type="hidden" name="devis_id" value="<?php echo $detail['devis_id']; ?>">
                        <input type="date" name="datePayement" required>
                        <button type="submit">Mettre à jour</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
        
    </table>
    <a href="<?php echo site_url('backOffice/ServiceController'); ?>">Retour</a>
    <a href="<?php echo site_url('backOffice/Deconnexion'); ?>">Deconnexion</a>

    <?php 
        $this->load->view('template/footer.php');
    ?>
</body>
</html>
