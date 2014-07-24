<?php

class Properties {
    static function getProperties() {
        require('db.php');

        $userId = $_SESSION['s_userId'];

        $sth = $dbh->query("SELECT lookingIn, rooms, availableFrom, minPrice, maxPrice FROM users WHERE userId=$userId");
        $sth->setFetchMode(PDO::FETCH_OBJ);
        $user = $sth->fetch();

        $roomsQuery = ($user->rooms == 'ANY' ? '' : "AND noOfRooms = $user->rooms");

        $sth = $dbh->query("SELECT propertyId, location, address, distanceUKC, distanceCCCU, distanceUKM, noOfRooms, availableFrom, info, timestamp
                            FROM properties
                            WHERE location = '$user->lookingIn'
                            $roomsQuery
                            AND availableFrom >= STR_TO_DATE('$user->availableFrom', '%Y-%m-%d')
                            AND propertyId NOT IN (SELECT propertyId FROM activity WHERE properties.propertyId=activity.propertyId AND activity.userId=$userId)");
        $sth->setFetchMode(PDO::FETCH_OBJ);
        $properties = $sth->fetchAll();

        // Find all the rooms for each property and append to property object
        $sth = $dbh->query("SELECT propertyId, roomNo, roomType, price, status FROM rooms");
        $sth->setFetchMode(PDO::FETCH_OBJ);
        $rooms = $sth->fetchAll();

        foreach($properties as $property) {
            $roomArray = array();

            foreach($rooms as $room) {
                if($room->propertyId == $property->propertyId) {
                    array_push($roomArray, $room);
                }
            }

            $property->rooms = ($roomArray);
        }

        return $properties;
    }

    static function getProperty($propertyId) {
        require('db.php');

        $sth = $dbh->query("SELECT propertyId, location, address, distanceUKC, distanceCCCU, distanceUKM, noOfRooms, availableFrom, info, timestamp FROM properties WHERE propertyId=$propertyId");
        $sth->setFetchMode(PDO::FETCH_OBJ);
        $property = $sth->fetch();

        // Find all the rooms for this property and append to property object
        $sth = $dbh->query("SELECT roomNo, roomType, price, status FROM rooms WHERE propertyId=$property->propertyId");
        $sth->setFetchMode(PDO::FETCH_OBJ);
        $rooms = $sth->fetchAll();

        $property->rooms = $rooms;

        return $property;
    }
}