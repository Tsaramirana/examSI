<!DOCTYPE html>
<html>
<head>
    <title>Service Management</title>
</head>
<body>
    <h1>Service Management</h1>

    <!-- Formulaire d'insertion/modification -->
    <h2><?php echo isset($service) ? 'Modifier Service' : 'Ajouter Service'; ?></h2>
    <form action="<?php echo site_url('ServiceController/save'); ?>" method="post">
        <input type="hidden" name="id" value="<?php echo isset($service) ? $service['id'] : ''; ?>">
        <label for="nom">Nom:</label>
        <input type="text" name="nom" value="<?php echo isset($service) ? $service['nom'] : ''; ?>" required>
        <br>
        <label for="duree">Durée:</label>
        <input type="time" name="duree" value="<?php echo isset($service) ? $service['duree'] : ''; ?>" required>
        <br>
        <label for="prix">Prix:</label>
        <input type="number" step="0.01" name="prix" value="<?php echo isset($service) ? $service['prix'] : ''; ?>" required>
        <br>
        <button type="submit"><?php echo isset($service) ? 'Modifier' : 'Ajouter'; ?></button>
    </form>

    <!-- Liste des services -->
    <h2>Liste des Services</h2>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Durée</th>
                <th>Prix</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($services as $service): ?>
            <tr>
                <td><?php echo $service['id']; ?></td>
                <td><?php echo $service['nom']; ?></td>
                <td><?php echo $service['duree']; ?></td>
                <td><?php echo $service['prix']; ?></td>
                <td>
                    <a href="<?php echo site_url('ServiceController/edit/'.$service['id']); ?>">Modifier</a>
                    <a href="<?php echo site_url('ServiceController/delete/'.$service['id']); ?>" onclick="return confirm('Are you sure you want to delete this item?');">Supprimer</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
