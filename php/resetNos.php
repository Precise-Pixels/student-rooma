<?php

session_start();

require('db.php');

$userId = $_SESSION['s_userId'];

$sth = $dbh->prepare("DELETE FROM activity WHERE userId=:userId AND status='no'");
$sth->bindParam(':userId', $userId);
$sth->execute();