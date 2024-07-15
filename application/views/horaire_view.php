<!DOCTYPE html>
<html>
<head>
    <title>Gestion des Horaires</title>
</head>
<body>
    <h1>Gestion des Horaires</h1>

    <?php if (isset($horaire)): ?>
        <h2>Mettre à jour les horaires</h2>

        <form action="<?php echo site_url('HoraireController/updateDebut'); ?>" method="post">
            <label for="debut">Début:</label>
            <input type="time" name="debut" value="<?php echo $horaire['debut']; ?>" required>
            <button type="submit">Mettre à jour</button>
        </form>

        <form action="<?php echo site_url('HoraireController/updateFin'); ?>" method="post">
            <label for="fin">Fin:</label>
            <input type="time" name="fin" value="<?php echo $horaire['fin']; ?>" required>
            <button type="submit">Mettre à jour</button>
        </form>

        <form action="<?php echo site_url('HoraireController/updateDateReference'); ?>" method="post">
            <label for="dateReference">Date de Référence:</label>
            <input type="date" name="dateReference" value="<?php echo $horaire['dateReference']; ?>">
            <button type="submit">Mettre à jour</button>
        </form>
    <?php else: ?>
        <p>Aucun horaire trouvé.</p>
    <?php endif; ?>
</body>
</html>
