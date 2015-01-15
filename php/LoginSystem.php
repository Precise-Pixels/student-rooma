<?php

class LoginSystem {
    static function login($email, $password) {
        require_once('db.php');
        require_once('Encryption.php');

        $passwordE  = Encryption::encrypt($password);

        $sth = $dbh->query("SELECT userId, password, valid, phone FROM users WHERE email='$email'");
        $sth->setFetchMode(PDO::FETCH_OBJ);
        $row = $sth->fetch();

        if($row) {
            if($row->valid == 1) {
                if($row->password === $passwordE) {
                    require_once('User.php');

                    $_SESSION['s_userId'] = $row->userId;
                    $_SESSION['s_loginMethod'] = 'email';

                    if(!$row->phone) {
                        $_SESSION['s_noPhone'] = 'true';
                    }

                    header('location: /app/');

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
        unset($_SESSION['s_userId']);
        if(isset($_SESSION['s_noPhone'])) {
            unset($_SESSION['s_noPhone']);
        }

        if($_SESSION['s_loginMethod'] === 'email') {
            unset($_SESSION['s_loginMethod']);
            header('location: /app/');
        }
    }

    static function createUser($email, $password) {
        require('db.php');
        require_once('Encryption.php');
        require_once('MailClient.php');

        $passwordE  = Encryption::encrypt($password);

        $rand1 = LoginSystem::generateRandomNumber();
        $rand2 = LoginSystem::generateRandomNumber();

        $timestamp = date("Y-m-d H:i:s");

        $sth = $dbh->prepare("INSERT INTO users (fbId, email, password, valid, validateRand, resetRand, name, phone, lookingIn, rooms, availableFrom, minPrice, maxPrice, timestamp) value (0, :email, :password, 0, :rand1, :rand2, '', '', 'Medway', 'ANY', '1970-01-01', 0, 9001, :timestamp)");
        $sth->bindParam(':email', $email);
        $sth->bindParam(':password', $passwordE);
        $sth->bindParam(':rand1', $rand1);
        $sth->bindParam(':rand2', $rand2);
        $sth->bindParam(':timestamp', $timestamp);
        $sth->execute();

        MailClient::verifyAccount($email, $rand1);

        return '<p class="success">Account successfully created. We have sent a verification link to your email. Please verify your account before attempting to sign in. If you have not received a verification email, check your spam/junk or <a href="/app/resend-validation-email">request another verification email</a>. Please also bear in mind that, while usually instantaneous, the email may take up to an hour to send.</p>';
    }

    static function checkEmailExists($email) {
        require('db.php');

        $sth = $dbh->query("SELECT email FROM users WHERE email='$email'");
        $sth->setFetchMode(PDO::FETCH_OBJ);
        $result = $sth->fetch();

        return (!$result ? false : true);
    }

    /*static function resendValidationEmail($email) {
        require('db.php');
        require_once('MailClient.php');

        $rand = LoginSystem::generateRandomNumber();

        $sth = $dbh->prepare("UPDATE users SET validateRand='$rand' WHERE email='$email'");
        $sth->execute();

        MailClient::sendMsg($email, 'Verify your account', "Please follow this link to verify your account: http://cell-industries.co.uk/verify-account?e=$email&r=$rand");

        return '<p class="error">We have sent a verification link to your email. Please verify your account before attempting to sign in. If you have not received a verification email, check your spam/junk. Please also bear in mind that, while usually instantaneous, the email may take up to an hour to send.</p>';
    }

    static function validateUser($email, $rand) {
        require('db.php');

        $sth = $dbh->query("SELECT validateRand FROM users WHERE email='$email'");
        $sth->setFetchMode(PDO::FETCH_OBJ);
        $result = $sth->fetch();

        if($result) {
            if($result->validateRand == $rand) {
                $sth = $dbh->prepare("UPDATE users SET valid=1 WHERE email='$email'");
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

        $rand = LoginSystem::generateRandomNumber();

        $sth = $dbh->prepare("UPDATE users SET resetRand='$rand' WHERE email='$email'");
        $sth->execute();

        MailClient::sendMsg($email, 'Reset your account password', "Please follow this link to reset your account password: http://cell-industries.co.uk/reset-password?e=$email&r=$rand");

        return '<p class="success">We have sent instructions on how to reset your password to your email. Please check your emails.</p>';
    }

    static function resetPassword($email, $password, $rand) {
        require('db.php');

        $sth = $dbh->query("SELECT resetRand FROM users WHERE email='$email'");
        $sth->setFetchMode(PDO::FETCH_OBJ);
        $result = $sth->fetch();

        if($result->resetRand == $rand) {
            require_once('Encryption.php');

            $passwordE = Encryption::encrypt($password);

            $newRand = LoginSystem::generateRandomNumber();

            $sth = $dbh->prepare("UPDATE users SET password='$passwordE', resetRand='$newRand' WHERE email='$email'");
            $sth->execute();

            return '<p class="success">Password successfully reset. Please <a href="signin">sign in</a>.</p>';
        } else {
            return '<p class="error">This link has expired. Please <a href="forgotten-password">request a new password reset link</a>.</p>';
        }
    }*/

    static function generateRandomNumber() {
        return rand(pow(10, 6-1), pow(10, 6)-1);
    }
}