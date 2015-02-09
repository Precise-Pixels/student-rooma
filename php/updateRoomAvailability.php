<?php

require('db.php');

if(preg_match('/landlord|admin\/update-room-availability/', $_SERVER['HTTP_REFERER'])) {
    $roomId       = $_POST['roomId'];
    $availability = $_POST['availability'];

    $sth = $dbh->prepare("UPDATE rooms SET availability=:availability WHERE roomId=$roomId");
    $sth->bindParam(':availability', $availability);
    $sth->execute();
}