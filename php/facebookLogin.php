<?php
session_start();

require('db.php');

$fbId     = $_POST['fbId'];
$name     = $_POST['name'];
$location = $_POST['location'];

$sth = $dbh->query("SELECT fbId FROM users WHERE fbId=$fbId");
$sth->setFetchMode(PDO::FETCH_OBJ);
$result = $sth->fetch();

// If new user
if($result === false) {
    if(strpos($location, 'Canterbury') !== false) {
        $lookingIn = 'Canterbury';
    } else if(strpos($location, 'Medway') !== false) {
        $lookingIn = 'Medway';
    } else {
        $lookingIn = '';
    }

    $timestamp = date("Y-m-d H:i:s");

    $sth = $dbh->prepare("INSERT INTO users (fbId, email, password, name, phone, lookingIn, roomType, availableFrom, minPrice, maxPrice, timestamp) value (:fbId, '', '', :name, '', :lookingIn, '', '', 0, 0, :timestamp)");
    $sth->bindParam(':fbId', $fbId);
    $sth->bindParam(':name', $name);
    $sth->bindParam(':lookingIn', $lookingIn);
    $sth->bindParam(':timestamp', $timestamp);
    $sth->execute();
}

$_SESSION['s_fbId'] = $fbId;
$_SESSION['s_name'] = $name;