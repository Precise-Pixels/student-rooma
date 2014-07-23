<?php

session_start();

require('db.php');

$lookingIn     = $_POST['lookingIn'];
$rooms         = $_POST['rooms'];
$availableFrom = $_POST['availableFrom'];
$minPrice      = $_POST['minPrice'];
$maxPrice      = $_POST['maxPrice'];
$phone         = $_POST['phone'];

if($lookingIn != 'Canterbury' && $lookingIn != 'Medway') { return; }
$phone = preg_replace('/[^0-9]/', '', $phone);

$sth = $dbh->prepare("UPDATE users SET lookingIn=:lookingIn, rooms=:rooms, availableFrom=:availableFrom, minPrice=:minPrice, maxPrice=:maxPrice, phone=:phone WHERE userId=:userId");
$sth->bindParam(':lookingIn', $lookingIn);
$sth->bindParam(':rooms', $rooms);
$sth->bindParam(':availableFrom', $availableFrom);
$sth->bindParam(':minPrice', $minPrice);
$sth->bindParam(':maxPrice', $maxPrice);
$sth->bindParam(':phone', $phone);
$sth->bindParam(':userId', $_SESSION['s_userId']);
$result = $sth->execute();