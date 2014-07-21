<?php

class Properties {
    static function getProperties() {
        require('db.php');

        $userId = $_SESSION['s_userId'];

        $sth = $dbh->query("SELECT lookingIn, roomType, availableFrom, minPrice, maxPrice FROM users WHERE userId=$userId");
        $sth->setFetchMode(PDO::FETCH_OBJ);
        $user = $sth->fetch();

        if($user->roomType == 'any') {
            $roomTypeQuery = '';
        } else {
            $roomTypeQuery = "AND roomType='$user->roomType'";
        }

        $sth = $dbh->query("SELECT propertyId, location, address, distanceUKC, distanceCCCU, distanceUKM, price, roomType, availableFrom, furnishing, timestamp FROM properties WHERE location='$user->lookingIn' AND price BETWEEN $user->minPrice AND $user->maxPrice AND availableFrom >= STR_TO_DATE('$user->availableFrom', '%Y-%m-%d') $roomTypeQuery");
        $sth->setFetchMode(PDO::FETCH_OBJ);
        $results = $sth->fetchAll();

        return $results;
    }
}