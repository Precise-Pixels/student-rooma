<?php

class Index {
    static function skipLogin() {
        if(isset($_SESSION['s_name']) && isset($_SESSION['s_userId'])) {
            header('location: /properties');
        }
    }
}