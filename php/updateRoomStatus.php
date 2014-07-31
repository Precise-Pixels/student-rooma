<?php

session_start();

require('db.php');

$updateQuery = $_POST['updateQuery'];

$sth = $dbh->prepare("INSERT INTO rooms (roomId, status)
                      VALUES $updateQuery
                      ON DUPLICATE KEY UPDATE status=VALUES(status)");
$sth->bindParam(':status', $status);
$sth->execute();