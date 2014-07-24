<?php

$urlVars    = explode('/', $q);
$propertyId = $urlVars[1];

require_once('php/Properties.php');
$images = Properties::getImages($propertyId);

if($images) {
    $file = 'gallery';
} else {
    $file = '404';
}