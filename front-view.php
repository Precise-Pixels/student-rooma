<!DOCTYPE HTML>
<html>
<head>
    <?php require_once('includes/head.php'); ?>
</head>
<body<?= ($isIndex ? ' class="index"' : ''); ?>>
    <?php require_once('includes/header.php'); ?>
    <?php require_once("views/$file.php"); ?>
    <?php require_once('includes/dialog.php'); ?>
    <?php require_once('includes/scripts.php'); ?>
</body>
</html>