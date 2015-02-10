<?php

class LandlordLoginSystem {
    static function login($email, $password) {
        require_once('db.php');
        require_once('Encryption.php');

        $passwordE  = Encryption::encrypt($password);

        $sth = $dbh->query("SELECT landlordId, password, valid FROM landlords WHERE email='$email'");
        $sth->setFetchMode(PDO::FETCH_OBJ);
        $row = $sth->fetch();

        if($row) {
            if($row->valid == 1) {
                if($row->password === $passwordE) {
                    $_SESSION['s_landlordId'] = $row->landlordId;
                } else {
                    return '<p class="error">Wrong email and/or password.</p>';
                }
            } else {
                return '<p class="error">Please verify your account by clicking the verification link in your email before attempting to log in. If you have not receive a verification email, please check your spam/junk or <a href="resend-validation-email">request another verification email</a>.</p>';
            }
        } else {
            return '<p class="error">Wrong email and/or password.</p>';
        }
    }

    static function logout() {
        unset($_SESSION['s_landlordId']);
        header('location: /landlord/');
    }

    static function createUser($email, $password, $name, $phone) {
        require('db.php');
        require_once('Encryption.php');
        require_once('MailClient.php');

        $passwordE  = Encryption::encrypt($password);

        $rand1 = LandlordLoginSystem::generateRandomNumber();
        $rand2 = LandlordLoginSystem::generateRandomNumber();

        $timestamp = date("Y-m-d H:i:s");

        $sth = $dbh->prepare("INSERT INTO landlords (email, password, valid, validateRand, resetRand, name, phone, timestamp) value (:email, :password, 0, :rand1, :rand2, :name, :phone, :timestamp)");
        $sth->bindParam(':email', $email);
        $sth->bindParam(':password', $passwordE);
        $sth->bindParam(':rand1', $rand1);
        $sth->bindParam(':rand2', $rand2);
        $sth->bindParam(':name', $name);
        $sth->bindParam(':phone', $phone);
        $sth->bindParam(':timestamp', $timestamp);
        $sth->execute();

        MailClient::verifyLandlordAccount($email, $rand1);

        return '<p class="success">Account successfully created. We have sent a verification link to your email. Please verify your account before attempting to sign in. If you have not received a verification email, check your spam/junk or <a href="/landlord/resend-validation-email">request another verification email</a>. Please also bear in mind that, while usually instantaneous, the email may take up to an hour to send.</p>';
    }

    static function checkEmailExists($email) {
        require('db.php');

        $sth = $dbh->query("SELECT email FROM landlords WHERE email='$email'");
        $sth->setFetchMode(PDO::FETCH_OBJ);
        $result = $sth->fetch();

        return (!$result ? false : true);
    }

    static function resendValidationEmail($email) {
        require('db.php');
        require_once('MailClient.php');

        $rand = LandlordLoginSystem::generateRandomNumber();

        $sth = $dbh->prepare("UPDATE landlords SET validateRand='$rand' WHERE email='$email'");
        $sth->execute();

        MailClient::verifyLandlordAccount($email, $rand);

        return '<p class="success">We have sent a verification link to your email. Please verify your account before attempting to sign in. If you have not received a verification email, check your spam/junk. Please also bear in mind that, while usually instantaneous, the email may take up to an hour to send.</p>';
    }

    static function validateUser($email, $rand) {
        require('db.php');

        $sth = $dbh->query("SELECT validateRand FROM landlords WHERE email='$email'");
        $sth->setFetchMode(PDO::FETCH_OBJ);
        $result = $sth->fetch();

        if($result) {
            if($result->validateRand == $rand) {
                $sth = $dbh->prepare("UPDATE landlords SET valid=1 WHERE email='$email'");
                $sth->execute();
                return true;
            } else {
                return false;
            }
        }
    }

    static function sendResetPasswordLink($email) {
        require('db.php');
        require_once('MailClient.php');

        $rand = LandlordLoginSystem::generateRandomNumber();

        $sth = $dbh->prepare("UPDATE landlords SET resetRand='$rand' WHERE email='$email'");
        $sth->execute();

        MailClient::resetLandlordPassword($email, $rand);

        return '<p class="success">We have sent instructions on how to reset your password to your email. Please check your emails.</p>';
    }

    static function resetPassword($email, $password, $rand) {
        require('db.php');

        $sth = $dbh->query("SELECT resetRand FROM landlords WHERE email='$email'");
        $sth->setFetchMode(PDO::FETCH_OBJ);
        $result = $sth->fetch();

        if($result->resetRand == $rand) {
            require_once('Encryption.php');

            $passwordE = Encryption::encrypt($password);

            $newRand = LandlordLoginSystem::generateRandomNumber();

            $sth = $dbh->prepare("UPDATE landlords SET password='$passwordE', resetRand='$newRand' WHERE email='$email'");
            $sth->execute();

            return '<p class="success">Password successfully reset. Please <a href="/landlord/">login</a>.</p>';
        } else {
            return '<p class="error">This link has expired. Please <a href="/landlord/#forgotten-your-password">request a new password reset link</a>.</p>';
        }
    }

    static function generateRandomNumber() {
        return rand(pow(10, 6-1), pow(10, 6)-1);
    }
}