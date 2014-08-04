<?php

require('db.php');

$roomId       = $_POST['roomId'];
$availability = $_POST['availability'];

$sth = $dbh->prepare("UPDATE rooms SET availability=:availability WHERE roomId=$roomId");
$sth->bindParam(':availability', $availability);
$sth->execute();