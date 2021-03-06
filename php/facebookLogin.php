<?php

session_start();

require('db.php');

$fbId     = $_POST['fbId'];
$name     = $_POST['name'];
$location = $_POST['location'];

$sth = $dbh->query("SELECT fbId FROM users WHERE fbId=$fbId");
$sth->setFetchMode(PDO::FETCH_OBJ);
$userExists = $sth->fetch();

if($userExists === false) {
    // New user
    if(strpos($location, 'Canterbury') !== false) {
        $lookingIn = 'Canterbury';
    } else {
        $lookingIn = 'Medway';
    }

    $timestamp = date("Y-m-d H:i:s");

    $sth = $dbh->prepare("INSERT INTO users (fbId, email, password, name, phone, lookingIn, rooms, availableFrom, minPrice, maxPrice, timestamp) value (:fbId, '', '', :name, '', :lookingIn, 'ANY', '1970-01-01', 0, 9001, :timestamp)");
    $sth->bindParam(':fbId', $fbId);
    $sth->bindParam(':name', $name);
    $sth->bindParam(':lookingIn', $lookingIn);
    $sth->bindParam(':timestamp', $timestamp);
    $sth->execute();

    $_SESSION['s_userId']      = $dbh->lastInsertId();
    $_SESSION['s_loginMethod'] = 'facebook';

    $_SESSION['s_firstTime'] = 'true';
    $_SESSION['s_noPhone']   = 'true';
} else {
    // Existing user
    $sth = $dbh->query("SELECT userId, phone FROM users WHERE fbId=$fbId");
    $sth->setFetchMode(PDO::FETCH_OBJ);
    $result = $sth->fetch();

    $_SESSION['s_userId']      = $result->userId;
    $_SESSION['s_loginMethod'] = 'facebook';

    if(!$result->phone) {
        $_SESSION['s_noPhone'] = 'true';
    }
}