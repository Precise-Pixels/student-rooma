<?php

require('db.php');

if(preg_match('/admin\/all-properties/', $_SERVER['HTTP_REFERER'])) {
    $propertyId = $_POST['propertyId'];
    $active     = $_POST['active'];

    $sth = $dbh->prepare("UPDATE properties SET active=:active WHERE propertyId=$propertyId");
    $sth->bindParam(':active', $active);
    $sth->execute();
}