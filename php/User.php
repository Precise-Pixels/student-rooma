<?php

class User {
    static function getUserData($userId) {
        require('db.php');

        $sth = $dbh->query("SELECT fbId, email, password, name, phone, lookingIn, rooms, availableFrom, minPrice, maxPrice FROM users WHERE userId=$userId");
        $sth->setFetchMode(PDO::FETCH_OBJ);
        $result = $sth->fetch();

        return $result;
    }
}