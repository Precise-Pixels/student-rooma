<?php

ob_start();
session_start();

$q = $_GET['q'];

$isIndex                       = ($q == '');
$isAdmin                       = preg_match('#^admin/?$#', $q);
$isAdminActivity               = preg_match('#^admin\/activity/?$#', $q);
$isAdminAllProperties          = preg_match('#^admin\/all-properties/?$#', $q);
$isAdminNewProperty            = preg_match('#^admin\/new-property/?$#', $q);
$isAdminUpdateRoomAvailability = preg_match('#^admin\/update-room-availability/?$#', $q);

$path = preg_replace('/\/$|.php/', '', $q);
if(empty($path)) {                                  // HOME
    $file = 'index';
} elseif($isAdmin) {
    $file = $path;                                  // ALLOW WITHOUT LOGGING IN
} elseif($isAdminActivity || $isAdminAllProperties || $isAdminNewProperty || $isAdminUpdateRoomAvailability) {
    if(!isset($_SESSION['s_admin'])) {
        header('location: /admin');
    } else {
        $file = $path;                              // ADMIN
    }
} elseif(file_exists("views/$path.php")) {
    if(!isset($_SESSION['s_userId'])) {
        header('location: /');                      // NOT LOGGED IN
    } else {
        $file = $path;                              // PAGE
    }
} else {                                            // NOT FOUND
    $file = '404';
}

if($isIndex) {
    require_once('models/model-index.php');
}

if($isAdminActivity) {
    require_once('models/model-admin-activity.php');
}

if($isAdminAllProperties) {
    require_once('models/model-admin-all-properties.php');
}

if($isAdminUpdateRoomAvailability) {
    require_once('models/model-admin-update-room-availability.php');
}

require_once('front-view.php');