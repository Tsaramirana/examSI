<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Liste des Services</title>
</head>
<body>
    <h1>Liste des Services</h1>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Durée</th>
                <th>Prix</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($services as $service): ?>
                <tr>
                    <td><?php echo $service['id']; ?></td>
                    <td><?php echo $service['nom']; ?></td>
                    <td><?php echo $service['duree']; ?></td>
                    <td><?php echo $service['prix']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php 
        $this->load->view('template/footer.php');
    ?>
</body>
</html>
