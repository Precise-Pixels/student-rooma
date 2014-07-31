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

    static function getProperties() {
        require('db.php');

        $sth = $dbh->query("SELECT rooms.roomId, rooms.roomNo, rooms.status, properties.address
                            FROM rooms
                            INNER JOIN properties ON rooms.propertyId=properties.propertyId");
        $sth->setFetchMode(PDO::FETCH_OBJ);
        $results = $sth->fetchAll();

        return $results;
    }
}