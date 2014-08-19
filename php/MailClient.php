<?php

class MailClient {
    static function sendMsg($userId, $propertyId) {
        require('db.php');

        $sth = $dbh->query("SELECT name, phone FROM users WHERE userId=$userId");
        $sth->setFetchMode(PDO::FETCH_OBJ);
        $user = $sth->fetch();

        $sth = $dbh->query("SELECT address FROM properties WHERE propertyId=$propertyId");
        $sth->setFetchMode(PDO::FETCH_OBJ);
        $property = $sth->fetch();

        $email   = 'bookings@studentrooma.co.uk';
        $subject = 'New property booking';
        $msg     = "Name:    $user->name\nPhone:   $user->phone\nAddress: $property->address\n\nhttp://studentrooma.co.uk/admin/activity?propertyId=$propertyId&userId=$userId";
        $headers = 'From: system@studentrooma.co.uk';
        mail($email, $subject, $msg, $headers);

        // testing
        echo $msg;
    }
}