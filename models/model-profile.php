<?php

require_once('php/User.php');
require_once('php/Properties.php');
$user = User::getUserData($_SESSION['s_userId']);
$min  = Properties::getMinPrice();
$max  = Properties::getMaxPrice();