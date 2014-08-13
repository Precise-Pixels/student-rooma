<?php

class Activity {
    static function getActivity() {
        require('db.php');

        $userId = $_SESSION['s_userId'];

        $sth = $dbh->query("SELECT activityId, activity.propertyId, status, properties.address, properties.noOfRooms
                            FROM activity
                            INNER JOIN properties ON activity.propertyId=properties.propertyId
                            WHERE userId=$userId
                            ORDER BY activity.timestamp DESC");
        $sth->setFetchMode(PDO::FETCH_OBJ);
        $activity = $sth->fetchAll();

        foreach($activity as $property) {
            $sth = $dbh->query("SELECT MIN(price) AS minPrice, MAX(price) AS maxPrice
                                FROM rooms
                                WHERE propertyId=$property->propertyId");
            $sth->setFetchMode(PDO::FETCH_OBJ);
            $prices = $sth->fetch();

            $property->minPrice = $prices->minPrice;
            $property->maxPrice = $prices->maxPrice;
        }

        return $activity;
    }
}