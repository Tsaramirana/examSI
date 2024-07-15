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
</html>