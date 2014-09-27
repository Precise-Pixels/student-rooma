<?php

require('db.php');

if(preg_match('/admin\/delete-property/', $_SERVER['HTTP_REFERER'])) {
    $propertyId = $_POST['propertyId'];

    $sth = $dbh->prepare("DELETE FROM properties WHERE propertyId=:propertyId");
    $sth->bindParam(':propertyId', $propertyId);
    $result = $sth->execute();

    $dir = "../img/properties/$propertyId/";

    $images = scandir(__DIR__ . '/' . $dir);
    array_splice($images, 0, 2);

    foreach($images as $image) {
        unlink($dir . $image);
    }

    rmdir($dir);
}