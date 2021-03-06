<?php

class Properties {
    static function getProperties() {
        require('db.php');

        $userId = $_SESSION['s_userId'];

        $sth = $dbh->query("SELECT lookingIn, rooms, availableFrom, minPrice, maxPrice FROM users WHERE userId=$userId");
        $sth->setFetchMode(PDO::FETCH_OBJ);
        $user = $sth->fetch();

        $roomsQuery = ($user->rooms == 'ANY' ? '' : "HAVING SUM(availability=1) = $user->rooms");

        $sth = $dbh->query("SELECT DISTINCT properties.propertyId, location, addressNumber, address, distanceUKC, distanceCCCU, distanceUKM, noOfRooms, availableFrom, info, timestamp
                            FROM properties
                            INNER JOIN rooms ON properties.propertyId=rooms.propertyId
                            WHERE location = '$user->lookingIn'
                            AND availableFrom >= STR_TO_DATE('$user->availableFrom', '%Y-%m-%d')
                            AND active = 1
                            AND properties.propertyId NOT IN (SELECT propertyId FROM activity WHERE properties.propertyId=activity.propertyId AND activity.userId=$userId)
                            GROUP BY properties.propertyId
                            $roomsQuery
                            ORDER BY RAND()");
        $sth->setFetchMode(PDO::FETCH_OBJ);
        $properties = $sth->fetchAll();

        // Find all the rooms for each property and append to property object
        $sth = $dbh->query("SELECT propertyId, roomNo, roomType, price, availability FROM rooms");
        $sth->setFetchMode(PDO::FETCH_OBJ);
        $rooms = $sth->fetchAll();

        function getPrice($room) {
            return $room->price;
        }

        foreach($properties as $property) {
            $roomArray = array();

            foreach($rooms as $room) {
                if($room->propertyId == $property->propertyId) {
                    array_push($roomArray, $room);
                }
            }

            $property->rooms = ($roomArray);

            // Get price range of rooms
            $prices = array_map('getPrice', $roomArray);
            $property->minPrice = min($prices);
            $property->maxPrice = max($prices);
        }

        // Remove properties if they do not contain at least one room within the specified price range
        for($i = count($properties) - 1; $i >= 0; $i--) {
            if(!(($properties[$i]->minPrice >= $user->minPrice && $properties[$i]->minPrice <= $user->maxPrice) || ($properties[$i]->maxPrice >= $user->minPrice && $properties[$i]->maxPrice <= $user->maxPrice))) {
                unset($properties[$i]);
            }
        }

        return $properties;
    }

    static function getProperty($propertyId) {
        require('db.php');

        $sth = $dbh->query("SELECT propertyId, location, addressNumber, address, distanceUKC, distanceCCCU, distanceUKM, noOfRooms, availableFrom, info, timestamp FROM properties WHERE propertyId=$propertyId");
        $sth->setFetchMode(PDO::FETCH_OBJ);
        $property = $sth->fetch();

        if($property) {
            // Find all the rooms for this property and append to property object
            $sth = $dbh->query("SELECT roomNo, roomType, price, availability FROM rooms WHERE propertyId=$property->propertyId");
            $sth->setFetchMode(PDO::FETCH_OBJ);
            $rooms = $sth->fetchAll();

            $property->rooms = $rooms;
        }

        return $property;
    }

    static function getImages($propertyId) {
        $images = null;

        if(file_exists(__DIR__ . "/../img/properties/{$propertyId}/")) {
            $images = scandir(__DIR__ . "/../img/properties/{$propertyId}/");
            array_splice($images, 0, 2);
        }

        return $images;
    }

    static function getMinPrice() {
        require('db.php');

        $sth = $dbh->query("SELECT MIN(price) FROM rooms");
        $sth->setFetchMode(PDO::FETCH_NUM);
        $min = $sth->fetch();

        return $min[0];
    }

    static function getMaxPrice() {
        require('db.php');

        $sth = $dbh->query("SELECT MAX(price) FROM rooms");
        $sth->setFetchMode(PDO::FETCH_NUM);
        $max = $sth->fetch();

        return $max[0];
    }
}