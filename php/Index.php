<?php

class Index {
    static function skipLogin() {
        if(isset($_SESSION['s_userId'])) {
            if(isset($_SESSION['s_noPhone'])) {
                header('location: /profile');
            } else {
                header('location: /properties');
            }
        }
    }
}