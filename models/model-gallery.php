<?php

$urlVars    = explode('/', $q);
$propertyId = $urlVars[2];

require_once('php/Properties.php');
$images = Properties::getImages($propertyId);

if($images) {
    $file = 'app/gallery';
} else {
    $file = '404';
}