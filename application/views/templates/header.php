<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta http­‐equiv="Content­‐Type" content="text/html; harset=UTF­‐8"/>
    <?php 
        for($i=0;$i < count($css);$i++) { ?>
            <link href="<?php echo base_url('assets/css/'.$css[$i]); ?>" rel="stylesheet" type="text/css" media="screen"/>
    <?php } ?>
    <link rel="shortcut icon" href="<?php echo base_url('assets/images/logo2.png'); ?>" type="image/x-icon">
    <title>FixIT</title>
</head>
