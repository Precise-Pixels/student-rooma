<?php

class Listing {
    static function getListings() {
        require('db.php');

        $sth = $dbh->query("SELECT propertyId, location, address, distanceUKC, distanceCCCU, distanceUKM, price, roomType, availableFrom, furnishing, timestamp FROM properties");
        $sth->setFetchMode(PDO::FETCH_OBJ);
        $results = $sth->fetchAll();

        return $results;
    }
}