<?php

class Shortlist {
    static function getShortlist() {
        require('db.php');

        $userId = $_SESSION['s_userId'];

        $sth = $dbh->query("SELECT shortlistId, shortlist.propertyId, status, properties.address, properties.price, properties.roomType FROM shortlist INNER JOIN properties ON shortlist.propertyId=properties.propertyId WHERE userId=$userId ORDER BY shortlist.timestamp DESC");
        $sth->setFetchMode(PDO::FETCH_OBJ);
        $results = $sth->fetchAll();

        return $results;
    }
}