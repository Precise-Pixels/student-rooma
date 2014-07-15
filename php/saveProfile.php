<?php

session_start();

require('db.php');

$lookingIn     = $_POST['lookingIn'];
$roomType      = $_POST['roomType'];
$availableFrom = $_POST['availableFrom'];
$minPrice      = $_POST['minPrice'];
$maxPrice      = $_POST['maxPrice'];
$phone         = $_POST['phone'];

$sth = $dbh->prepare("UPDATE users SET lookingIn=:lookingIn, roomType=:roomType, availableFrom=:availableFrom, minPrice=:minPrice, maxPrice=:maxPrice, phone=:phone WHERE userId=:userId");
$sth->bindParam(':lookingIn', $lookingIn);
$sth->bindParam(':roomType', $roomType);
$sth->bindParam(':availableFrom', $availableFrom);
$sth->bindParam(':minPrice', $minPrice);
$sth->bindParam(':maxPrice', $maxPrice);
$sth->bindParam(':phone', $phone);
$sth->bindParam(':userId', $_SESSION['s_userId']);
$result = $sth->execute();