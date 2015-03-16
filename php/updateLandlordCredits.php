<?php

require('db.php');

if(preg_match('/admin\/landlord-credits/', $_SERVER['HTTP_REFERER'])) {
    $landlordId = $_POST['landlordId'];
    $credits    = $_POST['credits'];

    $sth = $dbh->prepare("UPDATE landlords SET credits=:credits WHERE landlordId=$landlordId");
    $sth->bindParam(':credits', $credits);
    $sth->execute();
}