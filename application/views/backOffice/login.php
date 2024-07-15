<!DOCTYPE html>
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

  <form action="<?php echo base_url("backOffice/Login/login") ?>">
    <input type="text" name="nom" value="admin">
    <input type="password" name="mot_de_passe" value="admin">
    <input type="submit" value="Go">
  </form>
</body>
</html>