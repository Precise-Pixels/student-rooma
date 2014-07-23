<?php

class Properties {
    static function getProperties() {
        require('db.php');

        $userId = $_SESSION['s_userId'];

        $sth = $dbh->query("SELECT lookingIn, rooms, availableFrom, minPrice, maxPrice FROM users WHERE userId=$userId");
        $sth->setFetchMode(PDO::FETCH_OBJ);
        $user = $sth->fetch();

        $roomsQuery = ($user->rooms == 'ANY' ? '' : 'AND rooms = $user->rooms');

        $sth = $dbh->query("SELECT propertyId, location, address, distanceUKC, distanceCCCU, distanceUKM, price, rooms, roomType, availableFrom, furnishing, timestamp
                            FROM properties
                            WHERE location='$user->lookingIn'
                            AND price BETWEEN $user->minPrice
                            AND $user->maxPrice
                            AND availableFrom >= STR_TO_DATE('$user->availableFrom', '%Y-%m-%d')
                            $roomsQuery
                            AND propertyId NOT IN (SELECT propertyId FROM activity WHERE properties.propertyId=activity.propertyId AND activity.userId=$userId)");
        $sth->setFetchMode(PDO::FETCH_OBJ);
        $results = $sth->fetchAll();

        return $results;
    }

    static function getProperty($propertyId) {
        require('db.php');

        $sth = $dbh->query("SELECT propertyId, location, address, distanceUKC, distanceCCCU, distanceUKM, price, rooms, roomType, availableFrom, furnishing, timestamp FROM properties WHERE propertyId=$propertyId");
        $sth->setFetchMode(PDO::FETCH_OBJ);
        $result = $sth->fetch();

        return $result;
    }
}