<?php

ob_start();
session_start();

$q = $_GET['q'];

$isIndex                       = ($q == '');
$isApp                         = preg_match('#^app\/#', $q);
$isAppIndex                    = preg_match('#^app/?$#', $q);
$isProfile                     = preg_match('#^app\/profile/?$#', $q);
$isProperties                  = preg_match('#^app\/properties/?$#', $q);
$isActivity                    = preg_match('#^app\/activity/?$#', $q);
$isProperty                    = preg_match('#^app\/property\/\d+/?$#', $q);
$isGallery                     = preg_match('#^app\/property\/\d+/gallery/?$#', $q);
$isInstall                     = preg_match('#^app\/install/?$#', $q);
$isAbout                       = preg_match('#^app\/about/?$#', $q);
$isTerms                       = preg_match('#^app\/terms-and-conditions/?$#', $q);
$isPrivacy                     = preg_match('#^app\/privacy-policy/?$#', $q);
$isLogout                      = preg_match('#^app\/logout/?$#', $q);
$isAdmin                       = preg_match('#^app\/admin/?$#', $q);
$isAdminActivity               = preg_match('#^app\/admin\/activity/?$#', $q);
$isAdminAllProperties          = preg_match('#^app\/admin\/all-properties/?$#', $q);
$isAdminNewProperty            = preg_match('#^app\/admin\/new-property/?$#', $q);
$isAdminUpdateRoomAvailability = preg_match('#^app\/admin\/update-room-availability/?$#', $q);
$isAdminDeleteProperty         = preg_match('#^app\/admin\/delete-property/?$#', $q);

$path = preg_replace('/\/$|.php/', '', $q);

if($isApp) {
    if($isAppIndex) {
        $file = 'app/index';                            // APP HOME
    } elseif($isTerms || $isPrivacy || $isAdmin) {
        $file = $path;                                  // ALLOW WITHOUT LOGGING IN
    } elseif($isAdminActivity || $isAdminAllProperties || $isAdminNewProperty || $isAdminUpdateRoomAvailability || $isAdminDeleteProperty) {
        if(!isset($_SESSION['s_admin'])) {
            if($isAdminActivity)               { $r = 'activity'; }
            if($isAdminAllProperties)          { $r = 'all-properties'; }
            if($isAdminNewProperty)            { $r = 'new-property'; }
            if($isAdminUpdateRoomAvailability) { $r = 'update-room-availability'; }
            if($isAdminDeleteProperty)         { $r = 'delete-property'; }
            header("location: /app/admin?r=$r");
        } else {
            $file = $path;                              // ADMIN PAGE
        }
    } elseif(!isset($_SESSION['s_userId'])) {
        header('location: /app/');                      // NOT LOGGED IN
    } elseif(file_exists("views/$path.php")) {
        $file = $path;                                  // APP
    } else {
        $file = 'app/404';                              // APP 404 NOT FOUND
    }
} elseif(!$isApp) {
    if(empty($path)) {                                  // HOME
        $file = 'index';
    } elseif(file_exists("views/$path.php")) {
        $file = $path;                                  // LANDING SITE
    } else {
        $file = '404';                                  // LANDING SITE 404 NOT FOUND
    }
}

if($isAppIndex) {
    require_once('models/model-index.php');
}

if($isProfile) {
    require_once('models/model-profile.php');
}

if($isProperties) {
    require_once('models/model-properties.php');
}

if($isActivity) {
    require_once('models/model-activity.php');
}

if($isProperty) {
    require_once('models/model-property.php');
}

if($isGallery) {
    require_once('models/model-gallery.php');
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

if($isAdminDeleteProperty) {
    require_once('models/model-admin-delete-property.php');
}

require_once('front-view.php');