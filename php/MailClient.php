<?php

class MailClient {
    static function sendMsg($userId, $propertyId, $activityId) {
        require('db.php');

        $sth = $dbh->query("SELECT name, phone FROM users WHERE userId=$userId");
        $sth->setFetchMode(PDO::FETCH_OBJ);
        $user = $sth->fetch();

        $sth = $dbh->query("SELECT address FROM properties WHERE propertyId=$propertyId");
        $sth->setFetchMode(PDO::FETCH_OBJ);
        $property = $sth->fetch();

        $email   = 'bookings@studentrooma.co.uk';
        $subject = "[$activityId] New property booking";
        $msg     = "<html><body>
                    <table>
                        <tbody>
                            <tr>
                                <td>Activity ID:</td>
                                <td><strong>$activityId</strong></td>
                            </tr>
                            <tr>
                                <td>Name:</td>
                                <td><strong>$user->name</strong></td>
                            </tr>
                            <tr>
                                <td>Phone:</td>
                                <td><strong>$user->phone</strong></td>
                            </tr>
                            <tr>
                                <td>Address:</td>
                                <td><strong>$property->address</strong></td>
                            </tr>
                        </tbody>
                    </table>
                    <p>The following link will display a list of user activity with this particular viewing highlighted in orange.</p>
                    <p>Ensure the status is still 'book' before following up the booking otherwise the user has cancelled their booking.</p>
                    <p>If no row is highlighted orange, this means that the user has cancelled their booking and reset their no's.</p>
                    <p><a href='http://studentrooma.co.uk/admin/activity?propertyId=$propertyId&userId=$userId'>http://studentrooma.co.uk/admin/activity?propertyId=$propertyId&userId=$userId</a></p>
                    </body></html>";
        $headers = "From: system@studentrooma.co.uk\r\n";
        $headers .= "Content-Type: text/html\r\n";
        mail($email, $subject, $msg, $headers);
    }
}