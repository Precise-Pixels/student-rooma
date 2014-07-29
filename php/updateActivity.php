<?php

session_start();

require('db.php');

$userId     = $_SESSION['s_userId'];
$propertyId = $_POST['propertyId'];
$status     = $_POST['status'];

$sth = $dbh->prepare("UPDATE activity SET status=:status WHERE propertyId=$propertyId");
$sth->bindParam(':status', $status);
$sth->execute();

if($status === 'book') {
    require_once('MailClient.php');
    MailClient::sendMsg($userId, $propertyId);
}