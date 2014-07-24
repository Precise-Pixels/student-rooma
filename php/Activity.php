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
        $results = $sth->fetchAll();

        return $results;
    }
}