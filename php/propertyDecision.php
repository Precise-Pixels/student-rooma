<?php

session_start();

require('db.php');

$userId     = $_SESSION['s_userId'];
$propertyId = $_POST['propertyId'];
$status     = $_POST['status'];

$timestamp = date("Y-m-d H:i:s");

$sth = $dbh->prepare("INSERT INTO shortlist (userId, propertyId, status, timestamp) value (:userId, :propertyId, :status, :timestamp)");
$sth->bindParam(':userId', $userId);
$sth->bindParam(':propertyId', $propertyId);
$sth->bindParam(':status', $status);
$sth->bindParam(':timestamp', $timestamp);
$sth->execute();