<?php

class Index {
    static function skipLogin() {
        header('location: /admin');
    }
}