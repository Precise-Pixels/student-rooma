<?php

$urlVars    = explode('/', $q);
$propertyId = $urlVars[2];

require_once('php/Properties.php');
$property = Properties::getProperty($propertyId);

if($property) {
    $file = 'app/property';
} else {
    $file = '404';
}