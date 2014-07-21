<?php

session_start();

require('db.php');

$propertyId = $_POST['propertyId'];
$status     = $_POST['status'];

$sth = $dbh->prepare("UPDATE activity SET status=:status WHERE propertyId=$propertyId");
$sth->bindParam(':status', $status);
$sth->execute();