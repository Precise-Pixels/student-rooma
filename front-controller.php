<?php

ob_start();
session_start();

$q = $_GET['q'];

$isLanding                        = !preg_match('#^app|^landlord|^admin#', $q);

$isApp                            = preg_match('#^app#', $q);
$isAppIndex                       = preg_match('#^app/?$#', $q);
$isResendValidationEmail          = preg_match('#^app\/resend-validation-email/?$#', $q);
$isVerifyAccount                  = preg_match('#^app\/verify-account/?$#', $q);
$isResetPassword                  = preg_match('#^app\/reset-password/?$#', $q);
$isProfile                        = preg_match('#^app\/profile/?$#', $q);
$isProperties                     = preg_match('#^app\/properties/?$#', $q);
$isActivity                       = preg_match('#^app\/activity/?$#', $q);
$isProperty                       = preg_match('#^app\/property\/\d+/?$#', $q);
$isGallery                        = preg_match('#^app\/property\/\d+/gallery/?$#', $q);
$isInstall                        = preg_match('#^app\/install/?$#', $q);
$isAbout                          = preg_match('#^app\/about/?$#', $q);
$isPrivacy                        = preg_match('#^app\/privacy-policy/?$#', $q);
$isLogout                         = preg_match('#^app\/logout/?$#', $q);

$isLandlord                       = preg_match('#^landlord#', $q);
$isLandlordIndex                  = preg_match('#^landlord/?$#', $q);
$isLandlordResendValidationEmail  = preg_match('#^landlord\/resend-validation-email/?$#', $q);
$isLandlordVerifyAccount          = preg_match('#^landlord\/verify-account/?$#', $q);
$isLandlordResetPassword          = preg_match('#^landlord\/reset-password/?$#', $q);
$isLandlordActivity               = preg_match('#^landlord\/activity/?$#', $q);
$isLandlordAllProperties          = preg_match('#^landlord\/all-properties/?$#', $q);
$isLandlordNewProperty            = preg_match('#^landlord\/new-property/?$#', $q);
$isLandlordBuyCredits             = preg_match('#^landlord\/buy-credits/?$#', $q);
$isLandlordUpdateRoomAvailability = preg_match('#^landlord\/update-room-availability/?$#', $q);
$isLandlordRemoveProperty         = preg_match('#^landlord\/remove-property/?$#', $q);

$isAdmin                          = preg_match('#^admin#', $q);
$isAdminIndex                     = preg_match('#^admin/?$#', $q);
$isAdminActivity                  = preg_match('#^admin\/activity/?$#', $q);
$isAdminAllProperties             = preg_match('#^admin\/all-properties/?$#', $q);
$isAdminNewProperty               = preg_match('#^admin\/new-property/?$#', $q);
$isAdminUpdateRoomAvailability    = preg_match('#^admin\/update-room-availability/?$#', $q);
$isAdminDeleteProperty            = preg_match('#^admin\/delete-property/?$#', $q);
$isAdminLandlordCredits           = preg_match('#^admin\/landlord-credits/?$#', $q);

$path = preg_replace('/\/$|.php/', '', $q);

if($isLanding) {
    if(empty($path)) {                                  // HOME
        $file = 'index';
    } elseif(file_exists("views/$path.php")) {
        $file = $path;                                  // LANDING SITE
    } elseif($path === 'app') {
        header('location: /app/');                      // REDIRECT TO APP
    } else {
        $file = '404';                                  // LANDING SITE 404 NOT FOUND
    }
}

if($isApp) {
    if($isAppIndex) {
        $file = 'app/index';                            // APP HOME
    } elseif($isResendValidationEmail || $isVerifyAccount || $isResetPassword || $isPrivacy) {
        $file = $path;                                  // ALLOW WITHOUT LOGGING IN
    } elseif(!isset($_SESSION['s_userId'])) {
        header('location: /app/');                      // NOT LOGGED IN
    } elseif(file_exists("views/$path.php")) {
        $file = $path;                                  // APP
    } else {
        $file = 'app/404';                              // APP 404 NOT FOUND
    }
}

if($isLandlord) {
    if($isLandlordIndex) {
        $file = 'landlord/index';
    } elseif($isLandlordResendValidationEmail || $isLandlordVerifyAccount || $isLandlordResetPassword) {
        $file = $path;                                  // ALLOW WITHOUT LOGGING IN
    } else {
        if(!isset($_SESSION['s_landlordId'])) {
            header("location: /landlord?r=" . urlencode(str_replace('/landlord/', '', $_SERVER['REQUEST_URI'])));
        } else {
            $file = $path;                              // LANDLORD PAGE
        }
    }
}

if($isAdmin) {
    if($isAdminIndex) {
        $file = 'admin/index';
    } else {
        if(!isset($_SESSION['s_admin'])) {
            header("location: /admin?r=" . urlencode(str_replace('/admin/', '', $_SERVER['REQUEST_URI'])));
        } else {
            $file = $path;                              // ADMIN PAGE
        }
    }
}

if($isAppIndex)   { require_once('models/model-index.php');      }
if($isProfile)    { require_once('models/model-profile.php');    }
if($isProperties) { require_once('models/model-properties.php'); }
if($isActivity)   { require_once('models/model-activity.php');   }
if($isProperty)   { require_once('models/model-property.php');   }
if($isGallery)    { require_once('models/model-gallery.php');    }

if($isLandlordActivity)               { require_once('models/model-landlord-activity.php');                 }
if($isLandlordAllProperties)          { require_once('models/model-landlord-all-properties.php');           }
if($isLandlordNewProperty)            { require_once('models/model-landlord-new-property.php');             }
if($isLandlordBuyCredits)             { require_once('models/model-landlord-buy-credits.php');              }
if($isLandlordUpdateRoomAvailability) { require_once('models/model-landlord-update-room-availability.php'); }

if($isAdminActivity)               { require_once('models/model-admin-activity.php');                 }
if($isAdminAllProperties)          { require_once('models/model-admin-all-properties.php');           }
if($isAdminUpdateRoomAvailability) { require_once('models/model-admin-update-room-availability.php'); }
if($isAdminDeleteProperty)         { require_once('models/model-admin-delete-property.php');          }
if($isAdminLandlordCredits)        { require_once('models/model-admin-landlord-credits.php');         }

require_once('front-view.php');