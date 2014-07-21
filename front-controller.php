<?php

ob_start();
session_start();

$q = $_GET['q'];

$path = preg_replace('/\/$|.php/', '', $q);

if(empty($path)) {                                  // HOME
    $file = 'index';
} elseif(file_exists("views/$path.php")) {
    if(isset($_SESSION['s_userId']) === false) {
        header('location: /');                      // NOT LOGGED IN
    } else {
        $file = $path;                              // PAGE
    }
} else {                                            // NOT FOUND
    $file = '404';
}

$isIndex      = ($q == '');
$isProfile    = preg_match('#profile/?$#', $q);
$isProperties = preg_match('#properties/?$#', $q);
$isActivity   = preg_match('#activity/?$#', $q);
$isProperty   = preg_match('#property\/\d+/?$#', $q);
$isLogout     = preg_match('#logout/?$#', $q);

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

require_once('front-view.php');