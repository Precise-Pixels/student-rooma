<!DOCTYPE HTML>
<html>
<head>
    <?php require_once('includes/head.php'); ?>
</head>
<!--
Precise Pixels | http://precisepixels.co.uk
https://github.com/Precise-Pixels/student-rooma
-->
<body class="<?= ($isAppIndex ? ' app-index' : ''); ?><?= ($isLanding ? ' landing' : ''); ?><?= ($isApp ? ' app' : ''); ?>">
    <?php if($isApp): ?>
        <div id="app-frame">
    <?php endif; ?>
    <?php require_once('includes/header.php'); ?>
    <?php require_once("views/$file.php"); ?>
    <?php require_once('includes/dialog.php'); ?>
    <?php require_once('includes/scripts.php'); ?>
    <?php if($isApp): ?>
        </div>
    <?php endif; ?>
</body>
</html>