<!DOCTYPE HTML>
<html>
<head>
    <?php require_once('includes/head.php'); ?>
</head>
<!--
Precise Pixels | http://precisepixels.co.uk
https://github.com/Precise-Pixels/student-rooma
-->
<body<?= ($isAppIndex ? ' class="app-index"' : ''); ?><?= ($isLanding ? ' class="landing"' : ''); ?>>
    <?php require_once('includes/header.php'); ?>
    <?php require_once("views/$file.php"); ?>
    <?php require_once('includes/dialog.php'); ?>
    <?php require_once('includes/scripts.php'); ?>
</body>
</html>