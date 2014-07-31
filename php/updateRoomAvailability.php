<?php

session_start();

require('db.php');

$updateQuery = $_POST['updateQuery'];

$sth = $dbh->prepare("INSERT INTO rooms (roomId, availability)
                      VALUES $updateQuery
                      ON DUPLICATE KEY UPDATE availability=VALUES(availability)");
$sth->bindParam(':availability', $availability);
$sth->execute();