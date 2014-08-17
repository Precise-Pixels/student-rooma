<?php

class Index {
    static function skipLogin() {
        if(isset($_COOKIE['c_userId'])) {
            $_SESSION['s_userId'] = $_COOKIE['c_userId'];
            header('location: /properties');
        }
    }
}