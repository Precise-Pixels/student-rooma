<?php

class MailClient {
    static function sendMsg($userId, $propertyId, $activityId) {
        require('db.php');

        $sth = $dbh->query("SELECT name, phone FROM users WHERE userId=$userId");
        $sth->setFetchMode(PDO::FETCH_OBJ);
        $user = $sth->fetch();

        $sth = $dbh->query("SELECT address, landlords.email AS landlordEmail FROM properties INNER JOIN landlords ON properties.landlordId=landlords.landlordId WHERE propertyId=$propertyId");
        $sth->setFetchMode(PDO::FETCH_OBJ);
        $property = $sth->fetch();

        $email   = $property->landlordEmail;
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
                    <p><a href='http://studentrooma.co.uk/landlord/activity?propertyId=$propertyId&userId=$userId'>http://studentrooma.co.uk/landlord/activity?propertyId=$propertyId&userId=$userId</a></p>
                    <p>(You will need to be logged in as an landlord before opening this link.)</p>
                    </body></html>";
        $headers = "From: system@studentrooma.co.uk\r\n";
        $headers .= "Content-Type: text/html\r\n";
        mail($email, $subject, $msg, $headers);
    }

    static function verifyAccount($email, $rand1) {
        $headers = "From: system@studentrooma.co.uk\r\n";
        $headers .= "Content-Type: text/html\r\n";

        mail($email, 'Verify your account', "Please follow this link to verify your account: http://studentrooma.co.uk/app/verify-account?e=$email&r=$rand1", $headers);
    }

    static function resetPassword($email, $rand2) {
        $headers = "From: system@studentrooma.co.uk\r\n";
        $headers .= "Content-Type: text/html\r\n";

        mail($email, 'Reset your account password', "Please follow this link to reset your account password: http://studentrooma.co.uk/app/reset-password?e=$email&r=$rand2", $headers);
    }

    static function verifyLandlordAccount($email, $rand1) {
        $headers = "From: system@studentrooma.co.uk\r\n";
        $headers .= "Content-Type: text/html\r\n";

        mail($email, 'Verify your account', "Please follow this link to verify your account: http://studentrooma.co.uk/landlord/verify-account?e=$email&r=$rand1", $headers);
    }

    static function resetLandlordPassword($email, $rand2) {
        $headers = "From: system@studentrooma.co.uk\r\n";
        $headers .= "Content-Type: text/html\r\n";

        mail($email, 'Reset your account password', "Please follow this link to reset your account password: http://studentrooma.co.uk/landlord/reset-password?e=$email&r=$rand2", $headers);
    }
}