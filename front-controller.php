<?php

ob_start();
session_start();

$q = $_GET['q'];

$isIndex                       = ($q == '');
$isProfile                     = preg_match('#^profile/?$#', $q);
$isProperties                  = preg_match('#^properties/?$#', $q);
$isActivity                    = preg_match('#^activity/?$#', $q);
$isProperty                    = preg_match('#^property\/\d+/?$#', $q);
$isGallery                     = preg_match('#^property\/\d+/gallery/?$#', $q);
$isInstall                     = preg_match('#^install/?$#', $q);
$isAbout                       = preg_match('#^about/?$#', $q);
$isTerms                       = preg_match('#^terms-and-conditions/?$#', $q);
$isPrivacy                     = preg_match('#^privacy-policy/?$#', $q);
$isLogout                      = preg_match('#^logout/?$#', $q);
$isAdmin                       = preg_match('#^admin/?$#', $q);
$isAdminActivity               = preg_match('#^admin\/activity/?$#', $q);
$isAdminAllProperties          = preg_match('#^admin\/all-properties/?$#', $q);
$isAdminNewProperty            = preg_match('#^admin\/new-property/?$#', $q);
$isAdminUpdateRoomAvailability = preg_match('#^admin\/update-room-availability/?$#', $q);

$path = preg_replace('/\/$|.php/', '', $q);
if(empty($path)) {                                  // HOME
    $file = 'index';
} elseif($isTerms || $isPrivacy || $isAdmin) {
    $file = $path;                                  // ALLOW WITHOUT LOGGING IN
} elseif($isAdminActivity || $isAdminAllProperties || $isAdminNewProperty || $isAdminUpdateRoomAvailability) {
    if(!isset($_SESSION['s_admin'])) {
        if($isAdminActivity)               { $r = 'activity'; }
        if($isAdminAllProperties)          { $r = 'all-properties'; }
        if($isAdminNewProperty)            { $r = 'new-property'; }
        if($isAdminUpdateRoomAvailability) { $r = 'update-room-availability'; }
        header("location: /admin?r=$r");
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

require_once('front-view.php');