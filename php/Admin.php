<?php

class Admin {
    static function getActivity() {
        require('db.php');

        $sth = $dbh->query("SELECT users.name, users.phone, status, properties.address, activity.timestamp, activity.userId, activity.propertyId
                            FROM activity
                            INNER JOIN properties ON activity.propertyId=properties.propertyId
                            INNER JOIN users ON activity.userId=users.userId
                            ORDER BY activity.timestamp DESC");
        $sth->setFetchMode(PDO::FETCH_OBJ);
        $results = $sth->fetchAll();

        return $results;
    }

    static function postProperty($post) {
        require('db.php');

        // Property
        $distanceUKC = (int)$post['distance-UKC'];
        $distanceCCCU = (int)$post['distance-CCCU'];
        $distanceUKM = (int)$post['distance-UKM'];
        $noOfRooms = (int)$post['rooms'];
        $availableFrom = date("Y-m-d", strtotime($post['available-from']));
        $info = mysql_real_escape_string($post['info']);
        $timestamp = date("Y-m-d H:i:s");

        $sth = $dbh->prepare("INSERT INTO properties (location, address, distanceUKC, distanceCCCU, distanceUKM, noOfRooms, availableFrom, info, timestamp) VALUE (:location, :address, :distanceUKC, :distanceCCCU, :distanceUKM, :noOfRooms, :availableFrom, :info, :timestamp)");
        $sth->bindParam(':location', $post['location']);
        $sth->bindParam(':address', $post['address']);
        $sth->bindParam(':distanceUKC', $distanceUKC);
        $sth->bindParam(':distanceCCCU', $distanceCCCU);
        $sth->bindParam(':distanceUKM', $distanceUKM);
        $sth->bindParam(':noOfRooms', $noOfRooms);
        $sth->bindParam(':availableFrom', $availableFrom);
        $sth->bindParam(':info', $info);
        $sth->bindParam(':timestamp', $timestamp);
        $result = $sth->execute();

        if(!$result) { return false; }

        $propertyId = $dbh->lastInsertId();

        // Rooms
        mkdir("img/properties/$propertyId", 0777, true);

        $values = '';

        for($i = 1; $i <= $noOfRooms; $i++) {
            $values .= "({$propertyId},{$i},'{$post["room-type-$i"]}',{$post["price-$i"]},{$post["availability-$i"]}),";
        }

        $values = rtrim($values, ',');

        $sth = $dbh->prepare("INSERT INTO rooms (propertyId, roomNo, roomType, price, availability) VALUES $values");
        $result = $sth->execute();

        return $result;
    }

    static function getProperties() {
        require('db.php');

        $sth = $dbh->query("SELECT rooms.roomId, rooms.roomNo, rooms.availability, properties.address
                            FROM rooms
                            INNER JOIN properties ON rooms.propertyId=properties.propertyId");
        $sth->setFetchMode(PDO::FETCH_OBJ);
        $results = $sth->fetchAll();

        return $results;
    }
}